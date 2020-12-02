<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::kingdom(). '/pay/'. \dash\get::index($value, 'token') ?>">
        <img src="<?php echo \dash\get::index($value, 'avatar'); ?>" alt="Avatar - <?php echo \dash\get::index($value, 'displayname'); ?>">
        <div class="key"><?php echo \dash\get::index($value, 'displayname'); ?></div>
        <div class="key mobile"><?php echo \dash\fit::mobile(\dash\get::index($value, 'mobile')); ?></div>

        <div class="value datetime s0"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
        <div class="go s0"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>







<?php

$shoLogUrl = '';
if(\dash\request::get('showlog'))
{
  $shoLogUrl = '&showlog=1';
}

$statuUrl = '';
if(\dash\request::get('status'))
{
  $shoLogUrl = '&status='. \dash\request::get('status');
}

?>
<table class="tbl1 v1 cbox fs12">
    <thead>
      <tr class="fs07">
        <th data-sort="<?php echo \dash\get::index($value, 'username', 'order'); ?>">
          <a href='<?php echo \dash\get::index($value, 'username', 'link'); ?>'><?php echo T_("Username"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'displayname', 'order'); ?>">
          <a href='<?php echo \dash\get::index($value, 'displayname', 'link'); ?>'><?php echo T_("Display Name"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'mobile', 'order'); ?>" class="collapsing">
          <a href='<?php echo \dash\get::index($value, 'mobile', 'link'); ?>'><?php echo T_("Mobile"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'email', 'order'); ?>" class="collapsing s0 m0">
          <a href='<?php echo \dash\get::index($value, 'email', 'link'); ?>'><?php echo T_("Email"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'password', 'order'); ?>" class="collapsing s0">
          <a href='<?php echo \dash\get::index($value, 'password', 'link'); ?>'><?php echo T_("Password"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'status', 'order'); ?>" class="collapsing s0">
          <a href='<?php echo \dash\get::index($value, 'status', 'link'); ?>'><?php echo T_("Status"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'permission', 'order'); ?>" class="collapsing s0 m0">
          <a href='<?php echo \dash\get::index($value, 'permission', 'link'); ?>'><?php echo T_("Permission"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'datecreated', 'order'); ?>" class="collapsing s0 m0">
          <a href='<?php echo \dash\get::index($value, 'datecreated', 'link'); ?>'><?php echo T_("Created date"); ?></a>
        </th>
        <th data-sort="<?php echo \dash\get::index($value, 'datemodified', 'order'); ?>" class="collapsing s0 m0">
          <a href='<?php echo \dash\get::index($value, 'datemodified', 'link'); ?>'><?php echo T_("Last Modified"); ?></a>
        </th>
        <th>
          <?php echo T_("Edit"); ?>
        </th>
      </tr>
    </thead>
    <tbody>

      <?php foreach (\dash\data::dataTable() as $key => $value) {?>


      <tr <?php if(isset($value['status']) && in_array($value['status'], ['disable','removed','filter','unreachable'])) { echo ' class= "negative"';}else{}?>>
        <td>
          <a href="<?php echo \dash\url::this(); ?>/glance?id=<?php echo $value['id']; ?><?php echo $shoLogUrl; ?>">
            <img src="<?php echo $value['avatar']; ?>" alt='<?php echo $value['id']; ?>' width="40" class="pRa5"> <?php echo $value['username']; ?>
          </a>
        </td>
        <td>
          <div class="s0">
            <small>
              <a href="<?php echo \dash\url::this(); ?>?gender=<?php echo $value['gender']; ?><?php echo $statuUrl; ?>"><?php if($value['gender'] === 'male') { echo T_("Mr"); }elseif($value['gender'] == 'female') { echo T_("Mrs"); }else{ echo '-';} ?></a>
              <a href="<?php echo \dash\url::this(); ?>?firstname=<?php echo urlencode($value['firstname']); ?><?php echo $statuUrl; ?>"><?php echo $value['firstname']; ?></a>
            </small>
            <a href="<?php echo \dash\url::this(); ?>?lastname=<?php echo urlencode($value['lastname']); ?><?php echo $statuUrl; ?>"><?php echo $value['lastname']; ?></a>
          </div>
          <div class="mT5">
            <a href="<?php echo \dash\url::this(); ?>/glance?id=<?php echo $value['id']; ?><?php echo $shoLogUrl; ?>" class="txtB block"><span class="sf-user"></span> <?php echo $value['displayname']; ?></a>
          </div>
        </td>
        <td class="pRa5">
          <a href="<?php echo \dash\url::this(); ?>/glance?id=<?php echo $value['id']; ?><?php echo $shoLogUrl; ?>"><?php echo \dash\fit::mobile($value['mobile']); ?></a>
        </td>
        <td class="s0 m0 pRa5">
          <a href="<?php echo \dash\url::this(); ?>/glance?id=<?php echo $value['id']; ?><?php echo $shoLogUrl; ?>"><?php echo $value['email']; ?></a>
        </td>
        <td class="s0 collapsing">

          <?php if(isset($value['password']) && $value['password']) {?><i class="sf-check fc-green" title='<?php echo T_("Password is set"); ?>'></i><?php }else{ ?><i class="sf-times fc-red" title='<?php echo T_("Password is not set!"); ?>'></i><?php }//endif ?>
          <?php if(isset($value['twostep']) && $value['twostep']) {?><a href="<?php echo \dash\url::this(); ?>?twostep=yes<?php echo $statuUrl; ?>"><i class="sf-unlock-alt fc-green" title='<?php echo T_("Two step verification in enabled"); ?>'></i></a><?php }else{ ?><i class="sf-unlock fc-mute" title='<?php echo T_("Two step verification in disable"); ?>'></i><?php }//endif ?>
          <?php if(isset($value['chatid']) && $value['chatid']) {?><a href="<?php echo \dash\url::this(); ?>?chatid=yes<?php echo $statuUrl; ?>"><i class="sf-paper-plane fc-blue" title='<?php echo T_("Have chatid"); ?>'></i></a><?php }else{ ?><a href="<?php echo \dash\url::this(); ?>?chatid=no<?php echo $statuUrl; ?>"><i class="sf-paper-plane fc-mute" title='<?php echo T_("Have not chatid"); ?>'></i></a><?php }//endif ?>
          <?php if(isset($value['android_uniquecode']) && $value['android_uniquecode']) {?><a href="<?php echo \dash\url::this(); ?>?android_uniquecode=yes<?php echo $statuUrl; ?>"><i class="sf-android fc-blue" title='<?php echo T_("Have android_uniquecode"); ?>'></i></a><?php }else{ ?><a href="<?php echo \dash\url::this(); ?>?android_uniquecode=no<?php echo $statuUrl; ?>"><i class="sf-android fc-mute" title='<?php echo T_("Have not android uniquecode"); ?>'></i></a><?php }//endif ?>

          <?php if(isset($value['email']) && $value['email']) {?>

            <a href="<?php echo \dash\url::this(); ?>?email=yes<?php echo $statuUrl; ?>">
              <i class="sf-at fc-blue" title='<?php echo T_("Have email"); ?>'></i>
            </a>

          <?php }else{ ?>

            <a href="<?php echo \dash\url::this(); ?>?email=no<?php echo $statuUrl; ?>">
              <i class="sf-at fc-mute" title='<?php echo T_("Have not email"); ?>'></i>
            </a>

          <?php } //endif ?>

        </td>
        <td class="s0">
          <a href="<?php echo \dash\url::this(); ?>?status=<?php echo $value['status']; ?>"><?php echo T_($value['status']); ?></a>
        </td>
        <td class="s0 m0">
          <a href="<?php echo \dash\url::this(); ?>?permission=<?php echo $value['permission']; ?><?php echo $statuUrl; ?>"><?php echo T_(ucfirst($value['permission'])); ?></a>
        </td>
        <td class="s0 m0"><small class="fc-mute"><?php if(isset($value['datecreated']) && $value['datecreated']) { echo \dash\fit::date_human($value['datecreated']); }else{ echo '-';} ?></small></td>
        <td class="s0 m0"><small class="fc-mute"><?php if(isset($value['datemodified']) && $value['datemodified']) { echo \dash\fit::date_human($value['datemodified']); }else{ echo '-';} ?></small></td>
        <td class="collapsing"><a href="<?php echo \dash\url::this(); ?>/glance?id=<?php echo $value['id']; ?><?php echo $shoLogUrl; ?>"><i class="sf-edit fc-blue"></i></a></td>
      </tr>
      <?php } //endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html() ?>