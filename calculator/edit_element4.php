<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование элемента</title>


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
			if ($id == '0') {die ("Invalid element!!!!");}
			
			
			include ("bd.php");
			
$result = mysql_query("SELECT * FROM `handbook_elements` WHERE `id` = $id", $link);
	$row = mysql_fetch_array ($result);
			?>
			<table cellspacing="10" align="center" width="900">
	<tr>
    	<td>
        	<div align="left"><a href="add_stena.php?id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>" title="Назад к списку элементов"><?php include ("button_back.php");?></a></div>
        </td>
    </tr>
</table>
<div align="center"><form action="edit_element_isp4.php" enctype="multipart/form-data" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="id_shab" value="<?php echo $id_shab; ?>">
<input type="hidden" name="id_room" value="<?php echo $id_room; ?>">
<input type="hidden" name="group" value="<?php echo $row['group']; ?>">
<div align="center"><font color="#000000" size="+1"><em>Введите новое название элемента:&nbsp;&nbsp;&nbsp;</em></font></div><br />
&nbsp;&nbsp;&nbsp;<input type="text" name="newelnaz" size="45" value="<?php echo $row['name'];?>"><br /><br />
<input type="file" name="strimg"><br /><br />
&nbsp;&nbsp;&nbsp;<input type="submit" align="middle" value="Редактировать"/><input type="button" value="Отмена" onclick="location.href='add_stena.php?id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>'" title="Отменить и вернуться к списку элементов"/>
</form></div><br /><br /><br />

<?php // show picture
if (!empty ($row['image']))
{?>
<div align="center"><?php echo "<img src=\"img/images_elements/" . $row['image'] . "\" />"; ?>
<a href="delete_foto_elem4.php?id=<?php echo $row['id']; ?>&amp;id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>" title="Удалить картинку"><?php include ("button_delete_component.php");?></a></div><br />
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
