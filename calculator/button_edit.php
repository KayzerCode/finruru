<script language="JavaScript">
up = new Image(40,15); // 40 на 15 - размер кнопки в пикселях
up.src = "img/button_edit/up.png"; // обычная кнопка 
down = new Image(40,15);
down.src = "img/button_edit/down.png"; // кнопка при наведении курсора
click = new Image(40,15);
click.src = "img/button_edit/click.png"; // кнопка при нажатии
function switchThis(object) { document.knopka.src=object.src; }
</script>
<!--<SCRIPT LANGUAGE="JavaScript">
<!--
function new_window2()
{
window.open('edit_object.php?cat=<?php echo $cat;?>&id=<?php echo $row['id'];?>','newwin','top=250, left=500, menubar=0, toolbar=0, location=0, directories=0, status=0, scrollbars=0, resizable=0, width=500, height=500');
}
// 
</SCRIPT>--><img name = "knopka" border=0 SRC = "img/button_edit/up.png" onMouseOver="switchThis(up)" onMouseOut="switchThis(down)" onClick="switchThis(click)">