<?php 
/* Исполняющая php */
/* Проверяем на приход данных по имени нового объекта */

$_POST['id'] = htmlspecialchars ($_POST['id']); // id component

$_POST['id_shab'] = htmlspecialchars ($_POST['id_shab']); // id component

$_POST['id_potpokr'] = htmlspecialchars ($_POST['id_potpokr']);

$_POST['id_room'] = htmlspecialchars ($_POST['id_room']);

$_POST['componentnaz'] = htmlspecialchars ($_POST['componentnaz']);

$_POST['position'] = htmlspecialchars ($_POST['position']);

$_POST['razm'] = htmlspecialchars ($_POST['razm']);

$_POST['stmat'] = htmlspecialchars ($_POST['stmat']);

$_POST['strab'] = htmlspecialchars ($_POST['strab']);

$_POST['stsopmat'] = htmlspecialchars ($_POST['stsopmat']);

$_POST['trud'] = htmlspecialchars ($_POST['trud']);



if (get_magic_quotes_gpc())

		{

$id = stripslashes ($_POST['id']);

$id_shab = stripslashes ($_POST['id_shab']);

$id_potpokr = stripslashes ($_POST['id_potpokr']);

$id_room = stripslashes ($_POST['id_room']);

$componentnaz = stripslashes ($_POST['componentnaz']);

$position = stripslashes ($_POST['position']);

$razm = stripslashes ($_POST['razm']);

$stmat = stripslashes ($_POST['stmat']);

$strab = stripslashes ($_POST['strab']);

$stsopmat = htmlspecialchars ($_POST['stsopmat']);

$trud = htmlspecialchars ($_POST['trud']);		

include("bd.php");  

/* Edit */

$result1 = mysql_query("UPDATE `components_potpokr`SET `name` = ('" . $componentnaz .  "') WHERE `id` = ('" . $id .  "')");

$result2 = mysql_query("UPDATE `components_potpokr` SET `razm` = ('" . $razm .  "') WHERE `id` = ('" . $id .  "')");

$result3 = mysql_query("UPDATE `components_potpokr` SET `stmat` = ('" . $stmat .  "') WHERE `id` = ('" . $id .  "')");

$result4 = mysql_query("UPDATE `components_potpokr` SET `strab` = ('" . $strab .  "') WHERE `id` = ('" . $id .  "')");

$result5 = mysql_query("UPDATE `components_potpokr` SET `stsopmat` = ('" . $stsopmat .  "') WHERE `id` = ('" . $id .  "')");

$result6 = mysql_query("UPDATE `components_potpokr` SET `trud` = ('" . $trud .  "') WHERE `id` = ('" . $id .  "')");

if (is_uploaded_file($_FILES['compimg']['tmp_name'])) 


			{
			
			
$pathinfo = pathinfo($_FILES['compimg']['name']);

$extension = $pathinfo['extension'];

$filename = $id . '.' . 'jpg';

$result = mysql_query("UPDATE `components_potpokr` SET `foto` = '".$filename."' WHERE `id` =" .$id, $link);

$uploadfile_double = 'img/images_components_potpokr/' . $filename; // not admin folder

move_uploaded_file($_FILES['compimg']['tmp_name'], $uploadfile_double); 

}
//return

header("Location: show_potpokr.php?id_potpokr=" . $id_potpokr . "&id_room=" . $id_room . "&id=" . $id_shab);


	}?>