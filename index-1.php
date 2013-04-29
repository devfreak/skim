<?php
error_reporting(E_ALL | E_STRICT);
//available letters in array
$avail = array(
    "a" => "a",
    "b" => "b",
    "c" => "c",
    "d" => "d",
    "e" => "e",
    "f" => "f",
    "g" => "g",
    "h" => "h",
    "i" => "i",
    "j" => "j");
//available connectors in array
$con = array(
    array("a", "d", "h"), array("b", "d", "e"),
    array("e", "f", "i"), array("c", "f", "g"),
    array("a", "g", "j"), array("h", "i", "j"));

function setAvail($break){
    global $avail;
    if($break == 1){
        $temp_avail = $avail;
    }
    return $temp_avail;
}

function randletter($array_letters){
    global $break;
    $break = 0;
    $rand_letter = array_rand($array_letters, 1);
    $chosen_letter = $array_letters[$rand_letter[0]];
    return $chosen_letter;
}

function getConnectors($chosen_letter){
    global $con;
    $resConnectors = array();
    for($i = 0; $i < 6; $i++){
        $temp_array = $con[$i];
        if(in_array($chosen_letter, $temp_array) == true){
            array_push($resConnectors, "$i");
        }
    }
    return $resConnectors;
}

function getRandConnector($connectors){
    shuffle($connectors);
    return $connectors[0];
}

function removeLetter($letter){
    global $temp_avail;
    $temp_avail = array_diff($temp_avail, array($letter));
    shuffle($temp_avail);
    return $temp_avail;
}

function check_con_let($connector, $letter){
    global $con;
    $lettersfromconnector = $con[$connector];

    for($i = 0; $i < 10; $i++){
        if(in_array($letter[$i], $lettersfromconnector)){
            $next_letter = $letter[$i];
            return $next_letter;
            break;
        }
        if($i == 9){
            echo "ENDE";
        }
    }

}
/*
//break for setAvail = false
$break = 1;
$temp_avail = setAvail();
//functions abfolge
$letter = randletter($temp_avail);
$getcon = getConnectors($letter);
$new_letter = removeLetter($letter);
print_r($getcon);
echo "<br>";
$chosenConnector = getRandConnector($getcon);
print_r($letter);
print_r($new_letter);
$next_letter = check_con_let($chosenConnector, $new_letter);
echo $next_letter;

*/

$nl = 0;
$temp_avail = setAvail(1);
while(count($temp_avail)>0){
    if($nl == 1){
        $letter = $next_letter;
    }else{
        $letter = randletter($temp_avail);
    }
    $getcon = getConnectors($letter);
    $new_letter = removeLetter($letter);
    $chosenConnector = getRandConnector($getcon);
    $nl = 1;
    $next_letter = check_con_let($chosenConnector, $new_letter);
}
 
/*
$hallo = array("asd" => "asd", "kffk" => "kffk");
$hallo = array_diff($hallo, array("asd"));
print_r($hallo);
 

$nl = 0;
$break = 1;
$temp_avail = setAvail();
for($i = 1; $i < 5; $i++){
 if($nl == 1){
        $letter = $next_letter;
    }else{
        $letter = randletter($temp_avail);
    }
    $getcon = getConnectors($letter);
    $new_letter = removeLetter($letter);
    $chosenConnector = getRandConnector($getcon);
//    print_r($chosenConnector);

    $nl = 1;
    $next_letter = check_con_let($chosenConnector, $new_letter);
}
?>
