<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']) AND isset ($_POST['group']) AND !empty ($_POST['group']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['group'] = htmlspecialchars ($_POST['group']);
$_POST['elid'] = htmlspecialchars ($_POST['elid']);
$_POST['id_comp'] = htmlspecialchars ($_POST['id_comp']);


if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 
								$group = stripslashes($_POST['group']);
												$elid = stripslashes($_POST['elid']);
            $id_comp = stripslashes($_POST['id_comp']); 

        } else { 
            $id = addslashes($_POST['id']); 
								$group = addslashes($_POST['group']); 
            $id_comp = stripslashes($_POST['id_comp']); 
												$elid = addslashes($_POST['elid']);

        } 
        $id = (int)$id;
		$group = (int)$group;
				$elid = (int)$elid;

			if ($id == '0') {header("Location: show_elements.php?group=1");}
			if ($group == '0') {header("Location: show_elements.php?group=1");}
						if ($elid == '0') {header("Location: show_elements.php?group=1");}


include("bd.php");  

/* Редактируем в таблицу новый объект */
$res_del = mysql_query("DELETE FROM `shab_components` WHERE `id` = $id_comp AND `elid` = $elid AND `group` = $group") or die ("error");
if (file_exists ('img/images_components_shablon/' . $id_comp . '.' . 'jpg'))
{
	unlink ('img/images_components_shablon/' . $id_comp . '.' . 'jpg');
}
header("Location: show_element_other.php?id=" . $id . "&elid=" . $elid . "&group=" . $group);
}
?>