<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Удаление компонента</title>


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
        
        <?php if (isset ($_GET['id_del_comp']) AND !empty ($_GET['id_del_comp']))



			{
            
$_GET['id_del_comp'] = htmlspecialchars ($_GET['id_del_comp']);
if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id_del_comp']); 
        } else { 
            $id = addslashes($_GET['id_del_comp']); 
        } 
        $id = (int)$id;
			if ($id == '0') {die ("Invalid element!!!!");}
			
			
			include ("bd.php");
			
$result = mysql_query("SELECT * FROM `components_potpokr` WHERE `id` = $id", $link);
	$row = mysql_fetch_array ($result);
			?>
			<table cellspacing="10">
	<tr>
    	<td>
        	<div align="left"><a href="show_component_potpokr.php?show_comp_id=<?php echo $row['id'];?>&amp;id=<?php echo $row['id_shab']?>"><?php include ("button_back.php");?></a></div>
        </td>
    </tr>
</table>
<div align="center"><form action="delete_component_potpokr_isp1.php" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="hidden" name="id_potpokr" value="<?php echo $row['id_potpokr']; ?>">
<input type="hidden" name="id_room" value="<?php echo $row['id_room']; ?>">
<input type="hidden" name="id_shab" value="<?php echo $row['id_shab']; ?>">
<div align="center"><font color="#000000" size="+1"><em>Вы действительно хотите удалить компонент&nbsp;&nbsp;&nbsp;</em></font>
&nbsp;&nbsp;&nbsp;<font color="#CC33CC" size="+2"><?php echo $row['name'];?><font color="#000000" size="+1"><em>&nbsp;&nbsp;&nbsp;?</em></font></font></div><br />
&nbsp;&nbsp;&nbsp;<input type="submit" align="middle" value="Удалить" title="Удалить"/><input type="button" value="Отмена" onclick="location.href='show_component_potpokr.php?show_comp_id=<?php echo $row['id'];?>&amp;id=<?php echo $row['id_shab']?>'" />
</form></div><br /><br /><br />
        
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
