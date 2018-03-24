<?php
  include('../commands/session.php');
  include('../commands/permissions.php');

  if($program == 0) {
    echo '<script> function goBack() { window.history.back(); } goBack(); alert("You are not allowed to view this page!");</script>';
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title> Programs | Student Information Website </title>
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../materialize/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../materialize/css/fonts.css"  media="screen,projection"/>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="../materialize/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../materialize/js/materialize.min.js"></script>
    <script type="text/javascript" src="../tbsorter/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="../materialize/js/bootstrap-sortable.js"></script>
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
        			<li><a href="home.php">Home</a></li>
              <li><a href="students.php">Students</a></li>
              <li class="active"><a href="programs.php">Programs</a></li>
              <li><a href="subjects.php">Subjects</a></li>
              <li><a href="nationality.php">Nationality</a></li>
              <li><a href="religion.php">Religion</a></li>
              <li><a href="accounts.php">Accounts</a></li>
              <li><a href="grades.php">Grades</a></li>
              <li><a href="../commands/logout.php">Logout</a></li>
      			</ul>
      			<ul class="side-nav" id="mobile-demo">
              <li><a href="home.php">Home</a></li>
              <li><a href="students.php">Students</a></li>
              <li class="active"><a href="programs.php">Programs</a></li>
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
        			<li class="tab"><a href="#list">List</a></li>
              <?php
                if($programadd == 1) {
                  echo '<li class="tab"><a href="#add">Add New Program</a></li>';
                } else {
                  echo '<li class="tab disabled"><a href="#add">Add New Program</a></li>';
                }
              ?>
        			<span style="float: right;" class="tab"><?php echo $log_session; ?> &nbsp;&nbsp;&nbsp;</span>
      			</ul>
    		</div>
  		</nav>
	</header>
	<main>
    <!-- MODALS HERE -->
    <!-- VIEW CURRICULUM MODAL -->
    
    
    <!-- EDIT MODAL -->
    <!-- Modal Structure -->
    <div id="edit" class="modal modal-fixed-footer">
      <div class="modal-content">
        <h4>Edit Program Details</h4>
        <div class="divider"></div>
        <div class="row">
          <form class="col s12" action="../commands/editprograms.php">
            <div class="row">
              <input id="idedit" name="idedit" type="hidden" class="validate">
              <div class="input-field col s12">
                <input placeholder='' id="codeedit" name="codeedit" type="text" class="validate" maxlength="60">
                <label for="codeedit">Code</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input placeholder='' id="titleedit" name="titleedit" type="text" class="validate" maxlength="120">
                <label for="titleedit">Title</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input placeholder='' id="yearedit" name="yearedit" type="text" class="validate" onchange="isdigit(this.value)" maxlength="2">
                <label for="yearedit">Year</label>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Cancel</a>
        <button class="btn waves-effect waves-green btn-flat" type="submit" name="action" onclick="isEmpty()">Submit<i class="material-icons right">send</i></button>
        </form> 
      </div>
    </div>
    <!-- END MODALS -->
    <!-- MAIN TAB HERE -->
    <div id="list" class="col s12">
     <div class="container">
        <div class="section">
          <h5>List of Programs</h5>
          <p>You are currently viewing the list of programs offered by the university. To sort, click on the heading. 
          <br /> <a href="curriculum.php" class="waves-effect waves-red btn-flat "> Go to Curriculum</a>
          </p>
        </div>
        <div class="divider"></div>
        <?php
          include('../commands/databaseinfo.php');

          $sql = "SELECT * FROM program ORDER BY id";
          $result = mysqli_query($conn, $sql);
          //create table heading
          echo '
            <table id="dtable" class="sortable striped">
              <thead>
                <tr>
                  <th> ID </th>
                  <th> CODE </th>
                  <th> TITLE </th>
                  <th> YEAR </th>
                </tr>
              </thead>
              <tbody>
          ';
          if( $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "
                <tr>
                  <td> {$row['id']}</td>
                  <td> {$row['code']}</td>
                  <td> {$row['title']}</td>
                  <td> {$row['year']}</td>";
              if($programedit == 1) {
                echo "<td> <a class='modal-trigger waves-effect waves-light btn' href='#edit' onclick='editcell(this)'>Edit</a>  </td>";
              }
              echo "</tr>";
            }
            echo '</tbody></table></td></tr></center>';
          } else {
            echo "0 results";
          }
          
          mysqli_close($conn);
        ?>
      </div>
    </div>
    <!-- END MAIN TAB -->
    <!-- ADD TAB HERE -->
    <?php
      if($programadd == 1) {
        echo '<div id="add" class="col s12">';
      } else {
        echo '<div class="col s12" style="display: none;">';
      }
    ?>
      <div class="container">
        <div class="row">
          <div class="section">
            <h5>Add Program Details</h5>
            <p>Insert new program to offer.</p>
          </div>
        </div>
        <div class="row divider"></div>
        <div class="row">
          <form class="col s12" method="post" action="../commands/insertprogram.php">
            <div class="row">
              <div class="input-field col s12">
                <input id="code" name="code" type="text" class="validate" maxlength="60">
                <label for="code">Code</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="title" name="title" type="text" class="validate" maxlength="120">
                <label for="title">Title</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input id="year" name="year" type="text" class="validate" onchange="isdigit(this.value)" maxlength="2">
                <label for="year">Year</label>
              </div>
            </div>
          <div class="row">
            <span style="float: right;"><button class="btn waves-effect waves-green btn-flat" type="submit" name="action" onclick="isEmpty()">Submit<i class="material-icons right">send</i></button></span>
          </div>
        </form>
      </div>
    </div>
    </div>
		<!-- END ADD TAB -->
	</main>
  <script type="text/javascript">
    //$(document).ready(function() { $("#dtable").tablesorter(); }); 
    //$(document).ready(function() { $("#dtable").tablesorter( {sortList: [[0,0], [1,0]]} ); }); 
    $(document).ready(function() { $('#dtable').DataTable();} );
    $(document).ready(function() { $('.modal').modal(); });
    $(document).ready(function() { $('select').material_select(); });
    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15 // Creates a dropdown of 15 years to control year
    });

    var check = 0;

    function isdigit(x) {
      if(x >= 0) {

      } else {
        alert("Only input numbers.");
        reset();
      }
    }

    function reset() {
      document.getElementById('year').value = "";
      document.getElementById('yearedit').value = "";
    }

    function isEmpty() {
      if(check == 0) {
        if(document.getElementById("year").value == '' || document.getElementById("code").value == '' || document.getElementById("title").value == '') {
        alert("Please enter valid information in all fields.");
        }
      } else {
        check = 0;
        if(document.getElementById("yearedit").value == '' || document.getElementById("codeedit").value == '' || document.getElementById("titleedit").value == '') {
        alert("Please enter valid information in all fields.");
        }
      }
      
    }

    function editcell(x)  {
      check = 1;
      var index = x.parentNode.parentNode.rowIndex;
      document.getElementById("idedit").value = document.getElementById("dtable").rows[index].cells.item(0).innerHTML;
      document.getElementById("codeedit").value = document.getElementById("dtable").rows[index].cells.item(1).innerHTML;
      document.getElementById("titleedit").value = document.getElementById("dtable").rows[index].cells.item(2).innerHTML;
      document.getElementById("yearedit").value = document.getElementById("dtable").rows[index].cells.item(3).innerHTML;
    }
  </script>
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