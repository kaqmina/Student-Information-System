<?php
	

	function displaySubj() {
		$sql = "SELECT grade.id, CONCAT(student.lastname,', ', student.firstname,' ',student.middlename) AS fullname, subject.title, grade.schoolyear, (CASE WHEN semester = 1 THEN '1st Semester' WHEN semester = 2 THEN '2nd Semester' ELSE '3rd Semester' END) AS semester, grade, classcode FROM school.grade LEFT JOIN school.student ON grade.student_id = student.id LEFT JOIN school.subject ON grade.subject_id = subject.id ORDER BY subject_id";

		if(isset($_POST['submit'])) {
			
			$order_by = $_REQUEST['order'];

			$sql = "SELECT grade.id, CONCAT(student.lastname,', ', student.firstname,' ',student.middlename) AS fullname, subject.title, grade.schoolyear, (CASE WHEN semester = 1 THEN '1st Semester' WHEN semester = 2 THEN '2nd Semester' ELSE '3rd Semester' END) AS semester, grade, classcode FROM school.grade LEFT JOIN school.student ON grade.student_id = student.id LEFT JOIN school.subject ON grade.subject_id = subject.id WHERE grade.subject_id = $order_by ORDER BY id";
		}

		return $sql;
	}
?>