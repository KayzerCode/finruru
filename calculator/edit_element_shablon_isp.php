<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']) AND isset ($_POST['newelnaz']) AND !empty ($_POST['newelnaz']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['newelnaz'] = htmlspecialchars ($_POST['newelnaz']);
if (isset ($_POST['metraj'])) {$metraj = htmlspecialchars ($_POST['metraj']);}
if (isset ($_POST['quantity'])) {$quantity = htmlspecialchars ($_POST['quantity']);}
$koef = htmlspecialchars ($_POST['koef']);


if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 
			            $newelnaz = stripslashes($_POST['newelnaz']);
								$elid = stripslashes($_POST['elid']);
								$group = stripslashes($_POST['group']);

        } else { 
            $id = addslashes($_POST['id']); 
			            $newelnaz = addslashes($_POST['newelnaz']); 
								$elid = addslashes($_POST['elid']);
								$group = addslashes($_POST['group']);

        } 
        $id = (int)$id;
		$elid = (int)$elid;
				$group = (int)$group;

			if ($id == '0') {header("Location: handbook.php?group=1");}
			if ($elid == '0') {header("Location: handbook.php?group=1");}

include("bd.php");  

/* Редактируем в таблицу новый объект */
$result1 = mysql_query("UPDATE `shab_elements` SET `name` = ('" . $newelnaz .  "') WHERE `id` = ('" . $elid .  "')", $link) or die ("error1");

if (isset ($quantity))
	{
			$result4 = mysql_query("UPDATE `shab_elements` SET `quantity` = ('" . $quantity .  "') WHERE `id` = ('" . $elid .  "')", $link) or die ("error3");
		}
$result3 = mysql_query("UPDATE `shab_elements` SET `koef` = ('" . $koef .  "') WHERE `id` = ('" . $elid .  "')", $link) or die ("error4");



if (is_uploaded_file($_FILES['strimg']['tmp_name'])) 


			{

$pathinfo = pathinfo($_FILES['strimg']['name']);
$extension = $pathinfo['extension'];
$filename = $elid . '.' . 'jpg';
?>
<?php include("bd.php");   ?>
<?php
$result = mysql_query("UPDATE `shab_elements` SET `image` = '".$filename."' WHERE `id` =" .$elid, $link);

$uploadfile_double = 'img/images_elements_shablon/' . $filename; // not admin folder

move_uploaded_file($_FILES['strimg']['tmp_name'], $uploadfile_double);
			
			}

header("Location: show_element_other.php?id=" . $id . "&elid=" . $elid . "&group=" . $group);
}
?>