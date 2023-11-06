<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
require_once("database/dbconnect.php");
require_once("components/functions.php");
$true_or_flase = true;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <link id="lighttheme" rel="stylesheet" href="style/stylelight.css">
    <title>Home</title>
    <script src="script/script.js" defer></script>
</head>

<body class="d-flex justify-content-between flex-column index_body">
    <?php require_once("components/navbar.php"); ?>

    <form method="post">
        <!-- <?php echo "Storage left on server: " . StorageLeft(); ?> -->
        <p id="i"></p>
        <div class="cards-body">
            <?php

            switch (true) {
                case empty($_SESSION['search']) && !empty($_SESSION['language']) && !empty($_SESSION['filterdate']):
                    ShowData(SearchData($pdo, '', $_SESSION['language'], $_SESSION['filterdate']));
                    break;
                case empty($_SESSION['search']) && empty($_SESSION['language']) && !empty($_SESSION['filterdate']):
                    ShowData(SearchData($pdo, '', '', $_SESSION['filterdate']));
                    break;
                case empty($_SESSION['search']) && !empty($_SESSION['language']) && empty($_SESSION['filterdate']):
                    ShowData(SearchData($pdo, '', $_SESSION['language'], ''));
                    break;
                case !empty($_SESSION['search']) && !empty($_SESSION['language']) && !empty($_SESSION['filterdate']):
                    ShowData(SearchData($pdo, $_SESSION['search'], $_SESSION['language'], $_SESSION['filterdate']));
                    break;
                default:
                    ShowData(GetData($pdo));
                    break;
            }

            ?>
        </div>
    </form>
    <?php require_once("components/footer.php"); ?>
</body>

</html>