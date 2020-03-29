<?php $id = intval($_POST['id']);

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

$pathinfo = pathinfo($_FILES['strimg']['name']);
$extension = $pathinfo['extension'];
$filename = $id . '.' . 'jpg';
?>
<?php include("bd.php");   ?>
<?php
$result = mysql_query("UPDATE `handbook_elements` SET `image` = '".$filename."' WHERE `id` =" .$id, $link);

$uploadfile_double = 'img/images_elements/' . $filename; // not admin folder

move_uploaded_file($_FILES['strimg']['tmp_name'], $uploadfile_double);

header("Location: edit_element.php?id=" . $id . "");

}?>