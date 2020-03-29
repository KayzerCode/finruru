<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['shab'] = htmlspecialchars ($_POST['shab']);


if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 
								$shab = stripslashes($_POST['shab']);

        } else { 
            $id = addslashes($_POST['id']); 
								$shab = addslashes($_POST['shab']); 

        } 
        $id = (int)$id;

			if ($id == '0') {header("Location: show_elements.php?group=1");}

include("bd.php");  

/* Редактируем в таблицу новый объект */
$res_del = mysql_query("DELETE FROM `rooms_shab` WHERE `id` = '$id'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `polpokr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_polpokr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_polpokr/' . $row1['id'] . '.' . 'jpg');
		}
	}

$res_del2 = mysql_query("DELETE FROM `polpokr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `polobr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_polobr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_polobr/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del3 = mysql_query("DELETE FROM `polobr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `stena` WHERE `id_room` = '$id' AND `id_shab` = '$shab'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_stena/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_stena/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del4 = mysql_query("DELETE FROM `stena` WHERE `id_room` = '$id' AND `id_shab` = '$shab'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `potpokr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_potpokr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_potpokr/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del5 = mysql_query("DELETE FROM `potpokr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `potobr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_potobr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_potobr/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del6 = mysql_query("DELETE FROM `potobr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'") or die ("error rooms");

$sel1 = mysql_query ("SELECT * FROM `components_polpokr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_components_polpokr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_components_polpokr/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del7 = mysql_query("DELETE FROM `components_polpokr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `components_polobr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_components_polobr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_components_polobr/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del8 = mysql_query("DELETE FROM `components_polobr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `components_stena` WHERE `id_room` = '$id' AND `id_shab` = '$shab'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_components_stena/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_components_stena/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del9 = mysql_query("DELETE FROM `components_stena` WHERE `id_room` = '$id' AND `id_shab` = '$shab'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `components_potpokr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_components_potpokr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_components_potpokr/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del10 = mysql_query("DELETE FROM `components_potpokr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `components_potobr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_components_potobr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_components_potobr/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del11 = mysql_query("DELETE FROM `components_potobr` WHERE `id_room` = '$id' AND `id_shab` = '$shab'") or die ("error rooms");

header("Location: calc_shab.php?id=" . $shab . "&cat=otd");
}
?>