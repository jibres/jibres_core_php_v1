<nav class="items long">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) { ?>
     <li>
      <a class="item f align-center" href="<?php echo \dash\url::that(). '/view?id='. a($value, 'id'); ?>">
        <div class="key"><?php echo a($value, 'to'); ?></div>
        <div class="value"><?php echo a($value, 'subject') ?></div>
        <time class="value"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></time>
        <div class="go"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php \dash\utility\pagination::html(); ?>