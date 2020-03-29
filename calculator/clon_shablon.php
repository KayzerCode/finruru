<?php 
		if (isset ($_GET['id']) AND $_GET['id'] != '')
				
				{

$_GET['id'] = htmlspecialchars ($_GET['id']);

if(get_magic_quotes_gpc()){ 
            $id = stripslashes($_GET['id']);
        } else { 
            $id = addslashes($_GET['id']);
        } 
        $id = (int)$id;

			if ($id == '0') {die ("Invalid component!!!!");}

		include ("bd.php");
		// Clon only name and foto
			$select = mysql_query ("SELECT * FROM `shablons` WHERE `id` = $id", $link) or die ("Not select");
			$row = mysql_fetch_array ($select);
			
				$input = mysql_query ("INSERT into `shablons` (`name`) VALUES ('" . $row['name'] . "')") or die ("Not input");
				$id_shab = mysql_insert_id();
				if ($row['foto'] != '' AND file_exists ('img/images_shablons/' . $id . '.' . 'jpg'))
				{
					$from = 'img/images_shablons/' . $id . '.' . 'jpg';
					$to = 'img/images_shablons/' . $id_shab . '.' . 'jpg';
					copy ($from, $to);
					$image = $id_shab . '.' . 'jpg';
					$res_image = mysql_query("UPDATE `shablons` SET `foto` = '$image' WHERE `id` = '$id_shab'");

				}
				
		// Clon rooms
		$select_room = mysql_query ("SELECT * FROM `rooms_shab` WHERE `id_shab` = '$id'");
		while ($row_room = mysql_fetch_array ($select_room))
		{
			$input_room = mysql_query ("INSERT into `rooms_shab` (`id_shab`, `name`, `metraj`, `vuspot`, `jm`) VALUES ('$id_shab', '$row_room[name]', '$row_room[metraj]', '$row_room[vuspot]', '$row_room[jm]')") or die ("Not input_room");
			
				$id_room = mysql_insert_id();
				
								$select_polpokr = mysql_query ("SELECT * FROM `polpokr` WHERE `id_room` = '$row_room[id]' AND `id_shab` = '$id'", $link) or die ("Not select");
								while ($polpokr = mysql_fetch_array ($select_polpokr))
									{
									$input_polpokr = mysql_query ("INSERT into `polpokr` (`id_shab`, `id_room`, `metraj`, `koef`, `name`) VALUES ('$id_shab', '$id_room', '$polpokr[metraj]', '$polpokr[koef]', '$polpokr[name]')") or die ("Not input_polpokr");
									$id_polpokr = mysql_insert_id();
									$id1 = mysql_insert_id();
									$image = $id1 . '.' . 'jpg';
									if ($polpokr['image'] != '')
									{
									$image = $id1 . '.' . 'jpg';
									$res_image = mysql_query("UPDATE `polpokr` SET `image` = '$image' WHERE `id` = '$id_polpokr'");
									}
if (!empty ($polpokr['image']))
	{
	$filename = $polpokr['id'] . '.' . 'jpg';
		$source = 'img/images_polpokr/' . $filename;
		$to = 'img/images_polpokr/' . $image;
		copy ($source, $to);
	}

											$select_components_polpokr = mysql_query ("SELECT * FROM `components_polpokr` WHERE `id_room` = '$row_room[id]' AND `id_shab` = '$id' AND `id_polpokr` = '$polpokr[id]'", $link) or die ("Not select");
											while ($comp_polpokr = mysql_fetch_array ($select_components_polpokr))
												{
												$input_components_polpokr = mysql_query ("INSERT into `components_polpokr` (`id_polpokr`, `id_shab`, `id_room`, `name`, `position`, `stmat`, `strab`, `stsopmat`, `trud`, `razm`) VALUES ('$id_polpokr', '$id_shab', '$id_room', '$comp_polpokr[name]', '$comp_polpokr[position]', '$comp_polpokr[stmat]', '$comp_polpokr[strab]', '$comp_polpokr[stsopmat]', '$comp_polpokr[trud]', '$comp_polpokr[razm]')") or die ("Not input_room");	
													$id_comp = mysql_insert_id();
	$foto = $id_comp . '.' . 'jpg';
if (!empty ($comp_polpokr['foto']))
	{
	$res = mysql_query("UPDATE `components_polpokr` SET `foto` = '$foto' WHERE `id` = '$id_comp'");
	}
if (!empty ($comp_polpokr['foto']))
	{
	$filename = $comp_polpokr['id'] . '.' . 'jpg';
		$source = 'img/images_components_polpokr/' . $filename;
		$to = 'img/images_components_polpokr/' . $foto;
		copy ($source, $to);
	}


												}

									}
				
				
				
				
				
				
				
$select_polobr = mysql_query ("SELECT * FROM `polobr` WHERE `id_room` = '$row_room[id]' AND `id_shab` = '$id'", $link) or die ("Not select");
								while ($polobr = mysql_fetch_array ($select_polobr))
									{
									$input_polobr = mysql_query ("INSERT into `polobr` (`id_shab`, `id_room`, `jm`, `koef`, `name`) VALUES ('$id_shab', '$id_room', '$polobr[jm]', '$polobr[koef]', '$polobr[name]')") or die ("Not input_polobr");
						$id1 = mysql_insert_id();
						$id_polobr = mysql_insert_id();
$image = $id1 . '.' . 'jpg';
if (!empty ($polobr['image']))
	{
$res_image = mysql_query("UPDATE `polobr` SET `image` = '$image' WHERE `id` = '$id1'");
}
if (!empty ($polobr['image']))
	{
	$filename = $id . '.' . 'jpg';
		$source = 'img/images_polobr/' . $filename;
		$to = 'img/images_polobr/' . $image;
		copy ($source, $to);
	}
											$select_components_polobr = mysql_query ("SELECT * FROM `components_polobr` WHERE `id_room` = '$row_room[id]' AND `id_shab` = '$id' AND `id_polobr` = '$polobr[id]'", $link) or die ("Not select");
											while ($comp_polobr = mysql_fetch_array ($select_components_polobr))
												{
												$input_components_polobr = mysql_query ("INSERT into `components_polobr` (`id_polobr`, `id_shab`, `id_room`, `name`, `position`, `stmat`, `strab`, `stsopmat`, `trud`, `razm`) VALUES ('$id_polobr', '$id_shab', '$id_room', '$comp_polobr[name]', '$comp_polobr[position]', '$comp_polobr[stmat]', '$comp_polobr[strab]', '$comp_polobr[stsopmat]', '$comp_polobr[trud]', '$comp_polobr[razm]')") or die ("Not input_room");	
	$id_comp = mysql_insert_id();
	$foto = $id_comp . '.' . 'jpg';
	if (!empty ($comp_polobr['foto']))
	{
	$res = mysql_query("UPDATE `components_polobr` SET `foto` = '$foto' WHERE `id` = '$id_comp'");
	}
if (!empty ($comp_polobr['foto']))
	{
	$filename = $comp_polobr['id'] . '.' . 'jpg';
		$source = 'img/images_components_polobr/' . $filename;
		$to = 'img/images_components_polobr/' . $foto;
		copy ($source, $to);
	}

												}

									}
									
									
$select_stena = mysql_query ("SELECT * FROM `stena` WHERE `id_room` = '$row_room[id]' AND `id_shab` = '$id'", $link) or die ("Not select");
								while ($stena = mysql_fetch_array ($select_stena))
									{
									$input_stena = mysql_query ("INSERT into `stena` (`id_shab`, `id_room`, `jm`, `vuspot`, `koef`, `name`) VALUES ('$id_shab', '$id_room', '$stena[jm]', '$stena[vuspot]', '$stena[koef]', '$stena[name]')") or die ("Not input_stena");
									$id_stena = mysql_insert_id();
									$id1 = mysql_insert_id();
									$image = $id1 . '.' . 'jpg';
									if (!empty ($stena['image']))
	{
									$res_image = mysql_query("UPDATE `stena` SET `image` = '$image' WHERE `id` = '$id_stena'");
									}
if (!empty ($stena['image']))
	{
	$filename = $stena['id'] . '.' . 'jpg';
		$source = 'img/images_stena/' . $filename;
		$to = 'img/images_stena/' . $image;
		copy ($source, $to);
	}

											$select_components_stena = mysql_query ("SELECT * FROM `components_stena` WHERE `id_room` = '$row_room[id]' AND `id_shab` = '$id' AND `id_stena` = '$stena[id]'", $link) or die ("Not select");
											while ($comp_stena = mysql_fetch_array ($select_components_stena))
												{
												$input_components_stena= mysql_query ("INSERT into `components_stena` (`id_stena`, `id_shab`, `id_room`, `name`, `position`, `stmat`, `strab`, `stsopmat`, `trud`, `razm`) VALUES ('$id_stena', '$id_shab', '$id_room', '$comp_stena[name]', '$comp_stena[position]', '$comp_stena[stmat]', '$comp_stena[strab]', '$comp_stena[stsopmat]', '$comp_stena[trud]', '$comp_stena[razm]')") or die ("Not input_room stena");	
	$id_comp = mysql_insert_id();
	$foto = $id_comp . '.' . 'jpg';
if (!empty ($comp_stena['foto']))
	{
	$filename = $comp_stena['id'] . '.' . 'jpg';
		$source = 'img/images_components_stena/' . $filename;
		$to = 'img/images_components_stena/' . $foto;
		copy ($source, $to);
			$res = mysql_query("UPDATE `components_stena` SET `foto` = '$foto' WHERE `id` = '$id_comp'");

	}

												}

									}
				
				
				
				
				
$select_potpokr = mysql_query ("SELECT * FROM `potpokr` WHERE `id_room` = '$row_room[id]' AND `id_shab` = '$id'", $link) or die ("Not select");
								while ($potpokr = mysql_fetch_array ($select_potpokr))
									{
									$input_potpokr = mysql_query ("INSERT into `potpokr` (`id_shab`, `id_room`, `metraj`, `koef`, `name`) VALUES ('$id_shab', '$id_room', '$potpokr[metraj]', '$potpokr[koef]', '$potpokr[name]')") or die ("Not input_potpokr");
									$id_potpokr = mysql_insert_id();
									$id1 = mysql_insert_id();
									$image = $id1 . '.' . 'jpg';
if (!empty ($potpokr['image']))
	{
	$filename = $potpokr['id'] . '.' . 'jpg';
		$source = 'img/images_potpokr/' . $filename;
		$to = 'img/images_potpokr/' . $image;
		copy ($source, $to);
		$res_image = mysql_query("UPDATE `potpokr` SET `image` = '$image' WHERE `id` = '$id_potpokr'");

	}

											$select_components_potpokr = mysql_query ("SELECT * FROM `components_potpokr` WHERE `id_room` = '$row_room[id]' AND `id_shab` = '$id' AND `id_potpokr` = '$potpokr[id]'", $link) or die ("Not select");
											while ($comp_potpokr = mysql_fetch_array ($select_components_potpokr))
												{
												$input_components_potpokr = mysql_query ("INSERT into `components_potpokr` (`id_potpokr`, `id_shab`, `id_room`, `name`, `position`, `stmat`, `strab`, `stsopmat`, `trud`, `razm`) VALUES ('$id_potpokr', '$id_shab', '$id_room', '$comp_potpokr[name]', '$comp_potpokr[position]', '$comp_potpokr[stmat]', '$comp_potpokr[strab]', '$comp_potpokr[stsopmat]', '$comp_potpokr[trud]', '$comp_potpokr[razm]')") or die ("Not input_room potpokr");
												$id_comp = mysql_insert_id();
	$foto = $id_comp . '.' . 'jpg';
if (!empty ($comp_potpokr['foto']))
	{
	$filename = $comp_potpokr['id'] . '.' . 'jpg';
		$source = 'img/images_components_potpokr/' . $filename;
		$to = 'img/images_components_potpokr/' . $foto;
		copy ($source, $to);
			$res = mysql_query("UPDATE `components_potpokr` SET `foto` = '$foto' WHERE `id` = '$id_comp'");

	}	

												}

									}
				
				
				
				
				
				
				
$select_potobr = mysql_query ("SELECT * FROM `potobr` WHERE `id_room` = '$row_room[id]' AND `id_shab` = '$id'", $link) or die ("Not select");
								while ($potobr = mysql_fetch_array ($select_potobr))
									{
									$input_potobr = mysql_query ("INSERT into `potobr` (`id_shab`, `id_room`, `jm`, `koef`, `name`) VALUES ('$id_shab', '$id_room', '$potobr[jm]', '$potobr[koef]', '$potobr[name]')") or die ("Not input_potobr");
									$id_potobr = mysql_insert_id();
									$id1 = mysql_insert_id();
									$image = $id1 . '.' . 'jpg';
if (!empty ($potobr['image']))
	{
	$filename = $potobr['id'] . '.' . 'jpg';
		$source = 'img/images_potobr/' . $filename;
		$to = 'img/images_potobr/' . $image;
		copy ($source, $to);
											$res_image = mysql_query("UPDATE `potobr` SET `image` = '$image' WHERE `id` = '$id_potobr'");

	}
											$select_components_potobr = mysql_query ("SELECT * FROM `components_potobr` WHERE `id_room` = '$row_room[id]' AND `id_shab` = '$id' AND `id_potobr` = '$potobr[id]'", $link) or die ("Not select");
											while ($comp_potobr = mysql_fetch_array ($select_components_potobr))
												{
												$input_components_potobr = mysql_query ("INSERT into `components_potobr` (`id_potobr`, `id_shab`, `id_room`, `name`, `position`, `stmat`, `strab`, `stsopmat`, `trud`, `razm`) VALUES ('$id_potobr', '$id_shab', '$id_room', '$comp_potobr[name]', '$comp_potobr[position]', '$comp_potobr[stmat]', '$comp_potobr[strab]', '$comp_potobr[stsopmat]', '$comp_potobr[trud]', '$comp_potobr[razm]')") or die ("Not input_room potpokr");	
												$id_comp = mysql_insert_id();
	$foto = $id_comp . '.' . 'jpg';
if (!empty ($comp_potobr['foto']))
	{
	$filename = $comp_potobr['id'] . '.' . 'jpg';
		$source = 'img/images_components_potobr/' . $filename;
		$to = 'img/images_components_potobr/' . $foto;
		copy ($source, $to);
		$res = mysql_query("UPDATE `components_potobr` SET `foto` = '$foto' WHERE `id` = '$id_comp'");

	}	

												} } }
		// Clon area
		$select_area = mysql_query ("SELECT * FROM `areas` WHERE `id_shab` = '$id'");
		$row_area = mysql_fetch_array ($select_area);
		$input_area = mysql_query ("INSERT into `areas` (`id_shab`, `value`) VALUES ('$id_shab', '$row_area[value]')") or die ("Not input area");
		// Clon elements
		$select_elements = mysql_query ("SELECT * FROM `shab_elements` WHERE `id_shab` = '$id'", $link) or die ("Not select");
								while ($row = mysql_fetch_array ($select_elements))
									{
									$input_potobr = mysql_query ("INSERT into `shab_elements` (`group`, `id_shab`, `name`, `area`, `quantity`, `koef`) VALUES ('$row[group]', '$id_shab', '$row[name]', '$row[area]', '$row[quantity]', '$row[koef]')") or die ("Not input_elements");
									$id_elem = mysql_insert_id();
									$id1 = mysql_insert_id();
									$image = $id1 . '.' . 'jpg';
if (!empty ($row_el['image']))
	{
	$filename = $row_el['id'] . '.' . 'jpg';
		$source = 'img/images_elements_shablon/' . $filename;
		$to = 'img/images_elements_shablon/' . $image;
		copy ($source, $to);
											$res_image = mysql_query("UPDATE `shab_elements` SET `image` = '$image' WHERE `id` = '$id_elem'");

	}
											$select_components = mysql_query ("SELECT * FROM `shab_components` WHERE `elid` = '$row[id]' AND `id_shab` = '$id'", $link) or die ("Not select");
											while ($comp = mysql_fetch_array ($select_components))
												{
												$input_components = mysql_query ("INSERT into `shab_components` (`group`, `id_shab`, `elid`, `name`, `position`, `stmat`, `strab`, `stsopmat`, `trud`, `razm`) VALUES ('$comp[group]', '$id_shab', '$id1', '$comp[name]', '$comp[position]', '$comp[stmat]', '$comp[strab]', '$comp[stsopmat]', '$comp[trud]', '$comp[razm]')") or die ("Not input_room potpokr");	
												$id_comp = mysql_insert_id();
	$foto = $id_comp . '.' . 'jpg';
if (!empty ($comp['foto']))
	{
	$filename = $comp['id'] . '.' . 'jpg';
		$source = 'img/images_components_shablon/' . $filename;
		$to = 'img/images_components_shablon/' . $foto;
		copy ($source, $to);
		$res = mysql_query("UPDATE `shab_components` SET `foto` = '$foto' WHERE `id` = '$id_comp'");

	}	}}

				

				header("Location: calculation.php");
				
} else {
				
					die ("Not id");
						}
		?>