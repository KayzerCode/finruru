<?php 
/* Исполняющая php */
/* Проверяем на приход данных по имени нового объекта */

$_POST['id_polpokr'] = htmlspecialchars ($_POST['id_polpokr']);

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
$id_polpokr = stripslashes ($_POST['id_polpokr']);

$id_room = stripslashes ($_POST['id_room']);

$componentnaz = stripslashes ($_POST['componentnaz']);

$position = stripslashes ($_POST['position']);

$razm = stripslashes ($_POST['razm']);

$stmat = stripslashes ($_POST['stmat']);

$strab = stripslashes ($_POST['strab']);

$stsopmat = stripslashes ($_POST['stsopmat']);

$trud = stripslashes ($_POST['trud']);		

include("bd.php");  

/* Внедряем в таблицу новый объект */
$select = mysql_query ("SELECT * FROM `polpokr` WHERE `id` = '$id_polpokr'");
$row = mysql_fetch_array ($select);
$result = mysql_query("INSERT INTO `components_polpokr` (`id_polpokr`, `id_room`, `id_shab`, `name`, `position`, `stmat`, `strab`, `stsopmat`, `foto`, `trud`, `razm`) VALUES ('$id_polpokr', '$id_room', '$row[id_shab]', '$componentnaz', '$position', '$stmat', '$strab', '$stsopmat', '', '$trud', '$razm')") or die ("Not insert!!");

if (is_uploaded_file($_FILES['strimg']['tmp_name'])) 


			{
$id1 = mysql_insert_id();

$pathinfo = pathinfo($_FILES['strimg']['name']);

$extension = $pathinfo['extension'];

$filename = $id1 . '.' . 'jpg';

$result = mysql_query("UPDATE `components_polpokr` SET `foto` = '".$filename."' WHERE `id` =" .$id1, $link);

$uploadfile_double = 'img/images_components_polpokr/' . $filename; // not admin folder

move_uploaded_file($_FILES['strimg']['tmp_name'], $uploadfile_double);}

//return

header("Location: show_polpokr.php?id=" . $row['id_shab'] . "&id_room=" . $row['id_room'] . "&id_polpokr=" . $id_polpokr);


	}?>