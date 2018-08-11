<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Referencing the variable from home
$courseID = mysqli_real_escape_string($conn, $_POST['courseID']);

$sql = "SELECT concat(f.fname, ' ', f.lname) as full_name
FROM _faculty as f
WHERE NOT EXISTS
(
  SELECT *
FROM _course as c, _section as s, _faculty_section as fs
WHERE f.facultyID = fs.facultyID
and fs.sectionID = s.sectionID
and s.courseID = c.courseID
and c.title = 'Jazz Piano'
GROUP BY full_name);
";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);

// Print Table
if ($result->num_rows > 0) {
    echo "<table border>";
	echo "<tr><th>Faculty who have never taught that course</th></tr>";
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
