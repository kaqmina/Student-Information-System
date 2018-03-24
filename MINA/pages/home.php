<?php
  include('../commands/session.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title> Home | Student Information Website </title>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../materialize/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../materialize/css/fonts.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../materialize/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
    <style type="text/css">
    	html {
		    font-family: GillSans, Calibri, Trebuchet, sans-serif;
		  }
		.toplogo {
			font-family: 'Keania One', cursive;
		}
		.maincontent {
			font-family: 'Quicksand', sans-serif;
		}
		body {
		    display: flex;
		    min-height: 100vh;
		    flex-direction: column;
		}

		main {
		    flex: 1 0 auto;
		}
    </style>
</head>
<body>
	<header>
		<nav class="nav-extended">
    		<div class="nav-wrapper red darken-2">
      			<a href="#" class="brand-logo toplogo"> &nbsp;&nbsp; Student Information Website</a>
     			<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        		<ul id="nav-mobile" class="right hide-on-med-and-down">
        			<li class="active"><a href="home.php">Home</a></li>
			        <li><a href="students.php">Students</a></li>
			        <li><a href="programs.php">Programs</a></li>
			        <li><a href="subjects.php">Subjects</a></li>
			        <li><a href="nationality.php">Nationality</a></li>
			        <li><a href="religion.php">Religion</a></li>
			        <li><a href="accounts.php">Accounts</a></li>
			        <li><a href="grades.php">Grades</a></li>
			        <li><a href="../commands/logout.php">Logout</a></li>
			  	</ul>
			  	<ul class="side-nav" id="mobile-demo">
			        <li class="active"><a href="home.php">Home</a></li>
			        <li><a href="students.php">Students</a></li>
			        <li><a href="programs.php">Programs</a></li>
			        <li><a href="subjects.php">Subjects</a></li>
			        <li><a href="nationality.php">Nationality</a></li>
			        <li><a href="religion.php">Religion</a></li>
			        <li><a href="accounts.php">Accounts</a></li>
			        <li><a href="grades.php">Grades</a></li>
        			<li><a href="../commands/logout.php">Logout</a></li>
      			</ul>
    		</div>
    		<div class="nav-content red darken-3">
      			<ul class="tabs tabs-transparent">
        			<li class="tab"><a class="active" href="#list">Home</a></li>
        			<span style="float: right;" class="tab"><?php echo $log_session; ?> &nbsp;&nbsp;&nbsp;</span>
      			</ul>
    		</div>
  		</nav>
	</header>
	<main>
	<div class="container">
		<div class="section">
			<h3 id="intro"> Welcome to Student Information Website!</h3>
		</div>
		<div class="divider"></div>
		<p> Here you can create, view, and alter details of the Student body, provided that you have the <u>permissions to do so</u>. In the 'Students' tab: view, add, and edit. 'Programs' tab: View, Add, Edit and Curriculum. 'Subjects' tab: view, add, and edit. 'Nationality' tab: view. 'Religion' tab: view. 'Accounts' tab: view, add, and edit. Lastly, 'Grades' tab: view, add, and edit.</p>
	</div>
		
	</main>
</body>
<footer class="page-footer red darken-2">
  	<div class="container">
	    <div class="row">
	        <div class="col l6 s12">
	        	<h6 class="white-text"><b>About Me</b></h6>
	        	<p class="grey-text text-lighten-4">This website is made for the completion of Web Development Course under Professor Bulao II.</p>
	      	</div>
	      	<div class="col l4 offset-l2 s12">
	        	<h6 class="white-text"><b>Account</b></h6>
	        	<ul>
	          	<li><a class="grey-text text-lighten-3" href="../commands/logout.php">Logout</a></li>
	        	</ul>
	      	</div>
	    </div>
	  	</div>
	  	<div class="footer-copyright">
	    <div class="container">© 2017 Kennethe Ann Mina<a class="grey-text text-lighten-4 right" href="#top">Page Top</a></div>
	</div>
</footer>
</html>