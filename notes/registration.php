
<!DOCTYPE html>
<html>
<head>
	<title>registration</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/styles.css">

	<!--  AJAX Script!-->
	<!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
	<!-- Script -->
	<script type="text/javascript">
        $(document).ready(function () {

            $("#btn_register").click(function () {
                console.log("clicked");
                username = $("#username").val();
                email = $("#email").val();
                password = $("#password").val();
                confirmPassword = $("#confirmPassword").val();

                $.ajax({
                    type: "POST",
                    url: "adduser.php",
                    data: "username=" + username + "&email=" + email + "&password=" + password+"&confirmPassword=" + confirmPassword,
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

                        } else if (html == 'username') {
                            $("#err_desc").html('<div class="alert alert-danger"> \
                                                 <strong>First Name</strong> is required. \ \
                                                 </div>');
												 
						} else if (html == 'confirmPassword') {
                            $("#err_desc").html('<div class="alert alert-danger"> \
                                                 <strong>enter same password</strong> is required. \ \
                                                 </div>');

                        } else if (html == 'eshort') {
                            $("#err_desc").html('<div class="alert alert-danger"> \
                                                 <strong>Email Address</strong> is required. \ \
                                                 </div>');

                        } else if (html == 'eformat') {
                            $("#err_desc").html('<div class="alert alert-danger"> \
                                                 <strong>Email Address</strong> format is not valid. \ \
                                                 </div>');
												 
						} else if (html == 'pshort') {
                            $("#err_desc").html('<div class="alert alert-danger"> \
                                                 <strong>Password</strong> must be at least 4 characters . \ \
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
     		<h1> Registration form</h1>
     	</div>
 <div id="err_desc"></div>
 <form role="form" >
      <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">username</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="username" name="username" placeholder="enter username">
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">email</label>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="email" name="email" placeholder="enter email">
        </div>
      </div>
      <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
      </div>
      <div class="form-group row">
        <label for="confirmPassword" class="col-sm-2 col-form-label">confirmPassword</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder=" Confirm Password">
        </div>
      </div>
      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10">
          <input type="submit" value="submit" id ="btn_register" name="btn_register" class="btn btn-primary"/>
        </div>
      </div>
    </form>
    <p> Already a user?> <a href="login.php">Login</a></p>
</div>

</body>
</html>