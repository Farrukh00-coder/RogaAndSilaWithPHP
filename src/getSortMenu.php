<?php

function getSortMenu($params) : array
{
	$menu = arraySort($params, 'sort', SORT_ASC);
	
	// считаем количество массивов чтобы изменить каждое значение поля title
	$i = 0;
	foreach ($menu as $section) {
		// если пользователь не зарегистрирован то удаляем каталог из меню
		if (!isset($_SESSION['isAuth']) && $section['title'] == 'Каталог') {
			unset($menu[$i]);
			continue;
		}
		if (mb_strlen($section['title']) > 15) {
			$menu[$i]['title'] = cutString($section['title'], 12, '...');
		} else {
			$menu[$i]['title'] = $section['title'];
		}
		$i++;
	}
	return $menu;
}