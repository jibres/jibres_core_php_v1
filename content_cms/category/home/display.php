<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f" href="<?php echo \dash\url::this(); ?>/edit?id=<?php echo a($value, 'id'); ?>">
        <div class="key" title='<?php echo a($value, 'url'); ?>'><?php echo a($value, 'title'); ?></div>
        <div class="value"><?php echo \dash\fit::number(a($value, 'count')); ?> <small><?php echo T_("Post"); ?></small></div>
        <div class="go"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php \dash\utility\pagination::html(); ?>