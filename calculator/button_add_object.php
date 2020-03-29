<script language="JavaScript">
up = new Image(60,15); // 40 на 15 - размер кнопки в пикселях
up.src = "img/button_add_object/up.png"; // обычная кнопка 
down = new Image(60,15);
down.src = "img/button_add_object/down.png"; // кнопка при наведении курсора
click = new Image(60,15);
click.src = "img/button_add_object/click.png"; // кнопка при нажатии
function switchThis(object) { document.knopka.src=object.src; }
</script>

<img name = "knopka" border=0 SRC = "img/button_add_object/up.png" onMouseOver="switchThis(up)" onMouseOut="switchThis(down)" onClick="switchThis(click)">