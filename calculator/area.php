<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Задание площади элемента</title>


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
if (isset ($_GET['id']) && !empty ($_GET['id']))

	{
		
		
$_GET['id'] = htmlspecialchars ($_GET['id']);
if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']); 
        } else { 
            $id = addslashes($_GET['id']); 
        } 
        $id = (int)$id;
			if ($id == '0') {die ("Invalid component!!!!");}
			
		include ("bd.php");
	$select = mysql_query ("SELECT * FROM `areas` WHERE `id_shab` = $id") or die ("Not select");
	$count = mysql_num_rows ($select);
	if ($count < '1'){	

?>
<table cellspacing="10">
	<tr>
    	<td>
        	<div align="left"><a href="calc_shab.php?id=<?php echo $id;?>"><?php include ("button_back.php");?></a></div>
        </td>
    </tr>
</table>
<div align="center"><form action="add_area_isp.php" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<table align="center">
	<tr>
    	<td>
        	<div align="left"><font color="#000000" size="+1"><em>Введите величину площади дома:&nbsp;&nbsp;&nbsp;</em></font></div>
        </td>
        
        <td>
        	<div align="left"><input type="text" name="value" size="5">&nbsp;м&sup2;</div>
        </td>
    </tr>
</table><br />
<input type="submit" value="Сохранить" /><input type="button" value="Отмена" onclick="location.href='calc_shab.php?id=<?php echo $id;?>'" title="Отменить и вернуться к расчёту"/></form></div><br />
<?php } elseif ($count = '1') {
$row = mysql_fetch_array ($select) or die ("More rows!");
?>

<table cellspacing="10">
	<tr>
    	<td>
        	<div align="left"><a href="calc_shab.php?id=<?php echo $id;?>"><?php include ("button_back.php");?></a></div>
        </td>
    </tr>
</table>
<div align="center"><form action="edit_area_isp.php" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<table align="center">
	<tr>
    	<td>
        	<div align="left"><font color="#000000" size="+1"><em>Введите новую величину площади дома:&nbsp;&nbsp;&nbsp;</em></font></div>
        </td>
        
        <td>
        	<div align="left"><input type="text" name="value" size="5" value="<?php echo $row['value'];?>" >&nbsp;м&sup2;</div>
        </td>
    </tr>
</table><br />
<input type="submit" value="Редактировать" /><input type="button" value="Отмена" onclick="location.href='calc_shab.php?id=<?php echo $id;?>'" title="Отменить и вернуться к расчёту"/></form></div><br />

<?php } elseif ($count > '1'){ ?>
<table cellspacing="10">
	<tr>
    	<td>
        	<div align="left"><a href="calc_shab.php?id=<?php echo $id;?>"><?php include ("button_back.php");?></a></div>
        </td>
    </tr>
</table>

<?php echo "Error!!"; }
	
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
