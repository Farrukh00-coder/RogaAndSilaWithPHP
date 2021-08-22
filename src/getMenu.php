<?php
function getMenu() : array
{
	$menu = [
		[
			'title' => 'Главная',
			'path' => '/',
			'sort' => 3,
		],
		[
			'title' => 'Распродажа',
			'path' => '/sale/',
			'sort' => 9,
		],
		[
			'title' => 'Легковые',
			'path' => '/smallCars/',
			'sort' => 7,
		],
		[
			'title' => 'Внедорожники',
			'path' => '/bigCars/',
			'sort' => 6,
		],
	];


	if(isset($_SESSION['isAuth'])) {
		array_push($menu, ['title' => 'Каталог', 'path' => '/catalog/', 'sort' => 10,]);
	}

	$menu = arraySort($menu, 'sort', SORT_ASC);

	return $menu;
}
