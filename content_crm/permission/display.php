<nav class="items">
   <ul>
  <?php foreach (\dash\data::dataTable() as $key => $value) { ?>
      <li>
        <a class="f" href="<?php echo \dash\url::this(). '/edit?id='. $value['id']; ?>">
          <div class="key"><?php echo \dash\get::index($value, 'key'); ?></div>
            <?php if(\dash\get::index($value, 'user_count')) {?>
              <div class="value"><?php echo \dash\fit::number(\dash\get::index($value, 'user_count')). ' '. T_("Person") ?></div>
            <?php } //endif ?>
          <div class="go"></div>
        </a>
      </li>
  <?php } //endif ?>
   </ul>
</nav>