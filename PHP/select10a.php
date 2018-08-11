<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u18_team21","my+sql=i308u18_team21","i308u18_team21");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Referencing the variable from home
$facultyID = mysqli_real_escape_string($conn, $_POST['facultyID']);

$sql = "SELECT concat(f.fname, ' ', f.lname) as faculty_name,
b.name as building, r.roomNum as room_num,
concat(b.streetADD, ', ', b.cityADD, ', ', b.stateADD, ' ', b.zipADD) as building_address
FROM _faculty as f, _room as r, _building as b
WHERE b.buildingID = r.buildingID
and f.roomID = r.roomID
and f.facultyID = '$facultyID';
";


$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);


// Print Table
if ($result->num_rows > 0) {
    echo "<table border>";
	echo "<tr><th>Faculty Name</th><th>Building Name</th><th>Room Number</th><th>Building Address</th></tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["faculty_name"]."</td><td>".$row["building"]."</td><td>".$row["room_num"]."</td><td>".$row["building_address"]."</td></tr>";
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
