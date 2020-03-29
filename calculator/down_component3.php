<?php
if (isset ($_GET['id_down_comp']) AND !empty ($_GET['id_down_comp']))

	{ // Check vars
	$_GET['id_down_comp'] = htmlspecialchars ($_GET['id_down_comp']);
	$_GET['id_shab'] = htmlspecialchars ($_GET['id_shab']);
$_GET['id_room'] = htmlspecialchars ($_GET['id_room']);

		if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id_down_comp']);
			$id_shab = stripslashes($_GET['id_shab']); 
			$id_room = stripslashes($_GET['id_room']); 

        } else { 
            $id = addslashes($_GET['id_down_comp']);
			$id_shab = addslashes($_GET['id_shab']);
			$id_room = addslashes($_GET['id_room']); 

        } 
			$id = (int)$id;
			if ($id == '0') {die ("Invalid element!!!!");}
			
			include ("bd.php");
			
		$result1 = mysql_query ("SELECT * FROM `components` WHERE `id` = $id ");
		
		$row1 = mysql_fetch_array ($result1);
				
		
		$result2 = mysql_query ("SELECT * FROM `components` WHERE `position` = (SELECT MIN(position) FROM `components` WHERE `position` > '$row1[position]' AND `group` = $row1[group] AND `elid` = $row1[elid]) AND `group` = $row1[group] AND `elid` = $row1[elid]");
		
		$row2 = mysql_fetch_array ($result2);
		
		
		
		// Update
		
		$res1 = mysql_query("UPDATE `components` SET `position` = $row2[position] WHERE `id` = $row1[id]");
		
		$res2 = mysql_query("UPDATE `components` SET `position` = $row1[position] WHERE `id` = $row2[id]");
		
		// choose name of structure
		
		$result = mysql_query ("SELECT * FROM `handbook_elements` WHERE `id` = $row1[elid] ");
		
		$row = mysql_fetch_array ($result);
		
		// return
		
		header("Location: add_stena.php?id_shab=" . $id_shab . "&id_room=" . $id_room);

			}
	

?>