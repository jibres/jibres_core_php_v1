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
          <input type="radio" name="autorenew" value="default" id="autorenewdefault" <?php if(is_null(\dash\data::domainDetail_autorenew())) {echo 'checked';} ?>>
          <label for="autorenewdefault"><?php echo \dash\data::defaultTitleautorenew(); ?></label>
        </div>
        <div class="radio1 green">
          <input type="radio" name="autorenew" value="enable" id="autorenewenable" <?php if((string) \dash\data::domainDetail_autorenew() === '1') {echo 'checked';} ?>>
          <label for="autorenewenable"><?php echo T_("Enable"); ?></label>
        </div>
        <div class="radio1 red">
          <input type="radio" name="autorenew" value="disable" id="autorenewdisable" <?php if((string) \dash\data::domainDetail_autorenew() === '0') {echo 'checked';} ?>>
          <label for="autorenewdisable"><?php echo T_("Disable"); ?></label>
        </div>
      </div>
    </div>
  </form>
  <footer>
    <div class="row" data-space='high'>
<?php if(\dash\data::domainDetail_can_renew()) {?>
      <div class="c-auto s0">
          <a class="link" href="<?php echo \dash\url::this(). '/renew?domain='. \dash\request::get('domain'); ?>"><?php echo T_("Renew now") ?></a>
      </div>
<?php } //endif ?>
      <div class="c"></div>
      <div class="c-auto">
        <a class="link" target="_blank" href="<?php echo \dash\url::support(); ?>"><?php echo T_("Help") ?> <i class="sf-link-external"></i></a>
      </div>
    </div>
  </footer>
</section>