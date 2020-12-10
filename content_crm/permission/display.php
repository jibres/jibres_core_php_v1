<nav class="items">
   <ul>
  <?php foreach (\dash\data::dataTable() as $key => $value) { ?>
      <li>
        <a class="f" href="<?php echo \dash\url::this(). '/edit?id='. $value['id']; ?>">
          <div class="key"><?php echo a($value, 'key'); ?></div>
            <?php if(a($value, 'user_count')) {?>
              <div class="value"><?php echo \dash\fit::number(a($value, 'user_count')). ' '. T_("Person") ?></div>
            <?php } //endif ?>
          <div class="go"></div>
        </a>
      </li>
  <?php } //endif ?>
   </ul>
</nav>