<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Расчёт отделки</title>

</head>

<body>
<?php if (isset ($_GET['id']) AND !empty ($_GET['id']) AND $_GET['cat'] === 'otd')



			{?>
            

<?php 
$_GET['id'] = htmlspecialchars ($_GET['id']);
$_GET['cat'] = htmlspecialchars ($_GET['cat']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']);
			            $cat = stripslashes($_GET['cat']); 

        } else { 
            $id = addslashes($_GET['id']);
			            $cat = addslashes($_GET['cat']); 

        } 
	$id = (int)$id;
				if ($id == '0') {die ("Invalid shablon!!!!");}


include ("bd.php"); // connection to database?>

<?php // main table with components 
$result = mysql_query("SELECT * FROM `rooms_shab` WHERE `id_shab` = $id ORDER BY `id`", $link) or die ("Not select room");
$num = mysql_num_rows ($result); 
$nuw_rows = mysql_num_rows ($result);
if ($num < '1') {echo "<br><div align='center'>Пока нет комнат в этой спецификации!</div>"; ?>
<table border="1" cellpadding="0" cellspacing="10" align="center" frame="void" id="table2" bordercolor="#F1F1F">
<tr><td><div align="center"><a href="add_room.php?id=<?php echo $id;?>&amp;cat=<?php echo $cat;?>" title="Добавить новую комнату в эту спецификацию"><?php include ("button_add_object.php"); // the button ADD ?> </a></div></td></tr></table>
<?php 
}

else {
 
//Creation of a output table?>
<br /><div align="center"><a href="add_room.php?id=<?php echo $id;?>&amp;cat=<?php echo $cat;?>" title="Добавить новую комнату в эту спецификацию"><?php include ("button_add_object.php"); // the button ADD ?> </a></div><br /><hr align="center" color="#000000" width="600"/>
<table border="0" cellpadding="5" cellspacing="10" align="center" frame="void" bordercolor="#000000">
    

<tr bgcolor="#9999CC">
	<td id="men1">
    	Название комнаты
    </td>
    
    <td id="men1">
    	Площадь, м&sup2;
    </td>
    
    <td id="men1">
    	Высота потолка, м
    </td>
    
    <td id="men1">
    	Периметр, м
    </td>
    
    <td id="men1">
    	Редактировать
    </td >
    
    <td id="men1">
    	Клонировать
    </td>
    
    <td id="men1">
    	Удалить
    </td>
    
</tr>

<?php 
while ($row = mysql_fetch_array($result))

{

			?>
            
            <tr>
	<td id="comp">
    	<a href="calc_shab.php?id=<?php echo $id;?>&amp;cat=<?php echo $cat;?>&amp;show_room=<?php echo $row['id']?>"><?php echo $row['name'];?></a>
    </td>
    
    <td id="comp">
    	<?php echo round ($row['metraj'], 2);?>
    </td>
    
    <td id="comp">
    	<?php echo round ($row['vuspot'], 2);?>
    </td>
    
    <td id="comp">
    	<?php echo round ($row['jm'], 2);?>
    </td>
    
    <td id="comp">
    	<a href="edit_room.php?id=<?php echo $row['id'];?>&shab=<?php echo $id;?>" title="Редактировать параметры комнаты"><?php include ("button_edit.php");?></a>
    </td>
    
    <td id="comp">
    	<a href="clone_room.php?id=<?php echo $row['id'];?>&shab=<?php echo $id;?>" title="Клонировать комнату"><?php include ("button_clone.php");?></a>
    </td>
    
    <td id="comp">
    	<a href="delete_room.php?id=<?php echo $row['id'];?>&shab=<?php echo $id;?>" title="Удалить комнату из блока"><?php include ("button_delete.php");?></a>
    </td>
    
</tr>
              

<?php } ?>
</table><br />
<div align="right"></div>
<div align="center"><font size="+2"><strong>Итоговые подсчёты по блоку "Отделка"</strong></font>&nbsp;&nbsp;&nbsp;&nbsp;<a href="show_full_finishing.php?id=<?php echo $id;?>" title="Посмотреть весь блок целиком"><?php include ("button_full.php");?></a></div>
<?php
	$sel_comp = mysql_query ("SELECT * FROM `rooms_shab` WHERE `id_shab` = '$id'") or die ("NOT select room");
	$stmat_polpokr_total = 0;
	$strab_polpokr_total = 0;
	$stsopmat_polpokr_total = 0;
	$trud_polpokr_total = 0;
	$stmat_polpokr_total_koef = 0;
	$strab_polpokr_total_koef = 0;
	$stsopmat_polpokr_total_koef = 0;
	
	$stmat_polobr_total = 0;
	$strab_polobr_total = 0;
	$stsopmat_polobr_total = 0;
	$trud_polobr_total = 0;
	$stmat_polobr_total_koef = 0;
	$strab_polobr_total_koef = 0;
	$stsopmat_polobr_total_koef = 0;
	
	$stmat_stena_total = 0;
	$strab_stena_total = 0;
	$stsopmat_stena_total = 0;
	$trud_stena_total = 0;
	$stmat_stena_total_koef = 0;
	$strab_stena_total_koef = 0;
	$stsopmat_stena_total_koef = 0;
	
	$stmat_potpokr_total = 0;
	$strab_potpokr_total = 0;
	$stsopmat_potpokr_total = 0;
	$trud_potpokr_total = 0;
	$stmat_potpokr_total_koef = 0;
	$strab_potpokr_total_koef = 0;
	$stsopmat_potpokr_total_koef = 0;
	
	$stmat_potobr_total = 0;
	$strab_potobr_total = 0;
	$stsopmat_potobr_total = 0;
	$trud_potobr_total = 0;
	$stmat_potobr_total_koef = 0;
	$strab_potobr_total_koef = 0;
	$stsopmat_potobr_total_koef = 0;
	while ($row1 = mysql_fetch_array ($sel_comp))
		{
			$ros0 = mysql_query ("SELECT * FROM `polpokr` WHERE `id_shab` = '$id' AND `id_room` = '$row1[id]'") or die ("NOT select polpokr");
					$stmat_polpokr_room_koef = 0;
					$strab_polpokr_room_koef = 0;
					$stsopmat_polpokr_room_koef = 0;
					$trud_polpokr_room = 0;
					$stmat_polpokr_room = 0;
					$strab_polpokr_room = 0;
					$stsopmat_polpokr_room = 0;
				while ($row0 = mysql_fetch_array ($ros0))
					{
					$stmat_polpokr = 0;
					$strab_polpokr = 0;
					$stsopmat_polpokr = 0;
					$trud_polpokr = 0;

				$res1 = mysql_query ("SELECT * FROM `components_polpokr` WHERE `id_shab` = '$id' AND `id_room` = '$row1[id]' AND `id_polpokr` = '$row0[id]'") or die ("NOT select polpokr");
						while ($row_polpokr = mysql_fetch_array ($res1))
							{
								$stmat_polpokr = $stmat_polpokr + $row_polpokr['stmat'];
								$strab_polpokr = $strab_polpokr + $row_polpokr['strab'];
								$stsopmat_polpokr = $stsopmat_polpokr + $row_polpokr['stsopmat'];
								$trud_polpokr = $trud_polpokr + $row_polpokr['trud'];
							}
					$stmat_polpokr_room_koef = $stmat_polpokr_room_koef + $stmat_polpokr*$row0['koef'];
					$strab_polpokr_room_koef = $strab_polpokr_room_koef + $strab_polpokr*$row0['koef'];
					$stsopmat_polpokr_room_koef = $stsopmat_polpokr_room_koef + $stsopmat_polpokr*$row0['koef'];
					$trud_polpokr_room = $trud_polpokr_room + $trud_polpokr;
					$stmat_polpokr_room = $stmat_polpokr_room + $stmat_polpokr;
					$strab_polpokr_room = $strab_polpokr_room + $strab_polpokr;
					$stsopmat_polpokr_room = $stsopmat_polpokr_room + $stsopmat_polpokr;
					}
					
			$ros2 = mysql_query ("SELECT * FROM `polobr` WHERE `id_shab` = '$id' AND `id_room` = '$row1[id]'") or die ("NOT select polpokr");
					$stmat_polobr_room_koef = 0;
					$strab_polobr_room_koef = 0;
					$stsopmat_polobr_room_koef = 0;
					$trud_polobr_room = 0;
					$stmat_polobr_room = 0;
					$strab_polobr_room = 0;
					$stsopmat_polobr_room = 0;
				while ($row2 = mysql_fetch_array ($ros2))
					{
					$stmat_polobr = 0;
					$strab_polobr = 0;
					$stsopmat_polobr = 0;
					$trud_polobr = 0;

				$res2 = mysql_query ("SELECT * FROM `components_polobr` WHERE `id_shab` = '$id' AND `id_room` = '$row1[id]' AND `id_polobr` = '$row2[id]'") or die ("NOT select polobr");
						while ($row_polobr = mysql_fetch_array ($res2))
							{
								$stmat_polobr = $stmat_polobr + $row_polobr['stmat'];
								$strab_polobr = $strab_polobr + $row_polobr['strab'];
								$stsopmat_polobr = $stsopmat_polobr + $row_polobr['stsopmat'];
								$trud_polobr = $trud_polobr + $row_polobr['trud'];
							}
					$stmat_polobr_room_koef = $stmat_polobr_room_koef + $stmat_polobr*$row2['koef'];
					$strab_polobr_room_koef = $strab_polobr_room_koef + $strab_polobr*$row2['koef'];
					$stsopmat_polobr_room_koef = $stsopmat_polobr_room_koef + $stsopmat_polobr*$row2['koef'];
					$trud_polobr_room = $trud_polobr_room + $trud_polobr;
					$stmat_polobr_room = $stmat_polobr_room + $stmat_polobr;
					$strab_polobr_room = $strab_polobr_room + $strab_polobr;
					$stsopmat_polobr_room = $stsopmat_polobr_room + $stsopmat_polobr;
					}
					
			$ros3 = mysql_query ("SELECT * FROM `stena` WHERE `id_shab` = '$id' AND `id_room` = '$row1[id]'") or die ("NOT select stena");
					$stmat_stena_room_koef = 0;
					$strab_stena_room_koef = 0;
					$stsopmat_stena_room_koef = 0;
					$trud_stena_room = 0;
					$stmat_stena_room = 0;
					$strab_stena_room = 0;
					$stsopmat_stena_room = 0;
				while ($row3 = mysql_fetch_array ($ros3))
					{
					$stmat_stena = 0;
					$strab_stena = 0;
					$stsopmat_stena = 0;
					$trud_stena = 0;

				$res3 = mysql_query ("SELECT * FROM `components_stena` WHERE `id_shab` = '$id' AND `id_room` = '$row1[id]' AND `id_stena` = '$row3[id]'") or die ("NOT select stena");
						while ($row_stena = mysql_fetch_array ($res3))
							{
								$stmat_stena = $stmat_stena + $row_stena['stmat'];
								$strab_stena = $strab_stena + $row_stena['strab'];
								$stsopmat_stena = $stsopmat_stena + $row_stena['stsopmat'];
								$trud_stena = $trud_stena + $row_stena['trud'];
							}
					$stmat_stena_room_koef = $stmat_stena_room_koef + $stmat_stena*$row3['koef'];
					$strab_stena_room_koef = $strab_stena_room_koef + $strab_stena*$row3['koef'];
					$stsopmat_stena_room_koef = $stsopmat_stena_room_koef + $stsopmat_stena*$row3['koef'];
					$trud_stena_room = $trud_stena_room + $trud_stena;
					$stmat_stena_room = $stmat_stena_room + $stmat_stena;
					$strab_stena_room = $strab_stena_room + $strab_stena;
					$stsopmat_stena_room = $stsopmat_stena_room + $stsopmat_stena;
					}
					
					
		
			$ros4 = mysql_query ("SELECT * FROM `potpokr` WHERE `id_shab` = '$id' AND `id_room` = '$row1[id]'") or die ("NOT select potpokr");
					$stmat_potpokr_room_koef = 0;
					$strab_potpokr_room_koef = 0;
					$stsopmat_potpokr_room_koef = 0;
					$trud_potpokr_room = 0;
					$stmat_potpokr_room = 0;
					$strab_potpokr_room = 0;
					$stsopmat_potpokr_room = 0;
				while ($row4 = mysql_fetch_array ($ros4))
					{
					$stmat_potpokr = 0;
					$strab_potpokr = 0;
					$stsopmat_potpokr = 0;
					$trud_potpokr = 0;

				$res4 = mysql_query ("SELECT * FROM `components_potpokr` WHERE `id_shab` = '$id' AND `id_room` = '$row1[id]' AND `id_potpokr` = '$row4[id]'") or die ("NOT select polpokr");
						while ($row_potpokr = mysql_fetch_array ($res4))
							{
								$stmat_potpokr = $stmat_potpokr + $row_potpokr['stmat'];
								$strab_potpokr = $strab_potpokr + $row_potpokr['strab'];
								$stsopmat_potpokr = $stsopmat_potpokr + $row_potpokr['stsopmat'];
								$trud_potpokr = $trud_potpokr + $row_potpokr['trud'];
							}
					$stmat_potpokr_room_koef = $stmat_potpokr_room_koef + $stmat_potpokr*$row4['koef'];
					$strab_potpokr_room_koef = $strab_potpokr_room_koef + $strab_potpokr*$row4['koef'];
					$stsopmat_potpokr_room_koef = $stsopmat_potpokr_room_koef + $stsopmat_potpokr*$row4['koef'];
					$trud_potpokr_room = $trud_potpokr_room + $trud_potpokr;
					$stmat_potpokr_room = $stmat_potpokr_room + $stmat_potpokr;
					$strab_potpokr_room = $strab_potpokr_room + $strab_potpokr;
					$stsopmat_potpokr_room = $stsopmat_potpokr_room + $stsopmat_potpokr;
					}
					
		$ros5 = mysql_query ("SELECT * FROM `potobr` WHERE `id_shab` = '$id' AND `id_room` = '$row1[id]'") or die ("NOT select potobr");
					$stmat_potobr_room_koef = 0;
					$strab_potobr_room_koef = 0;
					$stsopmat_potobr_room_koef = 0;
					$trud_potobr_room = 0;
					$stmat_potobr_room = 0;
					$strab_potobr_room = 0;
					$stsopmat_potobr_room = 0;
				while ($row5 = mysql_fetch_array ($ros5))
					{
					$stmat_potobr = 0;
					$strab_potobr = 0;
					$stsopmat_potobr = 0;
					$trud_potobr = 0;

				$res5 = mysql_query ("SELECT * FROM `components_potobr` WHERE `id_shab` = '$id' AND `id_room` = '$row1[id]' AND `id_potobr` = '$row5[id]'") or die ("NOT select potobr");
						while ($row_potobr = mysql_fetch_array ($res5))
							{
								$stmat_potobr = $stmat_potobr + $row_potobr['stmat'];
								$strab_potobr = $strab_potobr + $row_potobr['strab'];
								$stsopmat_potobr = $stsopmat_potobr + $row_potobr['stsopmat'];
								$trud_potobr = $trud_potobr + $row_potobr['trud'];
							}
					$stmat_potobr_room_koef = $stmat_potobr_room_koef + $stmat_potobr*$row5['koef'];
					$strab_potobr_room_koef = $strab_potobr_room_koef + $strab_potobr*$row5['koef'];
					$stsopmat_potobr_room_koef = $stsopmat_potobr_room_koef + $stsopmat_potobr*$row5['koef'];
					$trud_potobr_room = $trud_potobr_room + $trud_potobr;
					$stmat_potobr_room = $stmat_potobr_room + $stmat_potobr;
					$strab_potobr_room = $strab_potobr_room + $strab_potobr;
					$stsopmat_potobr_room = $stsopmat_potobr_room + $stsopmat_potobr;
					}
					
	$stmat_polpokr_total = $stmat_polpokr_total + $stmat_polpokr_room*$row1['metraj'];
	$strab_polpokr_total = $strab_polpokr_total + $strab_polpokr_room*$row1['metraj'];
	$stsopmat_polpokr_total = $stsopmat_polpokr_total + $stsopmat_polpokr_room*$row1['metraj'];
	$trud_polpokr_total = $trud_polpokr_total + $trud_polpokr_room;
	$stmat_polpokr_total_koef = $stmat_polpokr_total_koef + $stmat_polpokr_room_koef*$row1['metraj'];
	$strab_polpokr_total_koef = $strab_polpokr_total_koef + $strab_polpokr_room_koef*$row1['metraj'];
	$stsopmat_polpokr_total_koef = $stsopmat_polpokr_total_koef + $stsopmat_polpokr_room_koef*$row1['metraj'];
	
	$stmat_polobr_total = $stmat_polobr_total + $stmat_polobr_room*$row1['jm'];
	$strab_polobr_total = $strab_polobr_total + $strab_polobr_room*$row1['jm'];
	$stsopmat_polobr_total = $stsopmat_polobr_total + $stsopmat_polobr_room*$row1['jm'];
	$trud_polobr_total = $trud_polobr_total + $trud_polobr_room;
	$stmat_polobr_total_koef = $stmat_polobr_total_koef + $stmat_polobr_room_koef*$row1['jm'];
	$strab_polobr_total_koef = $strab_polobr_total_koef + $strab_polobr_room_koef*$row1['jm'];
	$stsopmat_polobr_total_koef = $stsopmat_polobr_total_koef + $stsopmat_polobr_room_koef*$row1['jm'];
	
	$stmat_stena_total = $stmat_stena_total + $stmat_stena_room*$row1['jm']*$row1['vuspot'];
	$strab_stena_total = $strab_stena_total + $strab_stena_room*$row1['jm']*$row1['vuspot'];
	$stsopmat_stena_total = $stsopmat_stena_total + $stsopmat_stena_room*$row1['jm']*$row1['vuspot'];
	$trud_stena_total = $trud_stena_total + $trud_stena_room;
	$stmat_stena_total_koef = $stmat_stena_total_koef + $stmat_stena_room_koef*$row1['jm']*$row1['vuspot'];
	$strab_stena_total_koef = $strab_stena_total_koef + $strab_stena_room_koef*$row1['jm']*$row1['vuspot'];
	$stsopmat_stena_total_koef = $stsopmat_stena_total_koef + $stsopmat_stena_room_koef*$row1['jm']*$row1['vuspot'];

	$stmat_potpokr_total = $stmat_potpokr_total + $stmat_potpokr_room*$row1['metraj'];
	$strab_potpokr_total = $strab_potpokr_total + $strab_potpokr_room*$row1['metraj'];
	$stsopmat_potpokr_total = $stsopmat_potpokr_total + $stsopmat_potpokr_room*$row1['metraj'];
	$trud_potpokr_total = $trud_potpokr_total + $trud_potpokr_room;
	$stmat_potpokr_total_koef = $stmat_potpokr_total_koef + $stmat_potpokr_room_koef*$row1['metraj'];
	$strab_potpokr_total_koef = $strab_potpokr_total_koef + $strab_potpokr_room_koef*$row1['metraj'];
	$stsopmat_potpokr_total_koef = $stsopmat_potpokr_total_koef + $stsopmat_potpokr_room_koef*$row1['metraj'];
	
	$stmat_potobr_total = $stmat_potobr_total + $stmat_potobr_room*$row1['jm'];
	$strab_potobr_total = $strab_potobr_total + $strab_potobr_room*$row1['jm'];
	$stsopmat_potobr_total = $stsopmat_potobr_total + $stsopmat_potobr_room*$row1['jm'];
	$trud_potobr_total = $trud_potobr_total + $trud_potobr_room;
	$stmat_potobr_total_koef = $stmat_potobr_total_koef + $stmat_potobr_room_koef*$row1['jm'];
	$strab_potobr_total_koef = $strab_potobr_total_koef + $strab_potobr_room_koef*$row1['jm'];
	$stsopmat_potobr_total_koef = $stsopmat_potobr_total_koef + $stsopmat_potobr_room_koef*$row1['jm'];
		}
?>
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
        	<?php $stmat = $stmat_polpokr_total + $stmat_polobr_total + $stmat_stena_total + $stmat_potpokr_total + $stmat_potobr_total; echo round ($stmat, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php $stmat_koef = $stmat_polpokr_total_koef + $stmat_polobr_total_koef + $stmat_stena_total_koef + $stmat_potpokr_total_koef + $stmat_potobr_total_koef; echo round ($stmat_koef, 1);?>
        </td>
    </tr>
    
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Стоимость работ, &euro;
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php $strab = $strab_polpokr_total + $strab_polobr_total + $strab_stena_total + $strab_potpokr_total + $strab_potobr_total; echo round ($strab, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php $strab_koef = $strab_polpokr_total_koef + $strab_polobr_total_koef + $strab_stena_total_koef + $strab_potpokr_total_koef + $strab_potobr_total_koef; echo round ($strab_koef, 1);?>
        </td>
    </tr>
    
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Дополнительные расходы, &euro;
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php $stsopmat = $stsopmat_polpokr_total + $stsopmat_polobr_total + $stsopmat_stena_total + $stsopmat_potpokr_total + $stsopmat_potobr_total; echo round ($stsopmat, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php $stsopmat_koef = $stsopmat_polpokr_total_koef + $stsopmat_polobr_total_koef + $stsopmat_stena_total_koef + $stsopmat_potpokr_total_koef + $stsopmat_potobr_total_koef; echo round ($stsopmat_koef, 1);?>
        </td>
    </tr>
    
    
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Итого, &euro;
        </td>
        
        <td bgcolor="#FF6633" id="men1">
        	<?php $total = $stmat + $strab + $stsopmat; echo round ($total, 1);?>
        </td>
        
        <td bgcolor="#FF6633" id="men1">
        	<?php $total_koef = $stmat_koef + $strab_koef + $stsopmat_koef; echo round ($total_koef, 1);?>
        </td>
    </tr>
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Затраты труда, tth
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php $trud = $trud_polpokr_total + $trud_polobr_total + $trud_stena_total + $trud_potpokr_total + $trud_potobr_total; echo round ($trud, 0);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($trud, 0);?>
        </td>
    </tr>
</table>

		<?php }}?>
</body>
</html>