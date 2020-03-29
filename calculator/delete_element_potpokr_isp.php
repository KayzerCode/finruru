<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['id_room'] = htmlspecialchars ($_POST['id_room']);
$_POST['id_shab'] = htmlspecialchars ($_POST['id_shab']);


if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 
            $id_room = stripslashes($_POST['id_room']); 
            $id_shab = stripslashes($_POST['id_shab']); 

        } else { 
            $id = addslashes($_POST['id']); 
            $id_room = addslashes($_POST['id_room']); 
            $id_shab = addslashes($_POST['id_shab']); 

        } 
        $id = (int)$id;
			if ($id == '0') {header("Location: handbook.php?group=1");}

include("bd.php");  

/* Редактируем в таблицу новый объект */
if (file_exists ('img/images_potpokr/' . $id . '.' . 'jpg'))
{
	unlink ('img/images_potpokr/' . $id . '.' . 'jpg');
}
$res_del = mysql_query("DELETE FROM `potpokr` WHERE `id` = $id") or die ("error");
$res = mysql_query ("SELECT * FROM `components_potpokr` WHERE `id_potpokr` = '$id'");
while ($row2 = mysql_fetch_array ($res))
	{
		if (file_exists ('img/images_components_potpokr/' . $row2['id'] . '.' . 'jpg'))
{
	unlink ('img/images_components_potpokr/' . $row2['id'] . '.' . 'jpg');
}
		$res_del2 = mysql_query("DELETE FROM `components_potpokr` WHERE `id` = $row2[id]") or die ("error");
$id_room = $row2['id_room'];
	}

header("Location: calc_shab.php?id=" . $id_shab . "&cat=otd&show_room=" . $id_room);
}
?>