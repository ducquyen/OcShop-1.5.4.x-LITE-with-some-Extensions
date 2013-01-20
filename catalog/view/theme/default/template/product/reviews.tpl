<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <?php if ($reviews) { ?>
  <div class="product-list">
    <?php foreach ($reviews as $review) { ?>
    <div class="reviews">
      <?php if ($review['prod_thumb']) { ?>
      <div class="image"><a href="<?php echo $review['prod_href']; ?>"><img src="<?php echo $review['prod_thumb']; ?>" title="<?php echo $review['prod_name']; ?>" alt="<?php echo $review['prod_name']; ?>" /></a></div>
      <?php } ?>
      <div class="name">
        <?php if ($review['rating']) { ?>
          <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $review['rating']; ?>.png" /></div>
        <?php } ?>
        <a href="<?php echo $review['prod_href']; ?>"><?php echo $review['prod_name']; ?></a>
      </div>
      <div class="description"><?php echo $review['description']; ?></div>
      <div class="added"><?php echo $review["date_added"];?></div>
	  <div class="author"><?php echo $review["author"];?></div>
    </div>
    <?php } ?>
  </div>
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } else { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <?php }?>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>