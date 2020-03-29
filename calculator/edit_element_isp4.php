<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']) AND isset ($_POST['newelnaz']) AND !empty ($_POST['newelnaz']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['newelnaz'] = htmlspecialchars ($_POST['newelnaz']);
$_POST['group'] = htmlspecialchars ($_POST['group']);
$_POST['id_shab'] = htmlspecialchars ($_POST['id_shab']);
$_POST['id_room'] = htmlspecialchars ($_POST['id_room']);



if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 
			            $newelnaz = stripslashes($_POST['newelnaz']);
								$group = stripslashes($_POST['group']);
											            $id_shab = stripslashes($_POST['id_shab']); 
			            $id_room = stripslashes($_POST['id_room']); 


        } else { 
            $id = addslashes($_POST['id']); 
			            $newelnaz = addslashes($_POST['newelnaz']); 
								$group = addslashes($_POST['group']);
											            $id_shab = addslashes($_POST['id_shab']);
			$id_room = addslashes($_POST['id_room']); 
 

        } 
        $id = (int)$id;
		$group = (int)$group;
			if ($id == '0') {header("Location: handbook.php?group=1");}
			if ($group == '0') {header("Location: handbook.php?group=1");}

include("bd.php");  

/* Редактируем в таблицу новый объект */
$result1 = mysql_query("UPDATE `handbook_elements` SET `name` = ('" . $newelnaz .  "') WHERE `id` = ('" . $id .  "')", $link) or die ("error");


if (is_uploaded_file($_FILES['strimg']['tmp_name'])) 


			{

$pathinfo = pathinfo($_FILES['strimg']['name']);
$extension = $pathinfo['extension'];
$filename = $id . '.' . 'jpg';
?>
<?php include("bd.php");   ?>
<?php
$result = mysql_query("UPDATE `handbook_elements` SET `image` = '".$filename."' WHERE `id` =" .$id, $link);

$uploadfile_double = 'img/images_elements/' . $filename; // not admin folder

move_uploaded_file($_FILES['strimg']['tmp_name'], $uploadfile_double);

			}

header("Location: add_stena.php?id_shab=" . $id_shab . "&id_room=" . $id_room);
}
?>