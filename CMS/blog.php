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
  <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <title>Blog Page</title>
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
        
        <li class="nav-item">
          <a href="blog.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">About Us</a>
        </li>
        <li class="nav-item">
          <a href="blog.php" class="nav-link">Blog</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Contact Us </a>
        </li>
        <li class="nav-item">
          <a href="Comments.php" class="nav-link">Features</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <form class="form-inline d-none d-sm-block" action="blog.php">
            <div class="form-group">
                <input type="form-control mr-1" name="Search" placeholder="Search Here" value="">
                <button  class="btn btn-primary"name="SearchButton">Go</button>
               
            </div>
        </form>
      </ul>
    </div>
  </nav>
  <div style="height:10px; background: #27aae1;"></div>
  <!--NAVBAR END-->

  <!--HEADER-->
  <div class="container">
    <div class="row mt-4">
        <!--main area start-->
        <div class="col-sm-8 "  >
        <h1>The Complete Responsive FUOYE CMS Blog</h1>
        <h1 class="lead">By LULU using PHP</h1>
        <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?>
        <?php 
        global $ConnectingDB;
         if(isset($_GET["SearchButton"])){
            $Search = $_GET["Search"];
            $sql="SELECT * FROM posts WHERE datetime LIKE :search 
            OR title LIKE :search
            OR category LIKE :search 
            OR post LIKE :search";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue(":search",'%'.$Search.'%');
            $stmt->execute();

         }

        //The default SQL query
        else{
            $sql = "SELECT * FROM posts ORDER BY id desc";
            $stmt =$ConnectingDB->query($sql);
        }
        
        while ($DataRows = $stmt->fetch()){
            //code...
            $PostId = $DataRows['id'];
            $DateTime = $DataRows['datetime'];
            $PostTitle = $DataRows['title'];
            $Category =$DataRows['category'];
            $Admin = $DataRows['author'];
            $Image = $DataRows['image'];
            $PostDescription =$DataRows['post'];
         ?>
        <div class="card">
            <img src="upload/<?php echo htmlentities ($Image);?>" style="max-height:450px;" class="img-fluid card-img-top"/>
            <span style="float:right;" class="badge badge-dark text-light">Comments 20</span>
            <div class="card-body">
                <h4 class="card-title"><?php echo htmlentities ($PostTitle);?></h4>
                <small class="text-muted">Written by<?php echo htmlentities ($Admin);?>On <?php echo htmlentities ($DateTime); ?></small>
                <hr>
                <p class="card-text">
                    <?php if(strlen($PostDescription)>150) {
                    $PostDescription = substr($PostDescription,0,150)."...";} echo htmlentities ($PostDescription); ?></p>
                <a href="FullPost.php?id=<?php echo $PostId; ?>" style="float:right;">
                    <span class="btn btn-info">Read More >></span>
                </a>
            </div>
        </div>
        </div>
        <div class="col-sm-4" style="min-height:40px; background:green;">
        </div>

        </div>

    </div>
        <?php } ?>
  </div>
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
        <form class="" action="addnewpost.php" method="post" enctype="multipart/form-data">
          <div class="card bg-secondary text-light mb-3">

            <div class="card-body bg-dark">
              <div class="form-group">
                <label for="title"><span class="FieldInfo">Post Title:</span></label>
                <input class="form-control" type="text" name="PostTitle" id="title" placeholder="Type title here">
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
                  <a href="Dashboard.php" class="btn btn-warning btn-block "><I apologize for the abrupt ending of the response. Here's the continuation of the code:

```php
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

