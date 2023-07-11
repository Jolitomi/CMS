<?php
require_once("includes/db.php");
require_once("includes/functions.php");
require_once("includes/sessions.php");

if (isset($_GET['id'])) {
  $SearchQueryParameter = $_GET['id'];

  // Fetching existing content
  global $ConnectingDB;
  $sql = "SELECT * FROM post WHERE id='$SearchQueryParameter'";
  $stmtpost = $ConnectingDB->query($sql);
  while ($DataRows = $stmtpost->fetch()) {
    $TitleToBeDeleted = $DataRows['title'];
    $CategoryToBeDeleted = $DataRows['category'];
    $ImageToBeDeleted = $DataRows['image'];
    $PostToBeDeleted = $DataRows['post'];
  }

  if (isset($_POST["Submit"])) {
    // Query to delete post
    global $ConnectingDB;
    $sql = "DELETE FROM post WHERE id='$SearchQueryParameter'";
    $Execute = $ConnectingDB->query($sql);

    if ($Execute) {
      $Target_Path_To_Delete_Image = "Upload/$ImageToBeDeleted";
      unlink($Target_Path_To_Delete_Image);
      $_SESSION["SuccessMessage"] = "Post Deleted Successfully";
      Redirect_to("post.php");
    } else {
      $_SESSION["ErrorMessage"] = "Something went wrong. Try Again!";
      Redirect_to("post.php");
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
  <title>Delete Post</title>
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
          <h1><i class="fa fa-edit" style="color: aqua;"></i>Delete Post </h1>
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
      <form class="" action="deletepost.php?id=<?php echo $SearchQueryParameter ?>" method="post" enctype="multipart/form-data">
        <div class="card bg-secondary text-light mb-3">
          <div class>
            <div class="card-body bg-dark">
              <div class="form-group">
                <label for="title"><span class="FieldInfo">Post Title:</span></label>
                <input disabled class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here" value="<?php echo $TitleToBeDeleted ?>">
              </div>

              <div class="form-group">
                <span class="FieldInfo">Existing Category:</span>
                <?php echo $CategoryToBeDeleted;?>
                <br>
              </div>
              <div class="form-group">
                <span class="FieldInfo">Existing Image:</span>
                <img class="mb-1" src="upload/<?php echo $ImageToBeDeleted;?>" width="170px" height="70px">

                <?php echo $CategoryToBeDeleted;?>
               
              </div>
              <div class="form-group">
                <label for="Post"><span class="FieldInfo">Post:</span></label>
                <textarea disabled class="form-control" id="" name="PostDescription" cols="80" rows="8"><?php echo $PostToBeDeleted?></textarea>
              </div>
              <div class="row">
                <div class="col-lg-6 mb-2">
                  <a href="Dashboard.php" class="btn btn-warning btn-block ">
                    <i class="fa fa-arrow-left"></i>Back To Dashboard</a>
                </div>
                <div class="col-lg-6 mb-2">
                  <button type="submit" name="Submit" class="btn btn-danger btn-block ">
                    <i class="fa fa-trash"></i>Publish</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- Display error messages outside the form -->
<?php
echo ErrorMessage();
echo SuccessMessage();
?>

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

