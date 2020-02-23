

<?php function bAddressAdd() {?>

  <div class="cbox">
    <h3 class="txtC">
    <?php if(\dash\data::dataRowAddress()) {?>

        <?php echo T_("Edit address"); ?> <span class="txtB fc-blue"><?php echo \dash\data::dataRowAddress_title(); ?></span>
        <a class="badge secondary" href="<?php echo \dash\data::myUrlAddress(); if(\dash\request::get('id')) { echo '?id='. \dash\request::get('id'); }?>"><?php echo T_("Cancel"); ?></a>

    <?php }else{ ?>

      <?php echo T_("Add new address"); ?>

    <?php } //endif ?>

    </h3>

      <label for="title"><?php echo T_("Title of address"); ?></label>
      <div class="input">
        <input type="text" name="title" id="title" value="<?php echo \dash\data::dataRowAddress_title(); ?>" maxlength='40' minlength="1">
      </div>


      <label for="name"><?php echo T_("Name"); ?></label>
      <div class="input">
        <input type="text" name="name" id="name" value="<?php if(\dash\data::dataRowAddress_name()) { echo \dash\data::dataRowAddress_name(); }elseif(\dash\data::dataRowMember()) { echo \dash\data::dataRowMember_displayname(); }elseif(!\dash\data::dataRowAddress()) { echo \dash\user::detail('displayname');}?>" maxlength='40' minlength="1" placeholder='<?php echo T_("Name of person in this address"); ?>'>
      </div>


      <div class="mB10">
        <label for='country'><?php echo T_("Country"); ?></label>
        <div class="ui fluid search selection dropdown">
          <input type="hidden" name="country" value="<?php if(\dash\data::dataRowAddress_country()) { echo \dash\data::dataRowAddress_country(); }elseif(\dash\language::current() === 'fa'){ echo 'IR'; }?>">
          <i class="dropdown icon"></i>
          <div class="default text"><?php echo T_("Choose your country"); ?></div>
          <div class="menu">

            <?php foreach (\dash\data::countryList() as $key => $value) {?>

            <div class="item" data-value="<?php echo $key; ?>">
              <i class="<?php echo mb_strtolower(\dash\get::index($value, 'iso2')); ?> flag"></i><?php echo T_(\dash\get::index($value, 'name')); ?><small class="description"><?php echo ucfirst(\dash\get::index($value, 'name')); ?></small>
            </div>

            <?php } //endfor ?>

          </div>
        </div>
      </div>


      <div data-response='country' data-response-where='IR' <?php if(\dash\data::dataRowAddress_country() === 'IR' || (!\dash\data::dataRowAddress() && \dash\language::current() === 'fa')) {}else{ echo 'data-response-hide';} ?>>

      <label for='city'><?php echo T_("City"); ?></label>
      <select name="city" class="ui dropdown select search mB10" id="city">
        <option value="" readonly><?php echo T_("Select city"); ?></option>

        <?php foreach (\dash\data::cityList() as $key => $value) {?>

          <option value="<?php echo $key; ?>" <?php if(\dash\data::dataRowAddress_city() == $key) { echo 'selected';}?>><?php echo $value; ?></option>

        <?php } //endfor ?>

      </select>
      </div>


      <label for="address"><?php echo T_("Address"); ?> <small class="fc-red"><?php echo T_("Require"); ?></small></label>
      <textarea class="txt mB10 pB25" name="address" required maxlength='300' rows="2"><?php echo \dash\data::dataRowAddress_address(); ?></textarea>

      <label for="postcode"><?php echo T_("Post code"); ?></label>
      <div class="input ltr">
        <input type="text" name="postcode" id="postcode" value="<?php echo \dash\data::dataRowAddress_postcode(); ?>" maxlength='40' minlength="1" pattern=".{1,40}" >
      </div>

    <div class="f">
      <div class="c pRa5">

          <label for="iphone"><?php echo T_("Phone"); ?></label>
          <div class="input">
            <input type="tel" name="phone" id="iphone" value="<?php echo \dash\data::dataRowAddress_phone(); ?>" pattern=".{1,20}">
          </div>

      </div>
      <div class="c">

        <label for="iMobile"><?php echo T_("Mobile"); ?></label>
        <div class="input">
          <input type="tel" name="mobile" id="iMobile" value="<?php if(\dash\data::dataRowAddress_mobile()) { echo \dash\data::dataRowAddress_mobile(); }elseif(\dash\data::dataRowMember_mobile()){ echo \dash\data::dataRowMember_mobile();}elseif(!\dash\data::dataRowAddress()){ echo \dash\user::detail('mobile');} ?>" pattern=".{1,20}">
        </div>


      </div>
    </div>

    <div class="switch1 mB20 mT20">
     <input type="checkbox" name="company" id="company" <?php if(\dash\data::dataRowAddress_company())  { echo 'checked'; } ?>>
     <label for="company" data-on='<?php echo T_("Yes"); ?>' data-off='<?php echo T_("No"); ?>'></label>
     <label for="company" ><?php echo T_("Is this a company's address?"); ?></label>
    </div>

    <?php if(\dash\data::dataRowAddress()) {?>

      <div class="f">
        <div class="c pRa5">
            <button class="btn primary block mT20" name="btn" value="add"><?php echo T_("Save"); ?></button>
        </div>

        <div class="cauto os">
          <input type="hidden" name="addressid" value="<?php echo \dash\data::dataRowAddress_id(); ?>">
          <button class="btn danger outline block mT20" name="btnremove" value="delete"><?php echo T_("Delete"); ?></button>
        </div>
      </div>

    <?php }else{ ?>

      <button class="btn primary block mT20" cvalue="add"><?php echo T_("Add"); ?></button>

    <?php } //endif ?>

  </div>

<?php } //endfunction ?>




