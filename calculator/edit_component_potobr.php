<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование компонента</title>


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
if (isset ($_GET['id_edit_comp']) && !empty ($_GET['id_edit_comp']))

	{
		
		
$_GET['id_edit_comp'] = htmlspecialchars ($_GET['id_edit_comp']);
if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id_edit_comp']); 
        } else { 
            $id = addslashes($_GET['id_edit_comp']); 
        } 
        $id = (int)$id;
			if ($id == '0') {die ("Invalid component!!!!");}
			
		include ("bd.php");
		

$result = mysql_query ("SELECT * FROM `components_potobr` WHERE `id` = $id");
$row = mysql_fetch_array ($result);
?>
<table cellspacing="10">
	<tr>
    	<td>
        	<div align="left"><a href="show_potobr.php?id=<?php echo $row['id_shab'];?>&amp;id_room=<?php echo $row['id_room'];?>&amp;id_potobr=<?php echo $row['id_potobr']?>"><?php include ("button_back.php");?></a></div>
        </td>
    </tr>
</table>
<div align="center"><form action="edit_component_potobr_isp.php" enctype="multipart/form-data" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="id_room" value="<?php echo $row['id_room']; ?>">
<input type="hidden" name="id_potobr" value="<?php echo $row['id_potobr']; ?>">
<input type="hidden" name="id_shab" value="<?php echo $row['id_shab']; ?>">

<input type="hidden" name="position" value="<?php echo $row['position']; ?>">
<table align="center">
	<tr>
    	<td>
        	<div align="left"><font color="#000000" size="+1"><em>Введите новое название компонента:&nbsp;&nbsp;&nbsp;</em></font></div>
        </td>
        
        <td>
        	<div align="left"><input type="text" name="componentnaz" size="50" value="<?php echo $row['name'];?>"></div>
        </td>
    </tr>
    
    <tr>
    	<td>
        	<div align="left"><font color="#000000" size="+1"><em>Выберите размерность величин&nbsp;&nbsp;&nbsp;</em></font></div>
        </td>
        
        <td>
        	<div align="left"><select name="razm">
  <option selected="selected" value="м2">м2</option>
  <option value="пог.м.">пог.м.</option>
  <option value="шт.">шт.</option>
</select></div>
        </td>
    </tr>
    
    <tr>
    	<td>
        	<div align="left"><font color="#000000" size="+1"><em>Введите стоимость материала:&nbsp;&nbsp;&nbsp;</em></font></div>
        </td>
        
        <td>
        	<div align="left"><input type="text" name="stmat" value="<?php echo $row['stmat'];?>"> &euro;</div>
        </td>
    </tr>
    
    <tr>
    	<td>
        	<div align="left"><font color="#000000" size="+1"><em>Введите стоимость работ:&nbsp;&nbsp;&nbsp;</em></font></div>
        </td>
        
        <td>
        	<div align="left"><input type="text" name="strab" value="<?php echo $row['strab'];?>"> &euro;</div>
        </td>
    </tr>
    
    <tr>
    	<td>
        	<div align="left"><font color="#000000" size="+1"><em>Введите стоимость дополнительных материалов:&nbsp;&nbsp;&nbsp;</em></font></div>
        </td>
        
        <td>
        	<div align="left"><input type="text" name="stsopmat" value="<?php echo $row['stsopmat'];?>"> &euro;</div>
        </td>
    </tr>
    
    <tr>
    	<td>
        	<div align="left"><font color="#000000" size="+1"><em>Введите затраты труда на единицу материала:&nbsp;&nbsp;&nbsp;</em></font></div>
        </td>
        
        <td>
        	<div align="left"><input type="text" name="trud" value="<?php echo $row['trud'];?>"> <font color="#000000" size="+1"><em>tth</em></font></div>
        </td>
    </tr>
</table>
<input type="file" name="compimg" value="<?php echo $_FILES['compimg']['name'];?>"> 

&nbsp;&nbsp;&nbsp;<input type="submit" align="middle" value="Сохранить"/><input type="button" value="Отмена" onclick="location.href='show_potobr.php?id=<?php echo $row['id_shab'];?>&amp;id_room=<?php echo $row['id_room'];?>&amp;id_potobr=<?php echo $row['id_potobr']?>'" title="Отменить и вернуться к списку имеющихся элементов"/>
</form></div>

<?php // show picture
if (!empty ($row['foto']))
{?>
<div align="center"><?php echo "<img src=\"img/images_components_potobr/" . $row['foto'] . "\" />"; ?>
<a href="delete_foto_comp_potobr.php?id=<?php echo $row['id']; ?>" title="Удалить картинку"><?php include ("button_delete_component.php");?></a></div>
<?php } ?>

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
