<form method="get" autocomplete="off" action="<?php echo \dash\url::that() ?>">
  <div class="box">
    <div class="pad">
      <label for="date"><?php echo T_("Date"); ?></label>
      <div class="input">
        <input type="tel" name="date" value="<?php echo \dash\data::currentDate() ?>" data-format="date" id="date">
        <button class="btn-primary addon"><?php echo T_("Report") ?></button>
      </div>
    </div>
  </div>
</form>
