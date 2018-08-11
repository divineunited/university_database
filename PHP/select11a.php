<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Referencing the variable from home
$semesterID = mysqli_real_escape_string($conn, $_POST['semesterID']);

$sql = "SELECT sem.term as term, c.title as courseName, sec.sectionID as section_ID, sec.startTime as start_time, sec.endTime as end_time
FROM _course as c, _department as d, _semester as sem, _section as sec
WHERE c.deptID = d.deptID
and sec.courseID = c.courseID
and sem.semesterID = sec.semesterID
and sem.semesterID = '$semesterID'
ORDER BY courseName, start_time;
";


$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);


// Print Table
if ($result->num_rows > 0) {
    echo "<table border>";
	echo "<tr><th>Term</th><th>Course Name</th><th>Section ID</th><th>Start Time</th><th>End Time</th></tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["term"]."</td><td>".$row["courseName"]."</td><td>".$row["section_ID"]."</td><td>".$row["start_time"]."</td><td>".$row["end_time"]."</td></tr>";
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
