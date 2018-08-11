<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Referencing the variable from home
$sectionID = mysqli_real_escape_string($conn, $_POST['sectionID']);

$sql = "SELECT concat(stud.lname, ', ', stud.fname) as full_name
FROM _section as sec, _student as stud, _grade as g
WHERE stud.studentID = g.studentID and g.sectionID = sec.sectionID
and
sec.sectionID = '$sectionID'
";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);

// Print Table
if ($result->num_rows > 0) {
    echo "<table border>";
	echo "<tr><th>Roster - Student Name (l, f)</th></tr>";
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
