<?php

foreach ($data as $key => $section) {
		if (mb_strlen($section['title']) > 15) {
			$data[$key]['title'] = cutString($section['title'], 12, '...');
		} else {
			$data[$key]['title'] = $section['title'];
		}
	}

?>
<ul class="list-inside bullet-list-item flex flex-wrap justify-between -mx-5 -my-2">
	<?php foreach ($data as $section): ?>
		<li class="px-5 py-2"><a class="<?php if (isCurrentUrl($section['path'])) {?>text-orange hover:text-orange<?php } else {?>text-gray-600 hover:text-orange<?php }?>" href="<?=$section['path'];?>"><?=$section['title'];?></a></li>
	<?php endforeach;?>
</ul>
