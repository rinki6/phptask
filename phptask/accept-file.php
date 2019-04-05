<?php
error_reporting(0);
?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<html>
<head>
<title>PHP File Upload example</title>
</head>
<body>
  <div class="header">
    <?php  if (isset($_SESSION['username'])) : ?>
    <h5 id ="logout"> <a href="index.php?logout='1'" style="color: red;">logout</a> </h5>
      <h2>Welcome <strong><?php echo $_SESSION['username']; ?></strong></h2>
 <h5 id ="logout"> <a href="index.php" style="color: red;">go back to index page</a> </h5>
    <?php endif ?>
</div>
<form action="accept-file.php" enctype="multipart/form-data" method="post">
Select image :
<input type="file" name="file"><br/>
<input type="submit" value="Upload" name="Submit1"> <br/>


</form>
<div class="pager">
<?php
include('pager.php');
?>
</div>
<?php
$filename = $_FILES['file']['name'];
$tempname = $_FILES["file"]["tmp_name"];
$folder = 'uploads/'.$filename;
move_uploaded_file($tempname, $folder);
if (is_uploaded_file($_FILES['file']['tmp_name'])) {
    echo "File :". $_FILES['file']['name']."uploaded successfully.\n";
} else {
    echo "error";
}
echo "<img src='$folder' height=200 width=300 />";
?>

</body>
</html>
