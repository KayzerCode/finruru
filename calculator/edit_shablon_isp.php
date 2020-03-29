<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']) AND isset ($_POST['newshabnaz']) AND !empty ($_POST['newshabnaz']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['newshabnaz'] = htmlspecialchars ($_POST['newshabnaz']);


if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 
			            $newshabnaz = stripslashes($_POST['newshabnaz']);

        } else { 
            $id = addslashes($_POST['id']); 
			            $newshabnaz = addslashes($_POST['newshabnaz']); 

        } 
        $id = (int)$id;
			if ($id == '0') {header("Location: handbook.php?group=1");}

include("bd.php");  

/* Редактируем в таблицу новый объект */
$result1 = mysql_query("UPDATE `shablons` SET name = ('" . $newshabnaz .  "') WHERE id = ('" . $id .  "')", $link) or die ("error");


if (is_uploaded_file($_FILES['strimg']['tmp_name'])) 


			{

$pathinfo = pathinfo($_FILES['strimg']['name']);
$extension = $pathinfo['extension'];
$filename = $id . '.' . 'jpg';
?>
<?php include("bd.php");   ?>
<?php
$result = mysql_query("UPDATE `shablons` SET `foto` = '".$filename."' WHERE `id` =" .$id, $link);

$uploadfile_double = 'img/images_shablons/' . $filename; // not admin folder

move_uploaded_file($_FILES['strimg']['tmp_name'], $uploadfile_double);

			}

header("Location: calculation.php");
}
?>