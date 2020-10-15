<form method="post" autocomplete="off" id='form1'>
<div class="avand-md">

      <section class="box">
        <div class="body">
          <label for="itagname"><?php echo T_("Title"); ?></label>
          <div class="input">
            <input type="text" name="title" id="itagname" placeholder='<?php echo T_("Tag name"); ?>' value="<?php echo \dash\data::dataRow_title(); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1" required>
          </div>

          <label for="itagslug"><?php echo T_("Slug"); ?></label>
          <div class="input">
            <input type="text" name="slug" id="itagslug" placeholder='<?php echo T_("Tag name"); ?>' value="<?php echo \dash\data::dataRow_slug(); ?>" maxlength='50' minlength="1" >
          </div>

        </div>

      </section>

      <section class="box">
      <div class="pad mB50">
        <label for="productid"><?php echo T_("Choose product to add product to this Tag"); ?></label>
        <div>
          <select name="add_product_id" class="select22" data-model='html'  <?php \dash\layout\autofocus::html() ?> data-default data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::here(). '/sale'; ?>?json=true' data-placeholder='<?php echo T_("Search in products"); ?>'>
              </select>
        </div>
      </div>
      <footer class="f">
        <div class="cauto">
          <a class="btn link" href="<?php echo \dash\url::here(); ?>/products?tagid=<?php echo \dash\data::dataRow_id(); ?>">
              <span class="ltr"><?php echo \dash\fit::number(\dash\data::dataRow_count()) ?></span>
              <?php echo T_("Product founded by this tag"); ?>
            </a>

        </div>
        <div class="c"></div>
        <div class="cauto"><button class="btn master" name="add_product" value="add_product"><?php echo T_("Add"); ?></button></div>

      </footer>
    </section>

       <section class="box">
          <div class="pad">
            <?php if(!\dash\data::dataRow_count() && !\dash\data::dataRow_have_child()) {?>
            <p><?php echo T_("You can delete this tag because we are not found any product in that."); ?></p>
            <?php }else{ ?>
              <p><?php echo T_("You can delete this tag and merge all product in this tag by another tag."); ?></p>
            <?php }//endif ?>
          </div>
          <footer>
            <?php if(!\dash\data::dataRow_count() && !\dash\data::dataRow_have_child()) {?>
              <div class="txtRa"><span data-confirm data-data='{"delete" : "delete"}' class="btn linkDel" ><?php echo T_("Remove tag"); ?></span></div>
            <?php }else{ ?>
              <div class="txtRa"><a href="<?php echo \dash\url::this(). '/remove?'. \dash\request::fix_get() ?>" class="btn linkDel" ><?php echo T_("Remove tag"); ?></a></div>
            <?php }//endif ?>
          </footer>
        </section>
    <nav class="items long hide">
      <ul>
          <li>
            <a class="f item" href="<?php echo \dash\url::here(); ?>/products?tagid=<?php echo \dash\data::dataRow_id(); ?>">
              <div class="key"><?php echo T_("Show products by this tag"); ?></div>
              <div class="value"><?php echo \dash\fit::number(\dash\data::dataRow_count()) ?></div>
              <div class="go"></div>
            </a>
          </li>
      </ul>
    </nav>

    </div>

</div>
</form>
