<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']) AND isset ($_POST['id_potpokr']) AND !empty ($_POST['id_potpokr']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['id_potpokr'] = htmlspecialchars ($_POST['id_potpokr']);
$_POST['id_room'] = htmlspecialchars ($_POST['id_room']);
$_POST['id_shab'] = htmlspecialchars ($_POST['id_shab']);


if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 
								$id_potpokr = stripslashes($_POST['id_potpokr']);
												$id_room = stripslashes($_POST['id_room']);
												$id_shab = stripslashes($_POST['id_shab']);

        } else { 
            $id = addslashes($_POST['id']); 
								$id_potpokr = addslashes($_POST['id_potpokr']); 
												$id_room = addslashes($_POST['id_room']);
												$id_shab = addslashes($_POST['id_shab']);

        } 
        $id = (int)$id;
		$id_potpokr = (int)$id_potpokr;
				$id_room = (int)$id_room;
				$id_shab = (int)$id_shab;

			if ($id == '0') {header("Location: show_elements.php?group=1");}
			if ($id_potpokr == '0') {header("Location: show_elements.php?group=1");}
						if ($id_room == '0') {header("Location: show_elements.php?group=1");}


include("bd.php");  

/* Редактируем в таблицу новый объект */
if(file_exists('img/images_components_potpokr/' . $id . '.' . 'jpg'))
	{
		unlink ('img/images_components_potpokr/' . $id . '.' . 'jpg');
	}
$res_del = mysql_query("DELETE FROM `components_potpokr` WHERE `id` = '$id'") or die ("error");

header("Location: show_potpokr.php?id=" . $id_shab . "&id_room=" . $id_room . "&id_potpokr=" . $id_potpokr);
}
?>