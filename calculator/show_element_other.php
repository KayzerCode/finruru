<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Смотреть и редактировать параметры элемента</title>


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
    	<td width="300" bgcolor="#CCCCCC"><?php include ("left_block_calc.php");?></td>
<!--Center block-->
		<td valign="top" bgcolor="#F1F1F1" align="center">
         <?php if (isset ($_GET['id']) AND !empty ($_GET['id']))



			{
            
$_GET['id'] = htmlspecialchars ($_GET['id']); // id ofshablon
$_GET['elid'] = htmlspecialchars ($_GET['elid']);
$_GET['group'] = htmlspecialchars ($_GET['group']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']);
			            $elid = stripslashes($_GET['elid']); 
			            $group = stripslashes($_GET['group']); 

        } else { 
            $id = addslashes($_GET['id']);
			            $elid = addslashes($_GET['elid']); 
			            $group = addslashes($_GET['group']); 

        } 
        $id = (int)$id;
			if ($id == '0') {die ("Invalid element!!!!");}
			
			
			include ("bd.php");
			$select_group = mysql_query ("SELECT * FROM `handbook_groups` WHERE `id` = '$group'") or die ("Not select categorie");
$row_group = mysql_fetch_array ($select_group);
			
			$select_cat = mysql_query ("SELECT * FROM `categories` WHERE `id` = '$row_group[id_cat]'") or die ("Not select categorie");
$row_cat = mysql_fetch_array ($select_cat);

			$res = mysql_query ("SELECT * FROM `shab_elements` WHERE `id` = '$elid'");
			$row = mysql_fetch_array($res);?>
            
            <?php  
//Creation of title table?>
<table border="1" cellpadding="0" cellspacing="10" align="center" frame="void" id="table2" bordercolor="#F1F1F1" width="800">
<tr>
<td colspan="4">
<div align="left"><a href="calc_shab.php?id=<?php echo $id;?>&cat=<?php echo $row_cat['fix'];?>" title="Назад к просмотру элементов блока"><?php include ("button_back.php"); // the button BACK ?> </a></div>
</td>
</tr>
<tr>
<td>
<div align="left"><font size="+2"><?php echo $row['name']; ?></font><br /></div></td><td><div align="right"><a href="edit_element_shablon.php?id=<?php echo $id;?>&amp;elid=<?php echo $elid;?>&amp;group=<?php echo $group;?>" title="Редактировать элемент"><?php include ("button_edit.php");  // the button edit?></a></div></td><td><div align="left"><a href="delete_element_shablon.php?id=<?php echo $id;?>&amp;elid=<?php echo $elid;?>&amp;group=<?php echo $group;?>" title="Удалить элемент из шаблона"><?php include ("button_delete.php");  // the button delete?></a></div>
</td>
<td><div align="right"><a href="add_new_component_shablon.php?id=<?php echo $id;?>&amp;elid=<?php echo $elid;?>&amp;group=<?php echo $group;?>" title="Добавить новый слой"><?php include ("button_add_component.php"); // the button ADD COMPONENT?> </a></div></td>
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
$result1 = mysql_query("SELECT * FROM `shab_components` WHERE `id_shab` = '$id' AND `elid` = '$elid' ORDER BY `position` ");
$max = mysql_query ("SELECT * FROM `shab_components` WHERE `id_shab` = '$id' AND `elid` = '$elid' AND `position` = (SELECT MAX(position) FROM `shab_components` WHERE `id_shab` = '$id' AND `elid` = '$elid')");
$min = mysql_query ("SELECT * FROM `shab_components` WHERE `id_shab` = '$id' AND `elid` = '$elid' AND `position` = (SELECT MIN(position) FROM `shab_components` WHERE `id_shab` = '$id' AND `elid` = '$elid')");
$row_min = mysql_fetch_array ($min);
$row_max = mysql_fetch_array ($max);
while ($row1 = mysql_fetch_array($result1))
		{ 
		?>
				<tr bordercolor="#9999CC">
                	<td id="comp">
                    	<?php if ($row1['position'] > $row_min['position']) {?>
						<a href="up_component_polpokr.php?id_up_comp=<?php echo $row1['id'];?>" title="Поднять слой"><?php include ("button_up.php"); } // button up ?> </a>
                    </td>
                    
                    <td id="comp">
                    	<?php if ( $row1['position'] < $row_max['position'] ) { ?> 
						<a href="down_component_polpokr.php?id_down_comp=<?php echo $row1['id'];?>" title="Опустить слой"><?php include ("button_down.php"); } // button down?></a>
                    </td>
                    
                    <td id="comp">
                    	<a href="show_component_shablon.php?show_comp_id=<?php echo $row1['id'];?>&amp;id=<?php echo $id;?>"><?php echo $row1['name'];?></a>
                    </td>
                    
                    <td id="comp">
                    	<?php $razm = $row1['razm']; echo $razm;?>
                    </td>
                    
                    <td id="comp">
                    	<?php echo round ($row1['stmat'], 1);?>
                    </td>
                    
                    <td id="comp">
                    	<?php echo round ($row1['trud'], 0);?>
                    </td>
                    
                    <td id="comp">
                    	<?php echo round ($row1['strab'], 1);?>
                    </td>
                    
                    <td id="comp">
                    	<?php echo round ($row1['stsopmat'], 1);?>
                    </td>
                    
                    <td id="comp">
                    	<?php $sum_comp = $row1['stmat'] + $row1['strab'] + $row1['stsopmat']; echo round ($sum_comp, 1);?>
                    </td>
                    
                    <td id="comp">
                    	<a href="edit_component_shablon.php?id_edit_comp=<?php echo $row1['id'];?>" title="Редактировать"><?php include ("button_edit_component.php"); // button edit component?></a>
                    </td>
                    
                    <td id="comp">
                    	<a href="delete_component_shablon.php?id_del_comp=<?php echo $row1['id'];?>" title="Удалить"><?php include ("button_delete_component.php"); // button deletу component?></a>
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
        	Итого /без коэф./
        </td>
        
        <td bgcolor="#CCCCCC" bordercolor="#FFFFFF" id="men1">
        	<!--Размерность -->
        </td>
        
        <td id="men1">
        	<?php echo round ($total_mat*$row['quantity'], 1);?>
        </td>
        
        <td id="men1">
        	<?php echo round ($total_trud, 0);?>
        </td>
        
        <td id="men1">
        	<?php echo round ($total_rab*$row['quantity'], 1);?>
        </td id="men">
        
        <td id="men1">
        	<?php echo round ($total_sop_mat*$row['quantity'], 1);?>
        </td>
        
        <td id="men1">
        	<?php echo round ($total*$row['quantity'], 1);?>
        </td>
        
        <td bgcolor="#CCCCCC" bordercolor="#FFFFFF" id="men1">
        	<!-- Edit-->
        </td>
        
        <td bgcolor="#CCCCCC" bordercolor="#FFFFFF" id="men1">
        	<!-- Delete-->
        </td>
    </tr>
    
    <tr bgcolor="#FF6633">
    	<td id="men1" bgcolor="#CCCCCC" bordercolor="#FFFFFF">
        	<!-- up -->
        </td>
        
        <td id="men1" bgcolor="#CCCCCC" bordercolor="#FFFFFF">
        	<!-- down -->
        </td>
        
        <td id="men1">
        	Итого /с коэф./
        </td>
        
        <td bgcolor="#CCCCCC" bordercolor="#FFFFFF" id="men1">
        	<!--Размерность -->
        </td>
        
        <td id="men1">
        	<?php echo round ($total_mat*$row['quantity']*$row['koef'], 1);?>
        </td>
        
        <td id="men1">
        	<?php echo $total_trud;?>
        </td>
        
        <td id="men1">
        	<?php echo round ($total_rab*$row['quantity']*$row['koef'], 1);?>
        </td id="men">
        
        <td id="men1">
        	<?php echo round ($total_sop_mat*$row['quantity']*$row['koef'], 1);?>
        </td>
        
        <td id="men1">
        	<?php echo round ($total*$row['quantity']*$row['koef'], 1);?>
        </td>
        
        <td bgcolor="#CCCCCC" bordercolor="#FFFFFF" id="men1">
        	<!-- Edit-->
        </td>
        
        <td bgcolor="#CCCCCC" bordercolor="#FFFFFF" id="men1">
        	<!-- Delete-->
        </td>
    </tr>
    </table>
    <br />
   <div align="left"><font size="+1">&nbsp;&nbsp;&nbsp;Количество&nbsp;&nbsp;&nbsp;<?php echo round ($row['quantity'], 2);?>&nbsp;<?php echo $razm;?></font><?php }?><br />
<font size="+1">&nbsp;&nbsp;&nbsp;Коэффициент&nbsp;&nbsp;&nbsp;<?php echo round ($row['koef'], 2);?></font></div>
<?php 


if (!empty ($row['image']))
{?>
<br /><div align="center"><?php echo "<img src=\"img/images_elements_shablon/" . $row['image'] . "\" title=\"Фото элемента\"/>"; ?>
</div><br />
<?php } 
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
