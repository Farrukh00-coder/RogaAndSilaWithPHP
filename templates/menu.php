<?php

$menu = arraySort($data, 'sort', SORT_ASC);

// считаем количество массивов чтобы изменить каждое значение поля title
$i = 0;
foreach ($menu as $section) {
	if (mb_strlen($section['title']) > 15)
	{
		$menu[$i]['title'] = cutString($section['title'], 12, '...');
	} else {
		$menu[$i]['title'] = $section['title'];
	}
	$i++;
}

$url = "$_SERVER[REQUEST_URI]";
?>
<ul class="list-inside bullet-list-item flex flex-wrap justify-between -mx-5 -my-2">
	<?php foreach ($menu as $section): ?>
		<li class="px-5 py-2"><a class="<?php if ($url == $section['path']) {?>text-orange hover:text-orange<?php } else {?>text-gray-600 hover:text-orange<?php }?>" href="<?=$section['path'];?>"><?=$section['title'];?></a></li>
	<?php endforeach;?>
</ul>
