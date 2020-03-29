<?php 
/* Исполняющая php */
if (isset ($_POST['elid']) AND !empty ($_POST['elid']))

			{
            
$_POST['elid'] = htmlspecialchars ($_POST['elid']);
$_POST['group'] = htmlspecialchars ($_POST['group']);
$_POST['id_shab'] = htmlspecialchars ($_POST['id_shab']);



if(get_magic_quotes_gpc()){ 
            $elid = stripslashes($_POST['elid']); 
								$group = stripslashes($_POST['group']);
											            $id_shab = stripslashes($_POST['id_shab']); 


        } else { 
            $elid = addslashes($_POST['elid']); 
								$group = addslashes($_POST['group']);
											            $id_shab = addslashes($_POST['id_shab']);
 

        } 
        $elid = (int)$elid;
		$group = (int)$group;
			if ($elid == '0') {header("Location: handbook.php?group=1");}
			if ($group == '0') {header("Location: handbook.php?group=1");}

include("bd.php");  

/* Редактируем в таблицу новый объект */
if (file_exists ('img/images_elements/' . $elid . '.' . 'jpg'))
{
	unlink ('img/images_elements/' . $elid . '.' . 'jpg');
}
$res_del = mysql_query("DELETE FROM `handbook_elements` WHERE `id` = $elid") or die ("error");
$res = mysql_query ("SELECT * FROM `components` WHERE `group` = '$group' AND `elid` = $elid");
while ($row2 = mysql_fetch_array ($res))
	{
		if (file_exists ('img/images_components/' . $row2['id'] . '.' . 'jpg'))
{
	unlink ('img/images_components/' . $row2['id'] . '.' . 'jpg');
}
		$res_del2 = mysql_query("DELETE FROM `components` WHERE `id` = $row2[id]") or die ("error");

	}


header("Location: add_elements.php?id_shab=" . $id_shab . "&group=" . $group);
}
?>