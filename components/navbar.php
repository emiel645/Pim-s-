<?php

$fullurl = explode("/", $_SERVER["REQUEST_URI"]);
$url = array_slice($fullurl, -2);

if (isset($_POST['search'])) {
    $_SESSION['search'] = $_POST['search'];
    if ($url[0] == "pages") {
        header('Location: ../');
        exit();
    } else {
        header('Location: ./');
        exit();
    }
}

if (isset($_POST['languagefilter']) || isset($_POST["filterdate"])) {
    $_SESSION['language'] = $_POST['languagefilter'];
    $_SESSION['filterdate'] = $_POST["filterdate"];
    header("location: ./");
    exit();
}

?>
<div class="navbody">
    <div>
        <nav class="d-flex justify-content-between align-items-center flex-row navwidth">
            <?php
            if ($url[0] == "pages") {
                echo '
            <a href="../" class="homeknop">
                <h1 style="color: white;">codeju1</h1>
            </a>';
            } else {
                echo '<a href="./" class="homeknop">
                <h1 style="color: white;">codeju1</h1>
            </a>';
            }
            ?>
            <form method="post">
                <input placeholder="Search:" value="<?php if (isset($_SESSION['search'])) echo $_SESSION['search']; ?>" name="search" type="text" class="ellemant-coller-navbar">
            </form>
            <img id="theme" onclick="ChangeTheme()" src="/images/light-on.png" width="5%">
            <input id="themevalue" hidden value="0" type="text">
        </nav>
        <?php
        if ($true_or_flase) { ?>
            <div class="selectbody">
                <div class="d-flex flex-row navwidth">
                    <div class="d-flex flex-row navwidth align-items-start">
                        <p>filters:</p>
                        <form method="post">
                            <select selected="selected" name="languagefilter" onchange="submit()" class="ellemant-coller-navbar">
                                <?php
                                foreach ($programminglanguages as $language => $alias) {
                                    if ($_SESSION['language'] == $alias) {
                                        echo "<option selected value='{$alias}'>{$language}</option>";
                                    } else {
                                        echo "<option value='{$alias}'>{$language}</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input onchange="submit()" <?php if (!empty($_SESSION['filterdate'])) echo "value='" . $_SESSION['filterdate'] . "'"; ?> class="ellemant-coller-navbar" type="date" name="filterdate">

                        </form>
                    </div>
                    <div class="d-flex align-items-start flex-row-reverse navwidth">
                        <a href="pages/addcode.php">Add code</a>
                    </div>

                </div>
            <?php } else {
        } ?>
            </div>
    </div>
</div>