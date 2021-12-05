


<div class="text-center fs14 mTB25">
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
            <a class="btn-outline-danger" data-confirm  data-data='{"type": "terminateall" <?php echo \dash\csrf::get_json(); ?>}' ><?php echo T_("Terminate all other sessions"); ?></a>
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
            <div class="device72" data-device='<?php echo \dash\str::mb_strtolower(a($row, 'os')); ?>'></div>
          </div>
          <div class="pA5 c s7">
            <div class="mB5"><b><?php echo a($row, 'osName'); ?></b> <?php echo \dash\fit::number(a($row, 'osVer')); ?></div>
            <div class="fc-mute ltr compact font-12"><?php  echo \dash\fit::date_time(a($row, 'datecreated')) ?></div>

            <?php if(isset($row['current_session']) && $row['current_session']) {?>

            <div class="badge success"><?php echo T_("This device"); ?></div>

            <?php }//endif ?>

          </div>
          <div class="pA5 c s12 fs08">
            <div class="mB10"><b><?php echo a($row, 'browser'); ?></b> <?php echo \dash\fit::number(a($row, 'browserVer')); ?></div>
            <div><?php echo \dash\fit::date_human(a($row, 'last')); ?></div>
          </div>
          <div class="pA5 c3 s12">
            <div class="mB5">
              <a target="_blank" href="https://ipgeolocation.io/ip-location/<?php echo a($row, 'ip'); ?>" title='<?php echo T_("Check ip address"); ?>'><?php echo a($row, 'ip'); ?></a>
            </div>
            <div>
              <a class="badge danger" data-confirm data-data='{"id" : "<?php echo a($row, 'id'); ?>", "type": "terminate" <?php echo \dash\csrf::get_json(); ?>  }'><?php echo T_("Terminate"); ?></a>
            </div>
          </div>

          <?php if(\dash\permission::supervisor()) {?>

          <div class="c12 fs05 pA5 ovh"><?php echo a($row, 'agent'); ?></div>

          <?php } //endif ?>

        </div>
      </div>
  <?php } //endfor ?>
    </div>
  </div>
</div>


