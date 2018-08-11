<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Referencing the variable from home
$prerequisiteID = mysqli_real_escape_string($conn, $_POST['prerequisiteID']);

$sql = "SELECT distinct concat(stud.fname, ' ', stud.lname) as full_name
FROM _student as stud, _course as c, _grade as g, _section as sec
WHERE stud.studentID = g.studentID
and sec.sectionID = g.sectionID
and c.courseID = sec.courseID
and c.courseID = '$prerequisiteID';
";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);

// Print Table
if ($result->num_rows > 0) {
    echo "<table border>";
	echo "<tr><th>Students Eligible to take this Course</th></tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["full_name"]."</td></tr>";
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
