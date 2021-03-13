<?php require_once (root. 'content_my/domain/setting/pageStep.php'); ?>
<?php

$jibres_dns = null;

if(\dash\data::domainDetail_jibres_dns())
{
  $jibres_dns = '<img src="'.\dash\url::logo().'" alt="'.T_('Jibres').'">';
}

?>

<form method="post" autocomplete="off" >
  <div class="avand-sm">

        <?php if(!\dash\data::domainDetail_jibres_dns()) {?>
          <div class="msg info2 f font-16">
            <div class="cauto"><img class="avatar mRa10" src="<?php echo \dash\url::icon() ?>" alt="<?php echo T_("Jibres") ?>"></div>
            <div class="c">
              <?php echo T_("If you want to set your domain Nameserver as our jibres dns record") ?>
              <div data-confirm data-data='{"jibresdns":"jibresdns"}' data-title='<?php echo T_("Are you sure to set your domain Nameserver record on Jibres Nameserver?") ?>' class="btn link"><?php echo T_("Click here") ?></div>
            </div>
          </div>

        <?php } //endif ?>

    <div class="box">
      <div class="pad">
        <label for="ns1"><?php echo T_("Nameserver #1"); ?></label>
        <div class="input ltr">
          <input type="text" name="ns1" id="ns1" maxlength="50" value="<?php echo \dash\data::domainDetail_ns1(); ?>" >
          <?php if(\dash\data::domainDetail_jibres_dns()) {?><label class="addon"><img class="avatar" src="<?php echo \dash\url::icon() ?>"></label><?php }//endif ?>
        </div>

        <label for="ns2"><?php echo T_("Nameserver #2"); ?></label>
        <div class="input ltr">
          <input type="text" name="ns2" id="ns2" maxlength="50" value="<?php echo \dash\data::domainDetail_ns2(); ?>" >
          <?php if(\dash\data::domainDetail_jibres_dns()) {?><label class="addon"><img class="avatar" src="<?php echo \dash\url::icon() ?>"></label><?php }//endif ?>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Update"); ?></button>
      </footer>
    </div>
  </div>
</form>