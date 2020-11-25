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
          <p><i class="sf-arrows-out"></i> <?php echo T_("Change Order status") ?>
          <br><small class="fc-mute"><?php echo T_("Change order status by click on custome status") ?></small>
        </p>
        <div class="row mB10">
          <div class="c-auto">
            <div class="btn mB5 <?php if($orderStatus === 'preparing') { echo 'primary2';} ?>" data-confirm data-data='{"orderaction": "preparing"}'><?php echo T_("Set as preparing") ?></div>
          </div>
          <div class="c-auto">
            <div class="btn mB5 <?php if($orderStatus === 'sending') { echo 'primary2';} ?>" data-confirm data-data='{"orderaction": "sending"}'><i class="sf-bell"></i> <?php echo T_("Set as sending") ?></div>
          </div>

          <div class="c-auto">
            <div class="btn mB5 <?php if($orderStatus === 'delivered') { echo 'primary2';} ?>" data-confirm data-data='{"orderaction": "delivered"}'><?php echo T_("Set as delivered") ?></div>
          </div>

          <div class="c-auto">
            <div class="btn mB5" data-kerkere='.showAllStatusOrder'> <?php echo T_("Something else") ?></div>
          </div>


        </div>


        <div class="showAllStatusOrder" data-kerkere-content='hide'>
          <label for="istatus"><?php echo T_("Choose order status to change it") ?></label>
          <select name="orderaction" id="istatus" class="select22">
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


  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">
        <p>
          <i class="sf-money-banknote"></i> <?php echo T_("Change order payment status") ?>
          <br><small class="fc-mute"><?php echo T_("Change order payment status by click on custome status") ?></small>
        </p>
        <div class="row mB10">
          <div class="c-auto">
            <div class="btn mB5 <?php if($orderPayStatus === 'awaiting_payment') {echo 'primary2';} ?>" data-confirm data-data='{"orderaction": "awaiting_payment"}'><?php echo T_('Awaiting payment') ?></div>
          </div>
          <div class="c-auto">
            <div class="btn mB5 <?php if($orderPayStatus === 'awaiting_verify_payment') {echo 'primary2';} ?>" data-confirm data-data='{"orderaction": "awaiting_verify_payment"}'><?php echo T_('Awaiting verify payment') ?></div>
          </div>

          <div class="c-auto">
            <div class="btn mB5 <?php if($orderPayStatus === 'unsuccessful_payment') {echo 'primary2';} ?>" data-confirm data-data='{"orderaction": "unsuccessful_payment"}'><?php echo T_('Unsuccessful payment') ?></div>
          </div>

          <div class="c-auto">
            <div class="btn mB5 <?php if($orderPayStatus === 'payment_unverified') {echo 'primary2';} ?>" data-confirm data-data='{"orderaction": "payment_unverified"}'><?php echo T_('Payment unverified') ?></div>
          </div>

          <div class="c-auto">
            <div class="btn mB5 <?php if($orderPayStatus === 'successful_payment') {echo 'primary2';} ?>" data-confirm data-data='{"orderaction": "successful_payment"}'><?php echo T_('Successful payment') ?></div>
          </div>
        </div>

      </div>

    </div>
  </form>



  <form method="post" autocomplete="off" >
    <input type="hidden" name="orderaction" value="tracking">
    <div class="box">
      <div class="body">
        <label for='itrackingnumber'><i class="sf-bell"></i> <?php echo T_("Tracking number") ?></label>
        <div class="input ltr">
          <input type="tel" maxlength="30" name="trackingnumber" id="itrackingnumber" value="<?php echo null ?>">
        </div>
        <div class="fc-mute mT10">
          <?php echo T_("Save Tracking number for this order") ?>.
          <?php echo T_("After saving the tracking code, we will send it to the customer") ?>

        </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save") ?></button>
      </footer>
    </div>
  </form>

  <form method="post" autocomplete="off">
    <div class="box">
      <footer class="txtRa">
        <div class="btn linkDel" data-confirm data-data='{"removeorder": "removeorder"}'><?php echo T_("Remove order") ?></div>
      </footer>
    </div>
  </form>

<?php  if(\dash\data::myActionList()) {?>
  <div class="tblBox font-12">
    <table class="tbl1 v4">
      <thead>
        <tr><th colspan="3"><?php echo T_("Action history") ?></th></tr>
      </thead>
      <tbody>
        <?php foreach (\dash\data::myActionList() as $key => $value) { ?>
          <tr>
            <td class=""><?php echo \dash\get::index($value, 't_action') ?></td>
            <td>
              <?php echo \dash\get::index($value, 'desc') ?>
            </td>
            <td class="collapsing fc-mute"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')) ?></td>
          </tr>
        <?php } //endfor ?>
      </tbody>
    </table>
  </div>
<?php } //endif ?>




  </div>
</div>