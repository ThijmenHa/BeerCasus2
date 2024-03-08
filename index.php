<?php 
include "dbrefs.php";

$con = mysqli_connect($server, $user, $pw, $dbname);

if (mysqli_connect_errno() ) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}


$sql = "SELECT * FROM beers";
$result = mysqli_query($con, $sql);
if (!$result) {
    echo "Error: " . mysqli_error($con);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styling.css"
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biertjes</title>
</head>
<body>
    <h1>Biertjes</h1>
    
    <ul>
    <?php 
 echo "<table class='datatable'>";
 echo "<tr><th>Name</th><th>Brewer</th><th>Type</th><th>Yeast</th><th>Percentage</th><th>Purchase Price</th><th>Like Count</th></tr>";
 
 while ($row = mysqli_fetch_assoc($result)) {
     echo "<tr>";
     echo "<td>" . $row['name'] . "</td>";
     echo "<td>" . $row['brewer'] . "</td>";
     echo "<td>" . $row['type'] . "</td>";
     echo "<td>" . $row['yeast'] . "</td>";
     echo "<td>" . $row['perc'] . "</td>";
     echo "<td>" . $row['purchase_price'] . "</td>";
     echo "<td>" . $row['like_count'] . "</td>";
     echo "</tr>";
 }
 echo "</table>";
    
    ?>
    </ul>    

</body>
</html>

<?php 
mysqli_close($con);
?>
