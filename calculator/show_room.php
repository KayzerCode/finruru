<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Расчёт отделки</title>

</head>

<body>
<?php if (isset ($_GET['show_room']) AND !empty ($_GET['show_room']) AND $_GET['cat'] === 'otd')



			{?>
            

<?php 
$_GET['id'] = htmlspecialchars ($_GET['id']);
$_GET['cat'] = htmlspecialchars ($_GET['cat']);
$_GET['show_room'] = htmlspecialchars ($_GET['show_room']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']);
			            $cat = stripslashes($_GET['cat']); 
            $show_room = stripslashes($_GET['show_room']);

        } else { 
            $id = addslashes($_GET['id']);
			            $cat = addslashes($_GET['cat']); 
            $show_room = addslashes($_GET['show_room']);

        } 
	$id = (int)$id;
				if ($id == '0') {die ("Invalid shablon!!!!");}


include ("bd.php"); // connection to database?>

<?php // main table with components 
$result = mysql_query("SELECT * FROM `rooms_shab` WHERE `id` = $show_room", $link) or die ("Not select room");
$row = mysql_fetch_array($result);






//Creation of a output table?>
<div align="center"><font size="+2"><em>Комната</em></font>&nbsp;&nbsp;<font size="+2" color="#9933FF"><em><?php echo $row['name'];?></em></font></div>
<table border="0" cellpadding="5" cellspacing="10" align="center" frame="void" bordercolor="#000000">
    

<tr bgcolor="#9999CC">
	<td bgcolor="#F1F1F1"></td>
    
    <td id="men1">
    	Наименование
    </td>
    
    <td id="men1">
    	Материал
    </td>
    
    <td id="men1">
    	Стоимость материала, &euro;
    </td>
    
    <td id="men1">
    	Стоимость работы, &euro;
    </td>
    
    <td id="men1">
    	Доп. расходы, &euro;
    </td>
    
    <td id="men1">
    	Коэффициент
    </td>
    
    <td id="men1">
    	Итого /без коэф./
    </td>
    
    <td id="men1">
    	Итого /с коэф./
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
    	Убрать
    </td>
    
</tr>

<tr>
	<td>
    </td>
    
    <td id="comp" colspan="12" bgcolor="#CCFFCC">
    	<div align="center"><?php echo $row['name'];?>&nbsp;&nbsp;Метраж&nbsp;&nbsp;<?php echo $row['metraj'];?>&nbsp;м&sup2;&nbsp;/&nbsp;&nbsp;Высота потолка&nbsp;&nbsp;<?php echo $row['vuspot'];?>&nbsp;м&nbsp;/&nbsp;&nbsp;Периметр&nbsp;&nbsp;<?php echo $row['jm'];?>&nbsp;м</div>
    </td>
</tr>

<?php $result1 = mysql_query("SELECT * FROM `polpokr` WHERE `id_shab` = $id AND `id_room` = $show_room", $link) or die ("Not select polpokr");
if (mysql_num_rows ($result1) < '1')
	{?>
    <tr bgcolor="#9999CC">
	<td id="men1" bgcolor="#F1F1F1">
    	<a href="add_polpokr.php?id_shab=<?php echo $id;?>&amp;id_room=<?php echo $show_room;?>"><?php include ("button_add.php");?></a>
    </td>
    
    <td id="men1">
    	Отделка пола
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	-
    </td>
    
    <td id="men1">
    	-
    </td>
     
    <td id="men1">
    	
    </td>
    
</tr> <?php }
			elseif (mysql_num_rows($result1) >= '1')
				{
$total_stmat_polpokr = 0;
$total_strab_polpokr =0 ;
$total_stsopmat_polpokr = 0;
$total_stmat_polpokr_koef = 0;
$total_strab_polpokr_koef =0 ;
$total_stsopmat_polpokr_koef = 0;
while ($polpokr = mysql_fetch_array($result1)) {

$select = mysql_query ("SELECT * FROM `components_polpokr` WHERE `id_polpokr` = '$polpokr[id]' AND `id_shab` = '$id' AND `id_room` = '$show_room'") or die ("Not select components");
$stmat = 0;
$strab = 0;
$stsopmat = 0;
while ($sel = mysql_fetch_array ($select))
	{
	$stmat = $stmat + $sel['stmat'];
	$strab = $strab + $sel['strab'];
	$stsopmat = $stsopmat + $sel['stsopmat'];
	}
$result2 = mysql_query("SELECT * FROM `rooms_shab` WHERE `id` = '$show_room'") or die("Not select room");
$room = mysql_fetch_array($result2);
$stmat1 = $stmat*$polpokr['metraj'];
$strab1 = $strab*$polpokr['metraj'];
$stsopmat1 = $stsopmat*$polpokr['metraj'];
$total_stmat_polpokr = $total_stmat_polpokr + $stmat1;
$total_strab_polpokr = $total_strab_polpokr + $strab1 ;
$total_stsopmat_polpokr = $total_stsopmat_polpokr + $stsopmat1;
$total_stmat_polpokr_koef = $total_stmat_polpokr_koef + $stmat1*$polpokr['koef'];
$total_strab_polpokr_koef = $total_strab_polpokr_koef + $strab1*$polpokr['koef'];
$total_stsopmat_polpokr_koef = $total_stsopmat_polpokr_koef + $stsopmat1*$polpokr['koef'];
?>
            
            <tr bgcolor="#9999CC">
	<td id="men1" bgcolor="#F1F1F1">
    	<a href="add_polpokr.php?id_shab=<?php echo $id;?>&amp;id_room=<?php echo $show_room;?>" title="Добавить отделку пола"><?php include ("button_add.php");?></a>
    </td>
    
    <td id="men1">
    	Отделка пола
    </td>
    
    <td id="men1">
    	<a href="show_polpokr.php?id=<?php echo $polpokr['id_shab'];?>&amp;id_room=<?php echo $show_room;?>&amp;id_polpokr=<?php echo $polpokr['id']?>" title="Смотреть и редактировать элемент отделки пола"><?php echo $polpokr['name'];?></a>
    </td>
    
    <td id="men1">
    	<?php echo round ($stmat1, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($strab1, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($stsopmat1, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($polpokr['koef'], 2);?>
    </td>
    
    <td id="men1">
    	<?php echo round (($stmat1 + $strab1 + $stsopmat1), 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round (($stmat1 + $strab1 + $stsopmat1)*$polpokr['koef'], 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($polpokr['metraj'], 2);?>
    </td>
    
    <td id="men1">
    	-
    </td>
    
    <td id="men1">
    	-
    </td>
     
    <td id="men1">
    	<a href="erase_finishing.php?id=<?php echo $polpokr['id'];?>&amp;id_shab=<?php echo $id;?>&amp;id_room=<?php echo $show_room;?>" title="Убрать этот вид отделки">Убрать</a>
    </td>
    
</tr>
<?php } }

$result2 = mysql_query("SELECT * FROM `polobr` WHERE `id_shab` = '$id' AND `id_room` = '$show_room'", $link) or die ("Not select polobr");
if (mysql_num_rows ($result2) < '1')
		{?>

<tr bgcolor="#9999CC">
	<td id="men1" bgcolor="#F1F1F1">
    	<a href="add_polobr.php?id_shab=<?php echo $id;?>&amp;id_room=<?php echo $show_room;?>" title="Добавить материал обрамления пола"><?php include ("button_add.php");?></a>
    </td>
    
    <td id="men1">
    	Обрамление пола
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    </td>
    
    <td id="men1">

    </td>
    
    <td id="men1">
    	-
    </td>
    
    <td id="men1">
    	-
    </td>
    
    <td id="men1">
    	
    </td>
     
    <td id="men1">
    	
    </td>
    
</tr>
	<?php }	elseif (mysql_num_rows ($result2) >= '1')
				{ 
$total_stmat_polobr = 0;
$total_strab_polobr = 0;
$total_stsopmat_polobr = 0;
$total_stmat_polobr_koef = 0;
$total_strab_polobr_koef = 0;
$total_stsopmat_polobr_koef = 0;
				while ($polobr = mysql_fetch_array($result2))
					{
					$select = mysql_query ("SELECT * FROM `components_polobr` WHERE `id_polobr` = '$polobr[id]' AND `id_shab` = '$id' AND `id_room` = '$show_room'") or die ("Not select components");
$stmat_polobr = 0;
$strab_polobr = 0;
$stsopmat_polobr = 0;
while ($sel = mysql_fetch_array ($select))
	{
	$stmat_polobr = $stmat_polobr + $sel['stmat'];
	$strab_polobr = $strab_polobr + $sel['strab'];
	$stsopmat_polobr = $stsopmat_polobr + $sel['stsopmat'];
	}
$result3 = mysql_query("SELECT * FROM `rooms_shab` WHERE `id` = '$show_room'") or die("Not select room");
$room3 = mysql_fetch_array($result3);
$stmat_polobr_total = $stmat_polobr*$polobr['jm'];
$strab_polobr_total = $strab_polobr*$polobr['jm'];
$stsopmat_polobr_total = $stsopmat_polobr*$polobr['jm'];
$total_stmat_polobr = $total_stmat_polobr + $stmat_polobr_total;
$total_strab_polobr = $total_strab_polobr + $strab_polobr_total ;
$total_stsopmat_polobr = $total_stsopmat_polobr + $stsopmat_polobr_total;
$total_stmat_polobr_koef = $total_stmat_polobr_koef + $stmat_polobr_total*$polobr['koef'];
$total_strab_polobr_koef = $total_strab_polobr_koef + $strab_polobr_total*$polobr['koef'];
$total_stsopmat_polobr_koef = $total_stsopmat_polobr_koef + $stsopmat_polobr_total*$polobr['koef'];

?>
<tr bgcolor="#9999CC">
	<td id="men1" bgcolor="#F1F1F1">
    	<a href="add_polobr.php?id_shab=<?php echo $id;?>&amp;id_room=<?php echo $show_room;?>" title="Добавить материал обрамления пола"><?php include ("button_add.php");?></a>
    </td>
    
    <td id="men1">
    	Обрамление пола
    </td>
    
    <td id="men1">
    	<a href="show_polobr.php?id=<?php echo $polobr['id_shab'];?>&amp;id_room=<?php echo $show_room;?>&amp;id_polobr=<?php echo $polobr['id'];?>" title="Смотреть и редактировать элемент обрамления пола"><?php echo $polobr['name'];?></a>
    </td>
    
    <td id="men1">
    	<?php echo round ($stmat_polobr_total, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($strab_polobr_total, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($stsopmat_polobr_total, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($polobr['koef'], 2);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($stmat_polobr_total + $strab_polobr_total + $stsopmat_polobr_total, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round (($stmat_polobr_total + $strab_polobr_total + $stsopmat_polobr_total)*$polobr['koef'], 1);?>
    </td>
    
    <td id="men1">
    	-
    </td>
    
    <td id="men1">
    	-
    </td>
    
    <td id="men1">
    	<?php echo round ($polobr['jm'], 2);?>
    </td>
     
    <td id="men1">
    	<a href="erase_finishing1.php?id=<?php echo $polobr['id'];?>&amp;id_shab=<?php echo $id;?>&amp;id_room=<?php echo $show_room;?>" title="Убрать этот вид отделки">Убрать</a>
    </td>
    
</tr>
<?php
					}
				}
				

$result3 = mysql_query("SELECT * FROM `stena` WHERE `id_shab` = $id AND `id_room` = $show_room", $link) or die ("Not select stena");
if (mysql_num_rows ($result3) < '1')
	{
?>
		

<tr bgcolor="#9999CC">
	<td id="men1" bgcolor="#F1F1F1">
    	<a href="add_stena.php?id_shab=<?php echo $id;?>&amp;id_room=<?php echo $show_room;?>" title="Добавить материал отделки стен"><?php include ("button_add.php");?></a>
    </td>
    
    <td id="men1">
    	Стены
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	-
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
     
    <td id="men1">
    	
    </td>
    
</tr>
<?php }		elseif (mysql_num_rows ($result3) >= '1')
				{
$total_stmat_stena = 0;
$total_strab_stena = 0;
$total_stsopmat_stena = 0;
$total_stmat_stena_koef = 0;
$total_strab_stena_koef = 0;
$total_stsopmat_stena_koef = 0;

					while ($stena = mysql_fetch_array($result3))
						{
						$select = mysql_query ("SELECT * FROM `components_stena` WHERE `id_stena` = '$stena[id]' AND `id_shab` = '$id' AND `id_room` = '$show_room'") or die ("Not select components");
$stmat_stena = 0;
$strab_stena = 0;
$stsopmat_stena = 0;
while ($sel = mysql_fetch_array ($select))
	{
	$stmat_stena = $stmat_stena + $sel['stmat'];
	$strab_stena = $strab_stena + $sel['strab'];
	$stsopmat_stena = $stsopmat_stena + $sel['stsopmat'];
	}
$result4 = mysql_query("SELECT * FROM `rooms_shab` WHERE `id` = '$show_room'") or die("Not select room");
$room4 = mysql_fetch_array($result4);
$stmat_stena_total = $stmat_stena*$stena['jm']*$stena['vuspot'];
$strab_stena_total = $strab_stena*$stena['jm']*$stena['vuspot'];
$stsopmat_stena_total = $stsopmat_stena*$stena['jm']*$stena['vuspot'];
$total_stmat_stena = $total_stmat_stena + $stmat_stena_total;
$total_strab_stena = $total_strab_stena + $strab_stena_total ;
$total_stsopmat_stena = $total_stsopmat_stena + $stsopmat_stena_total;
$total_stmat_stena_koef = $total_stmat_stena_koef + $stmat_stena_total*$stena['koef'];
$total_strab_stena_koef = $total_strab_stena_koef + $strab_stena_total*$stena['koef'];
$total_stsopmat_stena_koef = $total_stsopmat_stena_koef + $stsopmat_stena_total*$stena['koef'];

?>
<tr bgcolor="#9999CC">
	<td id="men1" bgcolor="#F1F1F1">
    	<a href="add_stena.php?id_shab=<?php echo $id;?>&amp;id_room=<?php echo $show_room;?>" title="Добавить материал отделки стен"><?php include ("button_add.php");?></a>
    </td>
    
    <td id="men1">
    	Стены
    </td>
    
    <td id="men1">
    	<a href="show_stena.php?id=<?php echo $stena['id_shab'];?>&amp;id_room=<?php echo $show_room;?>&amp;id_stena=<?php echo $stena['id'];?>" title="Смотреть и редактировать элемент отделки стен"><?php echo $stena['name'];?></a>
    </td>
    
    <td id="men1">
    	<?php echo round ($stmat_stena_total, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($strab_stena_total, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($stsopmat_stena_total, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($stena['koef'], 2);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($stmat_stena_total + $strab_stena_total + $stsopmat_stena_total, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round (($stmat_stena_total + $strab_stena_total + $stsopmat_stena_total)*$stena['koef'], 1);?>
    </td>
    
    <td id="men1">
    	-
    </td>
    
    <td id="men1">
    	<?php echo round ($stena['vuspot'], 2);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($stena['jm'], 2);?>
    </td>
     
    <td id="men1">
    	<a href="erase_finishing2.php?id=<?php echo $stena['id'];?>&amp;id_shab=<?php echo $id;?>&amp;id_room=<?php echo $show_room;?>" title="Убрать этот вид отделки">Убрать</a>
    </td>
    
</tr>
<?php 
						}
				}
$result4 = mysql_query("SELECT * FROM `potpokr` WHERE `id_shab` = $id AND `id_room` = $show_room", $link) or die ("Not select potpokr");
if (mysql_num_rows ($result4) < '1')
	{
?>

<tr bgcolor="#9999CC">
	<td id="men1" bgcolor="#F1F1F1">
    	<a href="add_potpokr.php?id_shab=<?php echo $id;?>&amp;id_room=<?php echo $show_room;?>" title="Добавить материал отделки потолка"><?php include ("button_add.php");?></a>
    </td>
    
    <td id="men1">
    	Отделка потолка
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	-
    </td>
    
    <td id="men1">
    	-
    </td>
     
    <td id="men1">
    	
    </td>
    
</tr>
<?php } elseif (mysql_num_rows ($result4) >= '1')
				{
$total_stmat_potpokr = 0;
$total_strab_potpokr = 0;
$total_stsopmat_potpokr = 0;
$total_stmat_potpokr_koef = 0;
$total_strab_potpokr_koef = 0;
$total_stsopmat_potpokr_koef = 0;
					while ($potpokr = mysql_fetch_array($result4))
					{
					$select = mysql_query ("SELECT * FROM `components_potpokr` WHERE `id_potpokr` = '$potpokr[id]' AND `id_shab` = '$id' AND `id_room` = '$show_room'") or die ("Not select components");
$stmat_potpokr = 0;
$strab_potpokr = 0;
$stsopmat_potpokr = 0;
while ($sel = mysql_fetch_array ($select))
	{
	$stmat_potpokr = $stmat_potpokr + $sel['stmat'];
	$strab_potpokr = $strab_potpokr + $sel['strab'];
	$stsopmat_potpokr = $stsopmat_potpokr + $sel['stsopmat'];
	}
$resu2 = mysql_query("SELECT * FROM `rooms_shab` WHERE `id` = '$show_room'") or die("Not select room");
$room5 = mysql_fetch_array($resu2);
$stmat_potpokr_total = $stmat_potpokr*$potpokr['metraj'];
$strab_potpokr_total = $strab_potpokr*$potpokr['metraj'];
$stsopmat_potpokr_total = $stsopmat_potpokr*$potpokr['metraj'];
$total_stmat_potpokr = $total_stmat_potpokr + $stmat_potpokr_total;
$total_strab_potpokr = $total_strab_potpokr + $strab_potpokr_total;
$total_stsopmat_potpokr = $total_stsopmat_potpokr + $stsopmat_potpokr_total;
$total_stmat_potpokr_koef = $total_stmat_potpokr_koef + $stmat_potpokr_total*$potpokr['koef'];
$total_strab_potpokr_koef = $total_strab_potpokr_koef + $strab_potpokr_total*$potpokr['koef'];
$total_stsopmat_potpokr_koef = $total_stsopmat_potpokr_koef + $stsopmat_potpokr_total*$potpokr['koef'];

?>
<tr bgcolor="#9999CC">
	<td id="men1" bgcolor="#F1F1F1">
    	<a href="add_potpokr.php?id_shab=<?php echo $id;?>&amp;id_room=<?php echo $show_room;?>" title="Добавить материал отделки потолка"><?php include ("button_add.php");?></a>
    </td>
    
    <td id="men1">
    	Отделка потолка
    </td>
    
    <td id="men1">
    	<a href="show_potpokr.php?id=<?php echo $potpokr['id_shab'];?>&amp;id_room=<?php echo $show_room;?>&amp;id_potpokr=<?php echo $potpokr['id']?>" title="Смотреть и редактировать элемент отделки пола"><?php echo $potpokr['name'];?></a>
    </td>
    
    <td id="men1">
    	<?php echo round ($stmat_potpokr_total, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($strab_potpokr_total, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($stsopmat_potpokr_total, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($potpokr['koef'], 2);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($stmat_potpokr_total + $strab_potpokr_total + $stsopmat_potpokr_total, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round (($stmat_potpokr_total + $strab_potpokr_total + $stsopmat_potpokr_total)*$potpokr['koef'], 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($potpokr['metraj'], 2);?>
    </td>
    
    <td id="men1">
    	-
    </td>
    
    <td id="men1">
    	-
    </td>
     
    <td id="men1">
    	<a href="erase_finishing3.php?id=<?php echo $potpokr['id'];?>&amp;id_shab=<?php echo $id;?>&amp;id_room=<?php echo $show_room;?>" title="Убрать этот вид отделки">Убрать</a>
    </td>
    
</tr>
<?php
					}
				}

$result5 = mysql_query("SELECT * FROM `potobr` WHERE `id_shab` = $id AND `id_room` = $show_room", $link) or die ("Not select potobr");
if (mysql_num_rows ($result5) < '1')
			{?>


<tr bgcolor="#9999CC">
	<td id="men1" bgcolor="#F1F1F1">
    	<a href="add_potobr.php?id_shab=<?php echo $id;?>&amp;id_room=<?php echo $show_room;?>" title="Добавить материал обрамления потолка"><?php include ("button_add.php");?></a>
    </td>
    
    <td id="men1">
    	Обрамление потолка
    </td>
    
    <td id="men1">
    
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	
    </td>
    
    <td id="men1">
    	-
    </td>
    
    <td id="men1">
    	-
    </td>
    
    <td id="men1">
    	
    </td>
     
    <td id="men1">
    	
    </td>
    
</tr>

<?php } elseif (mysql_num_rows ($result5) >= '1')
				{
$total_stmat_potobr = 0;
$total_strab_potobr = 0;
$total_stsopmat_potobr = 0;
$total_stmat_potobr_koef = 0;
$total_strab_potobr_koef = 0;
$total_stsopmat_potobr_koef = 0;

					while ($potobr = mysql_fetch_array($result5))
					{
					$select = mysql_query ("SELECT * FROM `components_potobr` WHERE `id_potobr` = '$potobr[id]' AND `id_shab` = '$id' AND `id_room` = '$show_room'") or die ("Not select components");
$stmat_potobr = 0;
$strab_potobr = 0;
$stsopmat_potobr = 0;
while ($sel = mysql_fetch_array ($select))
	{
	$stmat_potobr = $stmat_potobr + $sel['stmat'];
	$strab_potobr = $strab_potobr + $sel['strab'];
	$stsopmat_potobr = $stsopmat_potobr + $sel['stsopmat'];
	}
$resu3 = mysql_query("SELECT * FROM `rooms_shab` WHERE `id` = '$show_room'") or die("Not select room");
$room8 = mysql_fetch_array($resu3);
$stmat_potobr_total = $stmat_potobr*$potobr['jm'];
$strab_potobr_total = $strab_potobr*$potobr['jm'];
$stsopmat_potobr_total = $stsopmat_potobr*$potobr['jm'];
$total_stmat_potobr = $total_stmat_potoobr + $stmat_potobr_total;
$total_strab_potobr = $total_strab_potobr + $strab_potobr_total;
$total_stsopmat_potobr = $total_stsopmat_potobr + $stsopmat_potobr_total;
$total_stmat_potobr_koef = $total_stmat_potoobr_koef + $stmat_potobr_total*$potobr['koef'];
$total_strab_potobr_koef = $total_strab_potobr_koef + $strab_potobr_total*$potobr['koef'];
$total_stsopmat_potobr_koef = $total_stsopmat_potobr_koef + $stsopmat_potobr_total*$potobr['koef'];

?>
<tr bgcolor="#9999CC">
	<td id="men1" bgcolor="#F1F1F1">
    	<a href="add_potobr.php?id_shab=<?php echo $id;?>&amp;id_room=<?php echo $show_room;?>" title="Добавить материал обрамления потолка"><?php include ("button_add.php");?></a>
    </td>
    
    <td id="men1">
    	Обрамление потолка
    </td>
    
    <td id="men1">
    	<a href="show_potobr.php?id=<?php echo $potobr['id_shab'];?>&amp;id_room=<?php echo $show_room;?>&amp;id_potobr=<?php echo $potobr['id'];?>" title="Смотреть и редактировать элемент обрамления потолка"><?php echo $potobr['name'];?></a>
    </td>
    
    <td id="men1">
    	<?php echo round ($stmat_potobr_total, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($strab_potobr_total, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($stsopmat_potobr_total, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($potobr['koef'], 2);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($stmat_potobr_total + $strab_potobr_total + $stsopmat_potobr_total, 2);?>
    </td>
    
    <td id="men1">
    	<?php echo round (($stmat_potobr_total + $strab_potobr_total + $stsopmat_potobr_total)*$potobr['koef'], 2);?>
    </td>
    
    <td id="men1">
    	-
    </td>
    
    <td id="men1">
    	-
    </td>
    
    <td id="men1">
    	<?php echo round ($potobr['jm'], 2);?>
    </td>
     
    <td id="men1">
    	<a href="erase_finishing4.php?id=<?php echo $potobr['id'];?>&amp;id_shab=<?php echo $id;?>&amp;id_room=<?php echo $show_room;?>" title="Убрать этот вид отделки">Убрать</a>
    </td>
    
</tr>
<?php 
					}
			}
			$select_room = mysql_query ("SELECT * FROM `rooms_shab` WHERE `id` = '$show_room'") or die ("NOT select room");
			$sel_row = mysql_fetch_array ($select_room);?>
<tr bgcolor="#F1F1F1">
	<td colspan="13">
    	<hr size="2" color="#000000" />
    </td>
</tr>
<tr bgcolor="#FF6633">
	<td id="men1" colspan="3">
    	Итого /без коэффициента/
    </td>
    
    <td id="men1">
    	<?php echo round ($total_stmat_polpokr + $total_stmat_polobr + $total_stmat_stena + $total_stmat_potpokr + $total_stmat_potobr, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($total_strab_polpokr + $total_strab_polobr + $total_strab_stena + $total_strab_potpokr + $total_strab_potobr, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($total_stsopmat_polpokr + $total_stsopmat_polobr + $total_stsopmat_stena + $total_stsopmat_potpokr + $total_stsopmat_potobr, 1);?>
    </td>
    
    <td id="men1" rowspan="2">
    	-
    </td>
    
    <td id="men1">
    	<?php echo round ($total_stmat_polpokr + $total_stmat_polobr + $total_stmat_stena + $total_stmat_potpokr + $total_stmat_potobr + $total_strab_polpokr + $total_strab_polobr + $total_strab_stena + $total_strab_potpokr + $total_strab_potobr + $total_stsopmat_polpokr + $total_stsopmat_polobr + $total_stsopmat_stena + $total_stsopmat_potpokr + $total_stsopmat_potobr, 1);?>
    </td>
    
    <td id="men1">
    	-
    </td>
    
    <td id="men1" rowspan="2">
    	-
    </td>
    
    <td id="men1" rowspan="2">
    	-
    </td>
    
    <td id="men1" rowspan="2">
    	-
    </td>
     
    <td id="men1" rowspan="2">
    	-
    </td>
    
</tr>

<tr bgcolor="#FF6633">
	<td id="men1" colspan="3">
    	Итого /с коэффициентом/
    </td>
    
    <td id="men1">
    	<?php echo round ($total_stmat_polpokr_koef + $total_stmat_polobr_koef + $total_stmat_stena_koef + $total_stmat_potpokr_koef + $total_stmat_potobr_koef, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($total_strab_polpokr_koef + $total_strab_polobr_koef + $total_strab_stena_koef + $total_strab_potpokr_koef + $total_strab_potobr_koef, 1);?>
    </td>
    
    <td id="men1">
    	<?php echo round ($total_stsopmat_polpokr_koef + $total_stsopmat_polobr_koef + $total_stsopmat_stena_koef + $total_stsopmat_potpokr_koef + $total_stsopmat_potobr_koef, 1);?>
    </td>
    
    <td id="men1">
    	-
    </td>
    
    
    <td id="men1">
    	<?php echo round ($total_stmat_polpokr_koef + $total_stmat_polobr_koef + $total_stmat_stena_koef + $total_stmat_potpokr_koef + $total_stmat_potobr_koef + $total_strab_polpokr_koef + $total_strab_polobr_koef + $total_strab_stena_koef + $total_strab_potpokr_koef + $total_strab_potobr_koef + $total_stsopmat_polpokr_koef + $total_stsopmat_polobr_koef + $total_stsopmat_stena_koef + $total_stsopmat_potpokr_koef + $total_stsopmat_potobr_koef, 1);?>
    </td>
    
    
     
    <td id="men1" bgcolor="#F1F1F1">
    	
    </td>
    
</tr>   
</table><br>


		<?php }?>
</body>
</html>