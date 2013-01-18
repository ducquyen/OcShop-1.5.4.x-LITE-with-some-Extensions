<div>
  <div class="box-content-home">
    <div class="box-mchome">
        <?php foreach ( array_slice($categories, 0, 9) as $category) { ?>
        <div class="mchome">
        <a href="<?php echo $category['href']; ?>"><img src="<?php echo $category['thumb']; ?>"></a>
        <?php if ($category['category_id'] == $category_id) { ?>
        <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
        <?php } else { ?>
        <h3><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></h3>
        <?php } ?>
        <?php if ($category['children']) { ?>
        <ul>
        <?php foreach ( array_slice($category['children'], 0, 7) as $child) { ?>
        <li>
        <?php if ($child['category_id'] == $child_id) { ?>
        <a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a>
        <?php } else { ?>
        <a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a>
        <?php } ?>
        </li>
        <?php } ?>
        <li class="active"><a href="<?php echo $category['href']; ?>">Все <?php echo $category['name']; ?>&nbsp;&rarr;</a></li>
        </ul>
        <?php } ?>
        </div>
        <?php } ?>
    </div>
  </div>
</div>
