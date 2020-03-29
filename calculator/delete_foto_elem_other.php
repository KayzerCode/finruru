<?php if (isset ($_GET['group']) && !empty ($_GET['group']))

	{
		
		
$_GET['group'] = htmlspecialchars ($_GET['group']);
$_GET['id_shab'] = htmlspecialchars ($_GET['id_shab']);
$_GET['elid'] = htmlspecialchars ($_GET['elid']);

if(get_magic_quotes_gpc()){ 
            $group = stripslashes($_GET['group']);
			$id_shab = stripslashes($_GET['id_shab']); 
			$elid = stripslashes($_GET['elid']);
 

        } else { 
            $group = addslashes($_GET['group']);
			$id_shab = addslashes($_GET['id_shab']);
			$elid = addslashes($_GET['elid']);
 

        } 
        $group = (int)$group;
			if ($group == '0') {die ("Invalid component!!!!");}

include("bd.php");  
$result1 = mysql_query("UPDATE `handbook_elements` SET `image` = ('') WHERE `id` = ('" . $elid .  "')");
$image = $elid . '.' . 'jpg';
$file = 'img/images_elements/' . $image;
unlink ($file);
header("Location: edit_element_other.php?id_shab=" . $id_shab . "&group=" . $group . "&elid=" . $elid); 

			}
?>