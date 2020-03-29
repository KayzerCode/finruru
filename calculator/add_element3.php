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
        
        <?php if (isset ($_GET['group']) AND !empty ($_GET['group']))



			{
            
$_GET['group'] = htmlspecialchars ($_GET['group']);
$_GET['id_shab'] = htmlspecialchars ($_GET['id_shab']);
$_GET['id_room'] = htmlspecialchars ($_GET['id_room']);

if(get_magic_quotes_gpc()){ 
            $group = stripslashes($_GET['group']);
			$id_shab = stripslashes($_GET['id_shab']); 
			$id_room = stripslashes($_GET['id_room']); 
 
        } else { 
            $group = addslashes($_GET['group']);
			$id_shab = addslashes($_GET['id_shab']);
			$id_room = addslashes($_GET['id_room']); 

        } 
        $group = (int)$group;
			if ($group == '0') {die ("Invalid group!!!!");}
			?>
			<table cellspacing="10">
	<tr>
    	<td>
        	<div align="left"><a href="add_stena.php?id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>"><?php include ("button_back.php");?></a></div>
        </td>
    </tr>
</table>
<div align="center"><form action="add_element_isp3.php"  enctype="multipart/form-data" method="post">
<input type="hidden" name="group" value="<?php echo $group; ?>">
<input type="hidden" name="id_shab" value="<?php echo $id_shab; ?>">
<input type="hidden" name="id_room" value="<?php echo $id_room; ?>">
<div align="center"><font color="#000000" size="+1"><em>Введите название нового элемента:&nbsp;&nbsp;&nbsp;</em></font></div><br />
&nbsp;&nbsp;&nbsp;<input type="text" name="elnaz" size="45"><br /><br />
<input type="file" name="strimg"><br /><br />
&nbsp;&nbsp;&nbsp;<input type="submit" align="middle" value="Создать"/><input type="button" value="Отмена" onclick="location.href='add_stena.php?id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>'" />
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
