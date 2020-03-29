
       <?php 
if (isset ($_GET['id']) && !empty ($_GET['id']) AND !isset ($_GET['cat']))

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
		

$result = mysql_query ("SELECT * FROM `shablons` WHERE `id` = $id");
$row = mysql_fetch_array ($result);
?>

<?php // show picture
if (!empty ($row['foto']) AND file_exists ('img/images_shablons/' . $id . '.' . 'jpg'))
{?>
<div align="center"><?php echo "<img src=\"img/images_shablons/" . $row['foto'] . "\" />"; ?></div><br />
<?php } 
	
		}


	?>
        