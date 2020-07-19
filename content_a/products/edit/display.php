<?php
$storData = \dash\data::store_store_data();
$productDataRow = \dash\data::productDataRow();
?>


<form class="jPage f" method="post" autocomplete="off" data-refresh data-autoScroll2="#productGallery">
  <button class="hide"  name="submitall" type="submit" value="master"><?php echo T_("Save"); ?></button>
  <div class="c8 x9 s12 pRa10">
    <section class="jbox pad">
      <header class="hide" data-kerkere='.jboxCodes' data-kerkere-icon='open'><h2><?php echo T_("Title"); ?></h2></header>
      <div class="input mB10">
        <input type="text" name="title" id="title" placeholder='<?php echo T_("Product Title"); ?> *' value="<?php echo \dash\get::index($productDataRow,'title'); ?>" maxlength='200' <?php \dash\layout\autofocus::html() ?> <?php if(\dash\data::productDataRow_parent()) { echo 'disabled';} ?>>
        <span class="addon" data-kerkere='.subTitle' <?php if(\dash\data::productDataRow_title2()) {?> data-kerkere-icon='open' <?php }else{ ?> data-kerkere-icon <?php }//endif ?>><?php echo T_("Technical title"); ?></span>
      </div>
      <div class="subTitle" data-kerkere-content='<?php if(\dash\data::productDataRow_title2()) {echo 'show'; }else{ echo 'hide'; } ?>'>
        <div class="input mB10">
          <input type="text" name="title2" id="title2" placeholder='<?php echo T_("Enter technical title here"); ?>' value="<?php echo \dash\data::productDataRow_title2(); ?>" maxlength='300' minlength="1" pattern=".{1,300}">
        </div>
      </div>
    </section>
    <section class="jbox">
      <header class="hide" data-kerkere='.jboxPrice' data-kerkere-icon='open'><h2><?php echo T_("Pricing Model"); ?></h2></header>
      <div class="pad jboxPrice">
        <div class="f" data-response='type' data-response-where='product' <?php if(!$productDataRow || \dash\data::productDataRow_type() === 'product'){}else{ echo 'data-response-hide';}?>  >
          <div class="c s12 pRa5">
            <label for='buyprice'><?php echo T_("Buy cost"); ?></label>
            <div class="input fix ltr">
              <input type="text" name="buyprice" id="buyprice" data-format='price' value="<?php echo \dash\get::index($productDataRow,'buyprice'); ?>" maxlength="15" data-run-input='calcProductMargin'>
            </div>
          </div>
          <div class="c s12">
            <div class="grossProfitMargin hideIn">
              <label for='buyprice'><?php echo T_("Gross profit"); ?></label>
              <div class="msg h36" data-percent='11'>
                <div class="f">
                  <div class="c"></div>
                  <div class="cauto"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="f mB10">
          <div class="c s12 pRa5">
            <label for='price'><?php echo T_("Sale Price"); ?></label>
            <div class="input fix ltr mB5-f">
              <input type="text" name="price" id="price" data-format='price' value="<?php echo \dash\get::index($productDataRow,'price'); ?>" maxlength="15" data-run-input='calcProductMargin'>
            </div>
          </div>
          <div class="c s12">
            <label for='discount'><?php echo T_("Discount"); ?></label>
            <div class="input fix ltr mB5-f">
              <input type="text" name="discount" id="discount" data-format='price' value="<?php echo \dash\get::index($productDataRow,'discount'); ?>" maxlength="15" data-run-input='calcProductMargin'>
              <div class="addon fs09" id='discountRate'></div>
            </div>
          </div>
        </div>

        <?php if(isset($storData['tax_status']) && $storData['tax_status']) {?>
          <div class="msg h36 dark2">
            <div class="f align-center">
              <div class="c pRa5">
                <div class="check1 mB0">
                  <input type="checkbox" name="vat" id="vat" data-rate='0.09' data-run-input='calcProductMargin' <?php if(\dash\data::productDataRow_vat()) { echo 'checked'; } ?> >
                  <label for="vat"><?php echo T_("Charge taxes"); ?><span class="compact mLa10 txtB"><?php echo \dash\fit::number(9); ?>%</span></label>
                </div>
              </div>
              <div class="cauto"><?php echo T_("VAT"); ?></div>
              <div class="cauto ltr txtL pLR5" id="vatCost"></div>
              <div class="cauto"><?php echo \dash\get::index($storData,'currency_detail','symbol_native'); ?></div>
            </div>
          </div>
        <?php } //endif ?>
        <div>
          <div class="msg mT10">
            <div class="f">
              <div class="cauto"><?php echo T_("Final Price"); ?></div>
              <div class="c ltr txtL pLR5" id="finalPrice"><?php echo \dash\get::index($productDataRow,'finalprice'); ?></div>
              <div class="cauto" id="moneyUnit"><?php echo \dash\get::index($storData,'currency_detail','symbol_native'); ?></div>
            </div>
          </div>
          <?php if(\dash\language::current() === 'fa') {?>
            <div class="msg info2 txtB finalPriceToman"></div>
          <?php } //endif ?>
        </div>
      </div>
    </section>
    <?php if(!\dash\detect\device::detectPWA()) {?>
    <section class="jbox">
      <div class="pad">
        <textarea name="desc" data-editor class="txt" rows="3" maxlength="2000" placeholder='<?php echo T_("Description"); ?>'><?php echo \dash\get::index(\dash\data::productDataRow(),'desc'); ?></textarea>
      </div>
    </section>
    <?php  } //endif ?>

    <section class="jbox">
      <div class="pad">
        <?php if(\dash\data::productDataRow_gallery_array()) {?>
          <div class="f">
            <?php foreach (\dash\data::productDataRow_gallery_array() as $key => $value) {?>

              <?php if(isset($value['path']) && $value['path'] == \dash\data::productDataRow_thumb()) {?>

                <div class="cauto pA5 pB10">
                  <div class="w150">
                    <img src="<?php echo \dash\get::index($value, 'path'); ?>" alt="<?php echo \dash\get::index($value, 'id'); ?>">
                    <div>
                      <a data-ajaxify data-method='post' data-refresh data-autoScroll2=".jboxGallery" data-data='{"fileaction": "remove", "fileid" : "<?php echo \dash\get::index($value, 'id'); ?>"}'><i class="sf-times fc-red"></i></a>
                    </div>
                  </div>
                </div>
              <?php } //endif ?>
            <?php } //endfor ?>
            <?php foreach (\dash\data::productDataRow_gallery_array() as $key => $value) {?>
              <?php if(isset($value['path']) && $value['path'] != \dash\data::productDataRow_thumb()) {?>
                <div class="cauto pA5 pB10">
                  <div class="w150">
                    <img src="<?php echo \dash\get::index($value, 'path'); ?>" alt="<?php echo \dash\get::index($value, 'id'); ?>">
                    <div>
                      <a data-ajaxify data-method='post' data-refresh data-autoScroll2=".jboxGallery" data-data='{"fileaction": "remove", "fileid" : "<?php echo \dash\get::index($value, 'id'); ?>"}'><i class="sf-times fc-red"></i></a>
                      <a data-ajaxify data-method='post' data-refresh data-autoScroll2=".jboxGallery" data-data='{"fileaction": "setthumb", "fileid" : "<?php echo \dash\get::index($value, 'id'); ?>"}' class="floatRa btn sm"><i class="sf-monitor-screen-1"></i> <span class="pRa5"><?php echo T_("Set as cover"); ?></span></a>
                    </div>
                  </div>
                </div>
              <?php } //endif ?>

            <?php } //endfor ?>
          </div>
        <?php } //endif ?>
        <?php if(is_array(\dash\data::productDataRow_gallery_array()) && count(\dash\data::productDataRow_gallery_array()) > 10) {?>
          <div class="msg minimal mB0 warn2"><?php echo T_("Product gallery is full!"); ?></div>
        <?php }else{ ?>
          <div data-uploader data-name='gallery' <?php echo \dash\data::productImageRatioHtml(); ?> <?php if(\dash\url::child() === 'edit') { echo 'data-autoSend'; }?>>
            <input type="file"  id="file1">
            <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?> <small class="fc-mute"><?php echo T_("Maximum file size"). ' '. \dash\data::maxUploadSize(); ?></small></label>
          </div>
        <?php } //endif ?>
      </div>
    </section>

    <section class="jbox">
      <header data-kerkere='.jboxCodes' data-kerkere-icon='open'><h2><?php echo T_("Inventory"); ?></h2></header>
      <div class="pad jboxCodes">
        <?php if(isset($storData['barcode']) && $storData['barcode']) {?>
          <div class="f">
            <div class="c s12 pRa5">
              <label for="barcode"><?php echo T_("Barcode"); ?></label>
              <div class="input">
                <input type="text" name="barcode" id="barcode" placeholder='<?php echo T_("Scan Barcode here..."); ?>' value="<?php if(\dash\data::productDataRow_barcode()) { echo \dash\data::productDataRow_barcode(); }elseif(\dash\request::get('barcode')){ echo \dash\request::get('barcode');} ?>" class="barCode txtC ltr" data-lock autocomplete="off" maxlength="30">
                <span class="addon flag"><img class="none" src="<?php echo \dash\url::icon(); ?>" alt="Jibres"/></span>
              </div>
              <div class="txtC mB10">
                <svg class="barcodePrev" data-val="#barcode"></svg>
              </div>
            </div>
            <div class="c s12">
              <label for="barcode2"><?php echo T_("Barcode2"); ?></label>
              <div class="input">
                <input type="text" name="barcode2" id="barcode2" placeholder='<?php echo T_("Scan Barcode2 here..."); ?>' value="<?php echo \dash\get::index($productDataRow,'barcode2'); ?>" class="barCode txtC ltr" data-lock autocomplete="off" maxlength="30">
                <span class="addon flag"><img class="none" src="<?php echo \dash\url::icon(); ?>" alt="Jibres"/></span>
              </div>
              <div class="txtC mB10">
                <svg class="barcodePrev" data-val="#barcode2"></svg>
              </div>
            </div>
          </div>
        <?php } //endif ?>
        <div class="f">
          <div class="c s12 pRa5">
            <label for='sku'><?php echo T_("Stock keeping unit - SKU"); ?></label>
            <div class="input">
              <input type="text" name="sku" id="sku" value="<?php echo \dash\get::index($productDataRow,'sku'); ?>" maxlength="16" class="txtC ltr">
            </div>
          </div>
          <?php if(isset($storData['barcode']) && $storData['barcode'] && isset($storData['scale']) && $storData['scale']) {?>
            <div data-response='type' data-response-where='product' <?php if(!$productDataRow || \dash\data::productDataRow_type() === 'product'){}else{ echo 'data-response-hide';}?> >
              <div class="c6 s12">
                <label for="codeOnScale"><?php echo T_("Code on scale"); ?></label>
                <div class="input">
                  <input type="text" name="scalecode" id="codeOnScale" value="<?php echo \dash\get::index($productDataRow,'scalecode'); ?>" class="txtC ltr" autocomplete="off" data-format='int' maxlength="5">
                </div>
              </div>
            </div>
          <?php } //endif ?>
        </div>

        <div data-response='type' data-response-where='product' <?php if(!$productDataRow || \dash\data::productDataRow_type() === 'product'){}else{ echo 'data-response-hide';}?> >
          <div class="switch1 mB5">
            <input type="checkbox" name="trackquantity" id="itrackquantity" <?php if(\dash\data::productDataRow_trackquantity() || (\dash\url::child() === 'add' && \dash\data::productSettingSaved_defaulttracking())) { echo 'checked';} ?>>
            <label for="itrackquantity"></label>
            <label for="itrackquantity"><?php echo T_("Track quantity"); ?><small></small></label>
          </div>
          <p class="fs09 fc-mute"><?php echo T_("Inventory tracking can help you avoid selling products that have run out of stock, or let you know when you need to order or make more of your product."); ?></p>
          <div data-response='itrackquantity' data-response-effect='slide' <?php if(\dash\data::productDataRow_trackquantity() || (\dash\url::child() === 'add' && \dash\data::productSettingSaved_defaulttracking())){}else{ echo 'data-response-hide';} ?>  >
            <?php if(!\dash\data::productDataRow_variant_child()) {?>
              <div class="c s12 pRa10">
                <label for='stock'><?php echo T_("Stock"). ' '. \dash\fit::number(\dash\data::productDataRow_stock()) ; ?></label>
                <div class="input">
                  <input type="text" name="stock" id="stock" data-format='number' placeholder="<?php echo T_("If you want to change the stock enter current stock here") ?>" maxlength="7">
                </div>
              </div>
            <?php } //endif ?>

            <div class="switch1">
              <input type="checkbox" name="oversale" id="oversale"  <?php if(\dash\data::productDataRow_oversale()) {echo 'checked';}?> >
              <label for="oversale"></label>
              <label for="oversale"><?php echo T_("Oversale"); ?></label>
            </div>
            <p class="fc-mute fs09"><?php echo T_("Allow to purchase when sold out of stock"); ?></p>
            <div class="f">
              <div class="c s12 pRa10">
                <label for='minstock'><?php echo T_("Min stock"); ?></label>
                <div class="input">
                  <input type="text" name="minstock" id="minstock" data-format='number' value="<?php echo \dash\get::index($productDataRow,'minstock'); ?>" maxlength="7">
                </div>
              </div>
              <div class="c s12">
                <label for='maxstock'><?php echo T_("Max stock"); ?></label>
                <div class="input">
                  <input type="text" name="maxstock" id="maxstock" data-format='number' value="<?php echo \dash\get::index($productDataRow,'maxstock'); ?>" maxlength="11">
                </div>
              </div>
            </div>
            <p class="fs09 fc-mute"><?php echo T_("Optimize your inventory decisions."); ?> <?php echo T_("Know which products are the most profitable and which you should re-order when."); ?> <b><?php echo T_("Demand forecasting!"); ?></b> <?php echo T_("Receive recommendations on your products based on your rate of sales."); ?>
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="jbox">
    <header data-kerkere='.seoData' data-kerkere-icon='open'><h2><?php echo T_("Customize for SEO"); ?></h2></header>
    <div class="pad">
      <div class="seoPreview">
        <a target="_blank" href="<?php echo \dash\data::productDataRow_url(); ?>">
          <cite><span><?php echo \dash\data::productDataRow_url(); ?></cite>
        </a>
        <div class="f">
          <div class="c s12 pLa10">
            <h3><?php if(\dash\data::productDataRow_seotitle()) { echo \dash\data::productDataRow_seotitle(); }else{ echo \dash\data::productDataRow_title(); } ?> | <?php echo \dash\face::site(); ?></h3>
            <p class="desc"><?php echo \dash\get::index($productDataRow,'seodesc'); ?></p>
          </div>
          <div class="cauto os s12">
            <img src="<?php echo \dash\url::siftal(); ?>/images/logo/google.png" alt='<?php echo T_("Google"); ?>'>
          </div>
        </div>
      </div>
      <div class="seoData" data-kerkere-content='hide'>
        <hr>
        <div>
          <label for='seoTitle'><?php echo T_("SEO Title"); ?> <small><?php echo T_("Recommended being more than 40 character."); ?></small></label>
          <div class="input">
            <input type="text" name="seotitle" id="seoTitle" placeholder='<?php if(!\dash\data::productDataRow_seotitle()) {echo \dash\data::productDataRow_title();} ?>' value="<?php echo \dash\get::index($productDataRow,'seotitle'); ?>"  maxlength='200' minlength="1" pattern=".{1,200}">
            <label class="addon"> | <?php echo \dash\face::site(); ?></label>
          </div>
        </div>
        <div>
          <label for="seoSlug"><?php echo T_("Slug"); ?> <small><?php echo T_("End part of your product url."); ?></small></label>
          <div class="input ltr mB10">
            <input type="text" name="slug" id="seoSlug" placeholder='<?php echo T_("Slug"); ?>' value="<?php echo \dash\get::index($productDataRow,'slug'); ?>" maxlength='100' minlength="1" pattern=".{1,100}">
          </div>
        </div>
        <div>
          <label for='seoDesc'><?php echo T_("SEO Description"); ?> <small><?php echo T_("If leave it empty we are generate it automatically"); ?></small></label>
          <textarea class="txt" name="seodesc" id="seoDesc" maxlength='300' rows='3' placeholder='<?php echo T_("Excerpt used for social media and search engines"); ?>'><?php echo \dash\get::index($productDataRow,'seodesc'); ?></textarea>
        </div>
      </div>
    </div>
  </section>
