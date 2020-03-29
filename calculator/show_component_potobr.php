<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Калькулятор дома</title>


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
   	  <td colspan="2" height="60">
   	  <?php include ("main_menu.php"); ?>
      </td>
    </tr>
	<tr>
<!--Left block#1-->
    	<td width="300" bgcolor="#CCCCCC"><?php include ("left_block_calc.php");?></td>
<!--Center block-->
		<td valign="top" bgcolor="#F1F1F1" align="center">
         <?php if (isset ($_GET['show_comp_id']) AND !empty ($_GET['show_comp_id']))



			{?>
            
<?php 
$_GET['show_comp_id'] = htmlspecialchars ($_GET['show_comp_id']);
$_GET['id'] = htmlspecialchars ($_GET['id']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['show_comp_id']);
			            $id_shab = stripslashes($_GET['id']);

        } else { 
            $id = addslashes($_GET['show_comp_id']);
            $id_shab = addslashes($_GET['id']);

        } 
        $id = (int)$id;
		$id_shab = (int)$id_shab;
			if ($id == '0') {die ("Invalid component!!!!");}

		include ("bd.php");  

$result = mysql_query("SELECT * FROM `components_potobr` WHERE `id` = $id ");
$row = mysql_fetch_array($result);

?>
<table cellspacing="10" align="left">
	<tr>
    	<td>
        	<div align="left"><a href="show_potobr.php?id=<?php echo $row['id_shab'];?>&id_room=<?php echo $row['id_room'];?>&amp;id_potobr=<?php echo $row['id_potobr'];?>"><?php include ("button_back.php");?></a></div>
        </td>
    </tr>
</table><br /><br />
<div align="center">Компонент <font color="#FF9966" size="+2"><?php echo $row['name']; ?></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="edit_component_potobr1.php?id_edit_comp=<?php echo $row['id'];?>" title="Редактировать"><?php include ("button_edit.php");  // the button edit?></a><a href="delete_component_potobr1.php?id_del_comp=<?php echo $row['id'];?>" title="Удалить"><?php include ("button_delete.php");  // the button delete?></a></div><br /><br />
<table align="center">
<tr>
	<td>
<table align="center" cellspacing="10">
<tr bgcolor="#CCCCCC">
	<td align="left" >
    	<font color="#000000" size="+1"><em>Стоимость материала:&nbsp;&nbsp;</em></font>
    </td>
    
    <td align="left">
    	<font color="#000000" size="+1"><?php echo round ($row['stmat'], 1);?>&nbsp;&euro;/<?php echo $row['razm'];?></font>
    </td>
</tr>

<tr bgcolor="#CCCCCC">
	<td align="left">
    	<font color="#000000" size="+1"><em>Стоимость работы:&nbsp;&nbsp;</em></font>
    </td>
    
    <td align="left">
    	<font color="#000000" size="+1"><?php echo round ($row['strab'], 1);?>&nbsp;&euro;/<?php echo $row['razm'];?></font>
    </td>
</tr>

<tr bgcolor="#CCCCCC">
	<td align="left">
    	<font color="#000000" size="+1"><em>Дополнительные расходы:&nbsp;&nbsp;</em></font>
    </td>
    
    <td align="left">
    	<font color="#000000" size="+1"><?php echo round ($row['stsopmat'], 1);?>&nbsp;&euro;/<?php echo $row['razm'];?></font>
    </td>
</tr>

<tr bgcolor="#CCCCCC">
	<td align="right">
    	<font color="#FFFFFF" size="+1"><em>Итого:&nbsp;&nbsp;</em></font>
    </td>
    
    <td align="left">
    	<font color="#FFFFFF" size="+1"><?php echo round ($row['stmat'] + $row['strab'] + $row['stsopmat'], 1);?>&nbsp;&euro;/<?php echo $row['razm'];?></font>
    </td>
</tr>

<tr>
	<td align="left">
    	<font color="#000000" size="+1"><em>Затраты труда:&nbsp;&nbsp;</em></font>
    </td>
    
    <td align="left">
    	<font color="#000000" size="+1"><?php echo round ($row['trud'], 0);?>&nbsp;tth</font>
    </td>
</tr>
</table>
</td>
</tr>
</table>
<?php if (!empty ($row['foto']))
{?>
<div align="center"><?php echo "<img src=\"img/images_components_potobr/" . $row['foto'] . "\" />"; ?>
</div>
<?php } ?>


		<?php 


			}?>
        
        
        
        
        </td>
     </tr>
<!--Footer-->
	<tr>
        <td colspan="2" align="center" bgcolor="#E1E1E1" height="35" valign="middle"><?php include ("footer.php"); ?></td>
  </tr>
</table>

</body>
</html>
