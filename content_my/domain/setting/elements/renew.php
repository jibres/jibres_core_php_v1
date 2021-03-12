<section class="f" data-option='domain-renew'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Auto Renew");?></h3>
      <div class="body">
        <p><?php echo T_("In order to use the Auto-renew feature, you will need to deposit the amount necessary for domain renewal.");?></p>
      </div>
    </div>
  </div>
  <form autocomplete="off" class="c4 s12" method="post" data-patch>
    <div class="action">
      <input type="hidden" name="runaction_autorenew" value="1">
      <div>
        <div class="radio1">
          <input type="radio" name="autorenew" value="default" id="autorenewdefault" <?php if(\dash\data::dataRow_autorenew() === 'default' || !\dash\data::dataRow_autorenew()) {echo 'checked';} ?>>
          <label for="autorenewdefault"><?php echo \dash\data::defaultTitleautorenew(); ?></label>
        </div>
        <div class="radio1 green">
          <input type="radio" name="autorenew" value="enable" id="autorenewenable" <?php if(\dash\data::dataRow_autorenew() === 'enable') {echo 'checked';} ?>>
          <label for="autorenewopen"><?php echo T_("Enable"); ?></label>
        </div>
        <div class="radio1 red">
          <input type="radio" name="autorenew" value="disable" id="autorenewdisable" <?php if(\dash\data::dataRow_autorenew() === 'disable') {echo 'checked';} ?>>
          <label for="autorenewclosed"><?php echo T_("Disable"); ?></label>
        </div>
      </div>
    </div>
  </form>
</section>