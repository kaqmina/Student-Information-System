<?php
  include('../commands/session.php');
  include('../commands/permissions.php');
  include('../commands/gradesbyclass.php');

  if($grade == 0) {
    echo '<script> function goBack() { window.history.back(); } goBack(); alert("You are not allowed to view this page!");</script>';
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title> Grades | Student Information Website </title>
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
              <li><a href="programs.php">Programs</a></li>
              <li><a href="subjects.php">Subjects</a></li>
              <li><a href="nationality.php">Nationality</a></li>
              <li><a href="religion.php">Religion</a></li>
              <li><a href="accounts.php">Accounts</a></li>
              <li class="active"><a href="grades.php">Grades</a></li>
              <li><a href="../commands/logout.php">Logout</a></li>
      			</ul>
      			<ul class="side-nav" id="mobile-demo">
              <li><a href="home.php">Home</a></li>
              <li><a href="students.php">Students</a></li>
              <li><a href="programs.php">Programs</a></li>
              <li><a href="subjects.php">Subjects</a></li>
              <li><a href="nationality.php">Nationality</a></li>
              <li><a href="religion.php">Religion</a></li>
              <li><a href="accounts.php">Accounts</a></li>
              <li class="active"><a href="grades.php">Grades</a></li>
        			<li><a href="../commands/logout.php">Logout</a></li>
      			</ul>
    		</div>
    		<div class="nav-content red darken-3">
      			<ul class="tabs tabs-transparent">
        			<li class="tab"><a href="#list">List</a></li>
              <?php
                if($gradeadd == 1) {
                  echo '<li class="tab"><a href="#add">Add New Grade</a></li>';
                } else {
                  echo '<li class="tab disabled"><a href="#add">Add New Grade</a></li>';
                }
              ?>
        			<span style="float: right;" class="tab"><?php echo $log_session; ?> &nbsp;&nbsp;&nbsp;</span>
      			</ul>
    		</div>
  		</nav>
	</header>
	<main>
    <!-- MODALS HERE -->
    
    <!-- EDIT MODAL -->
    <!-- Modal Structure -->
    <div id="edit" class="modal modal-fixed-footer">
      <div class="modal-content">
        <h4>Edit Grade Details</h4>
        <div class="divider"></div>
        <div class="row">
          <form class="col s12" method="post" action="../commands/editgrades.php">
            <div class="row">
            <input placeholder='' id="idedit" name="idedit" type="hidden" class="validate">
              <div class="input-field col s4">
                <input placeholder='' id="fullnameedit" name="fullnameedit" type="text" class="validate" disabled>
                <label for="fullnameedit">Fullname</label>
              </div>
              <div class="input-field col s4">
                <input placeholder='' id="subjectedit" name="subjectedit" type="text" class="validate" disabled>
                <label for="subjectedit">Subject</label>
              </div>
              <div class="input-field col s4">
                <input placeholder='' id="syearedit" name="syearedit" type="text" class="validate" onchange="isdigit(this.value)" maxlength="10">
                <label for="syearedit">School Year</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s4">
                <select name="semesteredit" id="semesteredit">
                  <option value="" disabled>Choose your option</option>
                  <option value="1" selected>First</option>
                  <option value="2">Second</option>
                  <option value="3">Summer</option>
                </select>
                <label>Semester</label>
              </div>
              <div class="input-field col s4">
                <input placeholder='' type="text" class="validate" name="gradeedit" id="gradeedit" maxlength="2">
                <label for="gradeedit">Grade</label>
              </div>
              <div class="input-field col s4">
                <input placeholder='' id="classcodeedit" name="classcodeedit" type="text" class="validate" onchange="isdigit2(this.value)" maxlength="10">
                <label for="classcodeedit">Class Code</label>
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
          <h5>List of Grades</h5>
          <p>You are currently viewing the list of grades. To sort, click on the heading.
          
          </p>
        </div>
        <div class="divider"></div>
        <?php
          include('../commands/databaseinfo.php');


          $sql = displaySubj();
          
          $result = mysqli_query($conn, $sql);
            //create table heading
            echo '
              <table id="dtable" class="sortable striped">
                <thead>
                  <tr>
                    <th> ID </th>
                    <th> Student </th>
                    <th> Subject </th>
                    <th> School Year </th>
                    <th> Semester </th>
                    <th> Grade </th>
                    <th> Class Code </th>
                  </tr>
                </thead>
                <tbody>
            ';
            if( $result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo "
                  <tr>
                    <td> {$row['id']}</td>
                    <td> {$row['fullname']}</td>
                    <td> {$row['title']}</td>
                    <td> {$row['schoolyear']}</td>
                    <td> {$row['semester']}</td>
                    <td> {$row['grade']}</td>
                    <td> {$row['classcode']}</td>";
                  if($gradeedit == 1) {
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
      if($gradeadd == 1) {
        echo '<div id="add" class="col s12">';
      } else {
        echo '<div class="col s12" style="display: none;">';
      }
    ?>
      <div class="container">
        <form method="post" action="../commands/insertgrades.php">
          <div class="row">
          <div class="section">
            <h5>Add New Grade</h5>
            <p>Add a grade to a student.</p>
          </div>
        </div>
        <div class="row divider"></div>
        <div class="row">
          <form class="col s12">
            <div class="row">
              <div class="input-field col s4">
                <input id="studid" name="studid" type="text" class="validate" maxlength="10" onchange="isdigit3(this.value)">
                <label for="studid">Student ID</label>
              </div>
              <div class="input-field col s4">
                <select name="subject" id="subject">
                  <?php
                    $servername = "localhost";
                    $username = "root";
                    $dbname = "school";
                    $password = '';
                    
                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    if($conn->connect_error) {
                        die("Connection failed " .$conn->connect_error);
                    }

                    $sql = "SELECT * FROM subject ORDER BY title ASC";
                    $result = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($result)) {
                      printf('<option value= "%d"> %s </option>', $row['id'], $row['title']);
                    }
                    mysqli_close($conn);
                  ?>
                </select>
                <label for="subject">Subject</label>
              </div>
              <div class="input-field col s4">
                <input id="syear" name="syear" type="text" class="validate" onchange="isdigit(this.value)" maxlength="10">
                <label for="syear">School Year</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s4">
                <select name="semester" id="semester">
                  <option value="" disabled>Choose your option</option>
                  <option value="1" selected>First</option>
                  <option value="2">Second</option>
                  <option value="3">Summer</option>
                </select>
                <label>Semester</label>
              </div>
              <div class="input-field col s4">
                <input type="text" class="validate" name="grade" id="grade" maxlength="2"  onchange="isdigit2(this.value)">
                <label for="bdate">Grade</label>
              </div>
              <div class="input-field col s4">
                <input id="classcode" name="classcode" type="text" class="validate" maxlength="10">
                <label for="classcode">Class Code</label>
              </div>
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
    $(document).ready(function() { $('#dtable').DataTable(); } );
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

    function isdigit2(x) {
      if(x >= 0) {

      } else {
        alert("Only input numbers.");
        reset2();
      }
    }

    function isdigit3(x) {
      if(x >= 0) {

      } else {
        alert("Only input numbers.");
        reset3();
      }
    }

    function reset() {
      document.getElementById('syear').value = "";
      document.getElementById('syearedit').value = "";
    }

    function reset2() {
      document.getElementById('grade').value = "";
      document.getElementById('gradeedit').value = "";
    }

     function reset3() {
      document.getElementById('syear').value = "";
      document.getElementById('syearedit').value = "";
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
      document.getElementById("fullnameedit").value = document.getElementById("dtable").rows[index].cells.item(1).innerHTML;
      document.getElementById("subjectedit").value = document.getElementById("dtable").rows[index].cells.item(2).innerHTML;
      document.getElementById("syearedit").value = document.getElementById("dtable").rows[index].cells.item(3).innerHTML;
      document.getElementById("semesteredit").value = document.getElementById("dtable").rows[index].cells.item(4).innerHTML;
      document.getElementById("gradeedit").value = document.getElementById("dtable").rows[index].cells.item(5).innerHTML;
      document.getElementById("classcodeedit").value = document.getElementById("dtable").rows[index].cells.item(6).innerHTML;
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