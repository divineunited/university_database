<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Referencing the variable from home
$advisorID = mysqli_real_escape_string($conn, $_POST['advisorID']);

$sql = "SELECT concat(stud.lname, ', ', stud.fname) as student_name, m.name as major
FROM _major as m,
_student as stud,
_faculty as f,
_major_student as ms,
_student_faculty as sf
WHERE m.majorID = ms.majorID
and ms.studentID = stud.studentID
and sf.facultyID = f.facultyID
and stud.studentID = sf.studentID
and f.facultyID  = '$advisorID'
GROUP BY student_name
ORDER BY student_name;
";


$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);


// Print Table
if ($result->num_rows > 0) {
    echo "<table border>";
	echo "<tr><th>Student Name</th><th>Major</th></tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["student_name"]."</td><td>".$row["major"]."</td></tr>";
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
