<?php
require_once("../database/dbconnect.php");
require_once("../components/functions.php");
$true_or_flase = false;
$codedata = ViewSpecific($pdo, $_GET['codeid']);

NotExists($codedata['codeid']);

if (isset($_POST['deletecode'])) {
    DeleteCode($pdo, $_GET['codeid']);
    header("location: ../");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viewing: <?php echo $codedata['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/default.min.css">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightElement(block);
            });
        });
    </script>
    <script src="../script/script.js" defer></script>
    <link id="lighttheme" rel="stylesheet" href="../style/stylelight.css">
</head>

<body class="d-flex justify-content-between flex-column index_body">
        <?php
        include("../components/navbar.php")
        ?>
        <form method="post">
            <?php
            echo "<h2>{$codedata['title']}</h2>";
            echo "<p>Language: {$codedata['language']}</p>";
            echo "<p>Creator: {$codedata['creator']}</p>";
            echo "<p>Description: {$codedata['description']}</p>";
            echo "<pre><code style='height:600px; width:100%; border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;' class='{$codedata['language']}'>" . htmlspecialchars($codedata['code']) . "</code></pre>";
            echo "<div class='options'> <p>{$codedata['uploaddate']}</p> <button id='Warn' onclick='WarnUser()' name='delete'>Delete</button> </div>";
            echo "<h5><a class='acoller' href='editcode.php?codeid={$codedata['codeid']}'>Edit</a><h5>";

            ?>
        </form>
        <?php require_once("../components/footer.php"); ?>
</body>

</html>