<?php

include '../simple_html_dom.php';
$htmlArabic = file_get_html('https://hisnmuslim.com/i/ar/0');
$htmlSwahili = file_get_html('https://hisnmuslim.com/i/sw/0');
$htmlEnglish = file_get_html('https://hisnmuslim.com/i/en/0');

// Loop the contents and store in an array 
foreach ($htmlArabic->find('a.ctitle') as $e) {
    $arrayArabic[] = $e->plaintext;
}
// Loop the contents and store in an array 
foreach ($htmlSwahili->find('a.ctitle') as $e) {
    $arraySwahili[] = $e->plaintext;
}
// Loop the contents and store in an array 
foreach ($htmlEnglish->find('a.ctitle') as $e) {
    $arrayEnglish[] = $e->plaintext;
}


$dir = 'sqlite:C:\AndroidProjects\HisnulMuslim\app\src\main\assets\hisnMuslimDb.db';
$dirOffice = 'sqlite:C:\Myprojects\HisnulMuslim\app\src\main\assets\hisnMuslimDb.db';
$databaseHandler = new PDO($dirOffice) or die("Can not open database");
// Get entire data and insert into the database
for ($i = 0; $i < count($arrayArabic); $i++) {
    echo $hadeethArabic =     SQLite3::escapeString(trim($arrayArabic[$i]));
    echo $hadeethSwahili = SQLite3::escapeString(trim($arraySwahili[$i]));
    echo $hadeethEnglish = SQLite3::escapeString(trim($arrayEnglish[$i]));
    echo $hadeethNumber = $i+ 1;
    echo '----------------------------';
    echo '<br/><br/>';

//    $query = "INSERT INTO hadeeth_category('id','name_arabic','name_swahili','name_english') VALUES (NULL,'$hadeethArabic','$hadeethSwahili','$hadeethEnglish');";
//    $databaseHandler->exec($query);
    var_dump($arrayArabic);
    unset($arrayArabic);
    echo '<br/><br/>';
    var_dump($arrayArabic);
    exit;
    //die(print_r($databaseHandler->errorInfo(), true));
}

//foreach ($databaseHandler->query($query) as $row) {
//    //echo $row['hadeeth_number'] . "<br>";
//}
$databaseHandler = NULL; // closes connection 
