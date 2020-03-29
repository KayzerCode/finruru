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
<!-- Center block -->
    <tr>
		<td valign="top" bgcolor="#F1F1F1">
        
       <?php 
if (isset ($_GET['id']) && !empty ($_GET['id']))

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
			if ($id == '0') {die ("Invalid component!!!!");}
			
		include ("bd.php");
		

$result = mysql_query ("SELECT * FROM `handbook_elements` WHERE `id` = $id");
$row = mysql_fetch_array ($result);
?>
<table cellspacing="10">
	<tr>
    	<td>
        	<div align="left"><a href="add_polobr.php?id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>"><?php include ("button_back.php");?></a></div>
        </td>
    </tr>
</table>
<?php // show picture
if (!empty ($row['image']))
{?>
<div align="center"><?php echo "<img src=\"img/images_elements/" . $row['image'] . "\" />"; ?></div><br />
<?php } else {

				?> <div align="center">Пока нет фотографии!!!<br />
                Фотографию можно добавить через страницу редактирования элемента <a href="edit_element3.php?id=<?php echo $id;?>&amp;id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>" title="Редактировать элемент"><?php include ("button_edit.php");  // the button edit?></a></div><?php
				
				}?>

<?php 
			
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
