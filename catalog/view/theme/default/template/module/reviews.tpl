<div class="box">
  <?php if ($header) {?>
  <div class="box-heading"><?php echo $header; ?></div>
  <?}?>
  <div class="box-content">
    <div class="box-reviews">
      <?php foreach ($reviews as $review) { ?>
      <div class="top">
        <?php if ($review['product_id']) {?>
          <?php if ($review['prod_thumb']) { ?>
          <div class="image"><a href="<?php echo $review['prod_href']; ?>"><img src="<?php echo $review['prod_thumb']; ?>" alt="<?php echo $review['prod_name']; ?>" title="<?php echo $review['prod_name']; ?>"/></a></div>
          <?php } ?>
          <div class="name"><a href="<?php echo $review['prod_href']; ?>"><?php echo $review['prod_name']; ?></a></div>
          <?}?>
        <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $review['rating']; ?>.png"/></div>
      </div>
      <div class="description"><?php echo $review['description']?> <a href="<?php echo $review['href']?>">...&raquo;</a></div>
      <div class="author"><?php echo $review['author']?></div>
      <?php } ?>
      <div class="all"><a href="<?php echo $link_all_reviews; ?>"><?php echo $text_all_reviews;?></a></div>
    </div>
  </div>
</div>
