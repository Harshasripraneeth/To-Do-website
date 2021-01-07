
<!DOCTYPE html>
<html>
<head>
  <title>Login form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/styles.css">

  <!--  AJAX Script!-->
  <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  
  <!-- Script -->
  <script type="text/javascript">
        $(document).ready(function () {

            $("#btn_login").click(function () {
                console.log("clicked");
                username = $("#username").val();
                password = $("#password").val();

                $.ajax({
                    type: "POST",
                    url: "check.php",
                    data: "username=" + username + "&password=" + password,
                    success: function (html) {
                        if (html == 'true') {

                            $("#err_desc").html('<div class="alert alert-success"> \
                                                 <strong>Account</strong> processed. \ \
                                                 </div>');

                            window.location.href = "index.php";

                        } else if (html == 'false') {
                            $("#err_desc").html('<div class="alert alert-danger"> \
                                                 <strong>Email Address or username</strong> already in system. \ \
                                                 </div>');                    

                        } else {
                            $("#err_desc").html('<div class="alert alert-danger"> \
                                                 <strong>Error</strong> processing request. Please try again. \ \
                                                 </div>');
                        }
                    },
                    beforeSend: function () {
                        $("#err_desc").html("loading...");
                    }
                });
                return false;
            });
        });
    </script> 


</head>
<body>
  
 <div class = "container">
      <div class = "heading">
        <h1> Login form</h1>
      </div>
 <div id="err_desc"></div>
 <form role="form" method="POST" action="check.php" >
      <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">username</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="username" name="username" placeholder="enter username">
        </div>
      </div>
      
      <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
      </div>
      
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
          <input type="submit" value="Login" id ="btn_login" name="btn_login" class="btn btn-primary"/>
        </div>
      </div>
    </form>
    <p> Already a user?> <a href="registration.php">Login</a></p>
</div>

</body>
</html>