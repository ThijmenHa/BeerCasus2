<?php 
include "dbrefs.php";

$con = mysqli_connect($server, $user, $pw, $dbname);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['like'])) {
    $beers_id = $_POST['beers_id'];
    

    if (!isset($_COOKIE['liked_beers']) || strpos($_COOKIE['liked_beers'], $beers_id) === false) {

        $query = "UPDATE beers SET like_count = like_count + 1 WHERE id = $beers_id";
        $result = mysqli_query($con, $query);

        if (isset($_COOKIE['liked_beers'])) {
            $liked_beers = $_COOKIE['liked_beers'] . ',' . $beers_id;
        } else {
            $liked_beers = $beers_id;
        }
        setcookie('liked_beers', $liked_beers, time() + (86400 * 30), "/"); 
        
        if ($result) {
            echo "<script>console.log('Je hebt biertje " . $beers_id . " geliked' );</script>";
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "<p>Kan biertje niet liken " . mysqli_error($con) . "</p>";
        }
    } else {
        echo "<p>Je hebt dit biertje al geliked.</p>";
    }
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
    <div class="container">

    <h1>Biertjes Lijst</h1>
    
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
            echo "<form method='POST'>";
            echo "<input type='submit' name='like' value='Like'></input>"; 
            echo "<input type='hidden' name='beers_id' value='" . $row['id'] . "'>"; 
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    </div> 
</body>
</html>

<?php 
mysqli_close($con);
?>
