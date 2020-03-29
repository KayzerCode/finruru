<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']) AND isset ($_POST['newcatnaz']) AND !empty ($_POST['newcatnaz']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['newcatnaz'] = htmlspecialchars ($_POST['newcatnaz']);
$_POST['cat'] = htmlspecialchars ($_POST['cat']);


if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 
			            $newcatnaz = stripslashes($_POST['newcatnaz']);
						            $cat = stripslashes($_POST['cat']); 


        } else { 
            $id = addslashes($_POST['id']); 
			            $newcatnaz = addslashes($_POST['newcatnaz']); 
           							$cat = addslashes($_POST['cat']); 

        } 
        $id = (int)$id;
		        $cat = (int)$cat;

			if ($id == '0') {header("Location: handbook.php?group=1");}

include("bd.php");  

/* Редактируем в таблицу новый объект */
$result1 = mysql_query("UPDATE `add_cat` SET name = ('" . $newcatnaz .  "') WHERE `id` = ('" . $cat .  "')", $link) or die ("error");


header("Location: calc_shab.php?id=" . $id);
}
?>