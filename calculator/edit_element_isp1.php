<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']) AND isset ($_POST['newelnaz']) AND !empty ($_POST['newelnaz']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['newelnaz'] = htmlspecialchars ($_POST['newelnaz']);
$_POST['group'] = htmlspecialchars ($_POST['group']);


if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 
			            $newelnaz = stripslashes($_POST['newelnaz']);
								$group = stripslashes($_POST['group']);

        } else { 
            $id = addslashes($_POST['id']); 
			            $newelnaz = addslashes($_POST['newelnaz']); 
								$group = addslashes($_POST['group']); 

        } 
        $id = (int)$id;
		$group = (int)$group;
			if ($id == '0') {header("Location: handbook.php?group=1");}
			if ($group == '0') {header("Location: handbook.php?group=1");}

include("bd.php");  

/* Редактируем в таблицу новый объект */
$result1 = mysql_query("UPDATE `handbook_elements` SET name = ('" . $newelnaz .  "') WHERE id = ('" . $id .  "')", $link) or die ("error");


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

header("Location: show_elements.php?id=" . $id);
}
?>