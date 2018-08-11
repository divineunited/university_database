<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT concat(f.fname, ' ', f.lname) as full_name, c.title as title, count(c.title) as times_taught
FROM _faculty as f, _course as c, _section as s, _faculty_section as fs
WHERE f.facultyID = fs.facultyID
and fs.sectionID = s.sectionID
and s.courseID = c.courseID
GROUP BY title
";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);

// Print Table
if ($result->num_rows > 0) {
    echo "<table border>";
	echo "<tr><th>Faculty Name</th><th>Course Taught</th><th>Times Taught</th></tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["full_name"]."</td><td>".$row["title"]."</td><td>".$row["times_taught"]."</td></tr>";
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
