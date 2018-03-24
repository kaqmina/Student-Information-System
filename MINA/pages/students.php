<?php
  include('../commands/session.php');
  include('../commands/permissions.php');

  if($student == 0) {
    echo '<script> function goBack() { window.history.back(); } goBack(); alert("You are not allowed to view this page!");</script>';
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title> Students | Student Information Website </title>
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
              <li class="active"><a href="students.php">Students</a></li>
              <li><a href="programs.php">Programs</a></li>
              <li><a href="subjects.php">Subjects</a></li>
              <li><a href="nationality.php">Nationality</a></li>
              <li><a href="religion.php">Religion</a></li>
              <li><a href="accounts.php">Accounts</a></li>
              <li><a href="grades.php">Grades</a></li>
              <li><a href="../commands/logout.php">Logout</a></li>
      			</ul>
      			<ul class="side-nav" id="mobile-demo">
              <li><a href="home.php">Home</a></li>
              <li class="active"><a href="students.php">Students</a></li>
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
        			<li class="tab"><a href="#list">List</a></li>
              <?php
                if($studadd == 1) {
                  echo '<li class="tab"><a href="#add">Add New Student</a></li>';
                } else {
                  echo '<li class="tab disabled"><a href="#add">Add New Student</a></li>';
                }
              ?>
        			
        			<span style="float: right;" class="tab"><?php echo $log_session; ?> &nbsp;&nbsp;&nbsp;</span>
      			</ul>
    		</div>
  		</nav>
	</header>
	<main>
    <!-- MODALS HERE -->
    <!-- VIEW GRADES MODAL -->
    <div id="view" class="modal modal-fixed-footer">
      <div class="modal-content">
        <h4>View Grades</h4>
        
        <div class="row">
          <form class="col s12" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
          <div class="row">
            <input placeholder='' id="idview" name="idview" type="hidden" class="validate">
            <button class='btn-flat waves-effect waves-light' type='submit'>Click to View Grades</button>
            <div class="divider"></div>
                <?php
                  include('../commands/databaseinfo.php');
                  if ($_SERVER ["REQUEST_METHOD"] == "POST") {
                    $id = $_POST["idview"];

                    $sql = "SELECT * FROM grade JOIN student ON grade.student_id = student.id LEFT JOIN subject ON grade.subject_id = subject.id WHERE student.id = $id";
                    $result = mysqli_query($conn, $sql);
                    $rows = mysqli_num_rows($result);

                    echo '
                      <table id="dtable" class="sortable striped">
                        <thead>
                          <tr>
                            <th> Subject Code </th>
                            <th> Title </th>
                            <th> Grade </th>
                          </tr>
                        </thead>
                        <tbody>
                    ';

                    while($rows = mysqli_fetch_assoc($result)) {
                    echo "
                      <tr>
                        <td> {$rows['code']}</td>
                        <td> {$rows['title']}</td>
                        <td> {$rows['grade']}</td>
                      </tr>
                    ";

                    }

                    echo '
                      </tbody>
                      </table>
                    ';
                    mysqli_close($conn);
                  }
                ?>
              
            </div>
          </div>
        </div>
      <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Go back</a>
          </form> 
      </div>
    </div>

    <!-- EDIT MODAL -->
    <!-- Modal Structure -->
    <div id="edit" class="modal modal-fixed-footer">
      <div class="modal-content">
        <h4>Edit Student Details</h4>
        <div class="divider"></div>
        <div class="row">
          <form class="col s12" action="../commands/editstudent.php" method="post">
            <div class="row">
                <input placeholder='' id="idedit" name="idedit" type="hidden" class="validate">
              <div class="input-field col s4">
                <input placeholder='' id="fnameedit" name="fnameedit" type="text" class="validate">
                <label for="fnameedit">First Name</label>
              </div>
              <div class="input-field col s4">
                <input placeholder='' id="mnameedit" name="mnameedit" type="text" class="validate" maxlength="1">
                <label for="mnameedit">Middle Initial</label>
              </div>
              <div class="input-field col s4">
                <input placeholder='' id="lnameedit" name="lnameedit" type="text" class="validate">
                <label for="lnameedit">Last Name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s4">
                <select name="genderedit" id="genderedit">
                  <option id="gen" value="" disabled>Choose your option</option>
                  <option value="1" >Male</option>
                  <option value="0" selected>Female</option>
                </select>
                <label>Gender</label>
              </div>
              <div class="input-field col s4">
                <input placeholder='' type="date" class="datepicker" name="bdateedit" id="bdateedit">
                <label for="bdateedit">Birthdate</label>
              </div>
              <div class="input-field col s4">
                <select name="nationalityedit" id="nationalityedit">
                  <option value="" disabled>Choose your option</option>
                  <?php
                    include('../commands/databaseinfo.php');

                    $sql = "SELECT * FROM nationality";
                    $result = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($result)) {
                    printf('<option value= "%d"> %s </option>', $row['id'], $row['name']);
                    }
                    mysqli_close($conn);
                  ?>
                </select>
                <label>Nationality</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s4">
              <select name="isregularedit" id="isregularedit">
                <option value="" disabled>Choose your option</option>
                <option value="0" selected>No</option>
                <option value="1">Yes</option>
              </select>
              <label>Regular</label>
            </div>
            <div class="input-field col s4">
                <select name="yearstatusedit" id="yearstatusedit">
                  <option value="" disabled>Choose your option</option>
                  <option value="1" selected>1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
                <label>Year Status</label>
            </div>
            <div class="input-field col s4">
              <select name="programedit" id="programedit">
                <option value="" disabled>Choose your option</option>
                  <?php
                    include('../commands/databaseinfo.php');

                    $sql = "SELECT * FROM program";
                    $result = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($result)) {
                      printf('<option value= "%d"> %s </option>', $row['id'], $row['code']);
                    }
                    mysqli_close($conn);
                  ?>
              </select>
              <label>Program</label>
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
          <h5>List of Students</h5>
          <p>You are currently viewing the list of students enrolled in the university. To sort, click on the heading.</p>
        </div>
        <div class="divider"></div>
        <?php
          include('../commands/databaseinfo.php');

          $sql = "SELECT student.id, CONCAT(student.lastname,', ', student.firstname,' ',student.middlename) AS fullname, (CASE WHEN gender = 0 THEN 'Female' ELSE 'Male' END) AS gender, birthdate, nationality.name AS nationality, (CASE WHEN regular = 0 THEN 'Yes' ELSE 'No' END) AS regular, yearstatus, program.code AS program FROM (school.student JOIN school.nationality ON student.nationality_id = nationality.id) LEFT JOIN school.program ON student.program_id = program.id ORDER BY id";
          $result = mysqli_query($conn, $sql);
          //create table heading
          echo '
            <table id="dtable" class="sortable striped">
              <thead>
                <tr>
                  <th> ID </th>
                  <th> Fullname </th>
                  <th> Gender </th>
                  <th> Birthdate </th>
                  <th> Nationality </th>
                  <th> Regular </th>
                  <th> Year Status </th>
                  <th> Program </th>
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
                  <td> {$row['gender']}</td>
                  <td> {$row['birthdate']}</td>
                  <td> {$row['nationality']}</td>
                  <td> {$row['regular']}</td>
                  <td> {$row['yearstatus']}</td>
                  <td> {$row['program']}</td>";
              if($studview == 1) {
                echo "<td> <button data-target='view' class='btn waves-effect waves-light' onclick='viewgrades(this)'>View</button></td>";
              }
              if($studedit == 1) {
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
      if($studadd == 1) {
        echo '<div id="add" class="col s12">';
      } else {
        echo '<div class="col s12" style="display: none;">';
      }
    ?>
      <div class="container">
        <form method="post" action="../commands/insertstudents.php">
          <div class="row">
          <div class="section">
            <h5>Add New Student</h5>
            <p>Enroll a student to the university.</p>
          </div>
        </div>
        <div class="row divider"></div>
        <div class="row">
          <form class="col s12">
            <div class="row">
              <div class="input-field col s4">
                <input id="fname" name="fname" type="text" class="validate">
                <label for="fname">First Name</label>
              </div>
              <div class="input-field col s4">
                <input id="mname" name="mname" type="text" class="validate" maxlength="1">
                <label for="mname">Middle Initial</label>
              </div>
              <div class="input-field col s4">
                <input id="lname" name="lname" type="text" class="validate">
                <label for="lname">Last Name</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s4">
                <select name="gender" id="gender">
                  <option value="" disabled>Choose your option</option>
                  <option value="1" selected>Male</option>
                  <option value="0">Female</option>
                </select>
                <label>Gender</label>
              </div>
              <div class="input-field col s4">
                <input type="date" class="datepicker" name="bdate" id="bdate">
                <label for="bdate">Birthdate</label>
              </div>
              <div class="input-field col s4">
                <select name="nationality" id="nationality">
                  <option value="" disabled>Choose your option</option>
                  <?php
                    include('../commands/databaseinfo.php');

                    $sql = "SELECT * FROM nationality";
                    $result = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($result)) {
                    printf('<option value= "%d"> %s </option>', $row['id'], $row['name']);
                    }
                    mysqli_close($conn);
                  ?>
                </select>
                <label>Nationality</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s4">
              <select name="isregular" id="isregular">
                <option value="" disabled>Choose your option</option>
                <option value="0" selected>No</option>
                <option value="1">Yes</option>
              </select>
              <label>Regular</label>
            </div>
            <div class="input-field col s4">
                <select name="yearstatus" id="yearstatus">
                  <option value="" disabled>Choose your option</option>
                  <option value="1" selected>1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
                <label>Year Status</label>
            </div>
            <div class="input-field col s4">
              <select name="program" id="program">
                <option value="" disabled>Choose your option</option>
                  <?php
                    include('../commands/databaseinfo.php');

                    $sql = "SELECT * FROM program";
                    $result = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($result)) {
                      printf('<option value= "%d"> %s </option>', $row['id'], $row['code']);
                    }
                    mysqli_close($conn);
                  ?>
              </select>
              <label>Program</label>
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
    selectYears: 15, // Creates a dropdown of 15 years to control year
    format: 'yyyy-mm-dd'
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
        if(document.getElementById("fname").value == '' || document.getElementById("lname").value == '' || document.getElementById("mname").value == '') {
        alert("Please enter valid information in all fields.");
        }
      } else {
        check = 0;
        if(document.getElementById("fnameedit").value == '' || document.getElementById("lnameedit").value == '' || document.getElementById("mnameedit").value == '') {
        alert("Please enter valid information in all fields.");
        }
      }
    }

    function editcell(x)  {
      check = 1;
      var index = x.parentNode.parentNode.rowIndex;

      var str = document.getElementById("dtable").rows[index].cells.item(1).innerHTML;
      str = str.replace(', ', ' ');
      var split1 = str.split(' ');
      var lname = split1[1];
      var fname = split1[2];
      var mname = split1[3];

      var d = document.getElementById("dtable").rows[index].cells.item(3).innerHTML;
      var s = d.split(' ');
      var date = s[1];

      document.getElementById("idedit").value = document.getElementById("dtable").rows[index].cells.item(0).innerHTML;
      document.getElementById("fnameedit").value = fname;
      document.getElementById("mnameedit").value = mname;
      document.getElementById("lnameedit").value = lname;
      document.getElementById("genderedit").value = document.getElementById("dtable").rows[index].cells.item(2).innerHTML;
      document.getElementById("bdateedit").value = date;
      document.getElementById("nationalityedit").value = document.getElementById("dtable").rows[index].cells.item(4).innerHTML;
      document.getElementById("isregularedit").value = document.getElementById("dtable").rows[index].cells.item(5).innerHTML;
      document.getElementById("yearstatusedit").value = document.getElementById("dtable").rows[index].cells.item(6).innerHTML;
      document.getElementById("programedit").value = document.getElementById("dtable").rows[index].cells.item(7).innerHTML;

    }

    function viewgrades(x) {
      var index = x.parentNode.parentNode.rowIndex;
      document.getElementById("idview").value = document.getElementById("dtable").rows[index].cells.item(0).innerHTML;
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

