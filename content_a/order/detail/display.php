<?php $orderDetail = \dash\data::orderDetail(); ?>

<div class="avand">
  <div class="box">
    <header><h2><?php echo T_("Order detail") ?></h2></header>
    <div class="body">

      <div class="row">
        <div class="c-md-6">

          <?php if (\dash\get::index($orderDetail, 'factor', 'customer')) {?>

            <div class="msg">
              <?php echo \dash\get::index($orderDetail, 'factor', 'customer_displayname'); ?>
              <span class="ltr compact"><?php echo \dash\fit::mobile(\dash\get::index($orderDetail, 'factor', 'customer_mobile')); ?></span>
              <a class="link btn" href="<?php echo \dash\url::kingdom(). '/crm/member/glance?id='. $orderDetail['factor']['customer']; ?>"><?php echo T_("View profile") ?></a>
            </div>

          <?php }else{ ?>
            <div class="msg"><?php echo T_("This order not set to any customer") ?></div>
          <?php } // endif ?>
        </div>
        <div class="c-md-6">
          <div class="btn mB10 info"><?php echo T_("Status"). ' '. \dash\get::index($orderDetail, 'factor', 'status'); ?></div>
          <div class="btn mB10"><?php echo T_("Last modified"). ' '. \dash\fit::date_human(\dash\get::index($orderDetail, 'factor', 'datemodified')); ?></div>
          <?php if (\dash\get::index($orderDetail, 'factor', 'pay')) {?>
            <div class="btn mB10 success"><?php echo T_("Factor is payed") ?></div>
          <?php }else{ ?>
            <div class="btn mB10 warn"><?php echo T_("Factor is not payed") ?></div>
          <?php } // endif ?>
        </div>
      </div>


      <div class="msg"><?php echo T_("Total"); ?><span class="txtB"><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'total')); ?></span></div>
      <div class="msg"><?php echo T_("Discount"); ?><span class="txtB"><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'didscount')); ?></span></div>
      <?php if(\dash\get::index($orderDetail, 'factor', 'desc')) {?><div class="msg"><?php echo T_("Description"); ?><span class="txtB"><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'desc')); ?></span></div><?php }// endif ?>
    </div>

  </div>

  <?php $address = \dash\get::index(\dash\data::orderDetail(), 'address'); ?>
  <div class="box">
    <header><h2><?php echo T_("Order Address") ?></h2></header>
    <div class="body">

      <?php if(isset($address['company']) && $address['company']) {?>
        <i class="fs16 mRa5 sf-building"></i>
      <?php }else{ ?>
        <i class="fs16 mRa5 sf-pin"></i>
      <?php } // endif ?>
      <?php if(isset($address['country']) && $address['country']) {?><i class="flag <?php echo mb_strtolower($address['country']); ?>"></i><?php } //endif ?>

      <span ><?php echo \dash\get::index($address, 'location_string'); ?></span>

      <span><?php echo \dash\get::index($address, 'address'); ?></span>

      <?php if(isset($address['postcode']) && $address['postcode']) {?>

        <span title='<?php echo T_("Postal code"); ?>' class="compact"><?php echo \dash\fit::text($address['postcode']); ?><i class="sf-crosshairs mRL5"></i></span>

      <?php }//endif ?>
      <?php echo \dash\get::index($address, 'name'); ?></td>


      <?php if(isset($address['phone']) && $address['phone']) {?>

        <div title='<?php echo T_("Phone"); ?>'><i class="sf-phone"></i> <?php echo \dash\fit::text($address['phone']); ?></div>
      <?php } //endif ?>

      <?php if(isset($address['mobile']) && $address['mobile']) {?>

        <div title='<?php echo T_("Mobile"); ?>' class="mT5"><i class="sf-mobile"></i> <?php echo \dash\fit::mobile($address['mobile']); ?></div>
      <?php } //endif ?>
    </div>
    <footer>
      <div class="txtRa">
        <a class="btn link" href="<?php echo \dash\url::this(). '/address?id='. \dash\request::get('id'); ?>"><?php echo T_("Edit address") ?></a>
      </div>
    </footer>


  </div>



  <div class="box">
    <header><h2><?php echo T_("Order items") ?></h2></header>
    <div class="body">

      <table class="tbl1 v4">
        <thead>
          <tr>
            <th class="collapsing">#</th>
            <th><?php echo T_("Title"); ?></th>
            <th><?php echo T_("Count"); ?></th>
            <th><?php echo T_("Price"); ?></th>
            <th><?php echo T_("Sum"); ?></th>
          </tr>
        </thead>
        <tbody>

          <?php foreach (\dash\get::index($orderDetail, 'factor_detail') as $key => $value) {?>
            <tr>
              <td class="collapsing"><?php echo \dash\fit::number($key + 1); ?></td>
              <td><?php echo \dash\get::index($value, 'title'); ?></td>
              <td><?php echo \dash\fit::number(\dash\get::index($value, 'count')); ?></td>
              <td><?php echo \dash\fit::number(\dash\get::index($value, 'price')); ?></td>
              <td><?php echo \dash\fit::number(\dash\get::index($value, 'sum')); ?></td>
            </tr>
          <?php } //endfor ?>
        </tbody>
      </table>

    </div>
    <?php if(false) {?>
    <footer>
      <div class="txtRa">
        <a class="btn link" href="<?php echo \dash\url::this(). '/edit?id='. \dash\request::get('id'); ?>"><?php echo T_("Edit items") ?></a>
      </div>
    </footer>
  <?php } //endif ?>

  </div>

  <form method="post" autocomplete="off">
    <div class="box">
      <header><h2><?php echo T_("Order action") ?></h2></header>
      <div class="body">
        <div>
          <label for="orderaction"><?php echo T_("Add new action"); ?></label>
          <select class="select22" name="orderaction">
            <option value="comment"><?php echo T_("comment") ?></option>
            <option value="pending_pay"><?php echo T_("Pending pay") ?></option>
            <option value="pay_successfull"><?php echo T_("Pay successfull") ?></option>
            <option value="pending_prepare"><?php echo T_("Pending prepare") ?></option>
            <option value="pending_verify"><?php echo T_("Pending verify") ?></option>
            <option value="pending_send"><?php echo T_("Pending send") ?></option>
            <option value="sending"><?php echo T_("Sending") ?></option>
            <option value="deliver"><?php echo T_("Deliver") ?></option>
            <option value="pay_unverified"><?php echo T_("Pay unverified") ?></option>
            <option value="reject"><?php echo T_("Reject") ?></option>
            <option value="spam"><?php echo T_("Spam") ?></option>
            <option value="expire"><?php echo T_("Expire") ?></option>
            <?php if(false) {?>
              <option value="go_to_bank"><?php echo T_("go_to_bank") ?></option>
              <option value="pay_error"><?php echo T_("pay_error") ?></option>
              <option value="pay_cancel"><?php echo T_("pay_cancel") ?></option>
              <option value="pay_verified"><?php echo T_("pay_verified") ?></option>
              <option value="cancel"><?php echo T_("cancel") ?></option>
              <option value="order"><?php echo T_("order") ?></option>
            <?php } //endif ?>

          </select>
        </div>

        <div class="mB20">
          <label for="desc"><?php echo T_("Description"); ?></label>
          <textarea id="desc" name="desc" class="txt" rows="5"><?php echo \dash\data::dataRow_desc(); ?></textarea>
        </div>

        <label for="file1"><?php echo T_("Attachment"); ?> <small class="fc-mute"><?php echo T_("Maximum file size"). ' '. \dash\data::maxUploadSize(); ?></small></label>

        <div class="box" data-uploader data-name='file'>
          <input type="file"  id="file1">
          <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
        </div>

      </div>
      <footer>
        <div class="txtRa">
          <button class="btn success"><?php echo T_("Save") ?></button>
        </div>
      </footer>
    </div>
  </form>




  <div class="box">
    <header><h2><?php echo T_("Order Action list") ?></h2></header>
    <div class="body">

      <table class="tbl1 v4">
        <thead>
          <tr>
            <th class="collapsing">#</th>
            <th><?php echo T_("Action"); ?></th>
            <th><?php echo T_("Date"); ?></th>
            <th><?php echo T_("Description"); ?></th>
            <th><?php echo T_("Attachment"); ?></th>
            <th><?php echo T_("User"); ?></th>
          </tr>
        </thead>
        <tbody>

          <?php foreach (\dash\get::index($orderDetail, 'action') as $key => $value) {?>
            <tr>
              <td class="collapsing"><?php echo \dash\fit::number((count(\dash\get::index($orderDetail, 'action'))) - ($key)); ?></td>
              <td><?php echo \dash\get::index($value, 'action'); ?></td>
              <td><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></td>
              <td><?php echo \dash\get::index($value, 'desc'); ?></td>
              <td><?php if(\dash\get::index($value, 'file')) {?><img src="<?php echo \dash\get::index($value, 'file'); ?>" alt="<?php echo T_("Action image"). ' '. \dash\request::get('id'); ?>"><?php } //endif ?></td>

              <td class="collapsing">
                <a href="<?php echo \dash\url::that(). '?user='.\dash\get::index($value, 'user_id'); ?>" class="f align-center userPack">
                  <div class="c pRa10">
                    <div class="mobile" data-copy="<?php echo \dash\get::index($value, 'mobile'); ?>"><?php echo \dash\fit::mobile(\dash\get::index($value, 'mobile')); ?></div>
                    <div class="name"><?php echo \dash\get::index($value, 'displayname'); ?></div>
                  </div>
                  <img class="cauto" src="<?php echo \dash\get::index($value, 'avatar'); ?>">
                </a>
              </td>
            </tr>
          <?php } //endfor ?>
        </tbody>
      </table>

    </div>


  </div>
</div>