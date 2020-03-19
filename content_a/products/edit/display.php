<?php
$storData = \dash\data::store_store_data();
$productDataRow = \dash\data::productDataRow();
?>


<form class="jPage f" method="post" autocomplete="off">


   <button class="hide"  name="submitall" type="submit" value="master"><?php echo T_("Save"); ?></button>


  <div class="c8 x9 s12 pRa10">

    <section class="jbox pad">
      <header class="hide" data-kerkere='.jboxCodes' data-kerkere-icon='open'><h2><?php echo T_("Title"); ?></h2></header>

      <div class="input mB10">
       <input type="text" name="title" id="title" placeholder='<?php echo T_("Product Title"); ?> *' value="<?php echo \dash\get::index($productDataRow,'title'); ?>" maxlength='200' autofocus <?php if(\dash\data::productDataRow_parent()) { echo 'disabled';} ?>>
      </div>

      <textarea name="desc" data-editor class="txt" rows="6" maxlength="2000" data-placeholder='<?php echo T_("Description"); ?>'><?php echo \dash\get::index($productDataRow,'desc'); ?></textarea>
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
          <input type="checkbox" name="infinite" id="iinfinite" <?php if(\dash\data::productDataRow_infinite()) { echo 'checked';} ?>>
          <label for="iinfinite"></label>
          <label for="iinfinite"><?php echo T_("Track quantity"); ?><small></small></label>
        </div>
        <p class="fs09 fc-mute"><?php echo T_("Inventory tracking can help you avoid selling products that have run out of stock, or let you know when you need to order or make more of your product."); ?></p>

        <div data-response='iinfinite' data-response-effect='slide' <?php if(\dash\data::productDataRow_infinite()){}else{ echo 'data-response-hide';} ?>  >
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

