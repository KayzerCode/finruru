<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Краткий отчёт</title>


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
        
        <?php if (isset ($_GET['id']) AND !empty ($_GET['id']))



			{?>
            

<?php 
$_GET['id'] = htmlspecialchars ($_GET['id']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']);

        } else { 
            $id = addslashes($_GET['id']);

        } 
	$id = (int)$id;
				if ($id == '0') {die ("Invalid shablon!!!!");}


include ("bd.php"); // connection to database?>
<table cellspacing="5">
        	<tr>
            	<td>
<div align="left"><a href="calc_shab.php?id=<?php echo $id;?>" title="Назад"><?php include ("button_back.php");?></a></div>
				</td>
			</tr>
</table>
<?php // foto
if (file_exists ('img/images_shablons/' . $id . '.' . 'jpg'))
{
	?><div align="center"><img src="img/images_shablons/<?php echo $id . '.' . 'jpg';?>" /></div>
<?php }
$select_cat = mysql_query ("SELECT * FROM `categories` WHERE `id` = '1'") or die ("Not select categorie finishing");
$row_cat = mysql_fetch_array ($select_cat);

	?><table cellpadding="5">
	<?php 
// main table with components
$total_stmat_finishing = 0;
$total_strab_finishing = 0; 
$total_stsopmat_finishing = 0; 
$total_stmat_finishing_koef = 0; 
$total_strab_finishing_koef = 0; 
$total_stsopmat_finishing_koef = 0; 

$result = mysql_query("SELECT * FROM `rooms_shab` WHERE `id_shab` = $id", $link) or die ("Not select room");
while ($row = mysql_fetch_array($result))
		{

//Creation of a output table?>


<?php $result1 = mysql_query("SELECT * FROM `polpokr` WHERE `id_shab` = '$id' AND `id_room` = '$row[id]'", $link) or die ("Not select polpokr");

$total_stmat_polpokr = 0;
$total_strab_polpokr =0 ;
$total_stsopmat_polpokr = 0;
$total_stmat_polpokr_koef = 0;
$total_strab_polpokr_koef =0 ;
$total_stsopmat_polpokr_koef = 0;
while ($polpokr = mysql_fetch_array($result1)) {

$select = mysql_query ("SELECT * FROM `components_polpokr` WHERE `id_polpokr` = '$polpokr[id]' AND `id_shab` = '$id' AND `id_room` = '$row[id]'") or die ("Not select components");
$stmat = 0;
$strab = 0;
$stsopmat = 0;
while ($sel = mysql_fetch_array ($select))
	{
	$stmat = $stmat + $sel['stmat'];
	$strab = $strab + $sel['strab'];
	$stsopmat = $stsopmat + $sel['stsopmat'];
	}
$result2 = mysql_query("SELECT * FROM `rooms_shab` WHERE `id` = '$row[id]'") or die("Not select room");
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
            
         
<?php  }

$result2 = mysql_query("SELECT * FROM `polobr` WHERE `id_shab` = '$id' AND `id_room` = '$row[id]'", $link) or die ("Not select polobr");

$total_stmat_polobr = 0;
$total_strab_polobr = 0;
$total_stsopmat_polobr = 0;
$total_stmat_polobr_koef = 0;
$total_strab_polobr_koef = 0;
$total_stsopmat_polobr_koef = 0;
				while ($polobr = mysql_fetch_array($result2))
					{
					$select = mysql_query ("SELECT * FROM `components_polobr` WHERE `id_polobr` = '$polobr[id]' AND `id_shab` = '$id' AND `id_room` = '$row[id]'") or die ("Not select components");
$stmat_polobr = 0;
$strab_polobr = 0;
$stsopmat_polobr = 0;
while ($sel = mysql_fetch_array ($select))
	{
	$stmat_polobr = $stmat_polobr + $sel['stmat'];
	$strab_polobr = $strab_polobr + $sel['strab'];
	$stsopmat_polobr = $stsopmat_polobr + $sel['stsopmat'];
	}
$result3 = mysql_query("SELECT * FROM `rooms_shab` WHERE `id` = '$row[id]'") or die("Not select room");
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

<?php
		
				}
				

$result3 = mysql_query("SELECT * FROM `stena` WHERE `id_shab` = $id AND `id_room` = '$row[id]'", $link) or die ("Not select stena");

$total_stmat_stena = 0;
$total_strab_stena = 0;
$total_stsopmat_stena = 0;
$total_stmat_stena_koef = 0;
$total_strab_stena_koef = 0;
$total_stsopmat_stena_koef = 0;

					while ($stena = mysql_fetch_array($result3))
						{
						$select = mysql_query ("SELECT * FROM `components_stena` WHERE `id_stena` = '$stena[id]' AND `id_shab` = '$id' AND `id_room` = '$row[id]'") or die ("Not select components");
$stmat_stena = 0;
$strab_stena = 0;
$stsopmat_stena = 0;
while ($sel = mysql_fetch_array ($select))
	{
	$stmat_stena = $stmat_stena + $sel['stmat'];
	$strab_stena = $strab_stena + $sel['strab'];
	$stsopmat_stena = $stsopmat_stena + $sel['stsopmat'];
	}
$result4 = mysql_query("SELECT * FROM `rooms_shab` WHERE `id` = '$row[id]'") or die("Not select room");
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

<?php 
						
				}
$result4 = mysql_query("SELECT * FROM `potpokr` WHERE `id_shab` = $id AND `id_room` = '$row[id]'", $link) or die ("Not select potpokr");

$total_stmat_potpokr = 0;
$total_strab_potpokr = 0;
$total_stsopmat_potpokr = 0;
$total_stmat_potpokr_koef = 0;
$total_strab_potpokr_koef = 0;
$total_stsopmat_potpokr_koef = 0;
					while ($potpokr = mysql_fetch_array($result4))
					{
					$select = mysql_query ("SELECT * FROM `components_potpokr` WHERE `id_potpokr` = '$potpokr[id]' AND `id_shab` = '$id' AND `id_room` = '$row[id]'") or die ("Not select components");
$stmat_potpokr = 0;
$strab_potpokr = 0;
$stsopmat_potpokr = 0;
while ($sel = mysql_fetch_array ($select))
	{
	$stmat_potpokr = $stmat_potpokr + $sel['stmat'];
	$strab_potpokr = $strab_potpokr + $sel['strab'];
	$stsopmat_potpokr = $stsopmat_potpokr + $sel['stsopmat'];
	}
$resu2 = mysql_query("SELECT * FROM `rooms_shab` WHERE `id` = '$row[id]'") or die("Not select room");
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

<?php
					
				}

$result5 = mysql_query("SELECT * FROM `potobr` WHERE `id_shab` = $id AND `id_room` = '$row[id]'", $link) or die ("Not select potobr");

$total_stmat_potobr = 0;
$total_strab_potobr = 0;
$total_stsopmat_potobr = 0;
$total_stmat_potobr_koef = 0;
$total_strab_potobr_koef = 0;
$total_stsopmat_potobr_koef = 0;

					while ($potobr = mysql_fetch_array($result5))
					{
					$select = mysql_query ("SELECT * FROM `components_potobr` WHERE `id_potobr` = '$potobr[id]' AND `id_shab` = '$id' AND `id_room` = '$row[id]'") or die ("Not select components");
$stmat_potobr = 0;
$strab_potobr = 0;
$stsopmat_potobr = 0;
while ($sel = mysql_fetch_array ($select))
	{
	$stmat_potobr = $stmat_potobr + $sel['stmat'];
	$strab_potobr = $strab_potobr + $sel['strab'];
	$stsopmat_potobr = $stsopmat_potobr + $sel['stsopmat'];
	}
$resu3 = mysql_query("SELECT * FROM `rooms_shab` WHERE `id` = '$row[id]'") or die("Not select room");
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

<?php 
					
			}
			$select_room = mysql_query ("SELECT * FROM `rooms_shab` WHERE `id` = '$row[id]'") or die ("NOT select room");
			$sel_row = mysql_fetch_array ($select_room);?>


    	<?php $total_stmat_finish = round ($total_stmat_polpokr + $total_stmat_polobr + $total_stmat_stena + $total_stmat_potpokr + $total_stmat_potobr, 1);?>
    
   
    	<?php $total_strab_finish = round ($total_strab_polpokr + $total_strab_polobr + $total_strab_stena + $total_strab_potpokr + $total_strab_potobr, 1);?>
   
    	<?php $total_stsopmat_finish = round ($total_stsopmat_polpokr + $total_stsopmat_polobr + $total_stsopmat_stena + $total_stsopmat_potpokr + $total_stsopmat_potobr, 1);?>
    
    	<?php $total_stmat_finish_koef = round ($total_stmat_polpokr_koef + $total_stmat_polobr_koef + $total_stmat_stena_koef + $total_stmat_potpokr_koef + $total_stmat_potobr_koef, 1);?>
   
    	<?php $total_strab_finish_koef = round ($total_strab_polpokr_koef + $total_strab_polobr_koef + $total_strab_stena_koef + $total_strab_potpokr_koef + $total_strab_potobr_koef, 1); ?>
  
    	<?php $total_stsopmat_finish_koef = round ($total_stsopmat_polpokr_koef + $total_stsopmat_polobr_koef + $total_stsopmat_stena_koef + $total_stsopmat_potpokr_koef + $total_stsopmat_potobr_koef, 1); ?>
   


		<?php 
$total_stmat_finishing = $total_stmat_finishing + $total_stmat_finish;
$total_strab_finishing = $total_strab_finishing + $total_strab_finish; 
$total_stsopmat_finishing = $total_stsopmat_finishing + $total_stsopmat_finish; 
$total_stmat_finishing_koef = $total_stmat_finishing_koef + $total_stmat_finish_koef; 
$total_strab_finishing_koef = $total_strab_finishing_koef + $total_strab_finish_koef; 
$total_stsopmat_finishing_koef = $total_stsopmat_finishing_koef + $total_stsopmat_finish_koef; 
} 
		?>
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
        	<?php echo round ($total_stmat_finishing, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_stmat_finishing_koef, 1);?>
        </td>
    </tr>
    
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Стоимость работ, &euro;
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_strab_finishing, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_strab_finishing_koef, 1);?>
        </td>
    </tr>
    
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Дополнительные расходы, &euro;
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_stsopmat_finishing, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_stsopmat_finishing_koef, 1);?>
        </td>
    </tr>
    
    
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Итого, &euro;
        </td>
        
        <td bgcolor="#FF6633" id="men1">
        	<?php $total_finish = $total_stmat_finishing + $total_strab_finishing + $total_stsopmat_finishing; echo round ($total_finish, 1);?>
        </td>
        
        <td bgcolor="#FF6633" id="men1">
        	<?php $total_finish_koef = $total_stmat_finishing_koef + $total_strab_finishing_koef + $total_stsopmat_finishing_koef; echo round ($total_finish_koef, 1);?>
        </td>
    </tr>
    
