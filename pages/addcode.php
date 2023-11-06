<?php
$uploaddate = date('Y-m-d');
require_once("../database/dbconnect.php");
require_once("../components/functions.php");
$true_or_flase = false;
if (isset($_POST["title"])) {
    if (!empty($_POST["code"]) && !empty($_POST["title"]) && !empty($_POST['language']) && !empty($_POST['description']) && !empty($_POST['creator']))
        AddCode($pdo, $_POST["title"], $_POST['creator'], $_POST["code"], $uploaddate, $_POST['language'], $_POST['description']);
    header("location: ../");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../style/style.css">

    <script src="../script/script.js" defer></script>
    <title>Add code</title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <link id="lighttheme" rel="stylesheet" href="../style/stylelight.css">
</head>

<body class="d-flex justify-content-between flex-column index_body">
    <?php
    include("../components/navbar.php")
    ?>
    <form method="post">

        <div class="   ">
            <div class="p-5 inputfield">
                <div class="inputfields">
                    <input placeholder="Title" type="text" name="title" id="inputfields">
                </div>
                <div class="inputfields">
                    <input placeholder="Your name" type="text" name="creator" id="inputfields">
                </div>
                <div class="inputfields">
                    <input placeholder="Short description" name="description" type="text" id="inputfields">
                </div>
                <div class="inputfields">
                    <select id="inputfields" name="language">
                        <?php
                        foreach ($programminglanguages as $language => $alias) {
                            echo "<option  value='{$alias}'>{$language}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="inputcodefield">
                <textarea placeholder="code" name="code" id="inputfields" cols="180" rows="30"></textarea>
            </div>
            <p></p>
            <div class="submit">
                <button id="button" type="submit">Submit</button>
            </div>
        </div>
    </form>
    <?php require_once("../components/footer.php") ?>
</body>

</html>