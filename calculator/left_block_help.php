<?php 

include ("bd.php"); // connection to database 
//Creation of a output table
$select1 = mysql_query ("SELECT * FROM `spravka1`") or die ("Not select 1");
while ($row1 = mysql_fetch_array ($select1))
	{
		?><p align="left"><a href="help.php?id1=<?php echo $row1['id'];?>&amp;id2=0&amp;id3=0&amp;id4=0"><?php echo $row1['name'];?></a></p><?php 
			$select2 = mysql_query ("SELECT * FROM `spravka2` WHERE `id1` = '$row1[id]'") or die ("Not select 2");
				while ($row2 = mysql_fetch_array ($select2))
					{
						?><p align="left">&nbsp;&nbsp;&nbsp;&nbsp;<a href="help.php?id1=<?php echo $row1['id'];?>&amp;id2=<?php echo $row2['id'];?>&amp;id3=0&amp;id4=0"><?php echo $row2['name'];?></a></p><?php
							$select3 = mysql_query ("SELECT * FROM `spravka3` WHERE `id1` = '$row1[id]' AND `id2` = '$row2[id]'") or die ("Not select 3");
				while ($row3 = mysql_fetch_array ($select3))
					{
						?><p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="help.php?id1=<?php echo $row1['id'];?>&amp;id2=<?php echo $row2['id'];?>&amp;id3=<?php echo $row3['id'];?>&amp;id4=0"><?php echo $row3['name'];?></a></p><?php
							$select4 = mysql_query ("SELECT * FROM `spravka4` WHERE `id1` = '$row1[id]' AND `id2` = '$row2[id]' AND `id3` = '$row3[id]'") or die ("Not select 4");
				while ($row4 = mysql_fetch_array ($select4))
					{
						?><p align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="help.php?id1=<?php echo $row1['id'];?>&amp;id2=<?php echo $row2['id'];?>&amp;id3=<?php echo $row3['id'];?>&amp;id4=<?php echo $row4['id'];?>"><?php echo $row4['name'];?></a></p><?php
							
					}
					}
					}
	}
?>