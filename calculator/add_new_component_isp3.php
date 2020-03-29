<?php 
/* Исполняющая php */
/* Проверяем на приход данных по имени нового объекта */

$_POST['group'] = htmlspecialchars ($_POST['group']);

$_POST['elid'] = htmlspecialchars ($_POST['elid']);

$_POST['componentnaz'] = htmlspecialchars ($_POST['componentnaz']);

$_POST['position'] = htmlspecialchars ($_POST['position']);

$_POST['razm'] = htmlspecialchars ($_POST['razm']);

$_POST['stmat'] = htmlspecialchars ($_POST['stmat']);

$_POST['strab'] = htmlspecialchars ($_POST['strab']);

$_POST['stsopmat'] = htmlspecialchars ($_POST['stsopmat']);

$_POST['trud'] = htmlspecialchars ($_POST['trud']);

$_POST['id_shab'] = htmlspecialchars ($_POST['id_shab']);
$_POST['id_room'] = htmlspecialchars ($_POST['id_room']);



if (get_magic_quotes_gpc())

		{
$elid = stripslashes ($_POST['elid']);

$group = stripslashes ($_POST['group']);

$componentnaz = stripslashes ($_POST['componentnaz']);

$position = stripslashes ($_POST['position']);

$razm = stripslashes ($_POST['razm']);

$stmat = stripslashes ($_POST['stmat']);

$strab = stripslashes ($_POST['strab']);

$stsopmat = stripslashes ($_POST['stsopmat']);

$trud = stripslashes ($_POST['trud']);	

$id_shab = stripslashes($_POST['id_shab']); 
$id_room = stripslashes($_POST['id_room']); 
	

include("bd.php");  

/* Внедряем в таблицу новый объект */

$result = mysql_query("INSERT INTO `components` (`group`, `elid`, `name`, `position`, `stmat`, `strab`, `stsopmat`, `foto`, `trud`, `razm`) VALUES ('$group', '$elid', '$componentnaz', '$position', '$stmat', '$strab', '$stsopmat', '', '$trud', '$razm')") or die ("Not insert!!");

if (is_uploaded_file($_FILES['strimg']['tmp_name'])) 


			{
$id1 = mysql_insert_id();

$pathinfo = pathinfo($_FILES['strimg']['name']);

$extension = $pathinfo['extension'];

$filename = $id1 . '.' . 'jpg';

$result = mysql_query("UPDATE `components` SET `foto` = '".$filename."' WHERE `id` =" .$id1, $link);

$uploadfile_double = 'img/images_components/' . $filename; // not admin folder

move_uploaded_file($_FILES['strimg']['tmp_name'], $uploadfile_double);}

//return

header("Location: add_stena.php?id_shab=" . $id_shab . "&id_room=" . $id_room);


	}?>