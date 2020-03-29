<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']) AND isset ($_POST['group']) AND !empty ($_POST['group']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['group'] = htmlspecialchars ($_POST['group']);


if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 
								$group = stripslashes($_POST['group']);
								$elid = stripslashes($_POST['elid']);

        } else { 
            $id = addslashes($_POST['id']); 
								$group = addslashes($_POST['group']); 
								$elid = addslashes($_POST['elid']);

        } 
        $id = (int)$id;
		$group = (int)$group;
			if ($id == '0') {header("Location: handbook.php?group=1");}
			if ($group == '0') {header("Location: handbook.php?group=1");}

include("bd.php");  

/* Редактируем в таблицу новый объект */
if (file_exists ('img/images_elements_shablon/' . $elid . '.' . 'jpg'))
{
	unlink ('img/images_elements_shablon/' . $elid . '.' . 'jpg');
}
$res_del = mysql_query("DELETE FROM `shab_elements` WHERE `id` = $elid") or die ("error");
$res = mysql_query ("SELECT * FROM `shab_components` WHERE `elid` = $elid");
while ($row2 = mysql_fetch_array ($res))
	{
		if (file_exists ('img/images_components_shablon/' . $row2['id'] . '.' . 'jpg'))
{
	unlink ('img/images_components_shablon/' . $row2['id'] . '.' . 'jpg');
}
		$res_del2 = mysql_query("DELETE FROM `shab_components` WHERE `id` = $row2[id]") or die ("error");

	}
	$select_group = mysql_query ("SELECT * FROM `handbook_groups` WHERE `id` = '$group'");
	$row_group = mysql_fetch_array ($select_group);
$select_cat = mysql_query ("SELECT * FROM `categories` WHERE `id` = '$row_group[id_cat]'") or die ("Not select categorie");
$row_cat = mysql_fetch_array ($select_cat);
header("Location: calc_shab.php?id=" . $id . "&cat=" . $row_cat['fix']);
}
?>