</table><br />
<?php
	$select_other_cat = mysql_query ("SELECT * FROM `categories` WHERE `id` != '1'");
	$total_stmat_other = 0;
	$total_strab_other = 0;
	$total_stsopmat_other = 0;
	$total_stmat_other_koef = 0;
	$total_strab_other_koef = 0;
	$total_stsopmat_other_koef = 0;
	$total1 = 0;
							$total1_koef = 0;
							$total1 =0;
							$total2_koef = 0;
	while ($row_cat = mysql_fetch_array ($select_other_cat))
		{
				?><?php 
$select_group = mysql_query ("SELECT * FROM `handbook_groups` WHERE `id_cat` = '$row_cat[id]'") or die ("Not select group");
							$total_stmat = 0;
							$total_strab = 0;
							$total_stsopmat = 0;
							$total_trud = 0;
							$total_stmat_koef = 0;
							$total_strab_koef = 0;
							$total_stsopmat_koef = 0;
							
while ($row_group = mysql_fetch_array ($select_group))
	{
		?>
        <?php $select_elements = mysql_query ("SELECT * FROM `shab_elements` WHERE `group` = '$row_group[id]' AND `id_shab` = '$id'") or die ("Not select elements");
						?>
                        
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
                                    
                        	
                           <?php $total_stmat_elem = $stmat*$row_elem['quantity'];?>
                           <?php $total_strab_elem = $strab*$row_elem['quantity'];?>
                           <?php $total_stsopmat_elem = $stsopmat*$row_elem['quantity'];?>
                           <?php $total_elem = $total_stmat_elem + $total_strab_elem + $total_stsopmat_elem;?>
                           <?php $total_elem_koef = ($total_stmat_elem + $total_strab_elem + $total_stsopmat_elem)*$row_elem['koef'];
							?>
                                    
                                    <?php
							$total_el_stmat = $total_el_stmat + $total_stmat_elem;
							$total_el_strab = $total_el_strab + $total_strab_elem;
							$total_el_stsopmat = $total_el_stsopmat + $total_stsopmat_elem;
							$total_el_trud = $total_el_trud + $trud;
							$total_el_stmat_koef = $total_el_stmat_koef + $total_stmat_elem*$row_elem['koef'];
							$total_el_strab_koef = $total_el_strab_koef + $total_strab_elem*$row_elem['koef'];
							$total_el_stsopmat_koef = $total_el_stsopmat_koef + $total_stsopmat_elem*$row_elem['koef'];
								
								}?>

                           <?php $total_el = $total_el_stmat + $total_el_strab + $total_el_stsopmat;?>
                            <?php $total_el_koef = $total_el_stmat_koef + $total_el_strab_koef + $total_el_stsopmat_koef;?>
                        <?php
							$total_stmat = $total_stmat + $total_el_stmat;
							$total_strab = $total_strab + $total_el_strab;
							$total_stsopmat = $total_stsopmat + $total_el_stsopmat;
							$total_trud = $total_trud + $total_el_trud;
							$total_stmat_koef = $total_stmat_koef + $total_el_stmat_koef;
							$total_strab_koef = $total_strab_koef + $total_el_strab_koef;
							$total_stsopmat_koef = $total_stsopmat_koef + $total_el_stsopmat_koef;

						}
		?>
		<?php
								
								 ?>
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
        	Стоимость материала, &euro;
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
    
