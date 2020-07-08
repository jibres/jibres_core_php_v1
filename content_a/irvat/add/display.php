
<div class="f justify-center">
  <div class="c6 m8 s12">

    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Add new factor"); ?></h2></header>

      <div class="body">

        <label for="title"><?php echo T_("Title"); ?></label>
        <div class="input">
          <input type="text" name="title" value="<?php echo \dash\data::dataRow_title(); ?>" id="title" maxlength="100" >
        </div>


        <label for="code"><?php echo T_("Internal code"); ?></label>
        <div class="input ltr">
          <input type="text" name="code" value="<?php echo \dash\data::dataRow_code(); ?>" id="code" maxlength="100" >
        </div>

        <label for="serialnumber"><?php echo T_("Factor serial number"); ?></label>
        <div class="input ltr">
          <input type="text" name="serialnumber" value="<?php echo \dash\data::dataRow_serialnumber(); ?>" id="serialnumber" maxlength="100" >
        </div>

        <label for="factordate" ><?php echo T_("Factor date"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>
        <div class="input">
          <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="factordate" value="<?php echo \dash\data::dataRow_factordate_raw(); ?>" id="factordate" value="<?php echo \dash\request::get('date'); ?>" autocomplete='off'>
        </div>


        <div class="f mB10">
          <div class="c pB10 pRa5">
            <div class="radio3">
              <input type="radio" name="type" value="cost" id="cost"  <?php if(\dash\data::dataRow_type() === 'cost') { echo 'checked';} ?>>
              <label for="cost"><?php echo T_("Cost"); ?></label>
            </div>
          </div>
          <div class="c pB10">
            <div class="radio3">
              <input type="radio" name="type" value="income" id="incom" <?php if(\dash\data::dataRow_type() === 'income') { echo 'checked';} ?>>
              <label for="incom"><?php echo T_("Income"); ?></label>
            </div>
          </div>
        </div>


        <div data-response='type' data-response-where='incom' <?php if(\dash\data::dataRow_type() === 'income') {}else{ echo 'data-response-hide';} ?> >
          <select name="customer" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true&list=customer' data-shortkey-search data-placeholder='<?php echo T_("Choose customer"); ?>'>
          </select>
        </div>

        <div data-response='type' data-response-where='cost' <?php if(\dash\data::dataRow_type() === 'cost') {}else{ echo 'data-response-hide';} ?>>
          <select name="seller" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true&list=customer' data-shortkey-search data-placeholder='<?php echo T_("Choose seller"); ?>'>
          </select>
        </div>


        <label for="total"><?php echo T_("Total factor price"); ?></label>
        <div class="input ltr">
          <input type="text" name="total" value="<?php echo \dash\data::dataRow_total(); ?>" id="total" max="9999999" data-format='price'>
        </div>

        <label for="subtotalitembyvat"><?php echo T_("Sub total item by vat"); ?></label>
        <div class="input ltr">
          <input type="text" name="subtotalitembyvat" value="<?php echo \dash\data::dataRow_subtotalitembyvat(); ?>" id="subtotalitembyvat" max="9999999" data-format='price'>
        </div>

        <label for="sumvat"><?php echo T_("Sum vat"); ?></label>
        <div class="input ltr">
          <input type="text" name="sumvat" value="<?php echo \dash\data::dataRow_sumvat(); ?>" id="sumvat" max="9999999" data-format='price'>
        </div>

        <label for="items"><?php echo T_("Items count"); ?></label>
        <div class="input ltr">
          <input type="text" name="items" value="<?php echo \dash\data::dataRow_items(); ?>" id="items" max="9999999" data-format='price'>
        </div>

        <label for="itemsvat"><?php echo T_("Item count by vat"); ?></label>
        <div class="input ltr">
          <input type="text" name="itemsvat" value="<?php echo \dash\data::dataRow_itemsvat(); ?>" id="itemsvat" max="9999999" data-format='price'>
        </div>



        <div class="switch1 mB20">
          <input type="checkbox" name="official" id="official"  <?php if(\dash\data::dataRow_official()) { echo 'checked'; } ?> >
          <label for="official" data-on="<?php echo T_("YES") ?>" data-off="<?php echo T_("NO") ?>"></label>
          <label for="official"><?php echo T_("Official factor?"); ?></label>
        </div>

        <div class="switch1 mB20">
          <input type="checkbox" name="vat" id="vat"  <?php if(\dash\data::dataRow_vat()) { echo 'checked'; } ?> >
          <label for="vat" data-on="<?php echo T_("YES") ?>" data-off="<?php echo T_("NO") ?>"></label>
          <label for="vat"><?php echo T_("Are you want to calculate in vat result?"); ?></label>
        </div>


        <div class="mB20">
          <label for="desc"><?php echo T_("Description"); ?></label>
          <textarea id="desc" name="desc" class="txt" rows="5"><?php echo \dash\data::dataRow_desc(); ?></textarea>
        </div>

        <?php if(\dash\url::child() === 'edit') {?>


          <div class="pad jboxGallery">

            <?php if(\dash\data::dataRow_gallery_array()) {?>

              <div class="f">
                <?php foreach (\dash\data::dataRow_gallery_array() as $key => $value) {?>
                  <div class="cauto pA5 pB10">
                    <div class="w150">
                      <img src="<?php echo \dash\get::index($value, 'path'); ?>" alt="<?php echo \dash\get::index($value, 'id'); ?>">
                      <div>
                        <a data-ajaxify data-method='post' data-refresh data-autoScroll2=".jboxGallery" data-data='{"fileaction": "remove", "fileid" : "<?php echo \dash\get::index($value, 'id'); ?>"}'><i class="sf-times fc-red"></i></a>

                      </div>
                    </div>
                  </div>
                <?php } //endfor ?>
              </div>
            <?php } //endif ?>

            <label id="productGallery" for="file1"><?php echo T_("Add file"); ?> <small class="fc-mute"><?php echo T_("Maximum file size"). ' '. \dash\data::maxUploadSize(); ?></small></label>

            <div data-uploader data-name='gallery' data-ratio=1 data-ratio-free data-autoSend>
              <input type="file"  id="file1">
              <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
            </div>

          </div>
        <?php } // endif ?>


      </div>

      <footer class="txtRa">
        <?php if(\dash\url::child() === 'edit') {?>
          <button class="btn primary"><?php echo T_("Edit"); ?></button>
        <?php }else{ ?>
          <button class="btn success"><?php echo T_("Add"); ?></button>
        <?php } //endif ?>
      </footer>
    </form>
  </div>
</div>

