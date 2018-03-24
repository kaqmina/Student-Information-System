<?php
  session_start();
  include('databaseinfo.php');

  $check_user = $_SESSION['login_user'];

  $id = $_REQUEST['idedit'];
  $code = $_REQUEST['codeedit'];
  $title = $_REQUEST['titleedit'];
  $unit = $_REQUEST['unitsedit'];

  if(trim($code) == '' || trim($title) == '' || trim($unit) == '') {
    $msg = "Error. Please try again with valid inputs.";
    echo "<script type='text/javascript'> alert('$message');</script>";
    echo "ERROR: Meh..". mysqli_error($conn);
    header("Location: ../pages/subjects.php");
  } else {
    $sql = "UPDATE subject SET code = '$code', title = '$title', unit = $unit WHERE id = $id";
    if(mysqli_query($conn, $sql)) {
      echo "<script type='text/javascript'> alert('Record added successfully..');</script>";
      header("Location: ../pages/subjects.php");
    } else {
      $msg = "Error. Please try again with valid inputs.";
      echo "<script type='text/javascript'> alert('$message');</script>";
      echo "ERROR: Meh..". mysqli_error($conn);
      header("Location: ../pages/subjects.php");
    }
  }
  
  mysqli_close($conn);
?>