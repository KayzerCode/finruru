<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']) AND isset ($_POST['value']) AND !empty ($_POST['value']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['value'] = htmlspecialchars ($_POST['value']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 
			            $value = stripslashes($_POST['value']); 

        } else { 
            $id = addslashes($_POST['id']); 
			            $value = addslashes($_POST['value']); 

        } 
        $id = (int)$id;
			if ($id == '0') {header("Location: handbook.php?group=1");}

include("bd.php");  

/* Внедряем в таблицу новый объект */
$result1 = mysql_query("UPDATE `areas` SET `value` = ('" . $value .  "') WHERE `id_shab` = ('" . $id .  "')", $link) or die ("error");

header("Location: calc_shab.php?id=" . $id);
}
?>