<?php $orderDetail = \dash\data::orderDetail(); ?>

<div class="row p0">
  <div class="c-xs-12 c-sm-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>
  <div class="c-xs-12 c-sm-9">




    <div class="box">
      <div class="pad">
        <div class="tblBox">
          <table class="tbl1 v4">
            <tbody>
              <tr class="active">
                <td><?php echo T_("Has the order been sent?") ?></td>
                <td>
                  <div data-confirm="" data-data='{"setaction": "sending"}' class="link"><?php echo T_("Set as sent") ?></div>
                </td>
              </tr>
              <tr class="positive">
                <td><?php echo T_("Set Deliver to customer") ?></td>
                <td>
                  <div data-confirm="" data-data='{"setaction": "deliver"}' class="link"><?php echo T_("Set as delivered") ?></div>
                </td>
              </tr>
              <tr class="disabled">
                <td><?php echo T_("Reject Order?") ?></td>
                <td>
                  <div data-confirm="" data-data='{"setaction": "reject"}' class="link"><?php echo T_("Set as rejected") ?></div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
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