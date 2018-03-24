<?php
  include('../commands/loginuser.php');
  if(isset($_SESSION['login_user'])) {
    header("Location: ../pages/home.php");
  } 
?>
<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../materialize/css/materialize.min.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../materialize/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../materializejs/materialize.min.js"></script>
    <style type="text/css">
    </style>
  </head>

  <body>
    <form method="post">
      <center>
        <table frame="box">
          <tr>
            <td colspan="2"><center>  Login  </center></td>
          </tr>
          <tr>
            <td> Username:</td>
            <td> <input id="uname" type="text" name="uname"></td>
          </tr>
          <tr>
            <td> Password:</td>
            <td> <input id="pword" type="password" name="pword"></td>
          </tr>
          <tr>
            <td colspan="2" align="right"> <input name="submit" type="submit" value="Login"></td>
          </tr>
        </table>
      <span><?php echo $invalid; ?></span>
      </center>
    </form>
  </body>
</html>