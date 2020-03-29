<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Фотография</title>


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
	<tr>
<!--Center block-->
		<td valign="top" bgcolor="#F1F1F1">
        		<?php $_GET['id'] = htmlspecialchars ($_GET['id']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']);
        } else { 
            $id = addslashes($_GET['id']);

        } 
        $id = (int)$id;

			if ($id == '0') {die ("Invalid component!!!!");}

		include ("bd.php");
		
		$select = mysql_query ("SELECT * FROM `shablons` WHERE `id` = $id", $link) or die ("Not select shablon");
		
			$row = mysql_fetch_array ($select);
			if (!empty ($row['foto']))
{?>
		<p align="center">Расчёт <?php echo $row['name'];?></p>
        <table align="center" border="0">
        	<tr>
            	<td valign="top">
                	  <div align="center"><a href="calculation.php" title="Назад к списку расчётов"><?php include ("button_back.php");?></a></div>
                </td>
                
                <td valign="middle" align="left">
                		<?php echo "<img src=\"img/images_shablons/" . $row['foto'] . "\" />"; ?>
                </td>
                
                <td valign="bottom">
                		<a href="delete_foto_shab1.php?id=<?php echo $row['id']; ?>" title="Удалить картинку"><?php include ("button_delete_component.php");?></a>
                </td>
            </tr>
        </table>
<br /> <?php } else {?> <p align="center">Пока нет картинки!!</p><div align="center"><a href="edit_shablon.php?id=<?php echo $row['id']; ?>" title="Добавить картинку"><?php include ("button_add_object.php");?></a></div><br /><?php } ?>
                
                
                
                
        </td>
     </tr>
<!--Footer-->
	<tr>
        <td colspan="2" align="center" bgcolor="#E1E1E1" height="35" valign="middle"><?php include ("footer.php"); ?></td>
  </tr>
</table>

</body>
</html>