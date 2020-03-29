<?php 
		if (isset ($_GET['id']) AND $_GET['id'] != '')
		
				{

$id = intval ($_GET['id']);
	if ($id != '0')
	
						{
include("bd.php");  
$result1 = mysql_query("UPDATE `polobr` SET `image` = ('') WHERE `id` = ('" . $id .  "')");
$image = $id . '.' . 'jpg';
$file = 'img/images_polobr/' . $image;
unlink ($file);
header("Location: edit_element_polobr.php?id=" . $id);
						}

				} else {
						die ("Error!!");
						}
?>