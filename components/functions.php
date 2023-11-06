<?php

$programminglanguages = [
    "Language" => "",
    "PHP" => "php",
    "Rust" => "rs",
    "C++" => "cpp",
    "C" => "c",
    "C#" => "cs",
    "HTML" => "html",
    "CSS" => "css",
    "PHP" => "php",
    "Python" => "py",
    "Javascript" => "javascript",
    "Kotlin" => "kt",
    "SQL" => "sql"
];

function RandomCharacters($length) // Function must be called with a length
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_'; // All characters that can be generated
    $randomString = ''; // Defined a variable to put the string in
    $bytes = random_bytes($length); // Generate random bytes based on the length in the function
    for ($i = 0; $i < $length; $i++) { // Loop the amount of random charaters based on the length of the function
        $randomString .= $characters[ord($bytes[$i]) % strlen($characters)]; // The random bytes gets converted and gets assigned a character based on the byte
    }
    return $randomString; // This is the final string
}

function StorageLeft()
{
    $currentdiskfreebytes = disk_free_space('/'); // Current free disk space in Bytes

    switch (true) {
        case $currentdiskfreebytes > 1000000000000000: // If current free disk space in Bytes is more than 1 quadrillion
            $currentdiskfree = round($currentdiskfreebytes / 1000000000000000, 2) . 'PB'; // Devide the amount of Bytes by 1 quadrillion and round them to 2 decimals to get PetaBytes
            break;
        case $currentdiskfreebytes > 1000000000000: // If current free disk space in Bytes is more than 1 trillion
            $currentdiskfree = round($currentdiskfreebytes / 1000000000000, 2) . 'TB'; // Devide the amount of Bytes by 1 trillion and round them to 2 decimals to get TerraBytes
            break;
        case $currentdiskfreebytes > 1000000000: // If current free disk space in Bytes is more than 1 billion
            $currentdiskfree = round($currentdiskfreebytes / 1000000000, 2) . 'GB'; // Devide the amount of Bytes by 1 billion and round them to 2 decimals to get GigaBytes
            break;
        case $currentdiskfreebytes > 1000000: // If current free disk space in Bytes is more than 1 million
            $currentdiskfree = round($currentdiskfreebytes / 1000000, 2) . 'MB'; // Devide the amount of Bytes by 1 million and round them to 2 decimals to get MegaBytes
            break;
        default: // If it's smaller than a million bytes it will default to KiloBytes
            $currentdiskfree = round($currentdiskfreebytes / 1000, 2) . 'KB'; // Devide the amount of Bytes by 1 thousand and round them to 2 decimals to get KiloBytes
            break;
    }

    return $currentdiskfree . ' free'; // This is the amount rounded
}

function SearchData($pdo, $search, $language, $uploaddate) // The variable must contain the connection of mysql via PDO and user must specify with 0 or 1 if it's trash. (0 is not trash) (1 is trash) and what you're searching for
{
    $query = "SELECT * FROM code WHERE (title LIKE :search OR creator LIKE :search) AND language LIKE :language AND uploaddate LIKE :uploaddate"; // Select all from the table uploads where the user id is from the user and trash is trash given in the function and the thing the user is looking for
    $stmt = $pdo->prepare($query); // Using prepared statements to prevent SQL injection attacks
    $stmt->execute([ // execute the prepared statements
        'search' => "%" . $search . "%", // Added percentages in front of the search and after the search so it can check any position of the string
        'language' => "%" . $language . "%",
        'uploaddate' => "%" . $uploaddate . "%"
    ]);
    $codeindatabase = $stmt->fetchAll(PDO::FETCH_ASSOC); // Put all the results that match in this variable
    return $codeindatabase; // This is the final result
}

function GetData($pdo) // The variable must contain the connection of mysql via PDO and user must specify with 0 or 1 if it's trash. (0 is not trash) (1 is trash)
{
    $query = "SELECT * FROM code"; // Get everything from the table code
    $stmt = $pdo->prepare($query); // Using prepared statements to prevent SQL injection attacks
    $stmt->execute(); // Exectuting the query and putting in all the data

    $codeindatabase = $stmt->fetchAll(PDO::FETCH_ASSOC); // All the file locations are in the variable
    return $codeindatabase; // This is the output for all the data
}

function AddCode($pdo, $title, $creator, $code, $uploaddate, $language, $description)
{
    $query = "INSERT INTO code (title, creator, code, uploaddate, codeid, language, description) VALUES (:title, :creator, :code, :uploaddate, :codeid, :language, :description)"; // Insert query to put in all data
    $stmt = $pdo->prepare($query); // Using prepared statements to prevent SQL injection attacks
    $stmt->execute([ // Exectuting the query and putting in all the data
        'title' => $title,
        'creator' => $creator,
        'code' => $code,
        'uploaddate' => $uploaddate,
        'codeid' => RandomCharacters(128),
        'language' => $language,
        'description' => $description
    ]);
}

function ViewSpecific($pdo, $codeid)
{
    $query = "SELECT * FROM code WHERE codeid = :codeid"; // Get everything from the table code where the code id is that
    $stmt = $pdo->prepare($query); // Using prepared statements to prevent SQL injection attacks
    $stmt->execute([
        "codeid" => $codeid
    ]); // Exectuting the query and putting in all the data

    $codeindatabase = $stmt->fetch(PDO::FETCH_ASSOC); // All the file locations are in the variable
    return $codeindatabase; // This is the output for all the data
}

function EditCode($pdo, $title, $creator, $code, $codeid, $uploaddate, $language, $description)
{
    $query = "UPDATE code SET title = :title, creator = :creator, code = :code, uploaddate = :uploaddate, language = :language, description = :description WHERE codeid = :codeid"; // Update query to change data about info
    $stmt = $pdo->prepare($query); // Using prepared statements to prevent SQL injection attacks
    $stmt->execute([ // Exectuting the query and putting in all the data
        'title' => $title,
        'creator' => $creator,
        'code' => $code,
        'codeid' => $codeid,
        'uploaddate' => $uploaddate,
        'language' => $language,
        'description' => $description
    ]);
}

function DeleteCode($pdo, $codeid)
{
    $query = "DELETE FROM code WHERE codeid = :codeid"; // Query to delete from database
    $stmt = $pdo->prepare($query); // Using prepared statements to prevent SQL injection attacks
    $stmt->execute([ // Execute the deletion of the code
        'codeid' => $codeid
    ]);
}

function NotExists($Check)
{
    if (empty($Check)) {
        header("location: ../");
        exit();
    }
}

function ShowData($pdoresults)
{
    foreach ($pdoresults as $code) {
        echo "<div class='cards-layout'>";
        echo "<p></p>";
        echo "<div class='d-flex flex-column cardwidth'>";
        echo "<div class='d-flex flex-row justify-content-between'>";
        echo "<h3><a href='pages/viewcode.php?codeid={$code['codeid']}' class='acoller'>Title: {$code['title']}</a></h3>";
        echo "<p>Upload date: {$code['uploaddate']}</p>";
        echo "</div>";
        echo "<p></p>";
        echo "<div class='d-flex justify-content-around'>";
        echo "<p>Language: {$code['language']}</p>";
        echo "<p>Creator: {$code['creator']}</p>";
        echo "<p>Description: {$code['description']}</p>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "<p></p>";
    }
}
?>