<?php $orderDetail = \dash\data::orderDetail(); ?>

<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-9">


    <form method="post" autocomplete="off">

      <div class="box">
        <div class="pad">
          <p><?php echo T_("Change factor date") ?></p>
          <label for='date'><?php echo T_("Date") ?></label>
          <div class="input">
            <input type="tel" data-format='date' name="date" value="<?php echo \dash\utility\convert::to_en_number(\dash\fit::date(\dash\get::index($orderDetail, 'factor', 'date'))) ?>">
          </div>

          <div class="hide">

          <label for='time'><?php echo T_("Time") ?></label>
          <div class="input">
            <input type="tel" data-format='time' name="time" value="<?php echo \dash\get::index($orderDetail, 'factor', 'date') ?>">
          </div>
          </div>

        </div>
        <footer class="txtRa">
          <button class="btn master"><?php echo T_("Save") ?></button>
        </footer>
      </div>
    </form>




  </div>
</div>