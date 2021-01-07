<?php
session_start();
define("PATH_ROOT", dirname(__FILE__));
include_once PATH_ROOT . "/config/Database.php";
include_once PATH_ROOT . "/list/Items.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>notes</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .table td,th{
      font-size: 1rem;
    }
    .table{
      margin: 50px;
    }
  </style>
</head>
<body>


<!-- insert form modal-->
<div class="modal modal-nutrition fade full-height from-right" id="create-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-12">
            <h4 class="modal-title">Insertion Form</h4>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <form role="form" id = "insert_form" method="POST" >
       <div class="form-group row">
        <label for="insert_description" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="insert_description" name="insert_description" placeholder="enter description">
        </div>
      </div>
      
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
          <div class="modal-footer">
        <button type="button" class="btn btn-flat-secondary" data-dismiss="modal">Cancel</button>
        <input type="submit" value="insert" id ="btn_insert_note" name="btn_insert_note" class="btn btn-primary"/>
      </div>
        </div>
      </div>
    </form>
      </div>
      
    </div>
  </div>
</div>

<!-- update form modal-->
<div class="modal modal-nutrition fade full-height from-right" id="panel-modal2" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
          <div class="col-md-12">
            <h4 class="modal-title">Update Form</h4>
          </div>
        </div>
      </div>
      <div class="modal-body">
        <form role="form" id = "update_form" method="POST">
       <div class="form-group row">
        <label for="update_description" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="update_description" name="update_description" placeholder="enter description">
        </div>
      </div>
      
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
          <div class="modal-footer">
        <button type="button" class="btn btn-flat-secondary" data-dismiss="modal">Cancel</button>
        <input type="submit" value="update" id ="btn_upd_desc" name="btn_upd_desc" class="btn btn-primary"/>
      </div>
        </div>
      </div>
    </form>
      </div>
      
    </div>
  </div>
</div>


	<h3> welcome <?php echo $_SESSION['username']?>
  <div id="err_desc"></div>
	
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">id</th>
      <th scope="col">Description</th>
      <th scope="col">created_at</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody id ="out">

    <!-- get records to display -->
    <?php
    $db = (new Database())->getMYSQLI();
    $items = new Items($db);
    $results = $items->getItemByUserName($_SESSION['username']);
    while( $row = $results->fetch_assoc())
    {
      ?>
   <tr>
      <th scope='row' class='id'><?php echo $row['id'] ?></th>
      <td class ='description'> <?php echo $row['description'] ?></td>
      <td class = 'created_at'><?php echo $row['created_at'] ?></td>
      <td>
        <button class='btn_delete btn btn-primary'>delete</button>
        <button class='btn_update btn btn-primary' data-toggle='modal' data-target='#panel-modal2'>update</button>
      </td></tr>




    <?php
    }
    ?>
    
    
  </tbody>
  <button class="btn btn-primary" id ="btn_logout"> logout</button>
  <button class="btn btn-primary" data-toggle="modal" data-target="#create-modal"id ="btn_inser"> insert</button>
