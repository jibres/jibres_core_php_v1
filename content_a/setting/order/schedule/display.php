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

      </div>

      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Save") ?></button>
      </footer>
    </div>
  </form>
  <div data-response='status' data-response-where='schedule' <?php if(\dash\data::dataRow_status() !== 'schedule') {echo 'data-response-hide';} ?>>
    <form method="post" autocomplete="off">
      <input type="hidden" name="add" value="schedule">
      <div class="box">
        <div class="pad">
          <?php $dataRow = \dash\data::dataRow(); ?>
          <?php if(is_array(a($dataRow, 'schedule'))) {?>
            <table class="tbl1 v4">
              <thead>
                <tr>
                  <td><?php echo T_("Weekday") ?></td>
                  <td><?php echo T_("Start time") ?></td>
                  <td><?php echo T_("End time") ?></td>
                  <td class="collapsing"></td>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($dataRow['schedule'] as $key => $value) { ?>
                  <tr>
                    <td><?php echo T_(ucfirst(a($value, 'weekday'))) ?></td>
                    <td><?php echo \dash\fit::text(substr(a($value, 'start'), 0 , 5)); ?></td>
                    <td><?php echo \dash\fit::text(substr(a($value, 'end'), 0 , 5)); ?></td>
                    <td><div class="" data-ajaxify data-data='{"remove": "time", "index" : "<?php echo $key ?>"}'><i class="sf-trash fc-red"></i></div></td>
                  </tr>
                <?php } //endfor ?>

              </tbody>
            </table>
          <?php } //endif ?>
          <p><?php echo T_("Add your active time in every day") ?></p>
            <div class="row">
              <div class="c-xs-12 c-sm-4">
                <select name="weekday" class="select22">
                  <?php foreach (\dash\data::weekdayList() as $value) { echo '<option value="'. $value. '">'. T_($value). '</option>';} ?>
                  </select>
              </div>
              <div class="c-xs-12 c-sm-4">
                <div class="input">
                  <input type="tel" name="start" data-format='time' >
                </div>
              </div>
              <div class="c-xs-12 c-sm-4">
                <div class="input">
                  <input type="tel" name="end" data-format='time' >
                </div>
              </div>
            </div>
        </div>
        <footer class="txtRa">
          <button class="btn"><?php echo T_('Add') ?></button>
        </footer>
      </div>
    </form>
  </div>
</div>