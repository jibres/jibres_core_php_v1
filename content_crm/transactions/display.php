<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::kingdom(). '/pay/'. \dash\get::index($value, 'token') ?>">
        <img src="<?php echo \dash\get::index($value, 'avatar'); ?>" alt="Avatar - <?php echo \dash\get::index($value, 'displayname'); ?>">
        <div class="key"><?php echo \dash\get::index($value, 'displayname'); ?></div>

        <div class="value txtB"><?php if(isset($value['plus']) && $value['plus']) {?><b>+<?php echo \dash\fit::number($value['plus']); ?></b><?php }?><?php if(isset($value['minus']) && $value['minus']) {?><b>-<?php echo \dash\fit::number($value['minus']); ?></b><?php }?></div>
        <div class="spay-32-<?php echo \dash\get::index($value, 'payment'); ?> key cauto"></div>
<?php if(isset($value['verify']) && $value['verify']) {?>
        <div class="go check ok"></div>
<?php }else{ ?>
        <div class="go times nok"></div>
<?php }//endif ?>
        <div class="value s0"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
        <div class="go s0"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>
