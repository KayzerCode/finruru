<?php 
/* Исполняющая php */
if (isset ($_POST['id_shab']) AND !empty ($_POST['id_shab']))

			{
            
$_POST['roomnaz'] = htmlspecialchars ($_POST['roomnaz']);
$_POST['id_shab'] = htmlspecialchars ($_POST['id_shab']);
$_POST['metraj'] = htmlspecialchars ($_POST['metraj']);
$_POST['vuspot'] = htmlspecialchars ($_POST['vuspot']);
$_POST['jm'] = htmlspecialchars ($_POST['jm']);
$_POST['id_room'] = htmlspecialchars ($_POST['id_room']);

if(get_magic_quotes_gpc()){ 
			            $roomnaz = stripslashes($_POST['roomnaz']);
										            $id = stripslashes($_POST['id_shab']); 
$metraj = stripslashes($_POST['metraj']);
$vuspot = stripslashes($_POST['vuspot']);
$jm = stripslashes($_POST['jm']);
$id_room = stripslashes($_POST['id_room']);

        } else { 
			            $roomnaz = addslashes($_POST['roomnaz']);
									            $id = addslashes($_POST['id_shab']);
$metraj = addslashes($_POST['metraj']);
$vuspot = addslashes($_POST['vuspot']);
$jm = addslashes($_POST['jm']);
$id_room = addslashes($_POST['id_room']);


        } 

include("bd.php");  

/* Внедряем в таблицу новый объект */
$result1 = mysql_query("UPDATE `rooms_shab` SET `name` = ('" . $roomnaz .  "') WHERE `id` = ('" . $id_room .  "')", $link) or die ("error");
$result2 = mysql_query("UPDATE `rooms_shab` SET `metraj` = ('" . $metraj .  "') WHERE `id` = ('" . $id_room .  "')", $link) or die ("error");
$result3 = mysql_query("UPDATE `rooms_shab` SET `vuspot` = ('" . $vuspot .  "') WHERE `id` = ('" . $id_room .  "')", $link) or die ("error");
$result4 = mysql_query("UPDATE `rooms_shab` SET `jm` = ('" . $jm .  "') WHERE `id` = ('" . $id_room .  "')", $link) or die ("error");
$result5 = mysql_query("UPDATE `polpokr` SET `metraj` = ('" . $metraj .  "') WHERE `id_room` = ('" . $id_room .  "') AND `id_shab` = '$id'", $link) or die ("error");
$result6 = mysql_query("UPDATE `polobr` SET `jm` = ('" . $jm .  "') WHERE `id_room` = ('" . $id_room .  "') AND `id_shab` = '$id'", $link) or die ("error2");
$result7 = mysql_query("UPDATE `stena` SET `vuspot` = ('" . $vuspot .  "') WHERE `id_room` = ('" . $id_room .  "') AND `id_shab` = '$id'", $link) or die ("error2");
$result8 = mysql_query("UPDATE `stena` SET `jm` = ('" . $jm .  "') WHERE `id_room` = ('" . $id_room .  "') AND `id_shab` = '$id'", $link) or die ("error2");
$result9 = mysql_query("UPDATE `potpokr` SET `metraj` = ('" . $metraj .  "') WHERE `id_room` = ('" . $id_room .  "') AND `id_shab` = '$id'", $link) or die ("error");
$result10 = mysql_query("UPDATE `potobr` SET `jm` = ('" . $jm .  "') WHERE `id_room` = ('" . $id_room .  "') AND `id_shab` = '$id'", $link) or die ("error2");



$sel1 = mysql_query ("SELECT * FROM `categories` WHERE `id` = '1'") or die ("Not select category");
					$row = mysql_fetch_array ($sel1);


header("Location: calc_shab.php?id=" . $id . "&cat=" . $row['fix']);
}
?>