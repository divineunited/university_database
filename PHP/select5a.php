<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Referencing the variable from home
$studentID = mysqli_real_escape_string($conn, $_POST['studentID']);

$sql = "SELECT sem.semesterID as semesterID, sem.term as term, c.title as course, g.grade as grade
FROM _student as stud, _section as sec, _course as c, _semester as sem, _grade as g
WHERE stud.studentID = g.studentID
and g.sectionID = sec.sectionID
and sec.courseID = c.courseID
and sem.semesterID = sec.semesterID
and stud.studentID = '$studentID'
GROUP BY course
ORDER BY semesterID;
";


$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);


// Print Table
if ($result->num_rows > 0) {
    echo "<table border>";
	echo "<tr><th>TermID</th><th>Term</th><th>Course Title</th><th>Grade</th></tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["semesterID"]."</td><td>".$row["term"]."</td><td>".$row["course"]."</td><td>".$row["grade"]."</td></tr>";
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