</div>


<div class="c4 x3 s12 mB10">
  <?php if(!\dash\detect\device::detectPWA()) {?>
    <button class="btn block master mB10" name="submitall" type="submit" value="master"><?php echo T_("Save"); ?></button>
  <?php } //endif ?>
  <section class="jbox">
    <div class="pad">
      <div class="mB10">
        <label for='cat'><?php echo T_("Category"); ?> <small><a href="<?php echo \dash\url::here(); ?>/category"><i class="sf-link-external"></i></a></small></label>
        <select name="cat[]" id="cat" class="select22" data-model="tag" multiple="multiple">
          <?php foreach (\dash\data::listCategory() as $key => $value) {?>
            <option value="<?php echo $value['title']; ?>" <?php if(is_array(\dash\data::listSavedCat()) && in_array($value['title'], \dash\data::listSavedCat())) {echo 'selected'; } ?>><?php echo $value['title']; ?></option>
          <?php } //endfor ?>
        </select>
      </div>
      <div class="mB10">
        <label for='tag'>#<?php echo T_("Tag"); ?></label>
        <select name="tag[]" id="tag" class="select22" data-model="tag" multiple="multiple">
          <?php foreach (\dash\data::listTag() as $key => $value) {?>
            <option value="<?php echo $value['title']; ?>" selected><?php echo $value['title']; ?></option>
          <?php } //endfor ?>
        </select>
      </div>
    </div>
  </section>

  <section class="jbox">
    <div class="pad">
      <div class="f mB10">
        <div class="c pRa5">
          <div class="radio3">
            <input type="radio" name="type" value="product" id="typeProduct" <?php if(!\dash\data::productDataRow() || \dash\data::productDataRow_type() === 'product') {echo 'checked';} if(\dash\data::productDataRow_parent() || \dash\data::productDataRow_variant_child()) { echo ' disabled ';} ?> >
            <label for="typeProduct"><?php echo T_("Product"); ?></label>
          </div>
        </div>
        <div class="c">
          <div class="radio3">
            <input type="radio" name="type" value="service" id="typeService" <?php if(\dash\data::productDataRow_type() == 'service') { echo 'checked'; } if(\dash\data::productDataRow_variant_child() || \dash\data::productDataRow_parent()) { echo ' disabled ';} ?>  >
            <label for="typeService"><?php echo T_("Service"); ?></label>
          </div>
        </div>
        <?php if(false) {?>
        <div class="c">
          <div class="radio3">
            <input type="radio" name="type" value="file" id="typeFile" <?php if(\dash\data::productDataRow_type() == 'file') { echo 'checked'; } if(\dash\data::productDataRow_variant_child() || \dash\data::productDataRow_parent()) { echo ' disabled ';} ?>>
            <label for="typeFile"><?php echo T_("File"); ?></label>
          </div>
        </div>
      <?php } //endif ?>
      </div>
      <div class="mB10">
        <label for='unit'><?php echo T_("Unit"); ?></label>
        <select name="unit" id="unit" class="select22" data-model='tag' data-placeholder='<?php echo T_("like Qty, kg, etc"); ?>' <?php if(\dash\data::productDataRow_parent()) echo 'disabled'; ?> >
          <option></option>
          <?php if(\dash\data::productDataRow_unit_id()) {?>
            <option value="0"><?php echo T_("Without unit"); ?></option>
          <?php } //endif ?>
          <?php foreach (\dash\data::listUnits() as $key => $value) {?>
            <option value="<?php echo $value['title']; ?>" <?php if($value['id'] == \dash\data::productDataRow_unit_id()) { echo 'selected'; } ?> ><?php echo $value['title']; ?></option>
          <?php } //endfor ?>
        </select>
      </div>

      <div class="mB10">
        <label for='company'><?php echo T_("Brand"); ?></label>
        <select name="company" id="company" class="select22" data-model="tag" data-placeholder='<?php echo T_("Product Brand"); ?>'>
          <option></option>

          <?php if(\dash\data::productDataRow_company_id()) {?>

            <option value="0"><?php echo T_("Without Brand"); ?></option>

          <?php } //endif ?>

          <?php foreach (\dash\data::listCompanies() as $key => $value) {?>

            <option value="<?php echo $value['title']; ?>" <?php if($value['id'] == \dash\data::productDataRow_company_id()) { echo 'selected'; } ?> ><?php echo $value['title']; ?></option>

          <?php } //endfor ?>

        </select>
      </div>


      <label for="iweight"><?php echo T_("Weight"); ?></label>
      <div class="input">
        <input type="text" name="weight" id="iweight" value="<?php echo \dash\get::index($productDataRow,'weight'); ?>"  autocomplete="off" maxlength="7" data-format='number'>
        <div class="addon"><?php echo \dash\get::index($storData,'mass_detail','name'); ?></div>
      </div>
    </div>
  </section>



  <?php if(\dash\url::child() == 'edit') {?>
    <nav class="items long">
      <ul>
        <li>
          <?php if(\dash\detect\device::detectPWA()) {?>
            <li><a class="f" href="<?php echo \dash\url::this().'/desc?id='. \dash\request::get('id'); ?>"><div class="key"><i class="sf-list mRa10"></i><?php echo T_("Edit Description") ?></div><div class="go"></div></a></li>
          <?php } //endif ?>
          <li><a class="f" href="<?php echo \dash\url::this(); ?>/property?id=<?php echo \dash\get::index($productDataRow,'id'); ?>"><div class="key"><i class="sf-grid-1 mRa10"></i><?php echo T_("Manage product properties"); ?></div><div class="go"></div></a></li>
          <li><a class="f" href="<?php echo \dash\url::this(); ?>/comment?id=<?php echo \dash\request::get('id'); ?>"><div class="key"><i class="sf-comment mRa10"></i><?php echo T_("Comments"); ?></div><div class="go"></div></a></li>
          <li><a class="f" href="<?php echo \dash\url::this(); ?>/cartlimit?id=<?php echo \dash\request::get('id'); ?>"><div class="key"><i class="sf-cart-plus mRa10"></i><?php echo T_("Cart Limit"); ?></div><div class="go"></div></a></li>
          <li><a class="f" href="<?php echo \dash\url::this(); ?>/sharetext?id=<?php echo \dash\request::get('id'); ?>"><div class="key"><i class="sf-network mRa10"></i><?php echo T_("Share text"); ?></div><div class="go"></div></a></li>
          <?php if(!\dash\data::productDataRow_variant_child() && !\dash\data::productFamily()) {?>
            <?php if(\dash\get::index(\dash\data::productSettingSaved(), 'variant_product')) {?>
              <li><a class="f" href="<?php echo \dash\url::this(); ?>/variants?id=<?php echo \dash\get::index($productDataRow,'id'); ?>"><div class="key"><i class="sf-atom mRa10"></i><?php echo T_("Make product variants"); ?></div><div class="go"></div></a></li>
            <?php } //endif ?>
          <?php } //endif ?>
        </li>
      </ul>
    </nav>
    <nav class="items long">
      <ul>
        <li>
          <li><a class="f" href="<?php echo \dash\url::here(); ?>/pricehistory?id=<?php echo \dash\request::get('id'); ?>"><div class="key"><i class="sf-chart-line mRa10"></i><?php echo T_("Price change chart"); ?></div><div class="go"></div></a></li>
        </li>
      </ul>
    </nav>
    <nav class="items long">
      <ul>
        <li>
          <li><a class="f" href="<?php echo \dash\url::this(); ?>/status?id=<?php echo \dash\request::get('id'); ?>"><div class="key"><?php echo T_("Status"); ?></div><div class="go"><?php echo T_(\dash\data::productDataRow_status()); ?></div></a></li>
        </li>
      </ul>
    </nav>

    <nav class="items long">
      <ul>
        <li>
          <li><a class="f"><div class="key"><?php if(\dash\data::productDataRow_instock()) {?><i class="sf-check fc-green mRa10"></i><?php }else{ ?><i class="sf-times fc-red mRa10"></i> <?php } //endif ?><?php echo T_("Stock"); ?></div><div class="go"><?php echo \dash\fit::number(\dash\data::productDataRow_stock()); ?></div></a></li>
        </li>
      </ul>
    </nav>

    <nav class="items long">
      <ul>
        <li>
          <li><a class="f" href="<?php echo \dash\url::this(); ?>/share?id=<?php echo \dash\request::get('id'); ?>"><div class="key"><i class="sf-paper-plane mRa10"></i><?php echo T_("Share with social network"); ?></div><div class="go"></div></a></li>
        </li>
      </ul>
    </nav>
    <?php if(\dash\data::productDataRow_variant_child() || \dash\data::productFamily()) {?>
      <nav class="items long">
        <ul>
          <?php if(isset($productDataRow['parentDetail']['id']) && $productDataRow['parentDetail']['id'] != \dash\request::get('id') ) {?>
            <li><a class="f" href="<?php echo \dash\url::that(); ?>?id=<?php echo $productDataRow['parentDetail']['id']; ?>"><div class="key"><i class="sf-atom mRa10"></i><?php echo $productDataRow['parentDetail']['title']; ?></div><div class="go"></div></a></li>
          <?php } //endif ?>
          <?php if(\dash\data::productDataRow_variant_child()) {?>
            <?php foreach (\dash\data::productDataRow_child() as $key => $value) {?>
              <li>
                <a class="f" href="<?php echo \dash\url::that(); ?>?id=<?php echo \dash\get::index($value, 'id'); ?>">
                  <div class="key">
                    <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname1'); ?></small> <b class="fc-red"><?php echo \dash\get::index($value, 'optionvalue1'); ?></b>
                    <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname2'); ?></small> <b class="fc-green"><?php echo \dash\get::index($value, 'optionvalue2'); ?></b>
                    <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname3'); ?></small> <b class="fc-blue"><?php echo \dash\get::index($value, 'optionvalue3'); ?></b>
                  </div>
                  <div class="go"></div>
                </a>
              </li>
            <?php } //endfor ?>
          <?php }elseif(\dash\data::productFamily()) {?>
            <?php foreach (\dash\data::productFamily() as $key => $value) {?>
              <li>
                <a class="f" href="<?php echo \dash\url::that(); ?>?id=<?php echo \dash\get::index($value, 'id'); ?>">
                  <div class="key">
                    <?php if(\dash\get::index($value, 'id') === \dash\request::get('id')) {?><i class="sf-edit mRa5"></i><?php } //endif ?>
                    <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname1'); ?></small> <b class="fc-red"><?php echo \dash\get::index($value, 'optionvalue1'); ?></b>
                    <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname2'); ?></small> <b class="fc-green"><?php echo \dash\get::index($value, 'optionvalue2'); ?></b>
                    <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname3'); ?></small> <b class="fc-blue"><?php echo \dash\get::index($value, 'optionvalue3'); ?></b>
                  </div>
                  <div class="go"></div>
                </a>
              </li>
              <?php if(\dash\request::get('id') == $value['id']) {?><?php }else{ ?><?php } //endif ?>
            <?php }//endfor ?>
          <?php }//endif ?>
        </ul>
      </nav>
    <?php } //endif ?>
  <?php } //endif ?>
</div>
<?php if(\dash\detect\device::detectPWA()) {?>
  <button class="btn block master mTB10" name="submitall" type="submit" value="master"><?php echo T_("Save"); ?></button>
<?php } //endif ?>
</form>
