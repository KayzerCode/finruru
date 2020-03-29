<?php 
/* Исполняющая php */
if (isset ($_POST['id_shab']) AND !empty ($_POST['id_shab']))

			{
            
$_POST['roomnaz'] = htmlspecialchars ($_POST['roomnaz']);
$_POST['id_shab'] = htmlspecialchars ($_POST['id_shab']);
$_POST['metraj'] = htmlspecialchars ($_POST['metraj']);
$_POST['vuspot'] = htmlspecialchars ($_POST['vuspot']);
$_POST['jm'] = htmlspecialchars ($_POST['jm']);
$_POST['fix'] = htmlspecialchars ($_POST['fix']);

if(get_magic_quotes_gpc()){ 
			            $roomnaz = stripslashes($_POST['roomnaz']);
										            $id = stripslashes($_POST['id_shab']); 
$metraj = stripslashes($_POST['metraj']);
$vuspot = stripslashes($_POST['vuspot']);
$jm = stripslashes($_POST['jm']);
$fix = stripslashes($_POST['fix']);

        } else { 
			            $roomnaz = addslashes($_POST['roomnaz']);
									            $id = addslashes($_POST['id_shab']);
$metraj = addslashes($_POST['metraj']);
$vuspot = addslashes($_POST['vuspot']);
$jm = addslashes($_POST['jm']);
$fix = addslashes($_POST['fix']);


        } 

include("bd.php");  

/* Внедряем в таблицу новый объект */
$res = mysql_query("INSERT INTO `rooms_shab` (`id_shab`, `name`, `metraj`, `vuspot`, `jm`) VALUES ('$id', '$roomnaz', '$metraj', '$vuspot', '$jm')") or die ("error - not insert");

$sel1 = mysql_query ("SELECT * FROM `categories` WHERE `id` = $id") or die ("Not select category");
					$row = mysql_fetch_array ($sel1);


header("Location: calc_shab.php?id=" . $id . "&cat=" . $fix);
}
?>