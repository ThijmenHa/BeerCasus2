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
    <link rel="stylesheet" href="styling.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biertjes</title>
</head>
<body>
    <h1>Biertjes</h1>
    
    <table class='datatable'>
        <tr>
            <th>Name</th>
            <th>Brewer</th>
            <th>Type</th>
            <th>Yeast</th>
            <th>Percentage</th>
            <th>Purchase Price</th>
            <th>Like Count</th>
            <th>Like</th>
        </tr>
        <?php 
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['brewer'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>" . $row['yeast'] . "</td>";
            echo "<td>" . $row['perc'] . "</td>";
            echo "<td>" . $row['purchase_price'] . "</td>";
            echo "<td>" . $row['like_count'] . "</td>";
            echo "<td>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='beers_id' value='" . $row['id'] . "'>";
            echo "<button type='submit' name='like'>Like</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>
</html>
        
    <?php 
    if (isset($_POST['like'])) {
        $beers_id = $_POST['beers_id'];
        $query = "UPDATE beers SET like_count = like_count + 1 WHERE id = $beers_id";
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<p>beer liked successfully!</p>";
        } else {
            echo "<p>Error liking post: " . mysqli_error($con) . "</p>";
        }
    }
    ?>
    
<?php 
mysqli_close($con);
?>
