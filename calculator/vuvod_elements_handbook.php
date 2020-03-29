<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Элементы</title>

</head>

<body>
<?php if (!$_GET['group']) {echo "<br><div align='center'>Не выбрана группа материалов из левого столбца! </div>";}?>
<?php if (isset ($_GET['group']) AND !empty ($_GET['group']))



			{?>
            

<?php 
$_GET['group'] = htmlspecialchars ($_GET['group']);
if(get_magic_quotes_gpc()){ 
            $group = stripslashes($_GET['group']); 
        } else { 
            $group = addslashes($_GET['group']); 
        } 
	$group = (int)$group;
				if ($group == '0') {die ("Invalid group!!!!");}


include ("bd.php"); // connection to database?>

<?php // main table with components 
$result = mysql_query("SELECT * FROM `handbook_elements` WHERE `group` = $group", $link);
$num = mysql_num_rows ($result); 
$nuw_rows = mysql_num_rows ($result);
if ($num < '1') {echo "<br><div align='center'>Пока нет элементов в этой группе!</div>"; ?>
<table border="1" cellpadding="0" cellspacing="10" align="center" frame="void" id="table2" bordercolor="#F1F1F">
<tr><td><div align="center"><a href="add_element.php?group=<?php echo $group;?>" title="Добавить новый элемент в эту группу"><?php include ("button_add_object.php"); // the button ADD ?> </a></div></td></tr></table>
<?php 
}

else {
 
//Creation of a output table?>
<table border="1" cellpadding="0" cellspacing="10" align="center" frame="void" id="table2" bordercolor="#F1F1F">
<tr><td><div align="center"><a href="add_element.php?group=<?php echo $group;?>" title="Добавить новый элемент в эту группу"><?php include ("button_add_object.php"); // the button ADD ?> </a></div></td></tr>

<?php 
while ($row = mysql_fetch_array($result))

{

			?><tr>
             			<td align="left" bgcolor="#CCCC99" id="td1" width="500" bordercolor="#000000"><font size="-1" color="#000000"><strong><a href="show_elements.php?id=<?php echo $row['id'];?>"><?php echo $row['name'];?></a></strong></font>
                        </td>
                        
                        <td align="center" id="td1" bordercolor="#FFFFFF"><a href="edit_element.php?id=<?php echo $row['id'];?>" title="Редактировать имя"><?php include ("button_edit.php");  // the button edit?></a></td> 
                        
                        <td align="center" id="td1" bordercolor="#FFFFFF"><a href="delete_element.php?id=<?php echo $row['id'];?>" title="Удалить элемент"><?php include ("button_delete.php");  // the button delete?></a></td>
   
                       
             
             
              </tr>
              

<?php } ?>
</table><br>


		<?php }}?>
</body>
</html>