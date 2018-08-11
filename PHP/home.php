<!doctype html>
<html>

<head>
    <title>IU Record System</title>
</head>

<body>
<h2>IU Record System</h2>
<h3>Custom Built by Danny Vu (using mock data)</h3>

<!-- NEXT SECTION 1a -->

Produce a roster for a specified course section sorted by student's last name, first name:
<br><br>

<form action="select1a.php" method="post">

Section: <select name='sectionID' required>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT sectionID FROM _section");
while ($row = mysqli_fetch_assoc($result)) {
              	unset($id);
              	$id = $row['sectionID'];
              	echo '<option value="'.$id.'">'.$id.'</option>';
}
?>
</select>
<br><br>

<input type="submit" value="Select Section ID">
</form>



<!-- NEXT SECTION 2a -->

<br><br>
Produce a list of rooms that are equipped with a certain feature:
<br><br>
<form action="select2a.php" method="post">

Features: <select name='feature' required>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT DISTINCT feature FROM _room_feature GROUP BY feature ORDER BY feature");
while ($row = mysqli_fetch_assoc($result)) {
              	unset($name);
              	$name = $row['feature'];
              	echo '<option value="'.$name.'">'.$name.'</option>';
}
?>
</select>
<br><br>

<input type="submit" value="Select Feature">
</form>



<!-- NEXT SECTION 3a -->

<br><br>
Produce a list of all faculty and all the courses they have ever taught.
Show how many times they have taught each course:
<br>
<form action="select3a.php" method="post">

<br><br>
<input type="submit" value="Show Faculty and Courses">
</form>


<!-- NEXT SECTION 4A -->

<br><br>
Produce a list of students who are eligible to register for a *specified course* that has a
prerequisite.
<br><br>

<form action="select4a.php" method="post">
Courses that have Prerequisites: <select name='prerequisiteID' required>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT DISTINCT prerequisiteID, title FROM _course WHERE prerequisiteID IS NOT NULL ORDER BY title");
while ($row = mysqli_fetch_assoc($result)) {
              	unset($id, $name);
              	$id = $row['prerequisiteID'];
              	$name = $row['title'];
              	echo '<option value="'.$id.'">'.$name.'</option>';
}
?>
</select>
<br><br>

<input type="submit" value="Students Who Are Eligible">
</form>

<!-- NEXT SECTION 5c -->

<br><br>
Produce a chronological list of all courses taken by a *specified student*. Show grades
earned. Include overall hours earned and GPA at the end. (Hint: An F does not earn
hours.)
<br><br>
<form action="select5c.php" method="post">

Features: <select name='studentID' required>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT distinct studentID, concat(fname, ' ', lname) as full_name FROM _student ORDER BY full_name");
while ($row = mysqli_fetch_assoc($result)) {
              	unset($id, $name);
              	$id = $row['studentID'];
              	$name = $row['full_name'];
              	echo '<option value="'.$id.'">'.$name.'</option>';
}
?>
</select>
<br><br>

<input type="submit" value="Show Transcript">
</form>

<!-- NEXT SECTION 7a -->

<br><br>
Produce an alphabetical list of students with their majors who are advised by a *specified advisor*.
<br><br>
<form action="select7a.php" method="post">

Features: <select name='advisorID' required>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT distinct facultyID, concat(f.fname, ' ', f.lname) as faculty_name FROM _faculty as f WHERE f.expertise = 'advising' ORDER BY faculty_name");
while ($row = mysqli_fetch_assoc($result)) {
              	unset($id, $name);
              	$id = $row['facultyID'];
              	$name = $row['faculty_name'];
              	echo '<option value="'.$id.'">'.$name.'</option>';
}
?>
</select>
<br><br>

<input type="submit" value="Show Students he/she advises">
</form>

<!-- NEXT SECTION 9b -->

<br><br>
Produce a list of students with hours earned who have met graduation requirements for a *specified major*.
<br><br>
<form action="select9b.php" method="post">

Features: <select name='majorID' required>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT distinct majorID, name as major_name FROM _major ORDER BY major_name");
while ($row = mysqli_fetch_assoc($result)) {
              	unset($id, $name);
              	$id = $row['majorID'];
              	$name = $row['major_name'];
              	echo '<option value="'.$id.'">'.$name.'</option>';
}
?>
</select>
<br><br>

<input type="submit" value="Show Students with Min Hours">
</form>


<!-- NEXT SECTION extra1 -->

<br><br>
Choose a faculty member and display his/her Building Name, Room Number, and Building Address
<br><br>
<form action="select10a.php" method="post">

Features: <select name='facultyID' required>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT distinct facultyID, concat(f.fname, ' ', f.lname) as faculty_name FROM _faculty as f ORDER BY faculty_name");
while ($row = mysqli_fetch_assoc($result)) {
              	unset($id, $name);
              	$id = $row['facultyID'];
              	$name = $row['faculty_name'];
              	echo '<option value="'.$id.'">'.$name.'</option>';
}
?>
</select>
<br><br>

<input type="submit" value="Show Faculty's Office Location">
</form>

<!-- NEXT SECTION extra2 -->

<br><br>
Choose a Semester and Display all the Courses Available with sections and times
<br><br>
<form action="select11a.php" method="post">

Features: <select name='semesterID' required>
<?php
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$result = mysqli_query($conn, "SELECT distinct semesterID, term FROM _semester ORDER BY semesterID");
while ($row = mysqli_fetch_assoc($result)) {
              	unset($id, $name);
              	$id = $row['semesterID'];
              	$name = $row['term'];
              	echo '<option value="'.$id.'">'.$name.'</option>';
}
?>
</select>
<br><br>

<input type="submit" value="Show Classes Available">
</form>


</body>
</html>
