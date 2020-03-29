<?php 
		if (isset ($_GET['id']) AND $_GET['id'] != '')
		
				{

$id = intval ($_GET['id']);
$_GET['id_shab'] = htmlspecialchars ($_GET['id_shab']);
$_GET['id_room'] = htmlspecialchars ($_GET['id_room']);
$id_shab = $_GET['id_shab'];
$id_room = $_GET['id_room'];
	if ($id != '0')
	
						{
include("bd.php");  
$result1 = mysql_query("UPDATE `components` SET `foto` = ('') WHERE `id` = ('" . $id .  "')");
$image = $id . '.' . 'jpg';
$file = 'img/images_components/' . $image;
unlink ($file);
header("Location: edit_component10.php?id_edit_comp=" . $id . "&id_shab=" . $id_shab . "&id_room=" . $id_room);
						}

				} else {
						die ("Error!!");
						}
?>