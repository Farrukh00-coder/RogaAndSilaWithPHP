<!-- <div class="bg-white w-full border border-gray-100 rounded overflow-hidden shadow-lg hover:shadow-2xl pt-4">
    <a class="block w-full h-40" href="#"><img class="w-full h-full hover:opacity-90 object-cover" src="<?=$car[$image]?>" alt="<?=$car[$name]?>"></a>
    <div class="px-6 py-4">
        <div class="text-black font-bold text-xl mb-2"><a class="hover:text-orange" href="#"><?=$car[$name]?></a></div>
        <p class="text-grey-darker text-base">
            <span class="inline-block"><?=$car[$price]?> ₽</span><span class="inline-block line-through pl-6 text-gray-400"><?=$car[$old_price]?> ₽</span>
        </p>
    </div>
</div> -->
<div class="bg-white w-full border border-gray-100 rounded overflow-hidden shadow-lg hover:shadow-2xl pt-4">
    <a class="block w-full h-40" href="#"><img class="w-full h-full hover:opacity-90 object-cover" src="<?=$data['image']?>" alt="<?=$data['name']?>"></a>
    <div class="px-6 py-4">
        <div class="text-black font-bold text-xl mb-2"><a class="hover:text-orange" href="#"><?=$data['name']?></a></div>
        <p class="text-grey-darker text-base">
            <span class="inline-block"><?=$data['price']?> ₽</span>
            <?php if ($data['old_price']) {?>
            <span class="inline-block line-through pl-6 text-gray-400"><?=$data['old_price']?> ₽</span> 
        	<?php }?>
        </p>
    </div>
</div>