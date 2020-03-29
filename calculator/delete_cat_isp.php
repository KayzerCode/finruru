<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['cat'] = htmlspecialchars ($_POST['cat']);


if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']);
			            $cat = stripslashes($_POST['cat']); 


        } else { 
            $id = addslashes($_POST['id']);
			            $cat = addslashes($_POST['cat']); 


        } 
        $id = (int)$id;
		        $cat = (int)$cat;

			if ($id == '0') {header("Location: handbook.php?group=1");}

include("bd.php");  

/* Редактируем в таблицу новый объект */
$res_del = mysql_query("DELETE FROM `add_cat` WHERE `id` = $cat") or die ("error");

header("Location: calc_shab.php?id=" . $id);
}
?>