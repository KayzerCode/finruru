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
        
       <?php 
if (isset ($_GET['group']) && !empty ($_GET['group']))

	{
		
		
$_GET['group'] = htmlspecialchars ($_GET['group']);
$_GET['id_shab'] = htmlspecialchars ($_GET['id_shab']);
$_GET['elid'] = htmlspecialchars ($_GET['elid']);

if(get_magic_quotes_gpc()){ 
            $group = stripslashes($_GET['group']);
			$id_shab = stripslashes($_GET['id_shab']); 
			$elid = stripslashes($_GET['elid']);
 

        } else { 
            $group = addslashes($_GET['group']);
			$id_shab = addslashes($_GET['id_shab']);
			$elid = addslashes($_GET['elid']);
 

        } 
        $group = (int)$group;
			if ($group == '0') {die ("Invalid component!!!!");}
			
		include ("bd.php");
		

$result = mysql_query ("SELECT * FROM `handbook_elements` WHERE `id` = '$elid'");
$row = mysql_fetch_array ($result);
?>
<table cellspacing="10">
	<tr>
    	<td>
        	<div align="left"><a href="add_elements.php?id_shab=<?php echo $id_shab;?>&amp;group=<?php echo $group;?>"><?php include ("button_back.php");?></a></div>
        </td>
    </tr>
</table>
<?php // show picture
if (!empty ($row['image']) AND file_exists ('img/images_elements/' . $row['id'] . '.' . 'jpg'))
{?>
<div align="center"><?php echo "<img src=\"img/images_elements/" . $row['image'] . "\" />"; ?></div><br />
<?php } else {

				?> <div align="center">Пока нет фотографии!!!<br />
                Фотографию можно добавить через страницу редактирования элемента <a href="edit_element_other.php?elid=<?php echo $elid;?>&amp;id_shab=<?php echo $id_shab;?>&amp;group=<?php echo $group;?>" title="Редактировать элемент"><?php include ("button_edit.php");  // the button edit?></a></div><br /><?php
				
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
