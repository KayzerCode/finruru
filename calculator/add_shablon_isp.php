<?php 
/* Исполняющая php */
if (isset ($_POST['elnaz']) AND !empty ($_POST['elnaz']))

			{
            
$_POST['elnaz'] = htmlspecialchars ($_POST['elnaz']);

if(get_magic_quotes_gpc()){ 
			            $elnaz = stripslashes($_POST['elnaz']); 

        } else { 
			            $elnaz = addslashes($_POST['elnaz']); 

        } 

include("bd.php");  

/* Внедряем в таблицу новый объект */
$res = mysql_query("INSERT INTO `shablons` (`name`) VALUES ('$elnaz')") or die ("error - not insert");

if (is_uploaded_file($_FILES['strimg']['tmp_name'])) 


			{

			
$id1 = mysql_insert_id();

$pathinfo = pathinfo($_FILES['strimg']['name']);

$extension = $pathinfo['extension'];

$filename = $id1 . '.' . 'jpg';

$result = mysql_query("UPDATE `shablons` SET `foto` = '".$filename."' WHERE `id` =" .$id1, $link);

$uploadfile_double = 'img/images_shablons/' . $filename; // not admin folder

move_uploaded_file($_FILES['strimg']['tmp_name'], $uploadfile_double); 

			}

header("Location: calculation.php");
}
?>