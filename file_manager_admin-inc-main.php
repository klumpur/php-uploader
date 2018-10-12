<?php 
mb_http_input("utf-8");
mb_http_output("utf-8");

ini_set('error_reporting', E_ALL);
//error_reporting(E_ERROR | E_PARSE);

////////////////////////////////////////////
////Settings///////////// //////////////////
$AdminUserName="administrator";
$AdminPassWord="admin";
$fileFolder="fileFolder";
$limit = 10;
////////////////////////////////////////////


///Functions List
function FileSizeConvert($bytes)
{
$result=NULL;
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}

function time_elapsed($secs){
    return $Edays= $secs / 86400 % 7;
    
    }

$nowtime = time();

?>