<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::this(). '/edit?id='.  a($value, 'id') ?>">
        <?php
          if(a($value, 'type') === 'page')
          {
            echo '<img src="'. a($value, 'cover'). '" alt="'. T_("Post image"). '">';
          }
          else
          {
            echo '<img src="'. a($value, 'thumb'). '" alt="'. T_("Post image"). '">';
          }
         ?>
        <div class="key"><?php echo a($value, 'title'); ?></div>
        <div class="value ltr"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></div>
        <div class="go <?php echo $value['icon_list'] ?>"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>
