
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
  <div class="box hide">
    <div class="pad">
      <div class="row">
        <div class="c-auto"><?php if($value['status'] !== 'approved') { echo "<i class='fc-green sf-check-circle font-18'></i>"; }?></div>
        <div class="c"><p><?php echo a($value, 'content'); ?></p></div>
      </div>
    </div>
    <footer class="">
      <div class="row">
        <div class="c-auto mLa10 mB10"><a class="link fc-green" href=""><?php echo T_("Approve") ?></a></div>
        <div class="c-auto mLa10 mB10"><a class="link fc-brown" href=""><?php echo T_("Unapprove") ?></a></div>

      </div>
    </footer>
  </div>
<?php } //endfor ?>

<nav class="items">
  <ul>
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\data::viewCommentModule(). \dash\request::full_get(['cid' => $value['id']]); ?>">
        <img src="<?php echo \dash\fit::img(a($value, 'avatar')); ?>" alt="Avatar - <?php echo a($value, 'displayname'); ?>">
        <div class="key"><?php echo substr(a($value, 'content'), 0, 70); ?></div>
        <div class="value status s0"><?php echo T_($value['status']); ?></div>

        <div class="value datetime humandate s0"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
        <div class="go <?php if(isset($value['status']) && in_array($value['status'], ['unapproved','spam'])) { echo ' times nok';}elseif($value['status'] === 'approved'){echo 'check ok';}else{  }?>"></div>
      </a>
     </li>
<?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>