<?php if(\dash\url::child() === 'edit') {?>


<section class="jbox">
  <header data-kerkere='.seoData' data-kerkere-icon='open'><h2><?php echo T_("Customize for SEO"); ?></h2></header>
  <div class="pad">

    <div class="seoPreview">
      <a target="_blank" href="<?php echo \dash\url::kingdom(); ?>/p/<?php echo \dash\get::index($productDataRow,'id'); ?>/<?php echo \dash\get::index($productDataRow,'slug'); ?>">
        <cite><span><?php echo \dash\url::kingdom(); ?>/p/</span><?php echo \dash\get::index($productDataRow,'id'); ?>/<?php echo \dash\get::index($productDataRow,'slug'); ?></cite>
      </a>
      <div class="f">
        <div class="c s12 pLa10">
          <h3><?php if(\dash\data::productDataRow_seotitle()) { echo \dash\data::productDataRow_seotitle(); }else{ echo \dash\data::productDataRow_title(); } ?> | <?php echo \dash\data::site_title(); ?></h3>
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
            <label class="addon"> | <?php echo \dash\data::site_title(); ?></label>
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


<section class="jbox">
  <header data-kerkere='.jboxGallery' data-kerkere-icon='open'><h2><?php echo T_("Images Gallery"); ?></h2></header>
  <div class="pad jboxGallery">

    <?php if(\dash\data::productDataRow_gallery_array()) {?>


  <div class="f">
    <?php foreach (\dash\data::productDataRow_gallery_array() as $key => $value) {?>

      <?php if(isset($value['path']) && $value['path'] == \dash\data::productDataRow_thumb()) {?>

      <div class="cauto pA5 pB10">
        <div class="w150">
          <img src="<?php echo \dash\get::index($value, 'path'); ?>" alt="<?php echo \dash\get::index($value, 'id'); ?>">
          <div>
            <a data-ajaxify data-method='post' data-data='{"fileaction": "remove", "fileid" : "<?php echo \dash\get::index($value, 'id'); ?>"}'><i class="sf-times fc-red"></i></a>
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
              <a data-ajaxify data-method='post' data-data='{"fileaction": "remove", "fileid" : "<?php echo \dash\get::index($value, 'id'); ?>"}'><i class="sf-times fc-red"></i></a>
              <a data-ajaxify data-method='post' data-data='{"fileaction": "setthumb", "fileid" : "<?php echo \dash\get::index($value, 'id'); ?>"}' class="floatRa btn sm"><i class="sf-monitor-screen-1"></i> <span class="pRa5"><?php echo T_("Set as cover"); ?></span></a>
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

    <div class="dropzone">
      <h4><?php echo T_("Add to gallery"); ?></h4>
      <label for='gallery' class="btn light"><?php echo T_("Choose or Drop file here"); ?></label>
      <input id="gallery" type="file" name="gallery" multiple>
      <div class="progress shadow" data-percent='30'>
        <div class="bar"></div>
        <div class="detail"></div>
      </div>
      <small><?php echo T_("Maximum file size"); ?> <b><?php echo \dash\data::maxUploadSize(); ?></b></small>
    </div>
  <?php } //endif ?>

  </div>
</section>



<?php } //endif ?>


  </div>
  <div class="c4 x3 s12 mB10">
    <?php if(!\dash\detect\device::detectPWA()) {?>
      <button class="btn block master mB10" name="submitall" type="submit" value="master"><?php echo T_("Save"); ?></button>
    <?php } //endif ?>

    <section class="jbox">
    <header data-kerkere='.jboxOrganize' data-kerkere-icon='open'><h2><?php echo T_("Organization"); ?></h2></header>
    <div class="pad jboxOrganize">


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

      <div class="c">
        <div class="radio3">
          <input type="radio" name="type" value="file" id="typeFile" <?php if(\dash\data::productDataRow_type() == 'file') { echo 'checked'; } if(\dash\data::productDataRow_variant_child() || \dash\data::productDataRow_parent()) { echo ' disabled ';} ?>>
          <label for="typeFile"><?php echo T_("File"); ?></label>
        </div>
      </div>

    </div>


      <div class="mB10">
      <label for='cat'><?php echo T_("Cat"); ?> <small><a href="<?php echo \dash\url::here(); ?>/category"><?php echo T_("Add"); ?></a></small></label>
      <select name="cat_id" id="cat" class="select22"  data-placeholder='<?php echo T_("Select or add new category"); ?>' <?php if(\dash\data::productDataRow_parent()) echo 'disabled'; ?> >
        <option></option>

        <?php if(\dash\data::productDataRow_cat_id()) {?>

          <option value="0"><?php echo T_("Without category"); ?></option>

        <?php } //endif ?>

        <?php foreach (\dash\data::listCategory() as $key => $value) {?>

          <option value="<?php echo \dash\get::index($value, 'id'); ?>" <?php if(\dash\data::productDataRow_cat_id() == $value['id']) { echo 'selected'; } ?> ><?php echo \dash\get::index($value, 'full_title'); ?></option>

        <?php } //endfor ?>

      </select>
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


      <?php if(\dash\url::child() === 'edit') {?>

        <?php if(\dash\permission::check('productAssignTag')) {?>

        <div class="mB10">
          <label for='tag'><?php echo T_("Tag"); ?></label>
          <select name="tag[]" id="tag" class="select22" data-model="tag" multiple="multiple">

            <?php foreach (\dash\data::listTag() as $key => $value) {?>

              <option value="<?php echo $value['title']; ?>" selected><?php echo $value['title']; ?></option>

            <?php } //endfor ?>

          </select>
        </div>
        <?php } //endif ?>

      <?php } //endif ?>


      <div class="mB10">
        <label for='company'><?php echo T_("Manufacturer"); ?></label>
        <select name="company" id="company" class="select22" data-model="tag" data-placeholder='<?php echo T_("Product manufacturer"); ?>'>
          <option></option>

          <?php if(\dash\data::productDataRow_company_id()) {?>

            <option value="0"><?php echo T_("Without manufacturer"); ?></option>

          <?php } //endif ?>

          <?php foreach (\dash\data::listCompanies() as $key => $value) {?>

            <option value="<?php echo $value['title']; ?>" <?php if($value['id'] == \dash\data::productDataRow_company_id()) { echo 'selected'; } ?> ><?php echo $value['title']; ?></option>

          <?php } //endfor ?>

        </select>
      </div>


    </div>
  </section>



<section class="jbox">
  <div data-response='type' data-response-where='product|file' <?php if(\dash\data::productDataRow_type() == 'service'){ echo 'data-response-hide';} ?>>
  <header data-kerkere='.unitsgPanel' data-kerkere-icon='close'><h2><?php echo T_("Units"); ?></h2></header>
  <div class="pad unitsgPanel hideIn">

    <div data-response='type' data-response-where='product' <?php if(!$productDataRow || \dash\data::productDataRow_type() == 'product'){}else{ echo 'data-response-hide';} ?>>
        <div><?php echo T_("Dimensions"); ?> <span class="fc-mute"> <?php echo \dash\get::index($storData,'length_detail','name'); ?></span></div>
      <div class="f">

        <div class="c">
          <label for="iLength"><?php echo T_("Length"); ?></label>
          <div class="input">
           <input type="text" name="length" id="iLength" value="<?php echo \dash\get::index($productDataRow,'length'); ?>"  autocomplete="off" maxlength="11" data-format='number'>
          </div>
        </div>



        <div class="c mLa5">
          <label for="iWidth"><?php echo T_("Width"); ?></label>
          <div class="input">
           <input type="text" name="width" id="iWidth" value="<?php echo \dash\get::index($productDataRow,'width'); ?>"  autocomplete="off" maxlength="11" data-format='number'>
          </div>
        </div>



        <div class="c mLa5">
          <label for="iHeight"><?php echo T_("Height"); ?></label>
          <div class="input">
           <input type="text" name="height" id="iHeight" value="<?php echo \dash\get::index($productDataRow,'height'); ?>"  autocomplete="off" maxlength="11" data-format='number'>
          </div>
        </div>


      </div>

      <label for="iweight"><?php echo T_("Weight"); ?></label>
      <div class="input">
       <input type="text" name="weight" id="iweight" value="<?php echo \dash\get::index($productDataRow,'weight'); ?>"  autocomplete="off" maxlength="7" data-format='number'>
       <div class="addon"><?php echo \dash\get::index($storData,'mass_detail','name'); ?></div>
      </div>

    </div>

    <div data-response='type' data-response-where='file' <?php if(\dash\data::productDataRow_type() == 'file'){}else{echo 'data-response-hide';} ?>>
      <label for="iFileSize"><?php echo T_("File Size"); ?></label>
      <div class="input">
       <input type="text" name="filesize" id="iFileSize" value="<?php echo \dash\get::index($productDataRow,'filesize'); ?>"  autocomplete="off" maxlength="11" data-format='number'>
       <div class="addon"><?php echo T_("MB"); ?></div>
      </div>
      <label for="iFileAddress"><?php echo T_("File Address"); ?></label>
      <div class="input">
       <input type="url" name="fileaddress" id="iFileAddress" value="<?php echo \dash\get::index($productDataRow,'fileaddress'); ?>"   maxlength="500">
      </div>
    </div>

  </div>
  </div>
</section>

<div data-response='type' data-response-where='product' <?php if(!$productDataRow || \dash\data::productDataRow_type() === 'product'){}else{ echo 'data-response-hide';}?> >
    <section class="jbox">
    <header data-kerkere='.salePanel' data-kerkere-icon='<?php if(\dash\data::productDataRow_minsale() || \dash\data::productDataRow_maxsale() || \dash\data::productDataRow_salestep()) {echo 'open';}else{echo 'close';} ?>'><h2><?php echo T_("Cart Limit"); ?></h2></header>
    <div class="pad salePanel <?php if(\dash\data::productDataRow_minsale() || \dash\data::productDataRow_maxsale() || \dash\data::productDataRow_salestep()) {}else{echo 'hideIn';} ?>">
      <div class="f">
        <div class="c s12 pRa5">
          <label for='minsale'><?php echo T_("Min quantity per order"); ?></label>
          <div class="input">
           <input type="text" name="minsale" id="minsale" data-format='number' value="<?php echo \dash\get::index($productDataRow,'minsale'); ?>" maxlength="7">
          </div>
        </div>
        <div class="c s12">
          <label for='maxsale'><?php echo T_("Max quantity per order"); ?></label>
          <div class="input">
           <input type="text" name="maxsale" id="maxsale" data-format='number' value="<?php echo \dash\get::index($productDataRow,'maxsale'); ?>" maxlength="7">
          </div>
        </div>
      </div>
      <label for='salestep'><?php echo T_("Step quantity"); ?></label>
      <div class="input">
       <input type="text" name="salestep" id="salestep" data-format='number' value="<?php echo \dash\get::index($productDataRow,'salestep'); ?>" maxlength="7">
      </div>
    </div>
  </section>
</div>
  <?php if(!\dash\data::productDataRow_variant_child() && !\dash\data::productFamily()) {?>

    <div data-response='type' data-response-where='product' <?php if(!$productDataRow || \dash\data::productDataRow_type() === 'product'){}else{ echo 'data-response-hide';}?> >
      <section class="jbox">
        <header data-kerkere='.variantPanelLink' data-kerkere-icon='close'><h2><?php echo T_("Variants"); ?></h2></header>
        <div class="pad variantPanelLink" data-kerkere-content='hide'>
            <a href="<?php echo \dash\url::this(); ?>/variants?id=<?php echo \dash\get::index($productDataRow,'id'); ?>"><?php echo T_("This product has multiple options, like different sizes or colors"); ?></a>
        </div>
      </section>
  </div>
  <?php } //endif ?>


  <?php if(\dash\data::productDataRow_variant_child() || \dash\data::productFamily()) {?>


    <section class="jbox">
      <header data-kerkere='.variantPanel' data-kerkere-icon='open'><h2><?php echo T_("Variants"); ?></h2></header>
      <div class="pad variantPanel">
        <?php if(isset($productDataRow['parentDetail']['id']) && $productDataRow['parentDetail']['id'] != \dash\request::get('id') ) {?>

    <div class="msg f primary outline">
      <div class="cauto"><span class="mRa10 sf-atom"></span></div>
      <div class="c">
        <?php echo $productDataRow['parentDetail']['title']; ?>

      </div>
      <div class="cauto">
        <a href="<?php echo \dash\url::that(); ?>?id=<?php echo $productDataRow['parentDetail']['id']; ?>" class="btn xs success"><?php echo T_("Edit"); ?></a>
      </div>
    </div>

    <?php } //endif ?>

    <?php if(\dash\data::productDataRow_variant_child()) {?>

    <?php foreach (\dash\data::productDataRow_child() as $key => $value) {?>


      <div class="msg f">
        <div class="cauto"><span class="mRa10"><?php echo \dash\fit::number($key + 1); ?></span></div>
        <div class="c">
          <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname1'); ?></small> <b class="fc-red"><?php echo \dash\get::index($value, 'optionvalue1'); ?></b>
          <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname2'); ?></small> <b class="fc-green"><?php echo \dash\get::index($value, 'optionvalue2'); ?></b>
          <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname3'); ?></small> <b class="fc-blue"><?php echo \dash\get::index($value, 'optionvalue3'); ?></b>
        </div>
        <div class="cauto">
          <a href="<?php echo \dash\url::that(); ?>?id=<?php echo \dash\get::index($value, 'id'); ?>" class="btn xs outline primary"><?php echo T_("Edit"); ?></a>
        </div>
      </div>
    <?php } //endfor ?>

  <?php }elseif(\dash\data::productFamily()) {?>


    <?php foreach (\dash\data::productFamily() as $key => $value) {?>


      <div class="msg f <?php if(\dash\request::get('id') == $value['id']) { echo 'primary2';} ?>">
        <div class="cauto"><span class="mRa10"><?php echo \dash\fit::number($key + 1); ?></span></div>
        <div class="c">
          <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname1'); ?></small> <b class="fc-red"><?php echo \dash\get::index($value, 'optionvalue1'); ?></b>
          <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname2'); ?></small> <b class="fc-green"><?php echo \dash\get::index($value, 'optionvalue2'); ?></b>
          <small class="fc-mute"><?php echo \dash\get::index($value, 'optionname3'); ?></small> <b class="fc-blue"><?php echo \dash\get::index($value, 'optionvalue3'); ?></b>
        </div>
        <?php if(\dash\request::get('id') == $value['id']) {?>

          <div class="cauto"><i class="sf-check"></i></div>

        <?php }else{ ?>

          <div class="cauto">
            <a href="<?php echo \dash\url::that(); ?>?id=<?php echo \dash\get::index($value, 'id'); ?>" class="btn xs outline primary"><?php echo T_("Edit"); ?></a>
          </div>

        <?php } //endif ?>

      </div>

    <?php }//endfor ?>



    <?php }//endif ?>


  </div>
</section>
<?php } //endif ?>


<?php if(\dash\url::child() == 'edit') {?>

  <section class="jbox">
    <header data-kerkere='.reportproduct' data-kerkere-icon='close'><h2><?php echo T_("Reports"); ?></h2></header>
    <div class="pad reportproduct"  data-kerkere-content='hide'>
      <ul>
        <li><a href="<?php echo \dash\url::here(); ?>/pricehistory?id=<?php echo \dash\request::get('id'); ?>"><?php echo T_("Price change chart"); ?></a></li>
        <li><a href="<?php echo \dash\url::this(); ?>/comment?id=<?php echo \dash\request::get('id'); ?>"><?php echo T_("Comments"); ?></a></li>
      </ul>
    </div>
  </section>



  <section class="jbox">
    <header data-kerkere='.deleteproduct' data-kerkere-icon='close'><h2><?php echo T_("Status"); ?></h2></header>
    <div class="pad deleteproduct" data-kerkere-content='hide'>

      <div class="mB10">
        <label for="status"><?php echo T_("Status"); ?></label>
        <select name="status" id="status" class="select22">
          <option value="available" <?php if(\dash\data::productDataRow_status() == 'available') {echo 'selected';} ?>><?php echo T_("Available"); ?></option>
          <option value="soon" <?php if(\dash\data::productDataRow_status() == 'soon') {echo 'selected';} ?>><?php echo T_("Soon"); ?></option>
          <option value="unavailable" <?php if(\dash\data::productDataRow_status() == 'unavailable') {echo 'selected';} ?>><?php echo T_("Unavailable"); ?></option>
          <option value="discountinued" <?php if(\dash\data::productDataRow_status() == 'discountinued') {echo 'selected';} ?>><?php echo T_("Discountinued"); ?></option>
        </select>
      </div>
      <div class="txtRa">

        <div class="btn danger sm" data-confirm data-data='{"delete":"product"}'><?php echo T_("Remove product"); ?></div>
      </div>
    </div>
  </section>

<?php } //endif ?>

  </div>


<?php if(\dash\detect\device::detectPWA()) {?>
  <button class="btn block master mTB10" name="submitall" type="submit" value="master"><?php echo T_("Save"); ?></button>
<?php } //endif ?>

</form>
