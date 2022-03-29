

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

<div class="max-w-screen-sm mx-auto select-none">
  <div class="text-center mt-2 mb-6">
    <img class="mb-2" src="<?php echo \dash\url::cdn(); ?>/img/account/profile-cover.png" alt='<?php echo T_("Personal info"); ?>'>
    <h2 class="font-bold text-2xl leading-loose"><?php echo \dash\face::title(); ?></h2>
    <p class="leading-loose text-zinc-500 mb-2 text-sm"><?php echo T_('Basic info, like your name and photo, that you use on our services'); ?></p>
  </div>




  <div class="text-sm">
    <section class="mb-4 bg-white rounded-lg border">
        <div class="p-2 lg:p-4">
          <div class="flex flex-wrap">
            <div class="grow">
              <h3 class="text-lg font-bold leading-loose"><?php echo T_("Account"); ?></h3>
              <p class="text-zinc-500 leading-loose text-xs"><?php echo T_("You can enter to your account with username and mobile."); ?></p>
            </div>
            <div class="flex-none order-first basis-full lg:basis-auto">
              <img class="w-64 mx-auto" src="<?php echo \dash\url::cdn(); ?>/img/account/profile-dashboard.png" alt='<?php echo T_("Profile"); ?>'>
            </div>
          </div>
        </div>

        <nav class="items insideBox">
          <ul>
            <li>
              <a class="item flex">
                <div class="key grow"><?php echo T_("Mobile"); ?></div>
                <div class="value ltr"><?php echo \dash\data::dataRow_mobile(); ?></div>
                <div class="go detail"></div>
              </a>
            </li>

            <li>
              <a class="item flex">
                <div class="key grow"><?php echo T_("Permission"); ?></div>
                <div class="value ltr"><?php echo \dash\data::permName(); ?></div>
                <div class="go detail"></div>
              </a>
            </li>

            <li>
              <a class="item flex" href="<?php echo \dash\url::this(); ?>/username">
                <div class="key grow"><?php echo T_("Username"); ?></div>
                <div class="value ltr"><?php echo \dash\data::dataRow_username(); ?></div>
                <div class="go"></div>
              </a>
            </li>

            <li>
              <a class="item flex" href="<?php echo \dash\url::this(); ?>/email">
                <div class="key grow"><?php echo T_("Email"); ?></div>
                <div class="value ltr"><?php echo \dash\data::myMasterEmail(); ?></div>
                <div class="go"></div>
              </a>
            </li>

          </ul>
        </nav>
    </section>

    <section class="mb-4">


        <div class="bg-white rounded-lg border">
        <div class="p-2 lg:p-4">
          <div class="f">
            <div class="c s12">
              <h3 class="text-lg font-bold leading-loose"><?php echo T_("Profile"); ?></h3>
              <p class="text-zinc-500 leading-5 text-xs"><?php echo T_("Some info may be visible to other people using our service."); ?> <a href="<?php echo \dash\url::kingdom(); ?>/privacy" target="_blank" class="link-dark"><?php echo T_("Learn more"); ?></a></p>
            </div>
          </div>
        </div>
        <table class="tbl1 v4 mb-0">
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
            <td><?php if(\dash\data::dataRow_gender()) { echo T_(ucfirst(\dash\data::dataRow_gender())); } ?></td>
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
            <td><?php if(\dash\data::dataRow_bio()) { echo nl2br(\dash\data::dataRow_bio()); } ?></td>
            <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/profile" class="block <?php echo $arrow; ?>"></a></td>
          </tr>
        </table>
      </div>




    </section>

    <section class="mb-4">



        <div class="bg-white rounded-lg border">
        <div class="p-2 lg:p-4">
          <div class="f">
            <div class="c s12">
              <h3 class="text-lg font-bold leading-loose"><?php echo T_("Social networks"); ?></h3>
              <p class="text-zinc-500 leading-5 text-xs"><?php echo T_("Website, Email and Social Networks"); ?></p>
            </div>
            <div class="cauto s12">
              <img class="w-64 mx-auto" src="<?php echo \dash\url::cdn(); ?>/img/account/social.svg" alt='<?php echo T_("Social Networks"); ?>'>
            </div>
          </div>
        </div>
        <table class="tbl1 v4 mb-0">
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

</div>




