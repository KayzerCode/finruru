<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Редактирование параметров комнаты</title>


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
$_GET['shab'] = htmlspecialchars ($_GET['shab']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']); 
            $shab = stripslashes($_GET['shab']); 

        } else { 
            $id = addslashes($_GET['id']); 
            $shab = addslashes($_GET['shab']); 

        } 
        $id = (int)$id;
			if ($id == '0') {header("Location: handbook.php?group=1");}
			
			include ("bd.php");
				$sel1 = mysql_query ("SELECT * FROM `categories` WHERE `id` = $shab") or die ("Not select category");
					$row = mysql_fetch_array ($sel1);
					
					$sel2 = mysql_query ("SELECT * FROM `rooms_shab` WHERE `id` = $id") or die ("Not select room");
					$row2 = mysql_fetch_array ($sel2);?>
            
			<table cellspacing="10">
	<tr>
    	<td>
        	<div align="left"><a href="calc_shab.php?id=<?php echo $shab;?>&amp;cat=otd"><?php include ("button_back.php");?></a></div>
        </td>
    </tr>
</table>
<div align="center"><form action="edit_room_isp.php" method="post">
<input type="hidden" name="id_shab" value="<?php echo $shab;?>" />
<input type="hidden" name="id_room" value="<?php echo $id;?>" />

<table>
	<tr>
    	<td>
<div align="center"><font color="#000000" size="+1"><em>Введите новое название комнаты:&nbsp;&nbsp;&nbsp;</em></font></div>
		</td>

		<td>
        	<input type="text" name="roomnaz" size="45" value="<?php echo $row2['name'];?>">
		</td>
    </tr>
    
    <tr>
    	<td>
<div align="center"><font color="#000000" size="+1"><em>Введите площадь комнаты:</em></font></div>
		</td>

		<td>
        	<input type="text" name="metraj" size="5" value="<?php echo $row2['metraj'];?>">&nbsp;&nbsp;м&sup2;
		</td>
    </tr>
    
    <tr>
    	<td>
<div align="center"><font color="#000000" size="+1"><em>Введите высоту потолков в комнате:</em></font></div>
		</td>

		<td>
        	<input type="text" name="vuspot" size="5" value="<?php echo $row2['vuspot'];?>">&nbsp;&nbsp;м
		</td>
    </tr>
    
    <tr>
    	<td>
<div align="center"><font color="#000000" size="+1"><em>Введите периметр комнаты:</em></font></div>
		</td>

		<td>
        	<input type="text" name="jm" size="5" value="<?php echo $row2['jm'];?>">&nbsp;&nbsp;м
		</td>
    </tr>
</table><br />

&nbsp;&nbsp;&nbsp;<input type="submit" align="middle" value="Редактировать"/><input type="button" value="Отмена" onclick="location.href='calc_shab.php?id=<?php echo $shab;?>&amp;cat=otd'" />
</form></div><br /><br /><br />
        
        <?php } else 
					{
						die ("Not shablon");
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
