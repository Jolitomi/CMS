<?php
require_once("includes/db.php");
require_once("includes/functions.php");
require_once("includes/sessions.php");
?>
<?php
if (isset($_POST["Submit"])){
    $UserName = $_POST["Username"];
    $Password = $_POST["password"];
    if(empty($UserName)||empty($Password)){
        $_SESSION["Error Message"]= "All fields must be filled out";
        Redirect_to("login.php");
    }else{
        // code for checking username and password from DB
       $Found_Account= Login_Attempt($UserName,$Password);
       if ($Found_Account) {
        $_SESSION["UserId"]=$Found_Account["id"];
        $_SESSION["UserName"]=$Found_Account["username"];
        $_SESSION["AdminName"]=$Found_Account["aname"];
        $_SESSION["SuccessMessage"]= "Welcome".$_SESSION["AdminName"]."!";
        Redirect_to("Dashboard.php");
       }else {
        $_SESSION["ErrorMessage"]= "Incorrect Username/Password";
        Redirect_to("login.php"); 
       }
    }  
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Login</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div>
          <a class="navbar-brand" href="#">FUOYE CMS</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
    
        </div>
      </nav>
      <div style="height:10px; background: #27aae1;"></div>
      <!--NAVBAR END-->
         <!--HEADER-->  
       <header class="bg-dark text-white py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1></h1>
                    </div>
                </div>
            </div>
       </header>
       <!--header end-->
       
       <!--Main Area-->
       <section class="container py-2 mb-4">
         <div class="row">
            <div class="offest-sm-3 col-sm-6" style="min-height: 500px;">
            <br><br><br>
            <?php
                echo ErrorMessage();
                echo SuccessMessage();
            ?>
            <div class="card bg-secondary text-light">
                <div class="card-header">
                    <h4>Welcome Back!</h4>
                    </div>
                    <div class="card-body bg-dark">
                    
                    <form class="" action="login.php" method="post">
                        <div class="form-group">
                            <label for="username"><span class="FieldInfo">Username</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-white bg-info"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="Username" id="username" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password"><span class="FieldInfo">Passwword</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-white bg-info"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" name="Password" id="passwor" value="">
                            </div>
                        </div>
                        <input type="submit" name="Submit" class="btn btn-info btn-block" value="Login">
                    </form>

                </div>

            </div>

            </div>

         </div>

       </section>
       <!--Main area end-->
      <br>
        <!--FOOTER-->
      <footer class="bg-dark text-white">
      <div class="container">
      <div class="row">
        <div class="col">
          <p class="lead text-center">Theme By | LULU |<span id="year"></span> &copy; ...All Right Reserved.</p>
        </div>
      </div>
    </div>
  </footer>
  <!--FOOTER END-->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script>
    $('#year').text(new Date().getFullYear());
  </script>

</body>

</html>
