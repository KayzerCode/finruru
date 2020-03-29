<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Добавление элемента</title>


</head>
<link href="style_menu.css" rel="stylesheet" type="text/css" />

<body bgcolor="#CCCCCC">
<table border="1" cellpadding="0" cellspacing="10" width="1000" align="center" bgcolor="#FFFFFF" frame="box" bordercolor="#000000">
<!-- Header-->	
  <tr bordercolor="#FFFFFF">
    	<td colspan="2"><?php include ("header.php"); ?></td>
  </tr>
<!-- Main menu-->  
    <tr align="center" valign="middle" bgcolor="#E1E1E1">
   	  <td height="60">
   	  <?php include ("main_menu.php"); ?>
      </td>
    </tr>
<!-- Center block -->
    <tr>
		<td valign="top" bgcolor="#F1F1F1">
		<?php  

if (isset ($_GET['id']) AND !empty ($_GET['id']))

			{?>
            
<?php 
$_GET['id'] = htmlspecialchars ($_GET['id']); // id of element
$_GET['id_shab'] = htmlspecialchars ($_GET['id_shab']);
$_GET['id_room'] = htmlspecialchars ($_GET['id_room']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']);
			$id_shab = stripslashes($_GET['id_shab']); 
			$id_room = stripslashes($_GET['id_room']); 

        } else { 
            $id = addslashes($_GET['id']);
			$id_shab = addslashes($_GET['id_shab']);
			$id_room = addslashes($_GET['id_room']); 


        } 
        $id = (int)$id;
			if ($id == '0') {die ("Invalid component!!!!");}

		include ("bd.php");  
$stmat = 0;
$strab = 0;
$stsopmat = 0;
$trud = 0;
$result = mysql_query("SELECT * FROM `handbook_elements` WHERE `id` = $id ") or die("Not select element");
$row = mysql_fetch_array($result);
$res = mysql_query("INSERT INTO `polobr` (`id_shab`, `id_room`, `name`) VALUES ('$id_shab', '$id_room', '$row[name]')") or die ("Not insert");
$id1 = mysql_insert_id();
$image = $id1 . '.' . 'jpg';
if (!empty ($row['image']) AND file_exists ('img/images_elements/' . $id . '.' . 'jpg'))
{
$res_image = mysql_query("UPDATE `polobr` SET `image` = '$image' WHERE `id` = '$id1'");
}
$result1 = mysql_query("SELECT * FROM `rooms_shab` WHERE `id` = $id_room") or die("Not select room");
$room = mysql_fetch_array($result1);

$result5 = mysql_query("UPDATE `polobr` SET `jm` = '$room[jm]' WHERE `id` = '$id1'");
$result6 = mysql_query("UPDATE `polobr` SET `koef` = '1.0' WHERE `id` = '$id1'");
if (!empty ($row['image']) AND file_exists ('img/images_elements/' . $id . '.' . 'jpg'))
	{
	$filename = $id . '.' . 'jpg';
		$source = 'img/images_elements/' . $filename;
		$to = 'img/images_polobr/' . $image;
		copy ($source, $to);
	}
$select = mysql_query ("SELECT * FROM `components` WHERE `group` = '10' AND `elid` = '$id'") or die ("Not select components");
while ($sel = mysql_fetch_array ($select))
	{
	$res = mysql_query("INSERT INTO `components_polobr` (`id_polobr`, `id_shab`, `id_room`, `name`, `position`, `stmat`, `strab`, `stsopmat`, `trud`, `razm`) VALUES ('$id1', '$id_shab', '$id_room', '$sel[name]', '$sel[position]', '$sel[stmat]', '$sel[strab]', '$sel[stsopmat]', '$sel[trud]', '$sel[razm]')") or die ("Not insert comp_polobr");
	$id_comp = mysql_insert_id();
	$foto = $id_comp . '.' . 'jpg';
if (!empty ($sel['foto']) AND file_exists ('img/images_components/' . $sel['id'] . '.' . 'jpg'))
{
	$res = mysql_query("UPDATE `components_polobr` SET `foto` = '$foto' WHERE `id` = '$id_comp'");
	}
if (!empty ($sel['foto']) AND file_exists ('img/images_components/' . $sel['id'] . '.' . 'jpg'))
	{
	$filename = $sel['id'] . '.' . 'jpg';
		$source = 'img/images_components/' . $filename;
		$to = 'img/images_components_polobr/' . $foto;
		copy ($source, $to);
	}
	}?>
    
<br /><div align="center">Добавление прошло успешно</div><br /><br />
<div align="center"<a href="add_polobr.php?id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>" title="К списку отделок пола"><?php include ("button_new_finishing.php");?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="calc_shab.php?id=<?php echo $id_shab;?>&amp;cat=otd&amp;show_room=<?php echo $id_room;?>" title="К редактированию комнат"><?php include ("button_to_edit_room.php");?></a></div><br />

<?php
			}
?>
 </td>
     </tr>
<!--Footer-->
	<tr>
        <td colspan="2" align="center" bgcolor="#E1E1E1" height="35" valign="middle"><?php include ("footer.php"); ?></td>
  </tr>
</table>

</body>
</html>
