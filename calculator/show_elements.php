<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Калькулятор дома</title>


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
   	  <td colspan="2" height="60">
   	  <?php include ("main_menu.php"); ?>
      </td>
    </tr>
	<tr>
<!--Left block#1-->
    	<td width="300" bgcolor="#CCCCCC"><?php include ("left_block_handbook.php");?></td>
<!--Center block-->
		<td valign="top" bgcolor="#F1F1F1" align="center">
         <?php if (isset ($_GET['id']) AND !empty ($_GET['id']))



			{
            
$_GET['id'] = htmlspecialchars ($_GET['id']);
if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']); 
        } else { 
            $id = addslashes($_GET['id']); 
        } 
        $id = (int)$id;
			if ($id == '0') {die ("Invalid element!!!!");}
			
			
			include ("bd.php");
			
			$res = mysql_query ("SELECT * FROM `handbook_elements` WHERE `id` = '$id'");
			$row = mysql_fetch_array($res);?>
            
            <?php  
//Creation of title table?>
<table border="1" cellpadding="0" cellspacing="10" align="center" frame="void" id="table2" bordercolor="#F1F1F1" width="800">
<tr>
<td colspan="4">
<div align="left"><a href="handbook.php?group=<?php echo $row['group'];?>" title="Назад к списку элементов"><?php include ("button_back.php"); // the button BACK ?> </a></div>
</td>
</tr>
<tr>
<td>
<div align="left"><font size="+2"><?php echo $row['name']; ?></font></div></td><td><div align="right"><a href="edit_element1.php?id=<?php echo $row['id'];?>" title="Редактировать элемент"><?php include ("button_edit.php");  // the button edit?></a></div></td><td><div align="left"><a href="delete_element1.php?id=<?php echo $row['id'];?>" title="Удалить элемент"><?php include ("button_delete.php");  // the button delete?></a></div>
</td>
<td><div align="right"><a href="add_new_component.php?group=<?php echo $row['group'];?>&amp;elid=<?php echo $id;?>" title="Добавить новый слой"><?php include ("button_add_component.php"); // the button ADD COMPONENT?> </a></div></td>
</tr>
</table>
<?php // End of title table ?>
<?php // main table with components ?>
<table border="0" frame="none" id="table2" cellspacing="10" cellpadding="2" bgcolor="#CCCCCC">
	<tr bgcolor="#9999CC">
    	<td id="men" bgcolor="#CCCCCC" bordercolor="#FFFFFF">
        	<!-- up -->
        </td>
        
        <td id="men" bgcolor="#CCCCCC" bordercolor="#FFFFFF">
        	<!-- down -->
        </td>
        
        <td id="men">
        	<center>Название</center>
        </td>
        
        <td bgcolor="#CCCCCC" bordercolor="#FFFFFF" id="men">
        	<!--Размерность -->
        </td>
        
        <td id="men">
        	<center>Стоимость материала, &euro;</center>
        </td>
        
        <td id="men">
        	<center>Затраты труда, tth</center>
        </td>
        
        <td id="men">
        	<center>Стоимость работы, &euro;</center>
        </td id="men">
        
        <td id="men">
        	<center>Доп. расходы, &euro;</center>
        </td>
        
        <td id="men" title="Стоимость материала + Стоимость работы + Доп. расходы">
        	<center>Общая стоимость, &euro;</center>
        </td>
        
        <td bgcolor="#CCCCCC" bordercolor="#FFFFFF" id="men">
        	<!-- Edit-->
        </td>
        
        <td bgcolor="#CCCCCC" bordercolor="#FFFFFF" id="men">
        	<!-- Delete-->
        </td>
    </tr>

<?php
// total sum for component
$total_comp = 0;
$total_mat = 0;
$total_rab = 0;
$total_sop_mat = 0;
$total_trud = 0;
$total = 0;
$result = mysql_query("SELECT * FROM `components` WHERE `elid` = '$id' AND `group` = '$row[group]' ORDER BY `position` ");
$max = mysql_query ("SELECT * FROM `components` WHERE `elid` = '$id' AND `position` = (SELECT MAX(position) FROM `components` WHERE `elid` = '$id' AND `group` = '$row[group]')");
$min = mysql_query ("SELECT * FROM `components` WHERE `elid` = '$id' AND `position` = (SELECT MIN(position) FROM `components` WHERE `elid` = '$id' AND `group` = '$row[group]')");
$row_min = mysql_fetch_array ($min);

