<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);


if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 

        } else { 
            $id = addslashes($_POST['id']); 

        } 
        $id = (int)$id;
			if ($id == '0') {header("Location: handbook.php?group=1");}

include("bd.php");  

/* Удаляем сам шаблон */
$res_del = mysql_query("DELETE FROM `shablons` WHERE `id` = $id") or die ("error");
if (file_exists('img/images_shablons/' . $id . '.' . 'jpg'))
{
	unlink ('img/images_shablons/' . $id . '.' . 'jpg');
}
$del_area = mysql_query("DELETE FROM `areas` WHERE `id_shab` = $id") or die ("error area");

$res_del0 = mysql_query("DELETE FROM `rooms_shab` WHERE `id_shab` = '$id'") or die ("error rooms");

$sel1 = mysql_query ("SELECT * FROM `polpokr` WHERE `id_shab` = '$id'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_polpokr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_polpokr/' . $row1['id'] . '.' . 'jpg');
		}
	}

$res_del2 = mysql_query("DELETE FROM `polpokr` WHERE `id_shab` = '$id'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `polobr` WHERE `id_shab` = '$id'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_polobr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_polobr/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del3 = mysql_query("DELETE FROM `polobr` WHERE `id_shab` = '$id'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `stena` WHERE `id_shab` = '$id'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_stena/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_stena/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del4 = mysql_query("DELETE FROM `stena` WHERE `id_shab` = '$id'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `potpokr` WHERE `id_shab` = '$id'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_potpokr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_potpokr/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del5 = mysql_query("DELETE FROM `potpokr` WHERE `id_shab` = '$id'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `potobr` WHERE `id_shab` = '$id'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_potobr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_potobr/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del6 = mysql_query("DELETE FROM `potobr` WHERE `id_shab` = '$id'") or die ("error rooms");

$sel1 = mysql_query ("SELECT * FROM `components_polpokr` WHERE `id_shab` = '$id'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_components_polpokr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_components_polpokr/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del7 = mysql_query("DELETE FROM `components_polpokr` WHERE `id_shab` = '$id'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `components_polobr` WHERE `id_shab` = '$id'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_components_polobr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_components_polobr/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del8 = mysql_query("DELETE FROM `components_polobr` WHERE `id_shab` = '$id'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `components_stena` WHERE `id_shab` = '$id'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_components_stena/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_components_stena/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del9 = mysql_query("DELETE FROM `components_stena` WHERE `id_shab` = '$id'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `components_potpokr` WHERE `id_shab` = '$id'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_components_potpokr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_components_potpokr/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del10 = mysql_query("DELETE FROM `components_potpokr` WHERE `id_shab` = '$id'") or die ("error rooms");
$sel1 = mysql_query ("SELECT * FROM `components_potobr` WHERE `id_shab` = '$id'");
while ($row1 =mysql_fetch_array ($sel1))
	{
	if (file_exists('img/images_components_potobr/' . $row1['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_components_potobr/' . $row1['id'] . '.' . 'jpg');
		}
	}
$res_del11 = mysql_query("DELETE FROM `components_potobr` WHERE `id_shab` = '$id'") or die ("error rooms");
$sel_elem = mysql_query ("SELECT * FROM `shab_elements` WHERE `id_shab` = '$id'");
while ($row_elem =mysql_fetch_array ($sel_elem))
	{
	if (file_exists('img/images_elements_shablon/' . $row_elem['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_elements_shablon/' . $row_elem['id'] . '.' . 'jpg');
		}
	}

$del_elem = mysql_query ("DELETE FROM `shab_elements` WHERE `id_shab` = '$id'");

$sel_comp = mysql_query ("SELECT * FROM `shab_components` WHERE `id_shab` = '$id'");
while ($row_comp =mysql_fetch_array ($sel_comp))
	{
	if (file_exists('img/images_components_shablon/' . $row_comp['id'] . '.' . 'jpg'))
		{
			unlink ('img/images_components_shablon/' . $row_comp['id'] . '.' . 'jpg');
		}
	}

$del_elem = mysql_query ("DELETE FROM `shab_components` WHERE `id_shab` = '$id'");

header("Location: calculation.php");
}
?>