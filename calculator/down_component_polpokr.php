<?php
if (isset ($_GET['id_down_comp']) AND !empty ($_GET['id_down_comp']))

	{ // Check vars
	$_GET['id_down_comp'] = htmlspecialchars ($_GET['id_down_comp']);
		if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id_down_comp']); 
        } else { 
            $id = addslashes($_GET['id_down_comp']); 
        } 
			$id = (int)$id;
			if ($id == '0') {die ("Invalid element!!!!");}
			
			include ("bd.php");
			
		$result1 = mysql_query ("SELECT * FROM `components_polpokr` WHERE `id` = $id ");
		
		$row1 = mysql_fetch_array ($result1);
		
		
		
		$result2 = mysql_query ("SELECT * FROM `components_polpokr` WHERE `position` = (SELECT MIN(position) FROM `components_polpokr` WHERE `position` > '$row1[position]' AND `id_shab` = $row1[id_shab] AND `id_polpokr` = $row1[id_polpokr] AND `id_room` = $row1[id_room]) AND `id_shab` = $row1[id_shab] AND `id_polpokr` = $row1[id_polpokr] AND `id_room` = $row1[id_room]");
		
		$row2 = mysql_fetch_array ($result2);
		
		
		// Update
		
		$res1 = mysql_query("UPDATE `components_polpokr` SET `position` = $row2[position] WHERE `id` = $row1[id]");
		
		$res2 = mysql_query("UPDATE `components_polpokr` SET `position` = $row1[position] WHERE `id` = $row2[id]");
		
		
		
		// return
		
		header("Location: show_polpokr.php?id=" . $row1['id_shab'] . "&id_room=" . $row1['id_room'] . "&id_polpokr=" . $row1['id_polpokr']);

			}
	

?>