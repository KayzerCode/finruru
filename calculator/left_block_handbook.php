<div align="center"><font color="#000000" size="+1"><em>Категории:</em></font></div>
<?php include ("bd.php"); // connection to database 
//Creation of a output table?>

<table border="0" cellpadding="0" cellspacing="10" width="300" align="center" rules="none" id="table" bordercolor="#000000">

<?php 
$result = mysql_query("SELECT * FROM `handbook_groups` ORDER BY `id`");
while ($row = mysql_fetch_array($result))

{

			?><tr>
            	<td>
             			<table align="center" border="0" id="table" bordercolor="#000000" width="300" cellspacing="5" cellpadding="10">
                        <tr>
             			<td id="td" align="center" bgcolor="#CCFFCC"><font size="+1" color="#000000"><strong><a href="handbook.php?group=<?php echo $row['id'];?>" title="<?php echo $row['name'];?>"><?php echo $row['name'];?></a></strong></font>
                        </td>
                        </tr>
                        </table>
                       
             
             	</td>
              </tr>


<?php } ?>
</table><br>