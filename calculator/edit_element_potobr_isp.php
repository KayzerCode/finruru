<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']) AND isset ($_POST['newelnaz']) AND !empty ($_POST['newelnaz']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['newelnaz'] = htmlspecialchars ($_POST['newelnaz']);
$jm = htmlspecialchars ($_POST['jm']);
$koef = htmlspecialchars ($_POST['koef']);


if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 
			            $newelnaz = stripslashes($_POST['newelnaz']);
								$id_room = stripslashes($_POST['id_room']);

        } else { 
            $id = addslashes($_POST['id']); 
			            $newelnaz = addslashes($_POST['newelnaz']); 
								$id_room = addslashes($_POST['id_room']); 

        } 
        $id = (int)$id;
		$id_room = (int)$id_room;
			if ($id == '0') {header("Location: handbook.php?group=1");}
			if ($id_room == '0') {header("Location: handbook.php?group=1");}

include("bd.php");  

/* Редактируем в таблицу новый объект */
$result1 = mysql_query("UPDATE `potobr` SET `name` = ('" . $newelnaz .  "') WHERE id = ('" . $id .  "')", $link) or die ("error");
$result2 = mysql_query("UPDATE `potobr` SET `jm` = ('" . $jm .  "') WHERE id = ('" . $id .  "')", $link) or die ("error");
$result3 = mysql_query("UPDATE `potobr` SET `koef` = ('" . $koef .  "') WHERE id = ('" . $id .  "')", $link) or die ("error");



if (is_uploaded_file($_FILES['strimg']['tmp_name'])) 


			{

$pathinfo = pathinfo($_FILES['strimg']['name']);
$extension = $pathinfo['extension'];
$filename = $id . '.' . 'jpg';
?>
<?php include("bd.php");   ?>
<?php
$result = mysql_query("UPDATE `potobr` SET `image` = '".$filename."' WHERE `id` =" .$id, $link);

$uploadfile_double = 'img/images_potobr/' . $filename; // not admin folder

move_uploaded_file($_FILES['strimg']['tmp_name'], $uploadfile_double);
			
			}
$result = mysql_query ("SELECT * FROM `potobr` WHERE `id`= '$id'");
$row = mysql_fetch_array ($result);
header("Location: show_potobr.php?id=" . $row['id_shab'] . "&id_room=" . $id_room . "&id_potobr=" . $id);
}
?>