<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::kingdom(). '/pay/'. \dash\get::index($value, 'token') ?>">
        <img src="<?php echo \dash\get::index($value, 'avatar'); ?>" alt="Avatar - <?php echo \dash\get::index($value, 'displayname'); ?>">
        <div class="key username"><?php echo \dash\get::index($value, 'displayname'); ?></div>

        <div class="key"><?php echo \dash\get::index($value, 'title'); ?></div>
        <div class="value datetime s0"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
        <div class="go s0"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>