$row_max = mysql_fetch_array ($max);
while ($row = mysql_fetch_array($result))
		{ 
		?>
				<tr bordercolor="#9999CC">
                	<td id="comp">
                    	<?php if ($row['position'] > $row_min['position']) {?>
						<a href="up_component.php?id_up_comp=<?php echo $row['id'];?>" title="Поднять слой"><?php include ("button_up.php"); } // button up ?> </a>
                    </td>
                    
                    <td id="comp">
                    	<?php if ( $row['position'] < $row_max['position'] ) { ?> 
						<a href="down_component.php?id_down_comp=<?php echo $row['id'];?>" title="Опустить слой"><?php include ("button_down.php"); } // button down?></a>
                    </td>
                    
                    <td id="comp">
                    	<a href="show_component.php?show_comp_id=<?php echo $row['id'];?>&amp;elid=<?php echo $row['elid']?>"><?php echo $row['name'];?></a>
                    </td>
                    
                    <td id="comp">
                    	<?php echo $row['razm'];?>
                    </td>
                    
                    <td id="comp">
                    	<?php echo round ($row['stmat'], 1);?>
                    </td>
                    
                    <td id="comp">
                    	<?php echo round ($row['trud'], 1);?>
                    </td>
                    
                    <td id="comp">
                    	<?php echo round ($row['strab'], 1);?>
                    </td>
                    
                    <td id="comp">
                    	<?php echo round ($row['stsopmat'], 1);?>
                    </td>
                    
                    <td id="comp">
                    	<?php $sum_comp = $row['stmat'] + $row['strab'] + $row['stsopmat']; echo round ($sum_comp, 1);?>
                    </td>
                    
                    <td id="comp">
                    	<a href="edit_component.php?id_edit_comp=<?php echo $row['id'];?>" title="Редактировать"><?php include ("button_edit_component.php"); // button edit component?></a>
                    </td>
                    
                    <td id="comp">
                    	<a href="delete_component.php?id_del_comp=<?php echo $row['id'];?>" title="Удалить"><?php include ("button_delete_component.php"); // button deletу component?></a>
                    </td>
                </tr><?php
		$total_mat = $total_mat + $row['stmat'];
$total_rab = $total_rab + $row['strab'];
$total_sop_mat = $total_sop_mat + $row['stsopmat'];
$total_trud = $total_trud + $row['trud'];
$total = $total + $sum_comp;
		
		}
		?>
       
        <?php
// end of main table

//  total calculating
?>

	<tr bgcolor="#FF6633">
    	<td id="men1" bgcolor="#CCCCCC" bordercolor="#FFFFFF">
        	<!-- up -->
        </td>
        
        <td id="men1" bgcolor="#CCCCCC" bordercolor="#FFFFFF">
        	<!-- down -->
        </td>
        
        <td id="men1">
        	Итого
        </td>
        
        <td bgcolor="#CCCCCC" bordercolor="#FFFFFF" id="men1">
        	<!--Размерность -->
        </td>
        
        <td id="men1">
        	<?php echo round ($total_mat, 1);?>
        </td>
        
        <td id="men1">
        	<?php echo round ($total_trud, 0);?>
        </td>
        
        <td id="men1">
        	<?php echo round ($total_rab, 1);?>
        </td id="men">
        
        <td id="men1">
        	<?php echo round ($total_sop_mat, 1);?>
        </td>
        
        <td id="men1">
        	<?php echo round ($total, 1);?>
        </td>
        
        <td bgcolor="#CCCCCC" bordercolor="#FFFFFF" id="men1">
        	<!-- Edit-->
        </td>
        
        <td bgcolor="#CCCCCC" bordercolor="#FFFFFF" id="men1">
        	<!-- Delete-->
        </td>
    </tr>
    </table>
<?php 

$result = mysql_query ("SELECT * FROM `handbook_elements` WHERE `id` = $id");
$row = mysql_fetch_array ($result);

if (!empty ($row['image']))
{?>
<br /><div align="center"><?php echo "<img src=\"img/images_elements/" . $row['image'] . "\" />"; ?>
<a href="delete_foto_elem.php?id=<?php echo $row['id']; ?>" title="Удалить картинку"><?php include ("button_delete_component.php");?></a></div>
<?php } }
 else {die ("Error!!!");}?>
        </td>
     </tr>
<!--Footer-->
	<tr>
        <td colspan="2" align="center" bgcolor="#E1E1E1" height="35" valign="middle"><?php include ("footer.php"); ?></td>
  </tr>
</table>

</body>
</html>
