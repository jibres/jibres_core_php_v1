<?php
$orderDetail = \dash\data::orderDetail();
$orderStatus = \dash\get::index($orderDetail, 'factor', 'status');
$orderPayStatus = \dash\get::index($orderDetail, 'factor', 'paystatus');
?>

<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-9">
    <form method="post" autocomplete="off" data-patch>

      <div class="box">
        <div class="pad">
          <div class="row mB10">
            <div class="c">
              <div class="btn master" data-confirm data-data='{"orderaction": "preparing"}'><?php echo T_("Set as preparing") ?></div>
            </div>
            <div class="c">
              <div class="btn master" data-confirm data-data='{"orderaction": "sending"}'><?php echo T_("Set as sending") ?></div>
            </div>

            <div class="c">
              <div class="btn master" data-confirm data-data='{"orderaction": "delivered"}'><?php echo T_("Set as delivered") ?></div>
            </div>

            <div class="c">
              <div class="btn master" data-kerkere='.showAllStatusOrder'> <?php echo T_("Something else") ?></div>
            </div>


          </div>


          <div class="showAllStatusOrder" data-kerkere-content='hide'>
            <select name="orderaction" class="select22">
              <option value ="draft" <?php if($orderStatus === 'draft') { echo 'selected';} ?>><?php echo T_('Draft') ?></option>
              <option value ="registered" <?php if($orderStatus === 'registered') { echo 'selected';} ?>><?php echo T_('Registered') ?></option>
              <option value ="awaiting" <?php if($orderStatus === 'awaiting') { echo 'selected';} ?>><?php echo T_('Awaiting') ?></option>
              <option value ="confirmed" <?php if($orderStatus === 'confirmed') { echo 'selected';} ?>><?php echo T_('Confirmed') ?></option>
              <option value ="cancel" <?php if($orderStatus === 'cancel') { echo 'selected';} ?>><?php echo T_('Cancel') ?></option>
              <option value ="expire" <?php if($orderStatus === 'expire') { echo 'selected';} ?>><?php echo T_('Expire') ?></option>
              <option value ="preparing" <?php if($orderStatus === 'preparing') { echo 'selected';} ?>><?php echo T_('Preparing') ?></option>
              <option value ="sending" <?php if($orderStatus === 'sending') { echo 'selected';} ?>><?php echo T_('Sending') ?></option>
              <option value ="delivered" <?php if($orderStatus === 'delivered') { echo 'selected';} ?>><?php echo T_('Delivered') ?></option>
              <option value ="revert" <?php if($orderStatus === 'revert') { echo 'selected';} ?>><?php echo T_('Revert') ?></option>
              <option value ="success" <?php if($orderStatus === 'success') { echo 'selected';} ?>><?php echo T_('Success') ?></option>
              <option value ="archive" <?php if($orderStatus === 'archive') { echo 'selected';} ?>><?php echo T_('Archive') ?></option>
              <option value ="spam" <?php if($orderStatus === 'spam') { echo 'selected';} ?>><?php echo T_('Spam') ?></option>
            </select>
          </div>
        </div>
      </div>
    </form>
    <?php  if(\dash\get::index($orderDetail, 'action')) {?>
      <div class="tblBox font-12">
        <table class="tbl1 v4">
          <tbody>
            <?php foreach (\dash\get::index($orderDetail, 'action') as $key => $value) { if(\dash\get::index($value, 'category') !== 'status') {continue;} ?>
            <tr>
              <td class=""><?php echo \dash\get::index($value, 't_action') ?></td>
              <td class="collapsing fc-mute"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')) ?></td>
              <td>
                <?php echo \dash\get::index($value, 'desc') ?>
              </td>
            </tr>
          <?php } //endfor ?>
        </tbody>
      </table>
    </div>

  <?php } //endif ?>

  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">
        <p><i class="sf-money-banknote"></i> <?php echo T_("Change order payment status") ?></p>
        <div>
          <select name="orderaction" class="select22">
            <option value ="awaiting_payment" <?php if($orderPayStatus === 'awaiting_payment') { echo 'selected';} ?>><?php echo T_('Awaiting payment') ?></option>
            <option value ="awaiting_verify_payment" <?php if($orderPayStatus === 'awaiting_verify_payment') { echo 'selected';} ?>><?php echo T_('Awaiting verify payment') ?></option>
            <option value ="unsuccessful_payment" <?php if($orderPayStatus === 'unsuccessful_payment') { echo 'selected';} ?>><?php echo T_('Unsuccessful payment') ?></option>
            <option value ="payment_unverified" <?php if($orderPayStatus === 'payment_unverified') { echo 'selected';} ?>><?php echo T_('Payment unverified') ?></option>
            <option value ="successful_payment" <?php if($orderPayStatus === 'successful_payment') { echo 'selected';} ?>><?php echo T_('Successful payment') ?></option>
          </select>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save") ?></button>
      </footer>
    </div>
  </form>
  <?php  if(\dash\get::index($orderDetail, 'action')) {?>
    <div class="tblBox font-12">
      <table class="tbl1 v4">
        <tbody>
          <?php foreach (\dash\get::index($orderDetail, 'action') as $key => $value) { if(\dash\get::index($value, 'category') !== 'paystatus') {continue;} ?>
          <tr>
            <td class=""><?php echo \dash\get::index($value, 't_action') ?></td>
            <td class="collapsing fc-mute"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')) ?></td>
            <td>
              <?php echo \dash\get::index($value, 'desc') ?>
            </td>
          </tr>
        <?php } //endfor ?>
      </tbody>
    </table>
  </div>

<?php } //endif ?>
<form method="post" autocomplete="off" class="hide">

  <div class="box">
    <div class="body">
      <label for='idesc'><?php echo T_("Tracking number") ?></label>
      <textarea name="desc" class="txt" id="idesc" rows="1"></textarea>
      <div class="fc-mute mT10"><?php echo T_("Save Tracking number for this order") ?></div>
    </div>
    <footer class="txtRa">
      <button class="btn master"><?php echo T_("Save") ?></button>
    </footer>
  </div>
</form>

</div>
</div>