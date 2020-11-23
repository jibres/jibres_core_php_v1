<?php $orderDetail = \dash\data::orderDetail(); ?>

<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-9">

    <form method="post" autocomplete="off">

      <div class="box">
        <div class="pad">

          <table class="tbl1 v4">
            <tbody>
              <tr>
                <td class="collapsing fc-mute"><?php echo T_("Order date") ?></td>
                <td>
                  <?php echo \dash\fit::date_time(\dash\get::index($orderDetail, 'factor', 'date')); ?>
                </td>
              </tr>
              <tr>
                <td class="collapsing fc-mute"><?php echo T_("Last date modified") ?></td>
                <td>
                  <?php echo \dash\fit::date_time(\dash\get::index($orderDetail, 'factor', 'datemodified')); ?>
                </td>
              </tr>
            </tbody>
          </table>
          <p><?php echo T_("Change factor date") ?></p>
          <label for='date'><?php echo T_("Date") ?></label>
          <div class="input">
            <input type="tel" data-format='date' name="date" value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(\dash\get::index($orderDetail, 'factor', 'date'))) ?>">
          </div>



          <label for='time'><?php echo T_("Time") ?></label>
          <div class="input">
            <input type="tel" data-format='time' name="time" value="<?php echo date("H:i", strtotime(\dash\get::index($orderDetail, 'factor', 'date'))) ?>">
          </div>


        </div>
        <footer class="txtRa">
          <button class="btn master"><?php echo T_("Save") ?></button>
        </footer>
      </div>
    </form>




  </div>
</div>