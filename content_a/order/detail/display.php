<?php $orderDetail = \dash\data::orderDetail(); ?>
<div class="row">
  <div class="c-xs-12 c-md-6">
    <div class="box">
      <div class="body">
        <table class="tbl1 v4">
          <tbody>
            <tr>
              <td><?php echo T_("Customer") ?></td>
              <td>
                <?php if (\dash\get::index($orderDetail, 'factor', 'customer')) {?>
                  <?php echo \dash\get::index($orderDetail, 'factor', 'customer_displayname'); ?>
                  <span class="ltr compact"><?php echo \dash\fit::mobile(\dash\get::index($orderDetail, 'factor', 'customer_mobile')); ?></span>
                  <a class="link btn" href="<?php echo \dash\url::kingdom(). '/crm/member/glance?id='. $orderDetail['factor']['customer']; ?>"><?php echo T_("View profile") ?></a>
                <?php }else{ ?>
                  <?php echo T_("The user is not logged in to save their details!") ?>
                <?php } // endif ?>
              </td>
            </tr>
            <tr>
              <td><?php echo T_("Status") ?></td>
              <td><?php echo \dash\get::index($orderDetail, 'factor', 'status'); ?></td>
            </tr>
            <tr>
              <td><?php echo T_("Order date") ?></td>
              <td><?php echo \dash\fit::date_time(\dash\get::index($orderDetail, 'factor', 'datecreated')); ?> <small class="fc-mute mLa20"><?php echo \dash\fit::date_human(\dash\get::index($orderDetail, 'factor', 'datecreated')) ?></small></td>
            </tr>

            <?php if(\dash\get::index($orderDetail, 'factor', 'discount')) {?>
              <tr>
                <td><?php echo T_("Discount") ?></td>
                <td><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'discount')). ' '. \lib\store::currency(); ?></td>
              </tr>
            <?php } //endif ?>
            <?php if(\dash\get::index($orderDetail, 'factor', 'shipping')) {?>
              <tr>
                <td><?php echo T_("Shipping") ?></td>
                <td><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'shipping')). ' '. \lib\store::currency(); ?></td>
              </tr>
            <?php } //endif ?>

            <tr>
              <td><?php echo T_("Total") ?></td>
              <td><?php echo \dash\fit::number(\dash\get::index($orderDetail, 'factor', 'total')). ' '. \lib\store::currency(); ?></td>
            </tr>
            <?php if(\dash\get::index($orderDetail, 'factor', 'desc')) {?>
              <tr class="warning">
                <td><?php echo T_("Description") ?></td>
                <td><?php echo \dash\get::index($orderDetail, 'factor', 'desc'); ?></td>
              </tr>
            <?php } //endif ?>

            <tr>
              <td><?php echo T_("Address") ?></td>
              <td>
                <?php $address = \dash\get::index(\dash\data::orderDetail(), 'address'); ?>
                <address>
                  <div class="title"><?php echo \dash\get::index($address, 'name'); ?></div>
                  <?php if(\dash\get::index($address, 'mobile')) {?>
                    <div class="mobile"><?php echo T_("Mobile") ?> <b><?php echo \dash\fit::mobile(\dash\get::index($address, 'mobile')); ?></b></div>
                  <?php } //endif ?>
                  <div class="addr"><?php echo \dash\get::index($address, 'address'); ?></div>
                  <?php if(\dash\get::index($address, 'postcode')) {?>
                    <div class="postalcode"><?php echo T_("Postalcode") ?> <b><?php echo \dash\fit::text(\dash\get::index($address, 'postcode')); ?></b></div>
                  <?php } //endif ?>
                  <?php if(\dash\get::index($address, 'phone')) {?>
                    <div class="phone"><?php echo T_("Phone") ?> <b><?php echo \dash\fit::text(\dash\get::index($address, 'phone')); ?></b></div>
                  <?php } //endif ?>
                </address>
              </td>
            </tr>
            <tr class="<?php if (\dash\get::index($orderDetail, 'factor', 'pay')) { echo 'positive'; }else{ echo 'negative';}?>">
              <td><?php echo T_("Pay status") ?></td>
              <td>
                <?php if (\dash\get::index($orderDetail, 'factor', 'pay')) {?>
                  <i class="sf-check-circle fc-green mRa10 fs14"></i><?php echo T_("Factor is payed") ?>
                <?php }else{ ?>
                  <i class="sf-times-circle fc-red mRa10 fs14"></i><?php echo T_("Factor is not payed") ?>
                  <p><?php echo T_("If you get the amount of this factor Set order as paid by click below link") ?></p>
                  <div class="link btn" data-confirm data-data='{"paid": "paid"}' ><?php echo T_("Amount received") ?></div>
                <?php } //endif ?>
              </td>
            </tr>
            <tr>
              <td><?php echo T_("Remove order") ?></td>
              <td>
                <p><?php echo T_("If you think this order is spam") ?></p>
                <div data-confirm data-data='{"removeorder": "removeorder"}' class="linkDel"><?php echo T_("Remove now"); ?></div>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>

    <h3><?php echo T_("Order products") ?></h3>
    <nav class="items">
      <ul>
        <?php foreach (\dash\get::index($orderDetail, 'factor_detail') as $key => $value) {?>
          <li>
            <a class="f" href="<?php echo \dash\url::here(). '/products/edit?id='.\dash\get::index($value, 'product_id'); ?>">
              <div class="key"><?php echo \dash\get::index($value, 'title');?></div>
              <div class="value"><?php echo \dash\fit::number(\dash\get::index($value, 'count')). ' '. \dash\get::index($value, 'unit'); ?></div>
            </a>
          </li>
        <?php } //endfor ?>
      </ul>
    </nav>

  </div>
  <div class="c-xs-12 c-md-6">
    <div class="box">
      <div class="body">
        <table class="tbl1 v4">
          <tbody>
            <tr class="active">
              <td><?php echo T_("Ready to send to customer?") ?></td>
              <td>
                <div data-confirm data-data='{"setasready": "setasready"}' class="link"><?php echo T_("Set as ready"); ?></div>
              </td>
            </tr>
            <tr class="positive">
              <td><?php echo T_("Set Deliver to customer") ?></td>
              <td>
                <div data-confirm data-data='{"setdeliver": "setdeliver"}' class="link"><?php echo T_("Set as deliver"); ?></div>
              </td>
            </tr>
            <tr class="disable">
              <td><?php echo T_("Cancel order") ?></td>
              <td>
                <div data-confirm data-data='{"setascancel": "setascancel"}' class="link"><?php echo T_("Cancel"); ?></div>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>

    <form method="post" autocomplete="off">
      <div class="box">
        <header><h2><?php echo T_("Add comment to this order") ?></h2></header>
        <div class="body padLess">
          <input type="hidden" name="orderaction" value="comment">
          <div class="mB20">
            <textarea id="desc" name="desc" class="txt" rows="3" placeholder="<?php echo T_("Only admin can see the comments") ?>"><?php echo \dash\data::dataRow_desc(); ?></textarea>
          </div>

          <div class="showAttachment" data-kerkere-content='hide'>

            <div class="box" data-uploader data-name='file'>
              <input type="file"  id="file1">
              <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
            </div>
          </div>
        </div>
        <footer class="f">
          <div class="cauto"><i data-kerkere='.showAttachment' class="sf-attach fs14"></i></div>
          <div class="c"></div>
          <div class="cauto"><button class="btn success"><?php echo T_("Add comment") ?></button></div>

        </footer>
      </div>
    </form>

    <h3><?php echo T_("Order Action list") ?></h3>
    <nav class="items">
      <ul>
        <?php foreach (\dash\get::index($orderDetail, 'action') as $key => $value) {?>
          <li>
            <a class="f">
              <div class="key"><?php if(\dash\get::index($value, 'action') === 'comment'){ echo \dash\get::index($value, 'desc'); }else{ echo \dash\get::index($value, 'action');}?></div>
              <div class="value"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated'));?></div>
            </a>
          </li>
        <?php } //endfor ?>
      </ul>
    </nav>
  </div>
</div>
