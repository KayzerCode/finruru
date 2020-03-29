<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Расчёт отделки</title>

</head>

<body>
<?php if (isset ($_GET['id']) AND !empty ($_GET['id']) AND isset ($_GET['cat']) AND !empty ($_GET['cat']) AND $_GET['cat'] != 'otd')

			{
$cat = $_GET['cat']; // fix
$_GET['id'] = htmlspecialchars ($_GET['id']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']); // id of shablon

        } else { 
            $id = addslashes($_GET['id']);

        } 
	$id = (int)$id;
				if ($id == '0') {die ("Invalid shablon!!!!");}
				
$select_cat = mysql_query ("SELECT * FROM `categories` WHERE `fix` = '$cat'") or die ("Not select categorie");
$row_cat = mysql_fetch_array ($select_cat);
?><table cellpadding="5">
	<tr align="left">
		<td>
			Блок <font size="+1"><strong><?php echo $row_cat['name'];?></strong></font>
		</td>
	</tr>
  </table>
<?php $select_group = mysql_query ("SELECT * FROM `handbook_groups` WHERE `id_cat` = '$row_cat[id]'") or die ("Not select group");
							$total_stmat = 0;
							$total_strab = 0;
							$total_stsopmat = 0;
							$total_trud = 0;
							$total_stmat_koef = 0;
							$total_strab_koef = 0;
							$total_stsopmat_koef = 0;
							$i = 0;
while ($row_group = mysql_fetch_array ($select_group))
	{
		?>
		<div align="center"><font size="+1"><u><?php echo $row_group['name'];?></u></font></div>
        <?php $select_elements = mysql_query ("SELECT * FROM `shab_elements` WHERE `group` = '$row_group[id]' AND `id_shab` = '$id'") or die ("Not select elements");
			$num = mysql_num_rows ($select_elements);
				if ($num < '1')
					{?> <div align="center">Пока нет элементов, но можно<br />
                    <a href="add_elements.php?id_shab=<?php echo $id;?>&amp;group=<?php echo $row_group['id'];?>" title="Добавить элемент из справочника в этот блок"><?php include ("button_add_object.php");?></a></div> <?php }
					
					elseif ($num >= '1')
						{?>
                        <div align="center"><a href="add_elements.php?id_shab=<?php echo $id;?>&amp;group=<?php echo $row_group['id'];?>" title="Добавить элемент из справочника в этот блок"><?php include ("button_add_object.php");?></a></div>
                      <table border="0" cellpadding="5" cellspacing="10" align="center" frame="void" bordercolor="#000000">
                      	<tr bgcolor="#9999CC">
                        	<td id="men1">Название</td>
                            <td id="men1">Стоимость материала, &euro;</td>
                            <td id="men1">Затраты труда, tth</td>
                            <td id="men1">Стоимость работы, &euro;</td>
                            <td id="men1">Доп. расходы, &euro;</td>
                            <td id="men1">Коэф.</td>
                            <td id="men1">Итого /без коэф./</td>
                            <td id="men1">Итого /с коэф./</td>
                            <td id="men1">Количество</td>
                            <td id="men1">Убрать из расчёта</td>
                        </tr>
							<?php 
							$total_el_stmat = 0;
							$total_el_strab = 0;
							$total_el_stsopmat = 0;
							$total_el_trud = 0;
							$total_el_stmat_koef = 0;
							$total_el_strab_koef = 0;
							$total_el_stsopmat_koef = 0;
							while ($row_elem = mysql_fetch_array ($select_elements))
								{
								$stmat = 0;
								$strab = 0;
								$trud = 0;
								$stsopmat =0;
								$select_components = mysql_query ("SELECT * FROM `shab_components` WHERE `group` = '$row_group[id]' AND `elid` = '$row_elem[id]' AND `id_shab` = '$id'") or die ("Not select components");
								while ($row_comp = mysql_fetch_array ($select_components))
									{
										$stmat = $stmat + $row_comp['stmat'];
										$strab = $strab + $row_comp['strab'];
										$stsopmat = $stsopmat + $row_comp['stsopmat'];
										$trud = $trud + $row_comp['trud'];
									}
									?>
                                    
                         <tr bgcolor="#99CCCC">
                        	<td id="men1"><a href="show_element_other.php?elid=<?php echo $row_elem['id'];?>&amp;id=<?php echo $id;?>&amp;group=<?php echo $row_group['id'];?>"><?php echo $row_elem['name'];?></a></td>
                            <td id="men1"><?php $total_stmat_elem = $stmat*$row_elem['quantity']; echo round ($total_stmat_elem, 1);?></td>
                            <td id="men1"><?php echo round ($trud, 0);?></td>
                            <td id="men1"><?php $total_strab_elem = $strab*$row_elem['quantity']; echo round ($total_strab_elem, 1);?></td>
                            <td id="men1"><?php $total_stsopmat_elem = $stsopmat*$row_elem['quantity']; echo round ($total_stsopmat_elem, 1);?></td>
                            <td id="men1"><?php echo round ($row_elem['koef'], 2);?></td>
                            <td id="men1"><?php $total_elem = $total_stmat_elem + $total_strab_elem + $total_stsopmat_elem; echo round ($total_elem, 1);?></td>
                            <td id="men1"><?php $total_elem_koef = ($total_stmat_elem + $total_strab_elem + $total_stsopmat_elem)*$row_elem['koef']; echo round ($total_elem_koef, 1);?></td>
                            
                            <td id="men1"><?php echo round ($row_elem['quantity'], 1);?></td>
                            <td id="men1"><a href="erase_element_from_shablon.php?elid=<?php echo $row_elem['id'];?>&amp;id=<?php echo $id;?>&amp;group=<?php echo $row_cat['id'];?>" title="Убрать из расчёта">Убрать</a></td>
                        </tr>
                                    
                                    <?php
							$total_el_stmat = $total_el_stmat + $total_stmat_elem;
							$total_el_strab = $total_el_strab + $total_strab_elem;
							$total_el_stsopmat = $total_el_stsopmat + $total_stsopmat_elem;
							$total_el_trud = $total_el_trud + $trud;
							$total_el_stmat_koef = $total_el_stmat_koef + $total_stmat_elem*$row_elem['koef'];
							$total_el_strab_koef = $total_el_strab_koef + $total_strab_elem*$row_elem['koef'];
							$total_el_stsopmat_koef = $total_el_stsopmat_koef + $total_stsopmat_elem*$row_elem['koef'];
								}
								?>
                                <tr bgcolor="#FF6633">
                        	<td id="men1">Итого /без коэф./</td>
                            <td id="men1"><?php echo round ($total_el_stmat, 1);?></td>
                            <td id="men1"><?php echo round ($total_el_trud, 0);?></td>
                            <td id="men1"><?php echo round ($total_el_strab, 1);?></td>
                            <td id="men1"><?php echo round ($total_el_stsopmat, 1);?></td>
                            <td id="men1">-</td>
                            <td id="men1"><?php $total_el = $total_el_stmat + $total_el_strab + $total_el_stsopmat; echo round ($total_el, 1);?></td>
                            <td id="men1">-</td>
                            <td id="men1">-</td>
                            <td id="men1">-</td>
                        </tr>
                        <tr bgcolor="#FF6633">
                        	<td id="men1">Итого /с коэф./</td>
                            <td id="men1"><?php echo round ($total_el_stmat_koef, 1);?></td>
                            <td id="men1"><?php echo round ($total_el_trud, 0);?></td>
                            <td id="men1"><?php echo round ($total_el_strab_koef, 1);?></td>
                            <td id="men1"><?php echo round ($total_el_stsopmat_koef, 1);?></td>
                            <td id="men1">-</td>
                            <td id="men1">-</td>
                            <td id="men1"><?php $total_el_koef = $total_el_stmat_koef + $total_el_strab_koef + $total_el_stsopmat_koef; echo round ($total_el_koef, 1);?></td>
                            <td id="men1">-</td>
                            <td id="men1">-</td>
                        </tr>
                        </table><?php
							$total_stmat = $total_stmat + $total_el_stmat;
							$total_strab = $total_strab + $total_el_strab;
							$total_stsopmat = $total_stsopmat + $total_el_stsopmat;
							$total_trud = $total_trud + $total_el_trud;
							$total_stmat_koef = $total_stmat_koef + $total_el_stmat_koef;
							$total_strab_koef = $total_strab_koef + $total_el_strab_koef;
							$total_stsopmat_koef = $total_stsopmat_koef + $total_el_stsopmat_koef;
 
						}
		?><hr width="80%" />
		<?php
		$i = $i + $num;
								} 
								if ($i != '0') {?>
    <div align="center"><font size="+2"><strong>Итоговые подсчёты по блоку "<?php echo $row_cat['name'];?>"</strong></font></div>
<table border="1" cellpadding="7" cellspacing="10" align="center" frame="void" id="table2" bordercolor="#F1F1F">
	<tr>
    	<td>
        </td>
        
        <td id="men1" bgcolor="#9999CC">
        	Без коэффициента
        </td>
        
        <td id="men1" bgcolor="#9999CC">
        	С коэффициентом
        </td>
    </tr>
    
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Стоимсоть материала, &euro;
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_stmat, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_stmat_koef, 1);?>
        </td>
    </tr>
    
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Стоимость работ, &euro;
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_strab, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_strab_koef, 1);?>
        </td>
    </tr>
    
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Дополнительные расходы, &euro;
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_stsopmat, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_stsopmat_koef, 1);?>
        </td>
    </tr>
    
    
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Итого, &euro;
        </td>
        
        <td bgcolor="#FF6633" id="men1">
        	<?php $total = $total_stmat + $total_strab + $total_stsopmat; echo round ($total, 1);?>
        </td>
        
        <td bgcolor="#FF6633" id="men1">
        	<?php $total_koef = $total_stmat_koef + $total_strab_koef + $total_stsopmat_koef; echo round ($total_koef, 1);?>
        </td>
    </tr>
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Затраты труда, tth
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_trud, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_trud, 1);?>
        </td>
    </tr>
</table>
            


		 <?php } } ?>

</body>
</html>