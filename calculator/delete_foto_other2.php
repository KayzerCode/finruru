<?php 
		if (isset ($_GET['id']) AND $_GET['id'] != '')
		
				{

$id = intval ($_GET['id']);
$_GET['id_shab'] = htmlspecialchars ($_GET['id_shab']);
$_GET['group'] = htmlspecialchars ($_GET['group']);
$id_shab = $_GET['id_shab'];
$group = $_GET['group'];
	if ($id != '0')
	
						{
include("bd.php");  
$result1 = mysql_query("UPDATE `components` SET `foto` = ('') WHERE `id` = ('" . $id .  "')");
$image = $id . '.' . 'jpg';
$file = 'img/images_components/' . $image;
unlink ($file);
$res = mysql_query ("SELECT * FROM `components` WHERE `id` = '$id'") or die ("NOT select");
$row = mysql_fetch_array ($res);
header("Location: edit_component_other2.php?id_edit_comp=" . $id . "&id_shab=" . $id_shab . "&group=" . $group . "&elid=" . $row['elid']);
						}

				} else {
						die ("Error!!");
						}
?>