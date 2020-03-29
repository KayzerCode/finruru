<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Добавление расчёта</title>


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
        
      
			<table cellspacing="10">
	<tr>
    	<td>
        	<div align="left"><a href="calculation.php"><?php include ("button_back.php");?></a></div>
        </td>
    </tr>
</table>
<div align="center"><form action="add_shablon_isp.php"  enctype="multipart/form-data" method="post">
<div align="center"><font color="#000000" size="+1"><em>Введите название нового расчёта:&nbsp;&nbsp;&nbsp;</em></font></div><br />
&nbsp;&nbsp;&nbsp;<input type="text" name="elnaz" size="45"><br /><br />
<input type="file" name="strimg"><br /><br />
&nbsp;&nbsp;&nbsp;<input type="submit" align="middle" value="Создать"/><input type="button" value="Отмена" onclick="location.href='calculation.php'" />
</form></div><br /><br /><br />
        
        
        </td>
     </tr>
<!--Footer-->
	<tr>
        <td colspan="2" align="center" bgcolor="#E1E1E1" height="35" valign="middle"><?php include ("footer.php"); ?></td>
  </tr>
</table>

</body>
</html>
