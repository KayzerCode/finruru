<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']) AND isset ($_POST['group']) AND !empty ($_POST['group']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['group'] = htmlspecialchars ($_POST['group']);
$_POST['id_shab'] = htmlspecialchars ($_POST['id_shab']);
$_POST['id_room'] = htmlspecialchars ($_POST['id_room']);



if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 
								$group = stripslashes($_POST['group']);
																			            $id_shab = stripslashes($_POST['id_shab']); 
			            $id_room = stripslashes($_POST['id_room']); 


        } else { 
            $id = addslashes($_POST['id']); 
								$group = addslashes($_POST['group']);
																			            $id_shab = addslashes($_POST['id_shab']);
			$id_room = addslashes($_POST['id_room']); 


        } 
        $id = (int)$id;
		$group = (int)$group;
			if ($id == '0') {header("Location: handbook.php?group=1");}
			if ($group == '0') {header("Location: handbook.php?group=1");}

include("bd.php");  

/* Редактируем в таблицу новый объект */
if (file_exists ('img/images_elements/' . $id . '.' . 'jpg'))
{
	unlink ('img/images_elements/' . $id . '.' . 'jpg');
}
$res_del = mysql_query("DELETE FROM `handbook_elements` WHERE `id` = $id") or die ("error");
$res = mysql_query ("SELECT * FROM `components` WHERE `group` = $group AND `elid` = $id");
while ($row2 = mysql_fetch_array ($res))
	{
		if (file_exists ('img/images_components/' . $row2['id'] . '.' . 'jpg'))
{
	unlink ('img/images_components/' . $row2['id'] . '.' . 'jpg');
}
		$res_del2 = mysql_query("DELETE FROM `components` WHERE `id` = $row2[id]") or die ("error");

	}

header("Location: add_potobr.php?id_shab=" . $id_shab . "&id_room=" . $id_room);
}
?>