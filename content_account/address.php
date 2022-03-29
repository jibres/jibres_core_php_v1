

<?php function bAddressAdd() {?>
  <div class="box">
    <div class="body">

    <h6 class="text-center">
    <?php if(\dash\data::dataRowAddress()) {?>
        <?php echo T_("Edit address"); ?> <span class="font-bold fc-blue"><?php echo \dash\data::dataRowAddress_title(); ?></span>
        <a class="badge secondary" href="<?php echo \dash\data::myUrlAddress(); if(\dash\request::get('id')) { echo '?id='. \dash\request::get('id'); }?>"><?php echo T_("Cancel"); ?></a>
    <?php }else{ ?>

      <?php echo T_("Add new address"); ?>

    <?php } //endif ?>

    </h6>

      <label for="title"><?php echo T_("Title of address"); ?></label>
      <div class="input">
        <input type="text" name="title" id="title" value="<?php echo \dash\data::dataRowAddress_title(); ?>" maxlength='40' minlength="1">
      </div>


      <label for="name"><?php echo T_("Name"); ?></label>
      <div class="input">
        <input type="text" name="name" id="name" value="<?php if(\dash\data::dataRowAddress_name()) { echo \dash\data::dataRowAddress_name(); }elseif(\dash\data::dataRowMember()) { echo \dash\data::dataRowMember_displayname(); }elseif(!\dash\data::dataRowAddress()) { echo \dash\user::detail('displayname');}?>" maxlength='40' minlength="1" placeholder='<?php echo T_("Name of person in this address"); ?>'>
      </div>

<?php echo \dash\utility\location::pack(\dash\data::dataRowAddress_country(), \dash\data::dataRowAddress_province(), \dash\data::dataRowAddress_city()); ?>


      <label for="address"><?php echo T_("Address"); ?> <small class="fc-red"><?php echo T_("Require"); ?></small></label>
      <textarea class="txt mb-2 pB25" name="address" required maxlength='300' rows="2"><?php echo \dash\data::dataRowAddress_address(); ?></textarea>

      <label for="postcode"><?php echo T_("Post code"); ?></label>
      <div class="input ltr">
        <input type="text" name="postcode" id="postcode" value="<?php echo \dash\data::dataRowAddress_postcode(); ?>" data-format="postalCode" >
      </div>

    <div class="row">
      <div class="c-xs-12 c-sm-6">
          <label for="iphone"><?php echo T_("Phone"); ?></label>
          <div class="input">
            <input type="text" name="phone" id="iphone" value="<?php echo \dash\data::dataRowAddress_phone(); ?>" data-format="phone-12">
          </div>
      </div>
      <div class="c-xs-12 c-sm-6">
        <label for="iMobile"><?php echo T_("Mobile"); ?></label>
        <div class="input">
          <input type="tel" name="mobile" id="iMobile" value="<?php if(\dash\data::dataRowAddress_mobile()) { echo \dash\data::dataRowAddress_mobile(); }elseif(\dash\data::dataRowMember_id()){ echo \dash\data::dataRowMember_mobile();}elseif(!\dash\data::dataRowAddress()){ echo \dash\user::detail('mobile');} ?>" data-format="phone-14">
        </div>
      </div>
    </div>

    <div class="switch1 mt-4">
     <input type="checkbox" name="company" id="company" <?php if(\dash\data::dataRowAddress_company())  { echo 'checked'; } ?>>
     <label for="company" data-on='<?php echo T_("Yes"); ?>' data-off='<?php echo T_("No"); ?>'></label>
     <label for="company" ><?php echo T_("Is this a company's address?"); ?></label>
    </div>

     <div class="switch1 mb-4 mt-4">
     <input type="checkbox" name="isdefault" id="isdefault" <?php if(\dash\data::dataRowAddress_isdefault())  { echo 'checked'; } ?>>
     <label for="isdefault" data-on='<?php echo T_("Yes"); ?>' data-off='<?php echo T_("No"); ?>'></label>
     <label for="isdefault" ><?php echo T_("Set as default address?"); ?></label>
    </div>
  </div>
   <footer class="">
     <?php if(\dash\data::dataRowAddress()) {?>
      <div class="row">
        <div class="cauto">
          <div class="btn-link-danger" data-confirm data-data='<?php echo json_encode(['addressid' => \dash\data::dataRowAddress_id(), 'btnremove' => 'delete']); ?>' name="btnremove" value="delete"><?php echo T_("Delete"); ?></div>
        </div>
        <div class="c"></div>
        <div class="cauto">
            <button class="btn master" name="btn" value="add"><?php echo T_("Save"); ?></button>
        </div>
      </div>
    <?php }else{ ?>
      <div class="txtRa">
        <button class="btn master" name="save_address" value="new_address" cvalue="add"><?php echo T_("Add"); ?></button>
      </div>
    <?php } //endif ?>
    </footer>
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
          <td class="font-bold pRa10">

          <span ><?php echo a($value, 'title'); ?></span>
          </td>
          <td class="pRa10"><?php if(isset($value['country']) && $value['country']) {?><i class="flag <?php echo \dash\str::mb_strtolower($value['country']); ?>"></i><?php } //endif ?></td>
          <td class="pRa10">
            <span ><?php echo a($value, 'location_string'); ?></span>
            <div>
              <span><?php echo a($value, 'address'); ?></span>

              <?php if(isset($value['postcode']) && $value['postcode']) {?>

                <span title='<?php echo T_("Postal code"); ?>' class="compact"><?php echo \dash\fit::text($value['postcode']); ?><i class="sf-crosshairs mRL5"></i></span>

              <?php }//endif ?>

            </div>

          </td>
          <td class="pRa10"><?php echo a($value, 'name'); ?></td>
          <td class="collapsing pRa10">
            <?php if(isset($value['phone']) && $value['phone']) {?>

              <div title='<?php echo T_("Phone"); ?>'><i class="sf-phone"></i> <?php echo \dash\fit::text($value['phone']); ?></div>
            <?php } //endif ?>

            <?php if(isset($value['mobile']) && $value['mobile']) {?>

              <div title='<?php echo T_("Mobile"); ?>' class="mT5"><i class="sf-mobile"></i> <?php echo \dash\fit::mobile($value['mobile']); ?></div>
            <?php } //endif ?>

          </td>
          <td class="pRa10">
            <a class="badge light" href="<?php echo \dash\data::myUrlAddress(). '?addressid='. a($value, 'id'); if(\dash\request::get('id')) { echo '&id='. \dash\request::get('id'); }?>"><i class="sf-pencil-square-o fs16"></i> <?php echo T_("Edit"); ?></a>
          </td>
        </tr>
      <?php } //endfor ?>
      </tbody>
    </table>
<?php } // endif ?>


<?php } //endfunction ?>

