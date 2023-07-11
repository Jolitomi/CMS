<?php
require_once("includes/db.php");
require_once("includes/functions.php");
require_once("includes/sessions.php");

if (isset($_POST["Submit"])) {
  $Category = $_POST["CategoryTitle"];
  $Admin =  $_SESSION["UserName"];
  date_default_timezone_set("Africa/Lagos");
  $CurrentTime = time();
  $DateTime = date("F-d-Y H:i:s", $CurrentTime);

  if (isset($_POST["Submit"])) {
    $PostTitle = $_POST["PostTitle"];
  // Rest of the code

  if (empty($Category)) {
    $_SESSION["ErrorMessage"] = "All field must be filled out";
    Redirect_to("categories.php");
  } elseif (strlen($Category) < 3) {
    $_SESSION["ErrorMessage"] = "Category title should be greater than 2 characters";
    Redirect_to("categories.php");
  } elseif (strlen($Category) > 49) {
    $_SESSION["ErrorMessage"] = "Category title should be less than 50 characters";
    Redirect_to("categories.php");
  } else {
    // Query to insert category in DB when everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO category (title, author, datetime) ";
    $sql .= "VALUES (:categoryName, :adminName, :dateTime)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':categoryName', $Category);
    $stmt->bindValue(':adminName', $Admin);
    $stmt->bindValue(':dateTime', $DateTime);
    $Execute = $stmt->execute();

    if ($Execute) {
      $_SESSION["SuccessMessage"] = "Category with id: " . $ConnectingDB->lastInsertId() . " added Successfully";
      Redirect_to("categories.php");
    } else {
      $_SESSION["ErrorMessage"] = "Something went wrong. Try Again!";
      Redirect_to("categories.php");
    }
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
  <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>Categories</title>
</head>

<body>
  <div style="height:10px; background: #27aae1;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">FUOYE CMS</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS"></div>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a href="MyProfile.php" class="nav-link"><i class="fa fa-user text-success"></i> My Profile</a>
        </li>
        <li class="nav-item">
          <a href="Dashboard.php" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="Posts.php" class="nav-link">Posts</a>
        </li>
        <li class="nav-item">
          <a href="Categories.php" class="nav-link">Categories</a>
        </li>
        <li class="nav-item">
          <a href="Admins.php" class="nav-link">Manage Admins</a>
        </li>
        <li class="nav-item">
          <a href="Comments.php" class="nav-link">Comments</a>
        </li>
        <li class="nav-item">
          <a href="Blog.php?page=1" class="nav-link">Live Blog</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="Logout.php" class="nav-link"><i class="fa fa-user-times text-danger"></i>
            Logout</a></li>
      </ul>
    </div>
  </nav>
  <div style="height:10px; background: #27aae1;"></div>
  <!--NAVBAR END-->

  <!--HEADER-->
  <header class="bg-dark text-white py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fa fa-edit" style="color: aqua;"></i>Add New Post </h1>
        </div>
      </div>
    </div>
  </header>
  <!--HEADER END-->
  <br>
  <!--Main-->
  <section class="container py-2 mb-4">
    <div class="row">
      <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
        <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?>
        <form class="" action="categories.php" method="post" enctype="multipart/form-data">
          <div class="card bg-secondary text-light mb-3">
          <div class="card-header">
                <h1>Add New Categories</h1>
            </div>

            <div class="card-body bg-dark">
              <div class="form-group">
                <label for="title"><span class="FieldInfo">Category Title:</span></label>
                <input class="form-control" type="text" name="CategoryTitle" id="title" placeholder="Type title here">
              </div>
              <div class="form-group">
                <label for="CategoryTitle"><span class="FieldInfo">Choose Category</span></label>
                <select class="form-control" id="CategoryTitle" name="CategoryTitle">
                  
                  <?php
                  require_once("includes/db.php");
                  // Fetching all categories from the category table
                  global $ConnectingDB;
                  $sql = "SELECT * FROM category";
                  $stmt = $ConnectingDB->query($sql);
                  while ($DataRows = $stmt->fetch()) {
                    // Display categories as options
                    $CategoryId = $DataRows["id"];
                    $CategoryName = $DataRows["title"];
                    ?>
                    <option value="<?php echo $CategoryId; ?>"><?php echo $CategoryName; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group mb-1">
                <div class="custom-file">
                  <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
                  <label for="imageSelect" class="custom-file-label">Select Image</label>
                </div>
              </div>
              <div class="form-group">
                <label for="Post"><span class="FieldInfo">Post:</span></label>
                <textarea class="form-control" id="" name="PostDescription" cols="80" rows="8"></textarea>
              </div>
              <div class="row">
                <div class="col-lg-6 mb-2">
                  <a href="Dashboard.php" class="btn btn-warning btn-block ">
                    <i class="fa fa-arrow-left"></i>Back To Dashboard</a>
                </div>
                <div class="col-lg-6 mb-2">
                  <button type="submit" name="Submit" class="btn btn-success btn-block ">
                    <i class="fa fa-check"></i>Publish</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  
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
