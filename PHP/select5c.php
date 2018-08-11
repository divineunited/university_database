<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Referencing the variable from home
$studentID = mysqli_real_escape_string($conn, $_POST['studentID']);

$sql = "SELECT
sem.term as term,
sem.startDate as startDate,
c.title as course,
g.grade as grade,
c.credit_hours as credit_hours
FROM _student as stud, _section as sec,
_course as c, _semester as sem, _grade as g
WHERE stud.studentID = g.studentID
and g.sectionID = sec.sectionID
and sec.courseID = c.courseID
and sem.semesterID = sec.semesterID
and stud.studentID = '$studentID'
UNION
SELECT
'' as term,
'TOTAL' as startDate,
'' as course,
(sum(g.gpa * c.credit_hours) / sum(c.credit_hours)) as grade,
sum(c.credit_hours) as total_credit_hours
FROM _student as stud, _section as sec,
_course as c, _semester as sem, _grade as g
WHERE stud.studentID = g.studentID
and g.sectionID = sec.sectionID
and sec.courseID = c.courseID
and sem.semesterID = sec.semesterID
and g.gpa > 0
and stud.studentID = '$studentID'
GROUP BY stud.studentID
ORDER BY startDate;
";


$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);



// Print Table
if ($result->num_rows > 0) {
    echo "<table border>";
	echo "<tr><th>Term</th><th>Start Date</th><th>Course</th><th>Grade</th><th>Credit Hours</th></tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["term"]."</td><td>".$row["startDate"]."</td><td>".$row["course"]."</td><td>".$row["grade"]."</td><td>".$row["credit_hours"]."</td></tr>";
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
