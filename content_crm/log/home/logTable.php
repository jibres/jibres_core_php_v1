
<?php function htmlTable() {?>


  <table class="tbl1 v1 cbox fs12">
    <thead class="fs09">
      <tr>
        <th><?php echo T_("User"); ?></th>
        <th><?php echo T_("Detail"); ?></th>
        <th><?php echo T_("Description"); ?></th>
        <th><?php echo T_("Date"); ?></th>

      </tr>
    </thead>

    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>

        <?php $codeValue = \dash\coding::encode($value['from']); ?>

      <tr class="">
        <td class="collapsing txtRa">
          <?php if($codeValue) {?>

          <a href="<?php echo \dash\url::this(); ?>?user=<?php echo $codeValue; ?>">
            <img src="<?php if(isset($value['avatar']) && $value['avatar']) {echo \dash\get::index($value, 'avatar'); }else{ echo \dash\url::siftal(). '/images/default/avatar.png'; } ?>" class="avatar mRa5" alt="<?php echo \dash\get::index($value, 'displayname'); ?>">
            <span class="txtB s0 fs08"><?php echo \dash\get::index($value, 'displayname'); ?></span>
          </a>
          <div class="txtRa fs08">
            <a title='<?php echo T_("Mobile"); ?>'><?php echo \dash\fit::mobile(\dash\get::index($value, 'mobile')); ?></a>
            <a href="<?php echo \dash\url::this(); ?>?userid=<?php echo $codeValue; ?>" class="badge" title='<?php echo T_("User id"); ?>'><?php echo $codeValue; ?></a>
          </div>

          <span class="badge light floatR"><a href="<?php echo \dash\url::this(); ?>/show?id=<?php echo \dash\get::index($value, 'id'); ?>"><?php echo \dash\fit::text($value['id']); ?></a></span>


          <nav class="txtRa">
            <a href="<?php echo \dash\url::this(); ?>?user_id=<?php echo $codeValue; ?>" title='<?php echo T_("User logs"); ?>'><i class="sf-briefcase"></i></a>
            <a href="<?php echo \dash\url::kingdom(); ?>/crm/member/glance?id=<?php echo $codeValue; ?>" title='<?php echo T_("User Profile"); ?>'><i class="sf-user-md"></i></a>
          </nav>

        <?php }else{ ?>

          <a href="<?php echo \dash\url::this(); ?>?session_id=<?php echo \dash\get::index($value, 'session_id'); ?>">
            <img src="<?php echo \dash\url::siftal(); ?>/images/default/avatar.png" class="avatar mRa5" alt='<?php echo T_("Guest"); ?>'>
            <span class="txtB s0 fs08"><?php echo T_("Guest"); ?></span>
          </a><br>
          <span class="badge light floatR"><a href="<?php echo \dash\url::this(); ?>/show?id=<?php echo \dash\get::index($value, 'id'); ?>"><?php echo \dash\fit::text($value['id']); ?></a></span>

        <?php } //endif ?>
        </td>


        <td class="collapsing txtRa">
          <span class="badge warn"><a href="<?php echo \dash\url::this(); ?>?caller=<?php echo \dash\get::index($value, 'caller'); ?>"><?php echo \dash\get::index($value, 'caller'); ?></a></span>


          <br>
          <?php if(isset($value['notification']) && $value['notification']) {?> <i class="sf-bell" title='<?php echo T_("Notification"); ?>'></i><?php }//endif ?>
          <?php if(isset($value['telegram']) && $value['telegram']) {?> <i class="sf-paper-plane" title='<?php echo T_("Telegram"); ?>'></i><?php }//endif ?>
          <?php if(isset($value['sms']) && $value['sms']) {?> <i class="sf-mobile" title='<?php echo T_("SMS"); ?>'></i><?php }//endif ?>
          <?php if(isset($value['email']) && $value['email']) {?> <i class="sf-at" title='<?php echo T_("Email"); ?>'></i><?php }//endif ?>
          <?php if(isset($value['url']) && $value['url']) {?> <a href="<?php echo \dash\get::index($value, 'url'); ?>"><i class="sf-share" title='<?php echo T_("Url"); ?>'></i></a><?php }//endif ?>
          <?php if(isset($value['life_time']) && $value['life_time']) {?> <span class="badge success2"><?php echo \dash\get::index($value, 'life_time'); ?></span><?php }//endif ?>
          <?php if(isset($value['need_answer']) && $value['need_answer']) {?> <span class="sf-check"></span><?php }//endif ?>
          <?php if(isset($value['auto_expire']) && $value['auto_expire']) {?> <br><span class="badge warn2"><?php echo \dash\get::index($value, 'auto_expire'); ?></span><?php }//endif ?>


          <br>
          <a class="badge info" href="<?php echo \dash\url::this(); ?>?status=<?php echo \dash\get::index($value, 'status'); ?>"><?php echo T_($value['status']); ?></a>

        </td>


        <td class="">
          <span class="txtB"><?php echo \dash\get::index($value, 'title'); ?></span>
          <br>
          <?php echo \dash\get::index($value, 'content'); ?>

          <pre>

          <?php if(isset($value['data'])) { print_r($value['data']); }?>

          </pre>



         </td>

        <td class="collapsing">
          <a href="<?php echo \dash\url::this(); ?>?datecreated=<?php echo \dash\get::index($value, 'datecreated'); ?>" title='<?php echo T_("Date created"); ?>'>
            <?php echo \dash\fit::date($value['datecreated']); ?>

          </a>
        <?php if(isset($value['datemodified']) && $value['datemodified']) {?>

        <br>
        <span class="badge danger2" title='<?php echo T_("Date modified"); ?>'>
          <a href="<?php echo \dash\url::this(); ?>?datecreated=<?php echo \dash\get::index($value, 'datemodified'); ?>">
            <?php echo \dash\fit::date($value['datemodified']); ?>
          </a>
        </span>
        <?php } // endif ?>

        </td>





      </tr>
      <?php } //endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>

<?php } //endfunction ?>


<?php function htmlFilter() {?>
<p class="f fs14 msg info2">
  <span class="c"><?php echo \dash\data::dataFilter(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/log"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/log"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2 pTB20"><?php echo T_("Hi!"); ?> <a href="<?php echo \dash\url::here(); ?>/log/add"><?php echo T_("Try to start with add new record!"); ?></a></p>
<?php } //endfunction ?>
