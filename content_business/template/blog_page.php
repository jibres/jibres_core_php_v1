<div class="avand">

<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo a($value, 'link') ?>">
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

      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>

</div>
<?php \dash\utility\pagination::html(); ?>
