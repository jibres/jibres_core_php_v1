<?php $lineSetting = \dash\data::lineSetting(); ?>
<?php if(\lib\pagebuilder\tools\tools::in('device')) {?>
  <form method="post" autocomplete="off" id="form1" data-patch>
    <input type="hidden" name="set_device" value="1">
    <div class="avand-md">
      <div class="box">
        <div class="pad">
          <div class="mB10">
            <label><?php echo T_("Device") ?></label>
            <div class="row">
              <div class="c-xs-6 c-sm-4">
                <div class="radio3">
                  <input type="radio" name="device" value="all" id="deviceall" <?php if(a($lineSetting, 'device') === 'all') { echo 'checked';} ?>>
                  <label for="deviceall"><?php echo T_("All") ?></label>
                </div>
              </div>
              <div class="c-xs-6 c-sm-4">
                <div class="radio3">
                  <input type="radio" name="device" value="desktop" id="devicedesktop" <?php if(a($lineSetting, 'device') === 'desktop') { echo 'checked';} ?>>
                  <label for="devicedesktop"><?php echo T_("Desktop") ?></label>
                </div>
              </div>
              <div class="c-xs-6 c-sm-4">
                <div class="radio3">
                  <input type="radio" name="device" value="mobile" id="devicemobile" <?php if(a($lineSetting, 'device') === 'mobile') { echo 'checked';} ?>>
                  <label for="devicemobile"><?php echo T_("Mobile") ?></label>
                </div>
              </div>
              <?php if(false) {?>
              <div class="c-xs-6 c-sm-3">
                <div class="radio3">
                  <input type="radio" name="device" value="other" id="deviceother" <?php if(a($lineSetting, 'device') === 'other') { echo 'checked';} ?>>
                  <label for="deviceother"><?php echo T_("Other") ?></label>
                </div>
              </div>
            <?php } //endif ?>
            </div>
          </div>
          <?php if(false) {?>

          <div data-response='device' data-response-where='mobile' <?php if(a($lineSetting, 'device') === 'mobile') {}else{ echo 'data-response-hide';} ?>>
            <label><?php echo T_("Mobile Mode") ?></label>
            <div class="mB10">
              <div class="row">
                <div class="c-xs-6 c">
                  <div class="radio3">
                    <input type="radio" name="mobile" value="all" id="mobileall" <?php if(a($lineSetting, 'mobile') === 'all') { echo 'checked';} ?>>
                    <label for="mobileall"><?php echo T_("All") ?></label>
                  </div>
                </div>
                <div class="c-xs-6 c">
                  <div class="radio3">
                    <input type="radio" name="mobile" value="browser" id="mobilebrowser" <?php if(a($lineSetting, 'mobile') === 'browser') { echo 'checked';} ?>>
                    <label for="mobilebrowser"><?php echo T_("Browser") ?></label>
                  </div>
                </div>
                <div class="c-xs-6 c">
                  <div class="radio3">
                    <input type="radio" name="mobile" value="pwa" id="mobilepwa" <?php if(a($lineSetting, 'mobile') === 'pwa') { echo 'checked';} ?>>
                    <label for="mobilepwa"><?php echo T_("PWA") ?></label>
                  </div>
                </div>
                <div class="c-xs-6 c">
                  <div class="radio3">
                    <input type="radio" name="mobile" value="application" id="mobileapplication" <?php if(a($lineSetting, 'mobile') === 'application') { echo 'checked';} ?>>
                    <label for="mobileapplication"><?php echo T_("application") ?></label>
                  </div>
                </div>
                <div class="c-xs-6 c">
                  <div class="radio3">
                    <input type="radio" name="mobile" value="other" id="mobileother" <?php if(a($lineSetting, 'mobile') === 'other') { echo 'checked';} ?>>
                    <label for="mobileother"><?php echo T_("Other") ?></label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } //endif ?>
          <label><?php echo T_("OS") ?></label>
          <div class="mB10">
            <div class="row">
              <div class="c-xs-6 c">
                <div class="radio3">
                  <input type="radio" name="os" value="all" id="osall" <?php if(a($lineSetting, 'os') === 'all') { echo 'checked';} ?>>
                  <label for="osall"><?php echo T_("All") ?></label>
                </div>
              </div>
              <div class="c-xs-6 c">
                <div class="radio3">
                  <input type="radio" name="os" value="windows" id="oswindows" <?php if(a($lineSetting, 'os') === 'windows') { echo 'checked';} ?>>
                  <label for="oswindows"><?php echo T_("Windows") ?></label>
                </div>
              </div>
              <div class="c-xs-6 c">
                <div class="radio3">
                  <input type="radio" name="os" value="linux" id="oslinux" <?php if(a($lineSetting, 'os') === 'linux') { echo 'checked';} ?>>
                  <label for="oslinux"><?php echo T_("Linux") ?></label>
                </div>
              </div>
              <div class="c-xs-6 c">
                <div class="radio3">
                  <input type="radio" name="os" value="mac" id="osmac" <?php if(a($lineSetting, 'os') === 'mac') { echo 'checked';} ?>>
                  <label for="osmac"><?php echo T_("Mac") ?></label>
                </div>
              </div>
              <?php if(false) {?>
              <div class="c-xs-6 c">
                <div class="radio3">
                  <input type="radio" name="os" value="android" id="osandroid" <?php if(a($lineSetting, 'os') === 'android') { echo 'checked';} ?>>
                  <label for="osandroid"><?php echo T_("Android") ?></label>
                </div>
              </div>
              <div class="c-xs-6 c">
                <div class="radio3">
                  <input type="radio" name="os" value="other" id="osother" <?php if(a($lineSetting, 'os') === 'other') { echo 'checked';} ?>>
                  <label for="osother"><?php echo T_("Other") ?></label>
                </div>
              </div>
            <?php } //endif ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
<?php }else{  // url subchild is title ?>
  <section class="f" data-option='website-line-device'>
    <div class="c8 s12">
      <div class="data">
        <h3><?php echo T_("Customize for different devices") ?></h3>
        <div class="body">
          <div class="badge light"><?php echo T_("Device"). ': '.  T_(ucfirst(a($lineSetting, 'device'))); ?></div>
          <?php if(false) {?>
          <div class="badge light"><?php if(a($lineSetting, 'device') === 'mobile') { echo T_("Mobile Mode"). ': '. a($lineSetting, 'mobile');} ?></div>
        <?php } //endif ?>
          <div class="badge light"><?php echo T_("OS"). ': '. T_(ucfirst(a($lineSetting, 'os'))); ?></div>
        </div>
      </div>
    </div>
    <div class="c4 s12">
      <div class="action">
        <a class="btn master" href="<?php echo \dash\url::current(). '/device'. \dash\request::full_get(); ?>"><?php echo T_("Customize"); ?></a>
      </div>
    </div>
  </section>
<?php } //endif ?>