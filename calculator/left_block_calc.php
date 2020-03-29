<?php if (isset ($_GET['id']) AND !empty ($_GET['id']))

			{
            
$_GET['id'] = htmlspecialchars ($_GET['id']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']); 

        } else { 
            $id = addslashes($_GET['id']); 

        } 
        $id = (int)$id;
			if ($id == '0') {header("Location: handbook.php?group=1");}?>

<table cellspacing="5">
        	<tr>
            	<td>
<div align="left"><a href="calculation.php" title="К списку всех рассчитанных домов"><?php include ("button_back.php");?></a></div>
				</td>
			</tr>
</table>
<br /><div align="center"><font size="+1" color="#000000"><strong><a href="area.php?id=<?php echo $id;?>" title="Задание площади дома">Площадь дома</a></strong></font></div>
<hr />
<div align="center"><font color="#000000" size="+1"><em>Категории:</em></font></div>

<?php include ("bd.php"); // connection to database 
//Creation of a output table?>
<table border="0" cellpadding="0" cellspacing="0" width="300" align="center" rules="none" id="table" bordercolor="#000000">

<?php 
$result = mysql_query("SELECT * FROM `categories` ORDER BY `id`");
while ($row = mysql_fetch_array($result))

{

			?><tr>
            	<td>
             			<table align="center" border="0" id="table" bordercolor="#000000" width="300" cellspacing="5" cellpadding="10">
                        <tr>
             			<td id="td" align="center" bgcolor="#CCFFCC"><font size="+1" color="#000000"><strong><a href="calc_shab.php?id=<?php echo $id;?>&amp;cat=<?php echo $row['fix'];?>" title="Категория <?php echo $row['name'];?>"><?php echo $row['name'];?></a></strong></font>
                        </td>
                        </tr>
                        </table>
                       
             
             	</td>
              </tr>


<?php } 

									{?>
                                    
									<?php 
	
	
							}?>
                            </table>
                            <hr color="#000000" width="80%" />
<br /> 
<div align="center"><font color="#000000" size="+1"><strong>Итоговые подсчёты</strong></font></div>
<div align="left"><font color="#000000" size="+1"><strong>&nbsp;&nbsp;<a href="full_calculation_shortly.php?id=<?php echo $id;?>" title="Краткий отчёт результатов">- кратко</a></strong></font></div>
<div align="left"><font color="#000000" size="+1"><strong>&nbsp;&nbsp;<a href="full_calculation_detailed.php?id=<?php echo $id;?>" title="Полный отчёт результатов">- подробно</a></strong></font></div>
<br />
<?php } else 
						{ 
							die ("No shablon!!");
													}?>