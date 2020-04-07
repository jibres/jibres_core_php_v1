


<div class="txtC fs14 mTB25">
  <img class="box700 mB20-f" src="<?php echo \dash\url::cdn(); ?>/img/account/privacy-checkup.png" alt='<?php echo T_("Sessions"); ?>'>
  <h2><?php echo \dash\face::title(); ?> <span class="badge"><?php if(is_array(\dash\data::sessionsList())) {echo \dash\fit::number(count(\dash\data::sessionsList()));} ?></span></h2>
  <p><?php echo T_("Devices that have been active on your account in the last month, or are currently signed in."); ?></p>
</div>


<div class="f justify-center">
  <div class="c9 m11 s12">
    <div class="fs16">
      <?php if(\dash\data::sessionsList()) {?>

        <div class="msg f align-center fs08">
          <div class="c s12"><?php echo T_("Don't recognize a device?"); ?></div>
          <div class="cauto os">
            <a class="btn danger outline" data-confirm  data-data='{"type": "terminateall" }' ><?php echo T_("Terminate all other sessions"); ?></a>
          </div>
        </div>

      <?php }else{ ?>

      <div class="msg f align-center fs08">
          <div class="c s12"><?php echo T_("No active session found"); ?></div>

        </div>

      <?php } //endif ?>

      <?php
      $sessionsList = \dash\data::sessionsList();
      if(!is_array($sessionsList))
      {
        $sessionsList = [];
      }

      foreach ($sessionsList as $key => $row) {

      ?>

      <div class="panel mB10">
        <div class="f align-center pad">
          <div class="cauto s5 pRa10">
            <div class="device72" data-device='<?php echo mb_strtolower(\dash\get::index($row, 'os')); ?>'></div>
          </div>
          <div class="pA5 c s7">
            <div class="mB5"><b><?php echo \dash\get::index($row, 'osName'); ?></b> <?php echo \dash\fit::number(\dash\get::index($row, 'osVer')); ?></div>

            <?php if(isset($row['code']) && $row['code'] === \dash\data::currentCookie()) {?>

            <div class="badge success"><?php echo T_("This device"); ?></div>

            <?php }//endif ?>

          </div>
          <div class="pA5 c s12 fs08">
            <div class="mB10"><b><?php echo \dash\get::index($row, 'browser'); ?></b> <?php echo \dash\fit::number(\dash\get::index($row, 'browserVer')); ?></div>
            <div><?php echo \dash\fit::date_human(\dash\get::index($row, 'last')); ?></div>
          </div>
          <div class="pA5 c3 s12">
            <div class="mB5">
              <a target="_blank" href="https://ipgeolocation.io/ip-location/<?php echo \dash\get::index($row, 'ip'); ?>" title='<?php echo T_("Check ip address"); ?>'><?php echo \dash\get::index($row, 'ip'); ?></a>
            </div>
            <div>
              <a class="badge danger" data-confirm data-data='{"id" : "<?php echo \dash\get::index($row, 'id'); ?>", "type": "terminate" }'><?php echo T_("Terminate"); ?></a>
            </div>
          </div>

          <?php if(\dash\permission::supervisor()) {?>

          <div class="c12 fs05 pA5 ovh"><?php echo \dash\get::index($row, 'agent'); ?></div>

          <?php } //endif ?>

        </div>
      </div>
  <?php } //endfor ?>
    </div>
  </div>
</div>


