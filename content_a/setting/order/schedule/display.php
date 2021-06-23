<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">

      <div class="pad">


          <div class="radio4">
            <input  id="active" type="radio" name="status" value="active" <?php if(\dash\data::dataRow_status() == 'active' || !\dash\data::dataRow_status()) {echo 'checked';} ?>>
            <label for="active">
              <div>
                <div class="title"><?php echo T_("Active"); ?></div>
                <div class="addr"><?php echo T_("Receive orders 24 hours a day, 7 days a week"); ?></div>
              </div>
            </label>
          </div>

          <div class="radio4">
            <input  id="deactive" type="radio" name="status" value="deactive" <?php if(\dash\data::dataRow_status() == 'deactive') {echo 'checked';} ?>>
            <label for="deactive">
              <div>
                <div class="title"><?php echo T_("Deactive"); ?></div>
                <div class="addr"><?php echo T_("Failure to receive the order"); ?></div>
              </div>
            </label>
          </div>

          <div class="radio4">
            <input  id="schedule" type="radio" name="status" value="schedule" <?php if(\dash\data::dataRow_status() == 'schedule') {echo 'checked';} ?>>
            <label for="schedule">
              <div>
                <div class="title"><?php echo T_("Schedule"); ?></div>
                <div class="addr"><?php echo T_("Receive orders according to the weekly schedule"); ?></div>
              </div>
            </label>
          </div>

          <div data-response='status' data-response-where='schedule' <?php if(\dash\data::dataRow_status() !== 'schedule') {echo 'data-response-hide';} ?>>
            <?php $dataRow = \dash\data::dataRow(); ?>
            <table  class="tbl1 v4 mT20">
              <thead>
                <tr>
                  <td><?php echo T_("Active in day?") ?></td>
                  <td><?php echo T_("Start time") ?></td>
                  <td><?php echo T_("End time") ?></td>
                </tr>
              </thead>
              <tbody>
            <?php foreach (\dash\data::weekdayList() as $weekday) {?>
                <tr>
                  <td>
                    <div class="check1">
                      <input type="checkbox" name="<?php echo $weekday; ?>_enable" id="<?php echo $weekday; ?>_enable" <?php if(a($dataRow, $weekday, 'status')) { echo 'checked';} ?>>
                      <label for="<?php echo $weekday; ?>_enable"><?php echo T_($weekday) ?></label>
                    </div>
                  </td>
                  <td>
                    <div class="input">
                      <input type="tel" name="<?php echo $weekday; ?>_start" data-format='time' value="<?php echo a($dataRow, $weekday, 'start') ?>">
                    </div>
                  </td>
                  <td>
                    <div class="input">
                      <input type="tel" name="<?php echo $weekday; ?>_end" data-format='time' value="<?php echo a($dataRow, $weekday, 'end') ?>">
                    </div>
                  </td>
                </tr>
            <?php } //endfor ?>
              </tbody>
            </table>
          </div>

      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save") ?></button>
      </footer>
    </div>
  </form>
</div>