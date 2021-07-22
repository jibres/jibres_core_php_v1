<nav class="items long">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) { ?>
     <li>
      <a class="item f align-center" href="<?php echo \dash\url::that(). '/edit?id='. a($value, 'id'); ?>">
        <div class="key"><?php echo strip_tags(a($value, 'title')); ?></div>
        <time class="value"><?php echo \dash\fit::date(a($value, 'date')); ?></time>
        <div class="go"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php \dash\utility\pagination::html(); ?>