</table><?php 
	$total_stmat_other = $total_stmat_other + $total_stmat;
	$total_strab_other = $total_strab_other + $total_strab;
	$total_stsopmat_other = $total_stsopmat_other + $total_stsopmat;
	$total_stmat_other_koef = $total_stmat_other_koef + $total_stmat_koef;
	$total_strab_other_koef = $total_strab_other_koef + $total_strab_koef;
	$total_stsopmat_other_koef = $total_stsopmat_other_koef + $total_stsopmat_koef;
	 	if ($row_cat['id'] == '2' OR $row_cat['id'] == '3' OR $row_cat['id'] == '4' OR $row_cat['id'] == '5' OR $row_cat['id'] == '6')
	{
		$total1 = $total1 + $total_stmat + $total_strab + $total_stsopmat;
			$total1_koef = $total1_koef + $total_stmat_koef + $total_strab_koef + $total_stsopmat_koef;
	}

		} 
?><hr width="80%" size="3" color="#000000" />
<hr width="80%" size="3" color="#000000" />
<div align="center"><font size="+2"><strong>Итоговые подсчёты</strong></font></div>
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
        	каркас + фундамент + крыша + окна + внутренние и внешние двери, &euro;
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total1, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total1_koef, 1);?>
        </td>
    </tr>
    
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	 отделка + каркас + фундамент + крыша + окна + внутренние и внешние двери, &euro;
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total1 + $total_finish, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total1_koef + $total_finish_koef, 1);?>
        </td>
    </tr>
    
    <tr>	
    	<td bgcolor="#FF6633" id="men1">
        	Стоимость материала по дому, &euro;
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_stmat_other + $total_stmat_finishing, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_stmat_other_koef + $total_stmat_finishing_koef, 1);?>
        </td>
    </tr>
    
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Стоимость работ по дому, &euro;
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_strab_other + $total_strab_finishing, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_strab_other_koef + $total_strab_finishing_koef, 1);?>
        </td>
    </tr>
    
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Дополнительные расходы по дому, &euro;
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_stsopmat_other + $total_stsopmat_finishing, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php echo round ($total_stsopmat_other_koef + $total_stsopmat_finishing_koef, 1);?>
        </td>
    </tr>
    
    
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Итого по дому, &euro;
        </td>
        
        <td bgcolor="#FF6633" id="men1">
        	<?php $total_other = $total_stmat_other + $total_strab_other + $total_stsopmat_other; echo round ($total_other + $total_finish, 1);?>
        </td>
        
        <td bgcolor="#FF6633" id="men1">
        	<?php $total_other_koef = $total_stmat_other_koef + $total_strab_other_koef + $total_stsopmat_other_koef; echo round ($total_other_koef + $total_finish_koef, 1);?>
        </td>
    </tr>
<?php $select_area = mysql_query ("SELECT * FROM `areas` WHERE `id_shab` = '$id'");
if (mysql_num_rows ($select_area) == '1') {$row_area = mysql_fetch_array ($select_area);
$area = $row_area['value'];
	if ($area <= '0') {echo "Площадь равна 0!!!";} else {?>
    <tr>
    	<td bgcolor="#FF6633" id="men1">
        	Стоимость квадратного метра, &euro;
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php $meter = ($total_other + $total_finish)/$area; echo round ($meter, 1);?>
        </td>
        
        <td bgcolor="#CC9999" id="men1">
        	<?php $meter_koef = ($total_other_koef + $total_finish_koef)/$area; echo round ($meter_koef, 1);?>
        </td>
    </tr><?php } }?>
    
</table>
		<?php }?>

        </td>
     </tr>
<!--Footer-->
	<tr>
        <td colspan="2" align="center" bgcolor="#E1E1E1" height="35" valign="middle"><?php include ("footer.php"); ?></td>
  </tr>
</table>

</body>
</html>
