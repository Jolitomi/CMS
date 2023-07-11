<?php
require_once("includes/db.php");
require_once("includes/functions.php");
require_once("includes/sessions.php");
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
    <title>Posts</title>
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
            <li class="nav-item"><a href="Logout.php" class="nav-link"><i class="fa fa-user-times text-danger"></i> Logout</a></li>
          </ul>
        </div>
      </nav>
      <div style="height:10px; background: #27aae1;"></div>
      <!--NAVBAR END-->
         
         <!--HEADER-->  
          <header class="bg-dark text-white py-3">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <h1><i class="fa fa-blog" style="color: #27aae1;"></i>Blog Posts </h1>
    
                </div>
                <div class="col-lg-3 mb-2" >
                  <a href="addnewpost.php" class="btn btn-primary btn-block">
                    <i class="fa fa-folder-edit"></i>Add New post
                  </a>
                </div>
                <div class="col-lg-3 mb-2">
                  <a href="categories.php" class="btn btn-info btn-block">
                    <i class="fa fa-folder-plus"></i>Add New Category
                  </a>
                </div>
                <div class="col-lg-3 mb-2">
                  <a href="Admins.php" class="btn btn-warning btn-block">
                    <i class="fa fa-user-plus"></i>Add New Admin
                  </a>
                </div>
                <div class="col-lg-3 mb-2">
                  <a href="comments.php" class="btn btn-success btn-block">
                    <i class="fa fa-check"></i>Add New Comments
                  </a>
                </div>
              </div>
            </div>
          </header>
          <!--HEADER END-->

          
          <!--MainArea-->
          <section class="container py-2 mb-4">
            <div class="row">
              <div class="col-lg-12">
              <?php
                echo ErrorMessage();
                echo SuccessMessage();
              ?>
                <table class="table table-striped table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Date&Time</th>
                      <th>Author</th>
                      <th>Banner</th>
                      <th>Comments</th>
                      <th>Action</th>
                      <th>Live Preview</th>
                    </tr>
                  </thead>  
                 <!-- ... previous code ... -->

<?php
global $ConnectingDB;
$sql = "SELECT * FROM post";
$stmt = $ConnectingDB->query($sql);
$Sr = 0;
while ($DataRows = $stmt->fetch()) {
  $Id           = $DataRows["id"];
  $DateTime     = $DataRows["datetime"];
  $PostTitle    = $DataRows["title"];
  $Category     = $DataRows["category"];
  $Admin        = $DataRows["author"];
  $Image        = $DataRows["image"];
  $PostText     = $DataRows["post"];
  $Sr++; 
?> 
<tbody>
  <tr>
    <td><?php echo $Sr; ?></td>
    <td>
      <?php 
      if (strlen($PostTitle)>20){
        $PostTitle=substr($PostTitle,0,18).'..';
      } 
      echo $PostTitle; 
      ?>
    </td>
    <td>
      <?php 
      if (strlen($Category)>8){
        $Category=substr($Category,0,8).'..';
      } 
      echo $Category; 
      ?>
    </td>
    <td>
      <?php 
      if (strlen($DateTime)>11){
        $DateTime=substr($DateTime,0,11).'..';
      } 
      echo $DateTime; 
      ?>
    </td>
    <td>
      <?php 
      if (strlen($Admin)>6){
        $Admin=substr($Admin,0,6).'..';
      } 
      echo $Admin; 
      ?>
    </td>
    <td>
      <img src="upload/<?php echo $Image; ?>" width="170px" height="50px">
    </td>
    <td>Comments</td>
    <td>
      <a href="editPost.php?id=<?php echo $Id;?>"><span class="btn btn-warning">Edit</span></a>
      <a href="deletePost.php?id=<?php echo $Id;?>"><span class="btn btn-danger">Delete</span></a>
    </td>
    <td>
      <a href="FullPost.php?id=<?php echo $Id;?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a>
    </td>
  </tr>
<?php } ?>
 </tbody>
</table>
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