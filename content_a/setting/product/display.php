<?php $urlHere = \dash\url::here(); ?>


<section class="f" data-option='product-tag'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Tag of products") ?></h3>
      <div class="body">
        <p></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
      <a class="btn primary" href="<?php echo $urlHere. '/tag' ?>"><?php echo T_("Tag of products") ?></a>
    </div>
  </div>
  <footer class="txtRa">
    <a class="link" href="<?php echo \dash\url::that(). '/tag' ?>"><?php echo T_("Add tag to all product"); ?></a>
  </footer>
</section>

<section class="f" data-option='product-unit'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Product Units") ?></h3>
      <div class="body">
        <p></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
      <a class="btn primary" href="<?php echo $urlHere. '/units' ?>"><?php echo T_("Product Units") ?></a>
    </div>
  </div>
</section>



<section class="f" data-option='product-import'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Import products") ?></h3>
      <div class="body">
        <p></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
      <a class="btn primary" href="<?php echo $urlHere; ?>/products/import"><?php echo T_("Import") ?></a>
    </div>
  </div>
</section>


<section class="f" data-option='product-export'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Export products") ?></h3>
      <div class="body">
        <p></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
      <a class="btn primary" href="<?php echo $urlHere; ?>/products/export"><?php echo T_("Export") ?></a>
    </div>
  </div>
</section>


<section class="f" data-option='product-viewtext' id="setting-product-viewtext">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Product Default view text") ?></h3>
      <div class="body">
        <p></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
      <a class="btn primary" href="<?php echo \dash\url::that(); ?>/viewtext"><?php echo T_("Set") ?></a>
    </div>
  </div>
</section>





<section class="f" data-option='product-setting-default-comment' id="setting-product-comment">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Product comments");?></h3>
      <div class="body">
        <p><?php echo T_("Is it possible to receive comment from customers for each product?");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>

      <div class="action">
        <input type="hidden" name="runaction_comment" value="1">
        <div class="switch1">
          <input type="checkbox" name="comment" id="comment" <?php if(a(\dash\data::productSettingSaved(), 'comment')) { echo 'checked'; } ?>>
          <label for="comment" data-on="<?php echo T_("Open"); ?>" data-off="<?php echo T_("Lock") ?>"></label>
        </div>
      </div>

  </form>
</section>





<section class="f" data-option='product-setting-image-ratio' id="setting-product-image-ratio">
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Image ratio");?></h3>
      <div class="body">
        <p><?php echo T_("Set default image ratio");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
      <div class="action">
        <input type="hidden" name="runaction_ratio" value="1">
        <select class="select22" name="ratio">
          <?php echo \lib\ratio::select_html(\dash\data::productSettingSaved_ratio(), 'products'); ?>
        </select>
      </div>
  </form>
</section>



<section class="f" data-option='product-setting-time'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set Preparation time");?></h3>
      <div class="body">
        <p><?php echo T_("If it takes time for your product to be ready and can be sent to the customer, enter the time in this field. Of course, each product has a separate preparation time, which in the order of the time entered here is added to the product preparation time.");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <div class="action">
      <a class="btn primary" href="<?php echo \dash\url::that(). '/preparationtime' ?>"><?php echo T_("Set Preparation time");?></a>
    </div>
  </form>
</section>




