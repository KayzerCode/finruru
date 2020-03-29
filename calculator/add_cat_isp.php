<?php 
/* Исполняющая php */
if (isset ($_POST['elnaz']) AND !empty ($_POST['elnaz']))

			{
            
$_POST['elnaz'] = htmlspecialchars ($_POST['elnaz']);
$_POST['id_shab'] = htmlspecialchars ($_POST['id_shab']);

if(get_magic_quotes_gpc()){ 
			            $elnaz = stripslashes($_POST['elnaz']);
										            $id = stripslashes($_POST['id_shab']); 


        } else { 
			            $elnaz = addslashes($_POST['elnaz']);
									            $id = addslashes($_POST['id_shab']); 


        } 

include("bd.php");  

/* Внедряем в таблицу новый объект */
$res = mysql_query("INSERT INTO `add_cat` (`id_shab`, `name`) VALUES ('$id', '$elnaz')") or die ("error - not insert");


header("Location: calc_shab.php?id=" . $id);
}
?>