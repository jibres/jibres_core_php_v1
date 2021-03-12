<?php require_once (root. 'content_my/domain/setting/pageStep.php'); ?>
<?php

$jibres_dns = null;

if(\dash\data::domainDetail_jibres_dns())
{
  $jibres_dns = '<img src="'.\dash\url::logo().'" alt="'.T_('Jibres').'">';
}

?>

<form method="post" autocomplete="off" >
  <div class="avand-md">
    <div class="box">
      <div class="pad">
        <?php if(!\dash\data::domainDetail_jibres_dns()) {?>
          <div class="msg f">
            <div class="cauto"><img class="avatar mRa10" src="<?php echo \dash\url::icon() ?>" alt="<?php echo T_("Jibres") ?>"></div>
            <div class="c">
              <?php echo T_("If you want to set your domain DNS as our jibres dns record") ?>
              <div data-confirm data-data='{"jibresdns":"jibresdns"}' data-title='<?php echo T_("Are you sure to set your domain DNS record on Jibres DNS?") ?>' class="btn link"><?php echo T_("Click here") ?></div>
            </div>
          </div>
        <?php } //endif ?>

        <label for="ns1"><?php echo T_("DNS #1"); ?></label>
        <div class="input ltr">
          <input type="text" name="ns1" id="ns1" maxlength="50" value="<?php echo \dash\data::domainDetail_ns1(); ?>" >
        </div>

        <label for="ns2"><?php echo T_("DNS #2"); ?></label>
        <div class="input ltr">
          <input type="text" name="ns2" id="ns2" maxlength="50" value="<?php echo \dash\data::domainDetail_ns2(); ?>" >
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Update"); ?></button>
      </footer>
    </div>
  </div>
</form>