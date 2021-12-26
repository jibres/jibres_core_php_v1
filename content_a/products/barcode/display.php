<div class="avand-md">
  <form method="get" autocomplete="off" action="<?php echo \dash\url::that() ?>">
    <div class="input search">
      <input type="search" name="q" placeholder="<?php echo T_("Search") ?>" id="q" value="" class="barCode" data-default="" data-pass="submit" autocomplete="off">
      <button class="addon btn-light3 s0">
        <span class="w-5"><?php echo \dash\utility\icon::svg('search') ?></span>
      </button>
    </div>
  </form>
</div>
<?php

$is_barcode_page = true;

require_once (root. 'content_a/products/home/ganje.php');
?>