<?php function bAddressList() {?>
<?php if(\dash\data::dataTable()) {?>

    <table class="tbl1 v1 cbox fs12">
      <thead>
        <th colspan="7" class="collapsing"><?php echo T_("Saved address"); ?></th>
      </thead>
      <tbody>

      <?php foreach (\dash\data::dataTable() as $key => $value) {?>


        <tr <?php if(\dash\request::get('id') == $value['id']) { echo "class='negative'"; } ?>>
          <td class="collapsing pRa5">
            <?php if(isset($value['company']) && $value['company']) {?>

              <i class="fs16 mRa5 sf-building"></i>

            <?php }else{ ?>

              <i class="fs16 mRa5 sf-pin"></i>

            <?php } // endif ?>

          </td>
          <td class="txtB pRa10">

          <span ><?php echo \dash\get::index($value, 'title'); ?></span>
          </td>
          <td class="pRa10"><?php if(isset($value['country']) && $value['country']) {?><i class="flag <?php echo mb_strtolower($value['country']); ?>"></i><?php } //endif ?></td>
          <td class="pRa10">
            <span ><?php echo \dash\get::index($value, 'location_string'); ?></span>
            <div>
              <span><?php echo \dash\get::index($value, 'address'); ?></span>

              <?php if(isset($value['postcode']) && $value['postcode']) {?>

                <span title='<?php echo T_("Postal code"); ?>' class="compact"><?php echo \dash\fit::text($value['postcode']); ?><i class="sf-crosshairs mRL5"></i></span>

              <?php }//endif ?>

            </div>

          </td>
          <td class="pRa10"><?php echo \dash\get::index($value, 'name'); ?></td>
          <td class="collapsing pRa10">
            <?php if(isset($value['phone']) && $value['phone']) {?>

              <div title='<?php echo T_("Phone"); ?>'><i class="sf-phone"></i> <?php echo \dash\fit::text($value['phone']); ?></div>
            <?php } //endif ?>

            <?php if(isset($value['mobile']) && $value['mobile']) {?>

              <div title='<?php echo T_("Mobile"); ?>' class="mT5"><i class="sf-mobile"></i> <?php echo \dash\fit::mobile($value['mobile']); ?></div>
            <?php } //endif ?>

          </td>
          <td class="pRa10">
            <a class="badge light" href="<?php echo \dash\data::myUrlAddress(). '?addressid='. \dash\get::index($value, 'id'); if(\dash\request::get('id')) { echo '&id='. \dash\request::get('id'); }?>"><i class="sf-pencil-square-o fs16"></i> <?php echo T_("Edit"); ?></a>
          </td>
        </tr>
      <?php } //endfor ?>
      </tbody>
    </table>
<?php } // endif ?>


<?php } //endfunction ?>

