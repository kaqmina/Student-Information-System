<?php

	$query = "SELECT * FROM account WHERE uname = '$log_session'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);


	$permitstudent = $row['permitstudent'];
	$str_stud = str_split($permitstudent);

	$student = $str_stud[0];
	$studadd = $str_stud[1];
	$studedit = $str_stud[2];
	$studview = $str_stud[3];


	$permitprogram = $row['permitprogram'];
	$str_prog = str_split($permitprogram);

	$program = $str_prog[0];
	$programadd = $str_prog[1];
	$programedit = $str_prog[2];
	$curriculum = $str_prog[3];
	$curriculumadd = $str_prog[4];
	$curriculumedit = $str_prog[5];

	$permitsubject = $row['permitsubject'];
	$str_subj = str_split($permitsubject);

	$subject = $str_subj[0];
	$subjectadd = $str_subj[1];
	$subjectedit = $str_subj[2];

	$permitnationality = $row['permitnationality'];
	$str_nation = str_split($permitnationality);

	$nationality = $str_nation[0];
	$nationalityadd = $str_nation[1];
	$nationalityedit = $str_nation[2];

	$permitreligion = $row['permitreligion'];
	$str_reli = str_split($permitreligion);

	$religion = $str_reli[0];
	$religionadd = $str_reli[1];
	$religionedit = $str_reli[2];

	$permitaccounts = $row['permitaccounts'];
	$str_acc = str_split($permitaccounts);

	$account = $str_acc[0];
	$accountadd = $str_acc[1];
	$accountedit = $str_acc[2];

	$permitgrades = $row['permitgrades'];
	$str_grade = str_split($permitgrades);

	$grade = $str_grade[0];
	$gradeadd = $str_grade[1];
	$gradeedit = $str_grade[2];

	mysqli_close($conn);
?>