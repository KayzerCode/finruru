<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']) AND isset ($_POST['group']) AND !empty ($_POST['group']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['group'] = htmlspecialchars ($_POST['group']);
$_POST['elid'] = htmlspecialchars ($_POST['elid']);
$_POST['id_shab'] = htmlspecialchars ($_POST['id_shab']);


if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']);
								$group = stripslashes($_POST['group']);
												$elid = stripslashes($_POST['elid']);
												$id_shab = stripslashes($_POST['id_shab']); 


        } else { 
            $id = addslashes($_POST['id']);
								$group = addslashes($_POST['group']);
												$elid = addslashes($_POST['elid']);
												$id_shab = addslashes($_POST['id_shab']); 


        } 
        $id = (int)$id;
		$group = (int)$group;
				$elid = (int)$elid;

			if ($id == '0') {header("Location: show_elements.php?group=1");}
			if ($group == '0') {header("Location: show_elements.php?group=1");}
						if ($elid == '0') {header("Location: show_elements.php?group=1");}


include("bd.php");  

/* Редактируем в таблицу новый объект */
if (file_exists ('img/images_components/' . $id . '.' . 'jpg'))
{
	unlink ('img/images_components/' . $id . '.' . 'jpg');
}
$res_del = mysql_query("DELETE FROM `components` WHERE `id` = '$id' AND `elid` = '$elid' AND `group` = '$group'") or die ("error");

header("Location: add_elements.php?id_shab=" . $id_shab . "&group=" . $group);
}
?>