<form method="post" autocomplete="off"  enctype="multipart/form-data">
  <div class="avand">
    <div class="row">

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
              <button class="btn primary" name="save" value="main"><?php echo T_("Edit"); ?></button>
            <?php }else{ ?>
              <button class="btn success" name="save" value="main"><?php echo T_("Add"); ?></button>
            <?php } //endif ?>
          </footer>
        </div>


      </div>

      <div class="c-xs-12 c-sm-6 c-md-4">
        <div class="box">
          <header><h2><?php echo T_("Customer detail"); ?></h2></header>
          <div class="body">

            <?php if(\dash\data::dataRow_type() === 'income' || \dash\request::get('type') === 'income') {?>
              <div class="f">
                <div class="c">
                  <select name="customer" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true&list=customer' data-shortkey-search data-placeholder='<?php echo T_("Choose customer"); ?>'>
                  </select>
                </div>
                <div class="cauto"><i data-kerkere='.addNewCustomer' class="sf-plus btn outline mLa5 pLR10"></i></div>
              </div>


              <?php if(\dash\get::index(\dash\data::dataRow(), 'customer_detail', 'user')) {?>
                <div class="msg mTB10">
                  <img src="<?php echo \dash\get::index(\dash\data::dataRow(), 'customer_detail', 'user', 'avatar'); ?>" class="avatar">
                  <?php echo \dash\get::index(\dash\data::dataRow(), 'customer_detail', 'user', 'displayname'); ?>
                  <?php echo \dash\get::index(\dash\data::dataRow(), 'customer_detail', 'legal_detail', 'companyname'); ?>
                </div>
                <?php \dash\data::dataRowLegal(\dash\get::index(\dash\data::dataRow(), 'customer_detail', 'legal_detail')); \dash\data::dataRowLegalUserID(\dash\get::index(\dash\data::dataRow(), 'customer_detail', 'user', 'id')); ?>

              <?php } //endif ?>
            <?php } // endif ?>

            <?php if(\dash\data::dataRow_type() === 'cost' || \dash\request::get('type') === 'cost') {?>

              <div class="f">
                <div class="c">
                  <select name="seller" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::kingdom(); ?>/crm/api?type=sale&json=true&list=customer' data-shortkey-search data-placeholder='<?php echo T_("Choose seller"); ?>'>
                  </select>
                </div>
                <div class="cauto"><i data-kerkere='.addNewCustomer' class="sf-plus btn outline mLa5 pLR10"></i></div>
              </div>

              <?php if(\dash\get::index(\dash\data::dataRow(), 'seller_detail', 'user')) {?>
                <div class="msg mTB10">
                  <img src="<?php echo \dash\get::index(\dash\data::dataRow(), 'seller_detail', 'user', 'avatar'); ?>" class="avatar">
                  <?php echo \dash\get::index(\dash\data::dataRow(), 'seller_detail', 'user', 'displayname'); ?>
                  <?php echo \dash\get::index(\dash\data::dataRow(), 'seller_detail', 'legal_detail', 'companyname'); ?>
                </div>
                <?php \dash\data::dataRowLegal(\dash\get::index(\dash\data::dataRow(), 'seller_detail', 'legal_detail')); \dash\data::dataRowLegalUserID(\dash\get::index(\dash\data::dataRow(), 'seller_detail', 'user', 'id')); ?>


              <?php } //endif ?>

            <?php } // endif ?>


            <?php if(\dash\data::dataRowLegal()) {?>
             <nav class="items long">
               <ul>
               <?php foreach (\dash\data::dataRowLegal() as $key => $value) {?>
                  <?php
                  $legal_title = null;
                  switch ($key)
                  {

                    case 'companyname': $legal_title = T_("Company name"); break;
                    case'companyeconomiccode': $legal_title = T_("Economic code");  break;
                    case'companynationalid': $legal_title = T_("Company national id");  break;
                    case'companyregisternumber': $legal_title = T_("Company register number");  break;
                    case'ceonationalcode': $legal_title = T_("CEO nationalcode");  break;
                    case'province': $legal_title = T_("Province");  break;
                    case'city': $legal_title = T_("City");  break;
                    case'address': $legal_title = T_("Address");  break;
                    case'postcode': $legal_title = T_("Post code");  break;
                    case'phone': $legal_title = T_("Phone");  break;
                    case'mobile': $legal_title = T_("Mobile");  break;
                    case'fax': $legal_title = T_("Fax");  break;
                    default: break;
                  } ?>
                  <?php if($legal_title && $value) {?>
                  <li><a class="f" ><div class="key"><?php echo T_($value); ?></div><div class="go"><?php echo T_($legal_title); ?></div></a></li>
                <?php } //endif ?>
              <?php } //endfor ?>
               </ul>
             </nav>
            <?php } //endif ?>

            <?php if(\dash\get::index(\dash\data::dataRow(), 'seller') || \dash\get::index(\dash\data::dataRow(), 'customer')) {?>
              <dir class="btn link" data-kerkere='.editLegalInformation'><?php echo T_("Edit legal information") ?></dir>
            <div class="editLegalInformation" data-kerkere-content='hide'>
              <input type="hidden" name="legal_user" value="<?php echo \dash\data::dataRowLegalUserID(); ?>">

              <label for="icompanyname"><?php echo T_("Company name"); ?></label>
              <div class="input">
                <input type="text" name="companyname" id="icompanyname" value="<?php echo \dash\data::dataRowLegal_companyname(); ?>" maxlength="40">
              </div>


              <label for="icompanyregisternumber"><?php echo T_("Company register number"); ?></label>
              <div class="input">
                <input type="text" name="companyregisternumber" id="icompanyregisternumber" value="<?php echo \dash\data::dataRowLegal_companyregisternumber(); ?>" data-format='int' maxlength="10">
              </div>

              <label for="icompanynationalid"><?php echo T_("Company national id"); ?></label>
              <div class="input">
                <input type="text" name="companynationalid" id="icompanynationalid" value="<?php echo \dash\data::dataRowLegal_companynationalid(); ?>" data-format='int' maxlength="11">
              </div>

              <label for="icompanyeconomiccode"><?php echo T_("Economic code"); ?></label>
              <div class="input">
                <input type="text" name="companyeconomiccode" id="icompanyeconomiccode" value="<?php echo \dash\data::dataRowLegal_companyeconomiccode(); ?>" data-format='int' maxlength="12">
              </div>


              <label for="iceonationalcode"><?php echo T_("CEO nationalcode"); ?></label>
              <div class="input">
                <input type="text" name="ceonationalcode" id="iceonationalcode" value="<?php echo \dash\data::dataRowLegal_ceonationalcode(); ?>" data-format='nationalCode'>
              </div>




              <div class="mB10">
                <label for='country'><?php echo T_("Country"); ?></label>
                <select class="select22" name="country" id="country" data-model='country' data-next='#province' data-next-default='<?php echo \dash\data::dataRowLegal_province(); ?>'>
                  <option value=""><?php echo T_("Choose your country"); ?></option>
                  <?php foreach (\dash\data::countryList() as $key => $value) {?>

                    <option value="<?php echo $key; ?>" <?php if(\dash\data::dataRowLegal_country() == $key) { echo 'selected';} ?>><?php echo ucfirst($value['name']); if(\dash\language::current() != 'en') { echo ' - '. T_(ucfirst($value['name']));} ?></option>

                  <?php } //endif ?>
                </select>
              </div>


              <div class="mB10" data-status='hide'>
                <label for='province'><?php echo T_("Province"); ?></label>
                <select name="province" id="province" class="select22" data-next='#city' data-next-default='<?php echo \dash\data::dataRowLegal_city(); ?>'>
                  <option value="0"><?php echo T_("Please choose country"); ?></option>
                  <option value="<?php echo \dash\data::dataRowLegal_province(); ?>" selected><?php echo \dash\data::dataRowLegal_province(); ?></option>
                </select>
              </div>


              <div class="mB10" data-status='hide'>
                <label for='city'><?php echo T_("City"); ?></label>
                <select name="city" id="city" class="select22">
                  <option value=""><?php echo T_("Please choose province"); ?></option>
                </select>
              </div>


              <label for="address"><?php echo T_("Address"); ?></label>
              <textarea class="txt mB10 pB25" name="address"  maxlength='300' rows="2"><?php echo \dash\data::dataRowLegal_address(); ?></textarea>

              <label for="postcode"><?php echo T_("Post code"); ?></label>
              <div class="input ltr">
                <input type="text" name="postcode" id="postcode" value="<?php echo \dash\data::dataRowLegal_postcode(); ?>" data-format="postalCode" >
              </div>




              <label for="iphone"><?php echo T_("Phone"); ?></label>
              <div class="input">
                <input type="text" name="phone" id="iphone" value="<?php echo \dash\data::dataRowLegal_phone(); ?>" data-format="tel">
              </div>

              <label for="ifax"><?php echo T_("Fax"); ?></label>
              <div class="input">
                <input type="text" name="fax" id="ifax" value="<?php echo \dash\data::dataRowLegal_fax(); ?>" data-format="tel">
              </div>


              <div class="txtRa">
                <button class="btn primary" name="save" value="legal"><?php echo T_("Save legal detail") ?></button>
              </div>
            </div>
            <?php } //endif ?>

            <div class="addNewCustomer" data-kerkere-content='hide'>
              <?php if(\dash\data::dataRow_type() === 'income' || \dash\request::get('type') === 'income') {?>
                <div class="msg info2 mT10 mB0 pTB5"><?php echo T_("Quickly add customer"); ?></div>
              <?php }elseif(\dash\data::dataRow_type() === 'cost' || \dash\request::get('type') === 'cost') {?>
                <div class="msg info2 mT10 mB0 pTB5"><?php echo T_("Quickly add seller"); ?></div>
              <?php } // endif ?>
              <div class="input mTB5">
                <input type="tel" name="memberTl" id="memberTl" placeholder='<?php echo T_("Mobile"); ?> <?php echo T_("Like"); ?> <?php echo \dash\fit::mobile('09120123456'); ?>' <?php \dash\layout\autofocus::html() ?>  maxlength='30' data-response-realtime>
              </div>

              <select name="memberGender" id="memberGender" class="select22 mT5">
                <option value="" disabled><?php echo T_("Gender"); ?></option>
                <option value="0">-</option>
                <option value="male"><?php echo T_("Mr"); ?></option>
                <option value="female"><?php echo T_("Mrs"); ?></option>
              </select>

              <div class="input mT5">
                <input type="text" name="memberN" id="memberN" placeholder='<?php echo T_("Name"); ?>'  maxlength='40' minlength="1">
              </div>
            </div>

          </div>
        </div>

        <div class="box">
          <header><h2><?php echo T_("Upload Documents"); ?></h2></header>
          <div class="body">

            <div class="pad jboxGallery">

              <?php if(\dash\data::dataRow_gallery_array()) {?>

                <div class="f">

                  <?php foreach (\dash\data::dataRow_gallery_array() as $key => $value) {?>
                    <?php if(\dash\get::index($value, 'path')){ ?>
                    <div class="cauto pA5 pB10">
                        <?php if(in_array(substr(\dash\get::index($value, 'path'), -3), ['jpg', 'png'])) {?>
                      <div class="w150">
                        <img src="<?php echo \dash\get::index($value, 'path'); ?>" alt="<?php echo \dash\get::index($value, 'id'); ?>">
                      </div>
                      <?php }else{ ?>
                        <a class="link btn" target="_blank" href="<?php echo \dash\get::index($value, 'path'); ?>"><?php echo substr(\dash\get::index($value, 'path'), -3) ?></a>
                        <?php } // endif ?>
                          <a data-ajaxify data-method='post' data-refresh data-autoScroll2=".jboxGallery" data-data='{"fileaction": "remove", "fileid" : "<?php echo \dash\get::index($value, 'id'); ?>"}'><i class="sf-times fc-red"></i></a>
                    </div>
                  <?php } //endif ?>
                  <?php } //endfor ?>
                </div>
              <?php } //endif ?>
              <input type="file" name="gallery">

              <label id="productGallery" for="file1"><?php echo T_("Add file"); ?> <small class="fc-mute"><?php echo T_("Maximum file size"). ' '. \dash\data::maxUploadSize(); ?></small></label>

              <div data-uploader data-name='gallery1' data-ratio=1 data-ratio-free>
                <input type="file"  id="file1">
                <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
              </div>

            </div>
          </div>
        </div>



      </div>
    </div>

  </div>
</form>

