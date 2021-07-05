<?php

$menu = getSortMenu($data);

?>
<ul class="list-inside bullet-list-item flex flex-wrap justify-between -mx-5 -my-2">
	<?php foreach ($menu as $section): ?>
		<li class="px-5 py-2"><a class="<?php if (isCurrentUrl($section['path'])) {?>text-orange hover:text-orange<?php } else {?>text-gray-600 hover:text-orange<?php }?>" href="<?=$section['path'];?>"><?=$section['title'];?></a></li>
	<?php endforeach;?>
</ul>
