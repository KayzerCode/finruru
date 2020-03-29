<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Добавление элемента</title>


</head>
<link href="style_menu.css" rel="stylesheet" type="text/css" />

<body bgcolor="#CCCCCC">
<table border="1" cellpadding="0" cellspacing="10" width="1000" align="center" bgcolor="#FFFFFF" frame="box" bordercolor="#000000">
<!-- Header-->	
  <tr bordercolor="#FFFFFF">
    	<td colspan="2"><?php include ("header.php"); ?></td>
  </tr>
<!-- Main menu-->  
    <tr align="center" valign="middle" bgcolor="#E1E1E1">
   	  <td height="60">
   	  <?php include ("main_menu.php"); ?>
      </td>
    </tr>
<!-- Center block -->
    <tr>
		<td valign="top" bgcolor="#F1F1F1">
        
        <?php if (isset ($_GET['group']) AND !empty ($_GET['group']))



			{
            
$_GET['group'] = htmlspecialchars ($_GET['group']);
$_GET['elid'] = htmlspecialchars ($_GET['elid']);
$_GET['id_shab'] = htmlspecialchars ($_GET['id_shab']);
$_GET['id_room'] = htmlspecialchars ($_GET['id_room']);

if(get_magic_quotes_gpc()){ 
            $group = stripslashes($_GET['group']);
			$elid = stripslashes($_GET['elid']); 
			            $id_shab = stripslashes($_GET['id_shab']); 
			            $id_room = stripslashes($_GET['id_room']); 

        } else { 
            $group = addslashes($_GET['group']);
            $elid = addslashes($_GET['elid']); 
			            $id_shab = addslashes($_GET['id_shab']);
			$id_room = addslashes($_GET['id_room']); 

        } 
        $group = (int)$group;
		$elid = (int)$elid;

			if ($group == '0') {die ("Invalid group!!!!");}
			if ($elid == '0') {die ("Invalid element!!!!");}
			
			include ("bd.php");
			
$max1 = mysql_query ("SELECT * FROM `components` WHERE `group` = $group AND `elid` = $elid AND `position` = (SELECT MAX(position) FROM `components` WHERE `group` = $group AND `elid` = $elid)");
$row_max1 = mysql_fetch_array ($max1);
$pos = $row_max1['position'] + 1;?>
			<table cellspacing="10">
	<tr>
    	<td>
        	<div align="left"><a href="add_polpokr.php?id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>" title="К списку имеющихся слоёв"><?php include ("button_back.php");?></a></div>
        </td>
    </tr>
</table>
<div align="center"><form action="add_new_component_isp1.php" enctype="multipart/form-data" method="post">
<input type="hidden" name="group" value="<?php echo $group; ?>">
<input type="hidden" name="elid" value="<?php echo $elid; ?>">
<input type="hidden" name="id_shab" value="<?php echo $id_shab; ?>">
<input type="hidden" name="id_room" value="<?php echo $id_room; ?>">

<table>
	<tr>
    	<td>
<div align="left"><font color="#000000" size="+1"><em>Введите название нового компонента:&nbsp;&nbsp;&nbsp;</em></font>
		</div>
        </td>
        
        <td>
<div align="left"><input type="text" name="componentnaz" size="50"></div>
		</td>
     </tr>
     
     <tr>
     	<td>
<input type="hidden" name="position" value="<?php echo $pos; ?>">
<div align="left"><font color="#000000" size="+1"><em>Выберите размерность величин&nbsp;&nbsp;&nbsp;</em></font>
</div>
</td>
<td>
<div align="left"><select name="razm">
  <option selected="selected" value="м2">м2</option>
  <option value="пог.м.">пог.м.</option>
  <option value="шт.">шт.</option>
</select></div></td>
</tr>
<tr>
	<td>
<div align="left"><font color="#000000" size="+1"><em>Введите стоимость материала:&nbsp;&nbsp;&nbsp;</em></font></div>
	</td>
    
	<td>
<div align="left"><input type="text" name="stmat" id="a"> &euro;</div>
	</td>
</tr>

<tr>
	<td>
<div align="left"><font color="#000000" size="+1"><em>Введите стоимость работ:&nbsp;&nbsp;&nbsp;</em></font></div>
	</td>
    
    <td>
<div align="left"><input type="text" name="strab"> &euro;</div>
	</td>
</tr>

<tr>
	<td>
<div align="left"><font color="#000000" size="+1"><em>Введите стоимость дополнительных материалов:&nbsp;&nbsp;&nbsp;</em></font></div>
	</td>
    
    <td>
<div align="left"><input type="text" name="stsopmat"> &euro;</div>
	</td>
</tr>

<tr>
	<td>
<div align="left"><font color="#000000" size="+1"><em>Введите затраты труда на единицу материала:&nbsp;&nbsp;&nbsp;</em></font></div>
	</td>
    
    <td>
<div align="left"><input type="text" name="trud"> <font color="#000000" size="+1"><em>tth</em></font></div>
	</td>
</tr>

<tr>
	<td colspan="2" align="center">
<input type="file" name="strimg">
</td>
</tr>

<tr>
	<td colspan="2" align="center">
    <input type="submit" align="middle" value="Создать" /><input type="button" value="Отмена" onclick="location.href='add_polpokr.php?id_shab=<?php echo $id_shab;?>&amp;id_room=<?php echo $id_room;?>'" title="Отменить и вернуться к списку имеющихся слоёв"/>
    </td>
    </tr>
    </tr>
</table>
</form></div>
        
        <?php 
        	}
				else {die ("Error!!!");}
   
        
        ?>
        </td>
     </tr>
<!--Footer-->
	<tr>
        <td colspan="2" align="center" bgcolor="#E1E1E1" height="35" valign="middle"><?php include ("footer.php"); ?></td>
  </tr>
</table>

</body>
</html>
