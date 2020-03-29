<?php
		include ("bd.php");
		
		$result = mysql_query ("SELECT * FROM `shablons` ORDER BY `id`");
		
		$count = mysql_num_rows ($result);
			
			if ($count < 1) {?> <div align="center">Пока нет ни одного расчёта!</div>
							<table align="center">
                            <tr>
                            	<td>
                            	<a href="add_shablon.php" title="Добавить новый расчёт"><?php include ("button_add_object.php");?></a>
                                </td>
                            </tr>
							</table><?php } else {?>
			
			<table align="center" cellpadding="10" border="0">
                        	<tr>
                            	
                                <td colspan="5" id="shab">
                                	Имеющиеся расчёты
                                </td>
                                
                            </tr>
		
		<?php while ($row = mysql_fetch_array ($result))
		
					{?>
						
                        	<tr>
                            	
                                <td>
                                	<a href="calc_shab.php?id=<?php echo $row['id'];?>" title="Название расчёта"><?php echo $row['name'];?></a>
                                </td>
                                
                                <td>
                                	<a href="edit_shablon.php?id=<?php echo $row['id'];?>" title="Редактировать название расчёта и приложенную к нему фотографию"><?php include ("button_edit.php");?></a>
                                </td>
                                
                                <td>
                                	<a href="delete_shablon.php?id=<?php echo $row['id'];?>" title="Удалить расчёт"><?php include ("button_delete.php");?></a>
                                </td>
                                
                                <td>
                                	<a href="clon_shablon.php?id=<?php echo $row['id'];?>" title="Клонировать расчёт"><?php include ("button_clone.php");?></a>
                                </td>
                                
                                <?php if (!empty ($row['foto'])) {?><td>
                                	<a href="foto_shablon.php?id=<?php echo $row['id'];?>" title="Приложенное изображение"><?php include ("button_foto.php");?></a>
                                </td><?php } else {?><td><div align="center">Без фото</div></td><?php }?>
                                
                            </tr>
                        
					<?php }
?>
							<tr>
                            	<td>
                            	<a href="add_shablon.php" title="Добавить новый расчёт"><?php include ("button_add_object.php");?></a>
                                </td>
                            </tr>
</table>
<?php }?>