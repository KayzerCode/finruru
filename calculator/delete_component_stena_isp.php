<?php 
/* Исполняющая php */
if (isset ($_POST['id']) AND !empty ($_POST['id']) AND isset ($_POST['id_stena']) AND !empty ($_POST['id_stena']))

			{
            
$_POST['id'] = htmlspecialchars ($_POST['id']);
$_POST['id_stena'] = htmlspecialchars ($_POST['id_stena']);
$_POST['id_room'] = htmlspecialchars ($_POST['id_room']);
$_POST['id_shab'] = htmlspecialchars ($_POST['id_shab']);


if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_POST['id']); 
								$id_stena = stripslashes($_POST['id_stena']);
												$id_room = stripslashes($_POST['id_room']);
												$id_shab = stripslashes($_POST['id_shab']);

        } else { 
            $id = addslashes($_POST['id']); 
								$id_stena = addslashes($_POST['id_stena']); 
												$id_room = addslashes($_POST['id_room']);
												$id_shab = addslashes($_POST['id_shab']);

        } 
        $id = (int)$id;
		$id_stena = (int)$id_stena;
				$id_room = (int)$id_room;
				$id_shab = (int)$id_shab;

			if ($id == '0') {header("Location: show_elements.php?group=1");}
			if ($id_stena == '0') {header("Location: show_elements.php?group=1");}
						if ($id_room == '0') {header("Location: show_elements.php?group=1");}


include("bd.php");  

/* Редактируем в таблицу новый объект */
if(file_exists('img/images_components_stena/' . $id . '.' . 'jpg'))
	{
		unlink ('img/images_components_stena/' . $id . '.' . 'jpg');
	}
$res_del = mysql_query("DELETE FROM `components_stena` WHERE `id` = '$id'") or die ("error");

header("Location: show_stena.php?id_stena=" . $id_stena . "&id_room=" . $id_room . "&id=" . $id_shab);
}
?>