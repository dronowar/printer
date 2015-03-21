<?php

return array(
    'maket_url' => 'Ссылка на макет',
    'papers' => 'Тип бумаги для печати',
    'w' => 'Ширина бумаги',
    'h' => 'Высота бумаги',
    'colors' => 'Количество красок',
    'quantity' => 'Число копий',
   	'color_count' => array(
		4 => 'цветное 4 краски',
		8 => 'цветное 8 красок',
		1 => 'чернобелое 1 краска',
 	),
 	'paper_id' => array(
 		1 => 'Фотобумага (тиснённая, глянцевая) EPSON, Japan 260 г/м2',
 		2 => 'Фотобумага (Сатин),190 г/м2 , Lomond',
 		3 => 'Холст (EPSON, Japan)',
 		4 => 'Фотобумага (матовая), EPSON, Japan 120 г/м2 360 dpi',
 		5 => 'Матовая бумага для инженерных работ, 90г/м2',
 	),
 	'paper_size_demension' => 'мм',
 	'delivery_provider_id' => array (
 		1 => 'Самовывоз',
 		2 => 'Постоматы',
 	),
 	'maket_status' => array (
 		0 => 'Макет на модерации',
        1 => 'Макет прошел модерацию',
    	2 => 'Макет не соответствует требованиям печати',
        ),
    'order_status' => array(
    	0 => 'Новый',
    	1 => 'Требуется оплата',
    	2 => 'В работе',
    	3 => 'Выполнен',
    	4 => 'Отправлен',
    	5 => 'Удален',
 		),
    'destroy_poster_success' => 'Постер успешно удален.',
    'update_maket_url_success' => 'Новая ссылка на макет отправлена.',
    'error' => 'Произошла ошибка. Попробуйте повторить позже.',

);