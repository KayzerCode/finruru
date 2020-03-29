<?php
if (isset ($_GET['id_down_comp']) AND !empty ($_GET['id_down_comp']))

	{ // Check vars
	$_GET['id_down_comp'] = htmlspecialchars ($_GET['id_down_comp']);
	$_GET['id_shab'] = htmlspecialchars ($_GET['id_shab']);
$_GET['group'] = htmlspecialchars ($_GET['group']);

		if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id_down_comp']);
			$id_shab = stripslashes($_GET['id_shab']); 
			$group = stripslashes($_GET['group']); 

        } else { 
            $id = addslashes($_GET['id_down_comp']);
			$id_shab = addslashes($_GET['id_shab']);
			$group = addslashes($_GET['group']); 

        } 
			$id = (int)$id;
			if ($id == '0') {die ("Invalid element!!!!");}
			
			include ("bd.php");
			
		$result1 = mysql_query ("SELECT * FROM `components` WHERE `id` = '$id' ");
		
		$row1 = mysql_fetch_array ($result1);
				
		
		$result2 = mysql_query ("SELECT * FROM `components` WHERE `position` = (SELECT MIN(position) FROM `components` WHERE `position` > '$row1[position]' AND `group` = $row1[group] AND `elid` = $row1[elid]) AND `group` = $row1[group] AND `elid` = $row1[elid]");
		
		$row2 = mysql_fetch_array ($result2);
		
		
		
		// Update
		
		$res1 = mysql_query("UPDATE `components` SET `position` = $row2[position] WHERE `id` = $row1[id]");
		
		$res2 = mysql_query("UPDATE `components` SET `position` = $row1[position] WHERE `id` = $row2[id]");
		
		
		// return
		
header("Location: add_elements.php?id_shab=" . $id_shab . "&group=" . $row1['group']);

			}
	

?>