<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Вывод компонентов</title>


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
        
        <?php if (isset ($_GET['id']) AND !empty ($_GET['id']))



			{
            
$_GET['id'] = htmlspecialchars ($_GET['id']);
if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']); 
        } else { 
            $id = addslashes($_GET['id']); 
        } 
        $id = (int)$id;
			if ($id == '0') {die ("Invalid shablon!!!!");}
			
			
			include ("bd.php");
			
$result = mysql_query("SELECT * FROM `shablons` WHERE `id` = $id", $link);
	$row = mysql_fetch_array ($result);
			?>
			<table cellspacing="10" align="center" width="900">
	<tr>
    	<td>
        	<div align="left"><a href="calculation.php" title="Назад к списку расчётов"><?php include ("button_back.php");?></a></div>
        </td>
       
    </tr>
</table>
<div align="center"><form action="edit_shablon_isp.php" enctype="multipart/form-data" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<div align="center"><font color="#000000" size="+1"><em>Введите новое название расчёта:&nbsp;&nbsp;&nbsp;</em></font></div><br />
&nbsp;&nbsp;&nbsp;<input type="text" name="newshabnaz" size="45" value="<?php echo $row['name'];?>"><br /><br />
<input type="file" name="strimg"><br /><br />
&nbsp;&nbsp;&nbsp;<input type="submit" align="middle" value="Редактировать"/><input type="button" value="Отмена" onclick="location.href='calculation.php'" title="Отменить и вернуться к списку имеющихся расчётов"/>
</form></div><br /><br /><br />

<?php // show picture
if (!empty ($row['foto']))
{?>
<div align="center"><?php echo "<img src=\"img/images_shablons/" . $row['foto'] . "\" />"; ?>
<a href="delete_foto_shab.php?id=<?php echo $row['id']; ?>" title="Удалить картинку"><?php include ("button_delete_component.php");?></a></div><br />
<?php } ?>

        
        <?php 
        	}
				else {die ("Error!!!");}
        
        
        
        
        
        
        
        
        
        
        
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
