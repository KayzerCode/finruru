<?php 
if (isset ($_GET['id']) && !empty ($_GET['id']))

	{
		
		
$_GET['id'] = htmlspecialchars ($_GET['id']);
$_GET['id_shab'] = htmlspecialchars ($_GET['id_shab']);
$_GET['id_room'] = htmlspecialchars ($_GET['id_room']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']);
			$id_shab = stripslashes($_GET['id_shab']); 
			$id_room = stripslashes($_GET['id_room']);
 

        } else { 
            $id = addslashes($_GET['id']);
			$id_shab = addslashes($_GET['id_shab']);
			$id_room = addslashes($_GET['id_room']);
 				} 
        $id = (int)$id;
			if ($id == '0') {die ("Invalid component!!!!");}
			
		include ("bd.php");
		$select = mysql_query ("SELECT * FROM `components_potobr` WHERE `id_potobr` = '$id' AND `id_shab` = '$id_shab' AND `id_room` = '$id_room'") or die ("NOt select components_potobr");
		while ($row = mysql_fetch_array ($select)){
			$res_del = mysql_query("DELETE FROM `components_potobr` WHERE `id` = '$row[id]'") or die ("error1");
			if (!empty ($row['foto'])){
			$image = $row['id'] . '.' . 'jpg';
$file = 'img/images_components_potobr/' . $image;
unlink ($file);}
													}
							$result = mysql_query ("SELECT * FROM `potobr` WHERE `id` = '$id'");
								$row = mysql_fetch_array ($result);
									if (!empty ($row['image'])){
			$image = $row['id'] . '.' . 'jpg';
$file = 'img/images_potobr/' . $image;
unlink ($file);}					
			$res_del_elem = mysql_query("DELETE FROM `potobr` WHERE `id` = '$id'") or die ("error2");
			
		header("Location: calc_shab.php?id=" . $id_shab . "&cat=otd&show_room=" . $id_room);
	

		}