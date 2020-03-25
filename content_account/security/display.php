
<?php
$arrow = 'sf-chevron-';
if(\dash\data::isLtr())
{
  $arrow .= 'right';
}
else
{
  $arrow .= 'left';
}
?>



<div class="txtC fs14 mTB25">
  <img class="box700 mB20-f" src="<?php echo \dash\url::siftal(); ?>/images/account/security-cover.png" alt='<?php echo T_("Personal info"); ?>'>
  <h2><?php echo \dash\face::title(); ?></h2>
  <p><?php echo \dash\face::desc(); ?></p>
</div>

<div class="fs14">
  <section class="mB20">


    <div class="panel">
      <div class="body pad">
        <div class="f">
          <div class="c">
            <h3><?php echo T_("Signing in to"); ?> <?php echo \dash\face::site(); ?></h3>
          </div>
          <div class="cauto os">
            <img class="box300" src="<?php echo \dash\url::siftal(); ?>/images/account/security-signin.png" alt='<?php echo T_("Signing to account"); ?>'>
          </div>
        </div>
      </div>
      <table class="tbl1 v4 responsive mB0">
        <tr>
          <th><?php echo T_("Password"); ?></th>
          <td></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::kingdom(); ?>/enter/pass/change" target="_blank" class="block <?php echo $arrow; ?>"></a></td>
        </tr>
        <tr>
          <th><?php echo T_("2-Step Verification"); ?></th>
          <td><?php if(\dash\data::dataRow_twostep()) {?><span class="badge fs11 success"><i class="sf-check vltop"></i> <?php echo T_("On"); ?></span><?php }else{ ?><span class="badge fs11 danger"><i class="sf-times vltop"></i> <?php echo T_("Off"); ?></span><?php } //endif ?></td>
          <td class="collapsing txtRa">
            <a href="<?php echo \dash\url::kingdom(); ?>/enter/twostep" target="_blank" class="block <?php echo $arrow; ?>"></a>
          </td>
        </tr>
        <tr>
          <th><?php echo T_("Remember me"); ?></th>
          <td><?php if(\dash\data::dataRow_forceremember()) {?><span class="badge fs11 warn"><i class="sf-check vltop"></i> <?php echo T_("On"); ?></span><?php }else{ ?><span class="badge fs11"><i class="sf-times vltop"></i> <?php echo T_("Off"); ?></span><?php } //endif ?></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/rememberme"class="block <?php echo $arrow; ?>"></a></td>
        </tr>
      </table>
    </div>



  </section>

  <section class="mB20">

    <div class="panel">
      <div class="body pad">
        <div class="f">
          <div class="c">
            <h3><?php echo T_("Ways we can verify it's you"); ?></h3>
            <p><?php echo T_("These can be used to make sure it's really you signing in or to reach you if there's suspicious activity in your account"); ?></p>
          </div>
          <div class="cauto os">
            <img class="box300" src="<?php echo \dash\url::siftal(); ?>/images/account/security-recovery.png" alt='<?php echo T_("Recovery Account"); ?>'>
          </div>
        </div>
      </div>
      <table class="tbl1 v4 responsive mB0">
        <tr>
          <th><?php echo T_("Recovery email"); ?></th>
          <td><?php echo \dash\data::dataRow_email(); ?></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::here(); ?>/my/email" class="block <?php echo $arrow; ?>"></a></td>
        </tr>
        <tr>
          <th><?php echo T_("Recovery phone"); ?></th>
          <td><?php echo \dash\fit::mobile(\dash\data::dataRow_mobile()); ?></td>
          <td></td>
        </tr>
      </table>
    </div>

  </section>

  <section class="mB20">

    <div class="panel">
      <div class="body pad">
        <div class="f">
          <div class="c">
            <h3><?php echo T_("Active Sessions"); ?></h3>
            <p><?php echo T_("Devices that have been active on your account in the last month, or are currently signed in."); ?></p>
            <p><?php echo T_("All of your history about signing in to you account is here and you can check them."); ?> <?php echo T_("If there’s a device you don’t recognize, someone else may have your password."); ?> <?php echo T_("Change your password to protect your Account."); ?></p>
            <a href="<?php echo \dash\url::this(); ?>/sessions" class="btn primary outline"><?php echo T_("Check all active sessions"); ?> <span class="badge primary"><?php if(is_array(\dash\data::sessionsList())) {echo \dash\fit::number(count(\dash\data::sessionsList()));} ?></span></a>
          </div>
          <div class="cauto os">
            <img class="box300" src="<?php echo \dash\url::siftal(); ?>/images/account/privacy-checkup.png" alt='<?php echo T_("Sessions"); ?>'>
          </div>
        </div>
      </div>
    </div>

  </section>

  <section class="mB20">

    <div class="panel">
      <div class="body pad">
        <div class="f">
          <div class="c">
            <h3><?php echo T_("Recent security events"); ?></h3>
            <p><?php echo T_("No activity in the last month."); ?> <?php echo T_("You'll be notified if unusual security activity is detected, like a sign-in from a new device or if a sensitive setting is changed in your account."); ?></p>
          </div>
          <div class="cauto os">
            <img class="box300" src="<?php echo \dash\url::siftal(); ?>/images/account/security-event.svg" alt='<?php echo T_("Security Event"); ?>'>
          </div>
        </div>
      </div>
    </div>

  </section>

  <section class="mB20">

    <div class="panel">
      <div class="body pad">
        <div class="f">
          <div class="c">
            <h3><?php echo T_("API key and Application key"); ?></h3>
            <p><?php echo T_("Protect this key like a password!"); ?></p>
            <p><?php echo T_("Keys used to access APIs in"); ?> <?php echo \dash\face::site(); ?></p>
            <a href="<?php echo \dash\url::here(); ?>/api" class="btn primary outline"><?php echo T_("API key"); ?></a>
            <a href="<?php echo \dash\url::here(); ?>/appkey" class="btn primary outline"><?php echo T_("Application key"); ?></a>
          </div>
          <div class="cauto os">
            <img class="box300" src="<?php echo \dash\url::siftal(); ?>/images/account/data-collected.svg" alt='<?php echo T_("Sessions"); ?>'>
          </div>
        </div>
      </div>
    </div>

  </section>


  <section class="mB20">

    <div class="panel">
      <div class="body pad">
        <div class="f">
          <div class="c">
            <h3><?php echo T_("Delete Account"); ?></h3>
            <p><?php echo T_("You can permanently delete your Account and all your data."); ?></p>
            <a class="btn danger outline sm" href="<?php echo \dash\url::kingdom(); ?>/enter/delete"  target="_blank"><?php echo T_("Delete my Account"); ?></a>
          </div>
          <div class="cauto os">
            <img class="box100" src="<?php echo \dash\url::siftal(); ?>/images/account/account-delete.png" alt='<?php echo T_("Security Event"); ?>'>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>



