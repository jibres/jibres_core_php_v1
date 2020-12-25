<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::this(). '/view?id='.  a($value, 'id') ?>">
        <img src="<?php echo a($value, 'thumb'); ?>" alt="<?php echo T_("Post image") ?>">
        <div class="key"><?php echo a($value, 'title'); ?></div>
        <div class="value s0"><?php echo \dash\fit::file_size(a($value, 'size')); ?></div>
        <div class="value"><span class="badge"><?php echo a($value, 'type'); ?></span></div>
        <div class="value ltr s0"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></div>
        <div class="go <?php echo $value['icon_list'] ?>"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>