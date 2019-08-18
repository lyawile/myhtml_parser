<?php

include '../simple_html_dom.php';
//$index = 11;
for ($index = 44 ; $index <= 49; $index++) {
    $categoryNumber = $index + 1;
    $htmlArabic = file_get_html('https://hisnmuslim.com/i/ar/' . $index);
    $htmlSwahili = file_get_html('https://hisnmuslim.com/i/sw/' . $index);
    $htmlEnglish = file_get_html('https://hisnmuslim.com/i/en/' . $index);

// Loop the contents and store in an array 
    foreach ($htmlArabic->find('div.thikr') as $e) {
        $arrayArabic[] = $e->plaintext;
    }
// Loop the contents and store in an array 
    foreach ($htmlSwahili->find('div.thikr') as $e) {
        $arraySwahili[] = $e->plaintext;
    }
// Loop the contents and store in an array 
    foreach ($htmlEnglish->find('div.thikr') as $e) {
        $arrayEnglish[] = $e->plaintext;
    }


    $dir = 'sqlite:C:\AndroidProjects\HisnulMuslim\app\src\main\assets\hisnMuslimDb.db';
    $databaseHandler = new PDO($dir) or die("Can not open database");
// Get entire data and insert into the database
    for ($i = 0; $i < count($arrayArabic); $i++) {
        echo $hadeethArabic = SQLite3::escapeString(trim($arrayArabic[$i]));
        echo $hadeethSwahili = SQLite3::escapeString(trim($arraySwahili[$i]));
        echo $hadeethEnglish = SQLite3::escapeString(trim($arrayEnglish[$i]));
        echo $hadeethNumber = $i + 1;
        echo '----------------------------';
        echo '<br/><br/>';

        $query = "INSERT INTO Hadeeth('id','hadeeth_category_id','hadeeth_number','content_arabic','content_swahili','content_english') VALUES (NULL,$categoryNumber,$hadeethNumber,'$hadeethArabic','$hadeethSwahili','$hadeethEnglish')";

        $databaseHandler->exec($query);
        //die(print_r($databaseHandler->errorInfo(), true));
    }

//foreach ($databaseHandler->query($query) as $row) {
//    //echo $row['hadeeth_number'] . "<br>";
//}
    $databaseHandler = NULL; // closes connection 
}

