<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Добавление отделки потолка</title>


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
		<td valign="top" bgcolor="#F1F1F1" align="center">
         <?php if (isset ($_GET['id_shab']) AND !empty ($_GET['id_shab']))



			{
            
$_GET['id_shab'] = htmlspecialchars ($_GET['id_shab']);
$_GET['id_room'] = htmlspecialchars ($_GET['id_room']);

if(get_magic_quotes_gpc()){ 
            $id_shab = stripslashes($_GET['id_shab']); 
			            $id_room = stripslashes($_GET['id_room']); 

        } else { 
            $id_shab = addslashes($_GET['id_shab']);
			$id_room = addslashes($_GET['id_room']); 
        } 
        $id_shab = (int)$id_shab;
			if ($id_shab == '0') {die ("Invalid element!!!!");}
			
			
			include ("bd.php");
			
			?>
            
            <?php  
//Creation of title table?>
<table border="1" cellpadding="0" cellspacing="10" align="center" frame="void" id="table2" bordercolor="#F1F1F1" width="800">
<tr>
<td colspan="4">
<div align="left"><a href="calc_shab.php?id=<?php echo $id_shab;?>&amp;cat=otd&amp;show_room=<?php echo $id_room;?>" title="Назад"><?php include ("button_back.php"); // the button BACK ?> </a></div>
</td>
</tr>
</table>
<?php 
	$res = mysql_query ("SELECT * FROM `handbook_elements` WHERE `group` = '9'");
			while ($row = mysql_fetch_array($res))
				{?>

<table border="1" cellpadding="0" cellspacing="10" align="center" frame="void" id="table2" bordercolor="#F1F1F1" width="800">
<tr>
<td>
<div align="left"><font size="+2"><?php echo $row['name']; ?></font></div></td>
<td><div align="right"><a href="show_foto4.php?id=<?php echo $row['id'];?>&amp;id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>" title="Показать фотографию элемента"><?php include ("button_foto.php");?></a></div></td>
<td><div align="right"><a href="edit_element5.php?id=<?php echo $row['id'];?>&amp;id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>" title="Редактировать элемент"><?php include ("button_edit.php");  // the button edit?></a></div></td><td><div align="left"><a href="delete_element5.php?id=<?php echo $row['id'];?>&amp;id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>" title="Удалить элемент"><?php include ("button_delete.php");  // the button delete?></a></div>
</td>

<td><a href="add_to_room_potpokr.php?id=<?php echo $row['id'];?>&amp;id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>" title="Добавить в комнату"><?php include ("button_add_to_room.php");?></a></td>
<td><div align="right"><a href="add_new_component4.php?group=<?php echo $row['group'];?>&amp;elid=<?php echo $row['id'];?>&amp;id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>" title="Добавить новый слой"><?php include ("button_add_component.php"); // the button ADD COMPONENT?> </a></div></td>
</tr>
</table>

<?php // End of title table ?>
<?php // main table with components 
?>
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
$result = mysql_query("SELECT * FROM `components` WHERE `elid` = '$row[id]' AND `group` = '9' ORDER BY `position` ");
$max = mysql_query ("SELECT * FROM `components` WHERE `elid` = '$row[id]' AND `position` = (SELECT MAX(position) FROM `components` WHERE `elid` = '$row[id]' AND `group` = '9')");
$min = mysql_query ("SELECT * FROM `components` WHERE `elid` = '$row[id]' AND `position` = (SELECT MIN(position) FROM `components` WHERE `elid` = '$row[id]' AND `group` = '9')");
$row_min = mysql_fetch_array ($min);

$row_max = mysql_fetch_array ($max);
while ($row1 = mysql_fetch_array($result))
		{ 
		?>
				<tr bordercolor="#9999CC">
                	<td id="comp">
                    	<?php if ($row1['position'] > $row_min['position']) {?>
						<a href="up_component4.php?id_up_comp=<?php echo $row1['id'];?>&amp;id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>" title="Поднять слой"><?php include ("button_up.php"); } // button up ?> </a>
                    </td>
                    
                    <td id="comp">
                    	<?php if ( $row1['position'] < $row_max['position'] ) { ?> 
						<a href="down_component4.php?id_down_comp=<?php echo $row1['id'];?>&amp;id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>" title="Опустить слой"><?php include ("button_down.php"); } // button down?></a>
                    </td>
                    
                    <td id="comp">
                    	<a href="show_component4.php?show_comp_id=<?php echo $row1['id'];?>&amp;elid=<?php echo $row1['elid']?>&amp;id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>"><?php echo $row1['name'];?></a>
                    </td>
                    
                    <td id="comp">
                    	<?php echo $row1['razm'];?>
                    </td>
                    
                    <td id="comp">
                    	<?php echo $row1['stmat'];?>
                    </td>
                    
                    <td id="comp">
                    	<?php echo $row1['trud'];?>
                    </td>
                    
                    <td id="comp">
                    	<?php echo $row1['strab'];?>
                    </td>
                    
                    <td id="comp">
                    	<?php echo $row1['stsopmat'];?>
                    </td>
                    
                    <td id="comp">
                    	<?php $sum_comp = $row1['stmat'] + $row1['strab'] + $row1['stsopmat']; echo $sum_comp;?>
                    </td>
                    
                    <td id="comp">
                    	<a href="edit_component8.php?id_edit_comp=<?php echo $row1['id'];?>&amp;id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>" title="Редактировать"><?php include ("button_edit_component.php"); // button edit component?></a>
                    </td>
                    
                    <td id="comp">
                    	<a href="delete_component8.php?id_del_comp=<?php echo $row1['id'];?>&amp;id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>" title="Удалить"><?php include ("button_delete_component.php"); // button deletу component?></a>
                    </td>
                </tr><?php
		$total_mat = $total_mat + $row1['stmat'];
$total_rab = $total_rab + $row1['strab'];
$total_sop_mat = $total_sop_mat + $row1['stsopmat'];
$total_trud = $total_trud + $row1['trud'];
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
        	<?php echo $total_mat;?>
        </td>
        
        <td id="men1">
        	<?php echo $total_trud;?>
        </td>
        
        <td id="men1">
        	<?php echo $total_rab;?>
        </td id="men">
        
        <td id="men1">
        	<?php echo $total_sop_mat;?>
        </td>
        
        <td id="men1">
        	<?php echo $total;?>
        </td>
        
        <td bgcolor="#CCCCCC" bordercolor="#FFFFFF" id="men1">
        	<!-- Edit-->
        </td>
        
        <td bgcolor="#CCCCCC" bordercolor="#FFFFFF" id="men1">
        	<!-- Delete-->
        </td>
    </tr>
    </table>
<?php }?> <br />
<div align="center"><a href="add_element4.php?group=9&amp;id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>"><?php include ("button_add_object.php");?></a></div> 
<br /><br /><?php

 }
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
