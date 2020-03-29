<?php
if (isset ($_GET['id']) AND !empty ($_GET['id']))



			{
            
$_GET['id'] = htmlspecialchars ($_GET['id']); // id ofshablon
$_GET['elid'] = htmlspecialchars ($_GET['elid']);
$_GET['group'] = htmlspecialchars ($_GET['group']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']);
			            $elid = stripslashes($_GET['elid']); 
			            $group = stripslashes($_GET['group']); 

        } else { 
            $id = addslashes($_GET['id']);
			            $elid = addslashes($_GET['elid']); 
			            $group = addslashes($_GET['group']); 

        } 
        $id = (int)$id;
			if ($id == '0') {die ("Invalid element!!!!");}
			
			
			include ("bd.php");
			$result = mysql_query("UPDATE `shab_elements`SET `quantity` = '0' WHERE `id` = ('" . $elid .  "')");
header("Location: edit_element_shablon.php?elid=" . $elid . "&id=" . $id . "&group=" . $group);
			}

?>