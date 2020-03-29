<?php 
/* Исполняющая php */
/* Проверяем на приход данных по имени нового объекта */

$_POST['group'] = htmlspecialchars ($_POST['group']);
$_POST['id'] = htmlspecialchars ($_POST['id']); // id of shablon

$_POST['elid'] = htmlspecialchars ($_POST['elid']);

$_POST['componentnaz'] = htmlspecialchars ($_POST['componentnaz']);

$_POST['position'] = htmlspecialchars ($_POST['position']);

$_POST['razm'] = htmlspecialchars ($_POST['razm']);

$_POST['stmat'] = htmlspecialchars ($_POST['stmat']);

$_POST['strab'] = htmlspecialchars ($_POST['strab']);

$_POST['stsopmat'] = htmlspecialchars ($_POST['stsopmat']);

$_POST['trud'] = htmlspecialchars ($_POST['trud']);



if (get_magic_quotes_gpc())

		{
$elid = stripslashes ($_POST['elid']);
$id = stripslashes ($_POST['id']);
$group = stripslashes ($_POST['group']);

$componentnaz = stripslashes ($_POST['componentnaz']);

$position = stripslashes ($_POST['position']);

$razm = stripslashes ($_POST['razm']);

$stmat = stripslashes ($_POST['stmat']);

$strab = stripslashes ($_POST['strab']);

$stsopmat = stripslashes ($_POST['stsopmat']);

$trud = stripslashes ($_POST['trud']);		

include("bd.php");  

/* Внедряем в таблицу новый объект */

$result = mysql_query("INSERT INTO `shab_components` (`group`, `elid`, `id_shab`,`name`, `position`, `stmat`, `strab`, `stsopmat`, `foto`, `trud`, `razm`) VALUES ('$group', '$elid', '$id', '$componentnaz', '$position', '$stmat', '$strab', '$stsopmat', '', '$trud', '$razm')") or die ("Not insert!!");

if (is_uploaded_file($_FILES['strimg']['tmp_name'])) 


			{
$id1 = mysql_insert_id();

$pathinfo = pathinfo($_FILES['strimg']['name']);

$extension = $pathinfo['extension'];

$filename = $id1 . '.' . 'jpg';

$result = mysql_query("UPDATE `shab_components` SET `foto` = '".$filename."' WHERE `id` =" .$id1, $link);

$uploadfile_double = 'img/images_components_shablon/' . $filename; // not admin folder

move_uploaded_file($_FILES['strimg']['tmp_name'], $uploadfile_double);}

//return

header("Location: show_element_other.php?id=" . $id . "&elid=" . $elid . "&group=" . $group);


	}?>