</table>


  <!-- Script -->

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  
  <!-- Ajax operations!-->
  <script type="text/javascript">
  console.log("entered");
        $(document).ready(function () {
            
           // getData();

            $("#btn_insert").click(function () {
                console.log("clicked insert button");
                /*ajax operation*/
                 $.ajax({
                    type: "POST",
                    url: "ajaxinsert.php",
                    data: "description= done" + "&action= insert",
                    success: function (data) {
                        $("#err_desc").html('<div class="alert alert-success"> \
                                                 <strong>'+data+'</strong> . \ \
                                                 </div>');
                        if (data == 'inserted') {

                            $("#err_desc").html('<div class="alert alert-success"> \
                                                 <strong>successfully inserted</strong> . \ \
                                                 </div>');
                           // getData();
                           window.location.href="index.php";

                        } 
                         else {
                            $("#err_desc").html('<div class="alert alert-danger"> \
                                                 <strong>Error</strong> processing request. Please try again. \ \
                                                 </div>');
                        }
                        

                    },
                    beforeSend: function () {
                        $("#err_desc").html("loading...");
                    }
                });
            });
            //logout session
            $("#btn_logout").click(function () {
                console.log("clicked logout button");

              //ajax logout 
               $.ajax({
                    type: "POST",
                    url: "ajaxlogout.php",
                    data: "action=logout",
                    success: function (data) {
                      console.log(data);
                      window.location.href = "login.php";
                    },
                    beforeSend: function () {
                        $("#err_desc").html("loading...");
                    }
                });


            });

            //delete record
            $(".btn_delete").click(function () {
                console.log("clicked delete button");
                var $item = $(this).closest("tr")   // Finds the closest row <tr> 
                       .find(".id")     // Gets a descendent with class="nr"
                       .text();         // Retrieves the text within <td>
                console.log($item);

                /* ajax operations*/
                $.ajax({
                    type: "POST",
                    url: "ajaxdelete.php",
                    data: "id= "+ $item + "&action=delete",
                    success: function (data) {
                        $("#err_desc").html('<div class="alert alert-success"> \
                                                 <strong>'+data+'</strong> . \ \
                                                 </div>');
                        window.location.href = "index.php";
                       /* if (data == 'true') {

                            $("#err_desc").html('<div class="alert alert-success"> \
                                                 <strong>successfully inserted</strong> . \ \
                                                 </div>');

                        } 
                         else {
                            $("#err_desc").html('<div class="alert alert-danger"> \
                                                 <strong>Error</strong> processing request. Please try again. \ \
                                                 </div>');
                        }*/


                    },
                    beforeSend: function () {
                        $("#err_desc").html("loading...");
                    }
                });
            });

            $itemid="";

            //update
            $(".btn_update").click(function () {
                console.log("clicked update button");
                $itemid = $(this).closest("tr")   // Finds the closest row <tr> 
                       .find(".id")     // Gets a descendent with class="nr"
                       .text();         // Retrieves the text within <td>
                console.log($itemid);

            });

            //form update submission
             $(document).on('submit', '#update_form', function(event){
              event.preventDefault();
              $desc = $('#update_description').val();
                $.ajax({
                  type: "POST",
                  url: "ajaxupdate.php",
                  data:"id="+$itemid+"&description="+$desc,
                  success: function(data){
                    if(data == 'true')
                    {
                       window.location.href = "index.php";
                       console.log($itemid+" "+$desc);
                      $itemid="";
                      $('#update_form')[0].reset();
                      $('#update_description').text("");
                    }
                  }

                })
                
           
             });

             //insert form
              $(document).on('submit', '#insert_form', function(event){
              event.preventDefault();
              $desc = $('#insert_description').val();
                $.ajax({
                  type: "POST",
                  url: "ajaxinsert.php",
                  data:"description="+$desc,
                  success: function(data){
                    if(data == 'inserted')
                    {
                       window.location.href = "index.php";
                      $('#insert_form')[0].reset();
                      $('#insert_description').text("");
                    }
                  }

                })
                
           
             });
              function getData()
              {
                 output="";
            $.ajax({
                    type: "POST",
                    url: "ajaxselect.php",
                    dataType: "json",
                    success: function (data) {
                      console.log(data);
                 
                      if(data)
                      {
                        for(i=0;i<data.length;i++)
                        {
                  
                          output += "<tr>"+
      "<th scope='row' class='id'> "+ data[i].id + "</th>"+
       "<td class ='description'> "+ data[i].description+ "</td>"+
      "<td class = 'created_at'>" + data[i].created_at+ "</td>"+
     "<td><button class='btn_delete btn btn-primary'>delete</button><button class='btn_update btn btn-primary'>update</button> </td></tr>";

                        }
                        $("#out").html(output);
                      }

                    }
                });

              } 
        });
    </script> 
</body>
</html>