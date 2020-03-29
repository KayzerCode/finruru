<?php 
/* Исполняющая php */
if (isset ($_GET['id']) AND !empty ($_GET['id']))



			{
            
$_GET['id'] = htmlspecialchars ($_GET['id']); // id ofshablon
$_GET['elid'] = htmlspecialchars ($_GET['elid']);
$_GET['group'] = htmlspecialchars ($_GET['group']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']);
			            $elid = stripslashes($_GET['elid']); 
			            $group = stripslashes($_GET['group']); 

        } else { 
            $id = addslashes($_GET['id']);
			            $elid = addslashes($_GET['elid']); 
			            $group = addslashes($_GET['group']); 

        } 
        $id = (int)$id;
			if ($id == '0') {die ("Invalid element!!!!");}

			
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
$select_cat = mysql_query ("SELECT * FROM `categories` WHERE `id` = '$group'") or die ("Not select categorie");
$row_cat = mysql_fetch_array ($select_cat);
header("Location: calc_shab.php?id=" . $id . "&cat=" . $row_cat['fix']);
}
?>