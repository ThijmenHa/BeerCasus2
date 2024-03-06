<?php 
include "dbrefs.php";

$con = mysqli_connect($server, $user, $pw, $dbname);

if (mysqli_connect_errno() ) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biertjes</title>
</head>
<body>
    Biertjes test
    <?php echo $user
    ?>
</body>
</html>