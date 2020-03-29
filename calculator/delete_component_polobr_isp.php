<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']) AND isset ($_POST['id_polobr']) AND !empty ($_POST['id_polobr']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['id_polobr'] = htmlspecialchars ($_POST['id_polobr']);
$_POST['id_room'] = htmlspecialchars ($_POST['id_room']);
$_POST['id_shab'] = htmlspecialchars ($_POST['id_shab']);


if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 
								$id_polobr = stripslashes($_POST['id_polobr']);
												$id_room = stripslashes($_POST['id_room']);
												$id_shab = stripslashes($_POST['id_shab']);

        } else { 
            $id = addslashes($_POST['id']); 
								$id_polobr = addslashes($_POST['id_polobr']); 
												$id_room = addslashes($_POST['id_room']);
												$id_shab = addslashes($_POST['id_shab']);

        } 
        $id = (int)$id;
		$id_polobr = (int)$id_polobr;
				$id_room = (int)$id_room;
				$id_shab = (int)$id_shab;

			if ($id == '0') {header("Location: show_elements.php?group=1");}
			if ($id_polobr == '0') {header("Location: show_elements.php?group=1");}
						if ($id_room == '0') {header("Location: show_elements.php?group=1");}


include("bd.php");  

/* Редактируем в таблицу новый объект */
if(file_exists('img/images_components_polobr/' . $id . '.' . 'jpg'))
	{
		unlink ('img/images_components_polobr/' . $id . '.' . 'jpg');
	}
$res_del = mysql_query("DELETE FROM `components_polobr` WHERE `id` = '$id'") or die ("error");

header("Location: show_polobr.php?id_polobr=" . $id_polobr . "&id_room=" . $id_room . "&id=" . $id_shab);
}
?>