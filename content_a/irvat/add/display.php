<form method="post" autocomplete="off"  enctype="multipart/form-data">
  <div class="avand">
    <div class="row">
      <div class="c-xs-12 c-sm-6 c-md-4">
        <div class="box">
          <header><h2><?php echo T_("Customer detail"); ?></h2></header>
          <div class="body">

            <?php if(\dash\data::dataRow_type() === 'income' || \dash\request::get('type') === 'income') {?>

              <?php if(\dash\get::index(\dash\data::dataRow(), 'customer_detail', 'user')) {?>
                <div class="msg">
                  <img src="<?php echo \dash\get::index(\dash\data::dataRow(), 'customer_detail', 'user', 'avatar'); ?>" class="avatar">
                  <?php echo \dash\get::index(\dash\data::dataRow(), 'customer_detail', 'user', 'displayname'); ?>
                  <?php echo \dash\get::index(\dash\data::dataRow(), 'customer_detail', 'legal_detail', 'companyname'); ?>
                </div>
              <?php } //endif ?>

              <select name="customer" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true&list=customer' data-shortkey-search data-placeholder='<?php echo T_("Choose customer"); ?>'>
              </select>
            <?php } // endif ?>


            <?php if(\dash\data::dataRow_type() === 'cost' || \dash\request::get('type') === 'cost') {?>

              <?php if(\dash\get::index(\dash\data::dataRow(), 'seller_detail', 'user')) {?>
                <div class="msg">
                  <img src="<?php echo \dash\get::index(\dash\data::dataRow(), 'seller_detail', 'user', 'avatar'); ?>" class="avatar">
                  <?php echo \dash\get::index(\dash\data::dataRow(), 'seller_detail', 'user', 'displayname'); ?>
                  <?php echo \dash\get::index(\dash\data::dataRow(), 'seller_detail', 'legal_detail', 'companyname'); ?>
                </div>
              <?php } //endif ?>
              <select name="seller" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true&list=customer' data-shortkey-search data-placeholder='<?php echo T_("Choose seller"); ?>'>
              </select>

            <?php } // endif ?>


          </div>
        </div>

        <div class="box">
          <header><h2><?php echo T_("Upload Documents"); ?></h2></header>
          <div class="body">

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
              <input type="file" name="gallery">

              <label id="productGallery" for="file1"><?php echo T_("Add file"); ?> <small class="fc-mute"><?php echo T_("Maximum file size"). ' '. \dash\data::maxUploadSize(); ?></small></label>

              <div data-uploader data-name='gallery1' data-ratio=1 data-ratio-free data-autoSend>
                <input type="file"  id="file1">
                <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
              </div>

            </div>
          </div>
        </div>



      </div>
      <div class="c-xs-12 c-sm-6 c-md-8">

        <div  class="box impact" >
          <?php if(\dash\request::get('type') === 'cost') {?>
            <header><h2><?php echo T_("Add new cost"); ?></h2></header>
          <?php }elseif(\dash\request::get('type') === 'income'){ ?>
            <header><h2><?php echo T_("Add new income"); ?></h2></header>
          <?php }else{ ?>
            <header><h2><?php echo T_("Add new factor"); ?></h2></header>
          <?php } ?>

          <div class="body">

            <label for="title"><?php echo T_("Title"); ?></label>
            <?php if(!\dash\data::titleList()) {?>
              <div class="input">
                <input type="text" name="title" value="<?php echo \dash\data::dataRow_title(); ?>" id="title" maxlength="100" >
              </div>
            <?php }else{ ?>
              <select name="title" id="title" class="select22" data-model='tag' >
                <option></option>

                <?php foreach (\dash\data::titleList() as $key => $value) {?>

                  <option value="<?php echo $value; ?>" <?php if($value == \dash\data::dataRow_title()) { echo 'selected'; } ?> ><?php echo $value; ?></option>

                <?php } //endfor ?>
              </select>
            <?php } //endif ?>



            <div class="row">
              <div class="c-md-6">
                <label for="code"><?php echo T_("Internal code"); ?></label>
                <div class="input ltr">
                  <input type="text" name="code" value="<?php echo \dash\data::dataRow_code(); ?>" id="code" maxlength="100" >
                </div>
              </div>
              <div class="c-md-6">
                <label for="serialnumber"><?php echo T_("Factor serial number"); ?></label>
                <div class="input ltr">
                  <input type="text" name="serialnumber" value="<?php echo \dash\data::dataRow_serialnumber(); ?>" id="serialnumber" maxlength="100" >
                </div>
              </div>
            </div>

            <label for="factordate" ><?php echo T_("Factor date"); ?> <b><?php echo T_("yyyy/mm/dd"); ?></b></label>
            <div class="input">
              <input class="ltr" type="text" placeholder="yyyy/mm/dd" data-format="date" name="factordate" value="<?php echo \dash\data::dataRow_factordate_raw(); ?>" id="factordate" value="<?php echo \dash\request::get('date'); ?>" autocomplete='off'>
            </div>








            <label for="total"><?php echo T_("Total factor price"); ?></label>
            <div class="input ltr">
              <input type="text" name="total" value="<?php echo \dash\data::dataRow_total(); ?>" id="total" max="9999999" data-format='price'>
            </div>


            <div class="row">
              <div class="c-md-6">

                <label for="subtotalitembyvat"><?php echo T_("Sub total item by vat"); ?></label>
                <div class="input ltr">
                  <input type="text" name="subtotalitembyvat" value="<?php echo \dash\data::dataRow_subtotalitembyvat(); ?>" id="subtotalitembyvat" max="9999999" data-format='price'>
                </div>

              </div>
              <div class="c-md-6">

                <label for="sumvat"><?php echo T_("Sum vat"); ?></label>
                <div class="input ltr">
                  <input type="text" name="sumvat" value="<?php echo \dash\data::dataRow_sumvat(); ?>" id="sumvat" max="9999999" data-format='price'>
                </div>

              </div>
            </div>



            <div class="row">
              <div class="c-md-6">
                <label for="items"><?php echo T_("Items count"); ?></label>
                <div class="input ltr">
                  <input type="text" name="items" value="<?php echo \dash\data::dataRow_items(); ?>" id="items" max="9999999" data-format='price'>
                </div>
              </div>
              <div class="c-md-6">
                <label for="itemsvat"><?php echo T_("Item count by vat"); ?></label>
                <div class="input ltr">
                  <input type="text" name="itemsvat" value="<?php echo \dash\data::dataRow_itemsvat(); ?>" id="itemsvat" max="9999999" data-format='price'>
                </div>
              </div>
            </div>




            <div class="row">
              <div class="c-md-6">


                <div class="switch1 mB20">
                  <input type="checkbox" name="official" id="official"  <?php if(\dash\data::dataRow_official()) { echo 'checked'; } ?> >
                  <label for="official" data-on="<?php echo T_("YES") ?>" data-off="<?php echo T_("NO") ?>"></label>
                  <label for="official"><?php echo T_("Official factor?"); ?></label>
                </div>

              </div>
              <div class="c-md-6">

                <div class="switch1 mB20">
                  <input type="checkbox" name="vat" id="vat"  <?php if(\dash\data::dataRow_vat()) { echo 'checked'; } ?> >
                  <label for="vat" data-on="<?php echo T_("YES") ?>" data-off="<?php echo T_("NO") ?>"></label>
                  <label for="vat"><?php echo T_("Are you want to calculate in vat result?"); ?></label>
                </div>
              </div>
            </div>



            <div class="mB20">
              <label for="desc"><?php echo T_("Description"); ?></label>
              <textarea id="desc" name="desc" class="txt" rows="5"><?php echo \dash\data::dataRow_desc(); ?></textarea>
            </div>




          </div>

          <footer class="txtRa">
            <?php if(\dash\url::child() === 'edit') {?>
              <button class="btn primary"><?php echo T_("Edit"); ?></button>
            <?php }else{ ?>
              <button class="btn success"><?php echo T_("Add"); ?></button>
            <?php } //endif ?>
          </footer>
        </div>


      </div>
    </div>
  </div>
</form>

