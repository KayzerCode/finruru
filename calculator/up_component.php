<?php
if (isset ($_GET['id_up_comp']) AND !empty ($_GET['id_up_comp']))

	{ // Check vars
	$_GET['id_up_comp'] = htmlspecialchars ($_GET['id_up_comp']);
		if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id_up_comp']); 
        } else { 
            $id = addslashes($_GET['id_up_comp']); 
        } 
			$id = (int)$id;
			if ($id == '0') {die ("Invalid element!!!!");}
			
			
			include ("bd.php");
			
		$result1 = mysql_query ("SELECT * FROM `components` WHERE `id` = $id ");
		
		$row1 = mysql_fetch_array ($result1);
				
		
		$result2 = mysql_query ("SELECT * FROM `components` WHERE `position` = (SELECT MAX(position) FROM `components` WHERE `position` < '$row1[position]' AND `group` = $row1[group] AND `elid` = $row1[elid]) AND `group` = $row1[group] AND `elid` = $row1[elid]");
		
		$row2 = mysql_fetch_array ($result2);
		
		
		
		// Update
		
		$res1 = mysql_query("UPDATE `components` SET `position` = $row2[position] WHERE `id` = $row1[id]");
		
		$res2 = mysql_query("UPDATE `components` SET `position` = $row1[position] WHERE `id` = $row2[id]");
		
		// choose name of structure
		
		$result = mysql_query ("SELECT * FROM `handbook_elements` WHERE `id` = $row1[elid] ") or die ("Error not select!!");
		
		$row = mysql_fetch_array ($result);
		
		// return
		
		header("Location: show_elements.php?id=" . $row1['elid'] . "");

	
	
	}

?>