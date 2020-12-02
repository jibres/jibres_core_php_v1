<nav class="items pwaMultiLine">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center">
        <img src="<?php echo \dash\get::index($value, 'avatar'); ?>" alt="Avatar - <?php echo \dash\get::index($value, 'displayname'); ?>">
        <div class="key">
          <div class="line1"><?php echo \dash\get::index($value, 'displayname'); ?></div>
          <div class="line2 f txtB"><?php echo \dash\get::index($value, 'title'); ?></div>
        </div>

        <div class="value datetime s0"><?php echo \dash\fit::date_time($value['datecreated']); ?></div>
        <div class="go detail s0"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>
