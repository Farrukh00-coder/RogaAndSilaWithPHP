<?php

function getMenu(): array
{
	$menu = [
		[
			'title' => 'Главная',
			'path' => '/',
			'sort' => 3,
		],
		[
			'title' => 'Каталог',
			'path' => '/catalog/',
			'sort' => 10,
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

	return $menu;
}