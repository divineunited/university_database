<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Referencing the variable from home
$majorID = mysqli_real_escape_string($conn, $_POST['majorID']);

$sql = "SELECT concat(stud.fname, ' ', stud.lname) as student_name, m.name as major, sum(c.credit_hours) as credit_hours, m.grad_credits as minimum_credits
FROM _student as stud,
_section as sec,
_grade as g,
_course as c,
_major as m,
_major_student as ms,
_major_course as mc
WHERE stud.studentID = g.studentID
and g.sectionID = sec.sectionID
and sec.courseID = c.courseID
and m.majorID = ms.majorID
and ms.studentID = stud.studentID
and c.courseID = mc.courseID
and mc.majorID = m.majorID
and g.gpa > '0'
and m.majorID = '$majorID'
GROUP BY student_name
HAVING credit_hours > minimum_credits;
";


$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);


// Print Table
if ($result->num_rows > 0) {
    echo "<table border>";
	echo "<tr><th>Student Name</th><th>Major</th><th>Credit Hours</th><th>Minimum Credits Needed to Graduate</th></tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["student_name"]."</td><td>".$row["major"]."</td><td>".$row["credit_hours"]."</td><td>".$row["minimum_credits"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Print Num Rows
echo "$num_rows Rows\n";

// Close Connection
mysqli_close($conn);
?>
