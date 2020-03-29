<?php 
/* Исполняющая php */
if (isset ($_POST['elid']) AND !empty ($_POST['elid']) AND isset ($_POST['newelnaz']) AND !empty ($_POST['newelnaz']))

			{
            
$_POST['elid'] = htmlspecialchars ($_POST['elid']);
$_POST['newelnaz'] = htmlspecialchars ($_POST['newelnaz']);
$_POST['group'] = htmlspecialchars ($_POST['group']);
$_POST['id_shab'] = htmlspecialchars ($_POST['id_shab']);



if(get_magic_quotes_gpc()){ 
            $elid = stripslashes($_POST['elid']); 
			            $newelnaz = stripslashes($_POST['newelnaz']);
								$group = stripslashes($_POST['group']);
											            $id_shab = stripslashes($_POST['id_shab']); 


        } else { 
            $elid = addslashes($_POST['elid']); 
			            $newelnaz = addslashes($_POST['newelnaz']); 
								$group = addslashes($_POST['group']);
											            $id_shab = addslashes($_POST['id_shab']);
 

        } 
        $elid = (int)$elid;
		$group = (int)$group;
			if ($elid == '0') {header("Location: handbook.php?group=1");}
			if ($group == '0') {header("Location: handbook.php?group=1");}

include("bd.php");  

/* Редактируем в таблицу новый объект */
$result1 = mysql_query("UPDATE `handbook_elements` SET `name` = ('" . $newelnaz .  "') WHERE `id` = ('" . $elid .  "')", $link) or die ("error");


if (is_uploaded_file($_FILES['strimg']['tmp_name'])) 


			{

$pathinfo = pathinfo($_FILES['strimg']['name']);
$extension = $pathinfo['extension'];
$filename = $elid . '.' . 'jpg';
?>
<?php include("bd.php");   ?>
<?php
$result = mysql_query("UPDATE `handbook_elements` SET `image` = '".$filename."' WHERE `id` =" . $elid, $link);

$uploadfile_double = 'img/images_elements/' . $filename; // not admin folder

move_uploaded_file($_FILES['strimg']['tmp_name'], $uploadfile_double);

			}

header("Location: add_elements.php?id_shab=" . $id_shab . "&group=" . $group);
}
?>