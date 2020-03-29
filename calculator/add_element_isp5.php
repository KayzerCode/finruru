<?php 
/* Исполняющая php */
if (isset ($_POST['group']) AND !empty ($_POST['group']) AND isset ($_POST['elnaz']) AND !empty ($_POST['elnaz']))

			{
            
$_POST['group'] = htmlspecialchars ($_POST['group']);
$_POST['elnaz'] = htmlspecialchars ($_POST['elnaz']);
$_POST['id_shab'] = htmlspecialchars ($_POST['id_shab']);
$_POST['id_room'] = htmlspecialchars ($_POST['id_room']);

if(get_magic_quotes_gpc()){ 
            $group = stripslashes($_POST['group']); 
			            $elnaz = stripslashes($_POST['elnaz']);
						$id_shab = stripslashes($_POST['id_shab']); 
			            $id_room = stripslashes($_POST['id_room']); 
 

        } else { 
            $group = addslashes($_POST['group']); 
			            $elnaz = addslashes($_POST['elnaz']); 
$id_shab = addslashes($_POST['id_shab']); 
			            $id_room = addslashes($_POST['id_room']); 

        } 
        $group = (int)$group;
			if ($group == '0') {header("Location: handbook.php?group=1");}

include("bd.php");  

/* Внедряем в таблицу новый объект */
$res = mysql_query("INSERT INTO `handbook_elements` (`group`, `name`) VALUES ('$group', '$elnaz')") or die ("error");

if (is_uploaded_file($_FILES['strimg']['tmp_name'])) 


			{

			
$id1 = mysql_insert_id();

$pathinfo = pathinfo($_FILES['strimg']['name']);

$extension = $pathinfo['extension'];

$filename = $id1 . '.' . 'jpg';

$result = mysql_query("UPDATE `handbook_elements` SET `image` = '".$filename."' WHERE `id` =" .$id1, $link);

$uploadfile_double = 'img/images_elements/' . $filename; // not admin folder

move_uploaded_file($_FILES['strimg']['tmp_name'], $uploadfile_double); 

			}

header("Location: add_potobr.php?id_shab=" . $id_shab . "&id_room=" . $id_room);
}
?>