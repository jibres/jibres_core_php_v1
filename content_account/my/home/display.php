

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
  <img class="box700 mB20-f" src="<?php echo \dash\url::cdn(); ?>/img/account/profile-cover.png" alt='<?php echo T_("Personal info"); ?>'>
  <h2><?php echo \dash\face::title(); ?></h2>
  <p><?php echo T_('Basic info, like your name and photo, that you use on our services'); ?></p>
</div>


<div class="fs14">
  <section class="mB20">


      <div class="panel">
      <div class="body pad">
        <div class="f">
          <div class="c s12">
            <h3><?php echo T_("Account"); ?></h3>
            <p><?php echo T_("You can enter to your account with username and mobile."); ?></p>
          </div>
          <div class="cauto s12">
            <img class="box300" src="<?php echo \dash\url::cdn(); ?>/img/account/profile-dashboard.png" alt='<?php echo T_("Profile"); ?>'>
          </div>
        </div>
      </div>
      <table class="tbl1 v4 mB0">
        <tr>
          <th class="s0"><?php echo T_("Username"); ?></th>
          <td><?php echo \dash\data::dataRow_username(); ?></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/username" class="block <?php echo $arrow; ?>"></a></td>
        </tr>
        <tr>
          <th class="s0"><?php echo T_("Mobile"); ?></th>
          <td><?php echo \dash\fit::text(\dash\data::dataRow_mobile()); ?></td>
          <td></td>
        </tr>

         <tr>
          <th class="s0"><?php echo T_("Email"); ?></th>
          <td><?php echo \dash\data::myMasterEmail(); ?></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/email" class="block <?php echo $arrow; ?>"></a></td>
        </tr>

        <?php if(\dash\data::dataRow_permission()) {?>

        <tr>
          <th class="s0"><?php echo T_("Permission"); ?></th>
          <td><?php echo \dash\data::permName(); ?></td>
          <td class="collapsing txtRa"></td>
        </tr>

        <?php }//endif ?>

      </table>
    </div>




  </section>

  <section class="mB20">


      <div class="panel">
      <div class="body pad">
        <div class="f">
          <div class="c s12">
            <h3><?php echo T_("Profile"); ?></h3>
            <p><?php echo T_("Some info may be visible to other people using our service."); ?> <a href="<?php echo \dash\url::kingdom(); ?>/privacy" target="_blank"><?php echo T_("Learn more"); ?></a></p>
          </div>
        </div>
      </div>
      <table class="tbl1 v4 mB0">
        <tr>
          <th><?php echo T_("Avatar"); ?></th>
          <td>
            <div class="f align-center">
              <div class="c s0"><?php echo T_("A photo helps personalize your account"); ?></div>
              <div class="cauto"><img src="<?php echo \dash\data::dataRow_avatar(); ?>" alt='<?php echo T_("Avatar"); ?>' class="avatar fs25 floatRa"></div>
            </div>
          </td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/avatar" class="block <?php echo $arrow; ?>"></a></td>
        </tr>
        <tr>
          <th><?php echo T_("First name"); ?></th>
          <td><?php echo \dash\data::dataRow_firstname(); ?></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/profile" class="block <?php echo $arrow; ?>"></a></td>
        </tr>
        <tr>
          <th><?php echo T_("Last name"); ?></th>
          <td><?php echo \dash\data::dataRow_lastname(); ?></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/profile" class="block <?php echo $arrow; ?>"></a></td>
        </tr>
        <tr>
          <th><?php echo T_("Gender"); ?></th>
          <td><?php echo T_(ucfirst(\dash\data::dataRow_gender())); ?></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/profile" class="block <?php echo $arrow; ?>"></a></td>
        </tr>
        <tr>
          <th><?php echo T_("BirthDate"); ?></th>
          <td><?php echo \dash\fit::date(\dash\data::dataRow_birthday()); ?></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/profile" class="block <?php echo $arrow; ?>"></a></td>
        </tr>
        <tr>
          <th><?php echo T_("Display name"); ?></th>
          <td><?php echo \dash\data::dataRow_displayname(); ?></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/profile" class="block <?php echo $arrow; ?>"></a></td>
        </tr>
        <tr>
          <th><?php echo T_("Bio"); ?></th>
          <td><?php echo nl2br(\dash\data::dataRow_bio()); ?></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/profile" class="block <?php echo $arrow; ?>"></a></td>
        </tr>
      </table>
    </div>




  </section>

  <section class="mB20">



      <div class="panel">
      <div class="body pad">
        <div class="f">
          <div class="c s12">
            <h3><?php echo T_("Social networks"); ?></h3>
            <p><?php echo T_("Website, Email and Social Networks"); ?></p>
          </div>
          <div class="cauto s12">
            <img class="box300" src="<?php echo \dash\url::cdn(); ?>/img/account/social.svg" alt='<?php echo T_("Social Networks"); ?>'>
          </div>
        </div>
      </div>
      <table class="tbl1 v4 mB0">
        <tr>
          <th><?php echo T_("Website"); ?></th>
          <td><?php echo \dash\data::dataRow_website(); ?></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/social" class="block <?php echo $arrow; ?>"></a></td>
        </tr>

        <tr>
          <th><?php echo T_("Instagram"); ?></th>
          <td><?php echo \dash\data::dataRow_instagram(); ?></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/social" class="block <?php echo $arrow; ?>"></a></td>
        </tr>
        <tr>
          <th><?php echo T_("Facebook"); ?></th>
          <td><?php echo \dash\data::dataRow_facebook(); ?></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/social" class="block <?php echo $arrow; ?>"></a></td>
        </tr>
        <tr>
          <th><?php echo T_("Twitter"); ?></th>
          <td><?php echo \dash\data::dataRow_twitter(); ?></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/social" class="block <?php echo $arrow; ?>"></a></td>
        </tr>
          <tr>
          <th><?php echo T_("Linkedin"); ?></th>
          <td><?php echo \dash\data::dataRow_linkedin(); ?></td>
          <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/social" class="block <?php echo $arrow; ?>"></a></td>
        </tr>
      </table>
    </div>



  </section>
</div>










