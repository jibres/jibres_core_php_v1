<?php require_once (root. 'content_my/domain/setting/pageStep.php'); ?>
<div class="avand-md">
  <div class="box">
    <div class="pad">

      <p class="msg danger2"><?php echo T_("From here, you can transfer your domain name to another person. To transfer out, you will need to make sure that Domain Lock is turned OFF and get an Auth Code. After you place the request here, we'll send your Auth Code to the registrant email address specified for this domain. It may take up to 5 days for the transfer to be completed."); ?></p>
      <?php if(\dash\data::domainDetail_alertholderaccessdeny()) {?>
        <div class="fc-mute mB10"><?php echo T_("We do not find our contact ID in your domain details. If you want to update your domain transafe lock in jibres, you must set our contact ID (ji128-irnic) as the admin owner of your domain, or allow to all agents to access your domain. To do this, go to nic.ir and set this setting, otherwise we can not update your domain transafe lock") ?></div>
      <?php } //endif ?>
      <div class="f fs06">
        <div class="c6 s12">
          <div class="dcard x1 <?php if(\dash\data::domainDetail_lock()) { echo ' active';} ?>" data-confirm data-data='{"myaction" : "lock"}'>
            <div class="statistic green">
              <div class="value"><i class="sf-lock"></i></div>
              <div class="label"><?php echo T_("Lock domain"); ?></div>
            </div>
          </div>
        </div>
        <div class="c6 s12">
          <div class="dcard x1 <?php  if( (string) \dash\data::domainDetail_lock() === '0') { echo ' active';} ?>" data-confirm data-data='{"myaction" : "unlock"}'>
            <div class="statistic red">
              <div class="value"><i class="sf-unlock"></i></div>
              <div class="label"><?php echo T_("Unlock domain"); ?></div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>