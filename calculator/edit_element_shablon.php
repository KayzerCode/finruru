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
            
$_GET['id'] = htmlspecialchars ($_GET['id']); // id ofshablon
$_GET['elid'] = htmlspecialchars ($_GET['elid']);
$_GET['group'] = htmlspecialchars ($_GET['group']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']);
			            $elid = stripslashes($_GET['elid']); 
			            $group = stripslashes($_GET['group']); 

        } else { 
            $id = addslashes($_GET['id']);
			            $elid = addslashes($_GET['elid']); 
			            $group = addslashes($_GET['group']); 

        } 
        $id = (int)$id;
			if ($id == '0') {die ("Invalid element!!!!");}

			
			include ("bd.php");
			
$result = mysql_query("SELECT * FROM `shab_elements` WHERE `id` = $elid", $link);
	$row = mysql_fetch_array ($result);
			?>
			<table cellspacing="10" align="center" width="900">
	<tr>
    	<td>
        	<div align="left"><a href="show_element_other.php?elid=<?php echo $elid;?>&amp;id=<?php echo $id;?>&amp;group=<?php echo $group;?>" title="Вернуться назад"><?php include ("button_back.php");?></a></div>
        </td>
       
    </tr>
</table>
<div align="center"><form action="edit_element_shablon_isp.php" enctype="multipart/form-data" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="elid" value="<?php echo $elid; ?>">
<input type="hidden" name="group" value="<?php echo $group; ?>">

<table cellpadding="10">
	<tr>
    	<td>
<div align="left"><font color="#000000" size="+1"><em>Введите новое название элемента:</em></font></div>
		</td>
    	
        <td>
<div align="left"><input type="text" name="newelnaz" size="45" value="<?php echo $row['name'];?>"></div>
		</td>
    </tr>
     
     <tr>
    	<td>
<div align="left"><font color="#000000" size="+1"><em>Введите новое значение количества:</em></font></div>	
        </td>
        
        <td>
<div align="left"><input type="text" name="quantity" size="5" value="<?php echo $row['quantity'];?>">&nbsp;</div>
		</td>
     </tr>
     <tr>
     	<td>
<div align="left"><font color="#000000" size="+1"><em>Введите новое значение коэффициента:</em></font></div>	
        </td>
        
        <td>
<div align="left"><input type="text" name="koef" size="10" value="<?php echo $row['koef'];?>"></div>
		</td>
     </tr>
     
     <tr>
     	<td colspan="2">
<div align="center"><input type="file" name="strimg"></div>
		</td>
     </tr>
     
     <tr>
     	<td colspan="2">
<div align="center"><input type="submit" align="middle" value="Редактировать"/><input type="button" value="Отмена" onclick="location.href='show_element_other.php?elid=<?php echo $elid;?>&amp;id=<?php echo $id;?>&amp;group=<?php echo $group;?>'" title="Вернуться назад"/></div>
		</td>
     </tr>
</table><br />
</form>

<?php // show picture
if (!empty ($row['image']))
{?>
<div align="center"><?php echo "<img src=\"img/images_elements_shablon/" . $row['image'] . "\" />"; ?>
<a href="delete_foto_elem_shablon.php?elid=<?php echo $elid;?>&amp;id=<?php echo $id;?>&amp;group=<?php echo $group;?>" title="Удалить картинку"><?php include ("button_delete_component.php");?></a></div><br />
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
