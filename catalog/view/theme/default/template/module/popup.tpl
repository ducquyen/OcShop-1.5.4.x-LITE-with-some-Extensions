<?php if ($popup_status == 'cart') { ?><div id="pop_up_cart">
	<div class="heading">
		<h4><?php echo $heading_title; ?></h4>		</div>
  <div class="content">
    <?php if ($products || $vouchers) { ?>
    <div class="mini-cart-info">
      <table>
        <?php foreach ($products as $product) { ?>
        <tr>
          <td class="image"><?php if ($product['thumb']) { ?>
            <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
            <?php } ?></td>
          <td class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
            <div>
              <?php foreach ($product['option'] as $option) { ?>
              - <small><?php echo $option['name']; ?> <?php echo $option['value']; ?></small><br />
              <?php } ?>
            </div></td>
          <td class="quantity">x&nbsp;<?php echo $product['quantity']; ?></td>
          <td class="total"><?php echo $product['total']; ?></td>
          <td class="remove"><img src="catalog/view/theme/default/image/remove-small.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" onclick="$('#info').load('index.php?route=module/popup/minicart&remove=<?php echo $product['key']; ?> #pop_up_cart > *'); $('#cart').load('index.php?route=module/cart&remove=<?php echo $product['key']; ?> #cart > *'); $('#intro').remove(); " /></td>
        </tr>
        <?php } ?>
        <?php foreach ($vouchers as $voucher) { ?>
        <tr>
          <td class="image"></td>
          <td class="name"><?php echo $voucher['description']; ?></td>
          <td class="quantity">x&nbsp;1</td>
          <td class="total"><?php echo $voucher['amount']; ?></td>
          <td class="remove"><img src="catalog/view/theme/default/image/remove-small.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" onclick="$('#info').load('index.php?route=module/popup/minicart&remove=<?php echo $voucher['key']; ?> #pop_up_cart > *'); reloadTotal();$('#cart').load('index.php?route=module/cart&remove=<?php echo $voucher['key']; ?> #cart > *'); $('#intro').remove(); " /></td>
        </tr>
        <?php } ?>
      </table>
    </div>
    <div class="mini-cart-total">
      <table>
        <?php foreach ($totals as $total) { ?>
        <tr>
          <td align="right"><b><?php echo $total['title']; ?>:</b></td>
          <td align="right"><?php echo $total['text']; ?></td>
        </tr>
        <?php } ?>
      </table>
    </div>	
    <div class="checkout"><div class="checkout-skip"><a class="button" onclick="$('#cart-success, .blackout').remove();"><?php echo $text_skip; ?></a></div> <div class="checkout-success"><a class="button" href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a></div></div>
    <?php } else { ?>
    <div class="empty"><?php echo $text_empty; ?></div>
    <?php } ?>
  </div>
</div><?php } ?>
<?php if ($popup_status == 'wish') { ?><div id="pop_up"><div class="content"><div class="checkout-wc"><div class="wishlist-skip"><a class="button" onclick="$('#cart-success, .blackout').remove();"><?php echo $text_skip; ?></div><div class="checkout-success"><a class="button" href="<?php echo $url_wishlist; ?>"><?php echo $text_wishlist; ?></a></div></div></div></div><?php } ?><?php if ($popup_status == 'compare') { ?><div id="pop_up"><div class="content"><div class="checkout-wc"><div class="compare-skip"><a class="button" onclick="$('#cart-success, .blackout').remove();"><?php echo $text_skip; ?></div><div class="checkout-success"><a class="button" href="<?php echo $url_compare; ?>"><?php echo $text_wishlist; ?></a></div></div></div></div><?php } ?>		