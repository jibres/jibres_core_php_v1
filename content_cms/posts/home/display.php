<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::this(). '/edit?id='.  \dash\get::index($value, 'id') ?>">
        <img src="<?php echo \dash\get::index($value, 'thumb'); ?>" alt="<?php echo T_("Post image") ?>">
        <div class="key"><?php echo \dash\get::index($value, 'title'); ?></div>
        <div class="value ltr"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></div>
        <div class="go <?php echo $value['icon_list'] ?>"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>
