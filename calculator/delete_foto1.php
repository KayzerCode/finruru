<?php 
		if (isset ($_GET['id']) AND $_GET['id'] != '')
		
				{

$id = intval ($_GET['id']);

	if ($id != '0')
	
						{
include("bd.php");  
$result1 = mysql_query("UPDATE `components` SET foto = ('') WHERE id = ('" . $id .  "')");
$image = $id . '.' . 'jpg';
$file = 'img/images_components/' . $image;
unlink ($file);
header("Location: edit_component1.php?id_edit_comp=" . $id);
						}

				} else {
						die ("Error!!");
						}
?>