<?php require_once(root. 'content_crm/member/userDetail.php'); ?>
<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::that(). '/detail'. \dash\request::full_get(['tid' => a($value, 'id')]) ?>">
        <div class="spay-32-<?php echo a($value, 'payment'); ?> key cauto"></div>
        <div class="key txtB ltr"><?php if(isset($value['plus']) && $value['plus']) {?><b>+<?php echo \dash\fit::price($value['plus']); ?></b><?php }?><?php if(isset($value['minus']) && $value['minus']) {?><b>-<?php echo \dash\fit::price($value['minus']); ?></b><?php }?></div>
<?php if(isset($value['verify']) && $value['verify']) {?>
        <div class="go check ok"></div>
<?php }else{ ?>
        <div class="go times nok"></div>
<?php }//endif ?>
        <div class="value datetime s0"><?php echo \dash\fit::date_time($value['date']); ?></div>
        <div class="go s0"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>
