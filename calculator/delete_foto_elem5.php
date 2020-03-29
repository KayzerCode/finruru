<?php 
$id = intval ($_GET['id']);
if (isset ($id) AND !empty ($id))



			{
            
$id = htmlspecialchars ($id);
$_GET['id_shab'] = htmlspecialchars ($_GET['id_shab']);
$_GET['id_room'] = htmlspecialchars ($_GET['id_room']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($id);
						$id_shab = stripslashes($_GET['id_shab']); 
			$id_room = stripslashes($_GET['id_room']); 

        } else { 
            $id = addslashes($id);
						$id_shab = addslashes($_GET['id_shab']);
			$id_room = addslashes($_GET['id_room']); 

        } 
        $id = (int)$id;
			if ($id == '0') {die ("Invalid element!!!!");}
include("bd.php");  
$result1 = mysql_query("UPDATE `handbook_elements` SET `image` = ('') WHERE `id` = ('" . $id .  "')");
$image = $id . '.' . 'jpg';
$file = 'img/images_elements/' . $image;
unlink ($file);
header("Location: edit_element5.php?id=" . $id . "&id_shab=" . $id_shab . "&id_room=" . $id_room); 

			}
?>