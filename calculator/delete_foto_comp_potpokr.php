<?php 
$id = intval ($_GET['id']);
if (isset ($id) AND !empty ($id))



			{
            
$id = htmlspecialchars ($id);
if(get_magic_quotes_gpc()){ 
            $id = stripslashes($id); 
        } else { 
            $id = addslashes($id); 
        } 
        $id = (int)$id;
			if ($id == '0') {die ("Invalid element!!!!");}
include("bd.php");  
$result1 = mysql_query("UPDATE `components_potpokr` SET `foto` = ('') WHERE `id` = ('" . $id .  "')");
$image = $id . '.' . 'jpg';
$file = 'img/images_components_potpokr/' . $image;
unlink ($file);
header("Location: edit_component_potpokr.php?id_edit_comp=" . $id . ""); 

			}
?>