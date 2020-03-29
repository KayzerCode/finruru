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

if (isset ($_GET['id_shab']) AND !empty ($_GET['id_shab']))

			{?>
            
<?php 
$_GET['group'] = htmlspecialchars ($_GET['group']);
$_GET['id_shab'] = htmlspecialchars ($_GET['id_shab']);
$_GET['elid'] = htmlspecialchars ($_GET['elid']);

if(get_magic_quotes_gpc()){ 
            $group = stripslashes($_GET['group']);
			$id_shab = stripslashes($_GET['id_shab']); 
			$elid = stripslashes($_GET['elid']); 

        } else { 
            $group = addslashes($_GET['group']);
			$id_shab = addslashes($_GET['id_shab']);
			$elid = addslashes($_GET['elid']); 
        } 
        $group = (int)$group;
			if ($group == '0') {die ("Invalid component!!!!");}

		include ("bd.php");  
$stmat = 0;
$strab = 0;
$stsopmat = 0;
$trud = 0;
$result = mysql_query("SELECT * FROM `handbook_elements` WHERE `id` = '$elid'") or die("Not select element");
$row = mysql_fetch_array($result);
$select_area = mysql_query ("SELECT * FROM `areas` WHERE `id_shab` = '$id_shab'") or die ("Not select area");
if (mysql_num_rows ($select_area) < '1') {$area = '0';}
elseif (mysql_num_rows ($select_area) == '1') {$row_area = mysql_fetch_array ($select_area); $area = $row_area['value'];}
elseif (mysql_num_rows ($select_area) > '1') {die ("More areas");}
$res = mysql_query("INSERT INTO `shab_elements` (`group`, `id_shab`, `name`, `area`, `quantity`, `koef`) VALUES ('$group', '$id_shab', '$row[name]', '$area', '0', '1')") or die ("Not insert");
$id1 = mysql_insert_id();
$image = $id1 . '.' . 'jpg';
if (!empty ($row['image']) AND file_exists ('img/images_elements/' . $row['id'] . '.' . 'jpg'))
	{
$res_image = mysql_query("UPDATE `shab_elements` SET `image` = '$image' WHERE `id` = '$id1'");

	$filename = $elid . '.' . 'jpg';
		$source = 'img/images_elements/' . $filename;
		$to = 'img/images_elements_shablon/' . $image;
		copy ($source, $to);
	}
$select = mysql_query ("SELECT * FROM `components` WHERE `group` = '$group' AND `elid` = '$elid'") or die ("Not select components");
while ($sel = mysql_fetch_array ($select))
	{
	$res = mysql_query("INSERT INTO `shab_components` (`group`, `elid`, `id_shab`, `name`, `position`, `stmat`, `strab`, `stsopmat`, `trud`, `razm`) VALUES ('$group', '$id1', '$id_shab', '$sel[name]', '$sel[position]', '$sel[stmat]', '$sel[strab]', '$sel[stsopmat]', '$sel[trud]', '$sel[razm]')") or die ("Not insert components");
	$id_comp = mysql_insert_id();
	$foto = $id_comp . '.' . 'jpg';
if (!empty ($sel['foto']) AND file_exists ('img/images_components/' . $sel['id']) . '.' . 'jpg')
	{
	$filename = $sel['id'] . '.' . 'jpg';
		$source = 'img/images_components/' . $filename;
		$to = 'img/images_components_shablon/' . $foto;
		copy ($source, $to);
		$res = mysql_query("UPDATE `shab_components` SET `foto` = '$foto' WHERE `id` = '$id_comp'");

	}
	}
    

				$sel1 = mysql_query ("SELECT * FROM `handbook_groups` WHERE `id` = '$group'") or die ("Not select handbook group");
					$row = mysql_fetch_array ($sel1);
				$select_cat = mysql_query ("SELECT * FROM `categories` WHERE `id` = '$row[id_cat]'") or die ("Not select categorie");
					$row_cat = mysql_fetch_array ($select_cat);
  ?>  
<br /><div align="center">Добавление прошло успешно</div><br /><br />
<div align="center"<a href="add_elements.php?id_shab=<?php echo $id_shab;?>&amp;group=<?php echo $group;?>" title="К списку имеющихся элементов"><?php include ("button_to_elements.php");?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="calc_shab.php?id=<?php echo $id_shab;?>&amp;cat=<?php echo $row_cat['fix'];?>" title="К редактированию блока"><?php include ("button_to_shablon.php");?></a></div><br />
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
