<div class="avand-md">
  <?php if(\dash\data::menuList()) {?>
    <nav class="items">
      <ul>
        <?php foreach (\dash\data::menuList() as $key => $value) {?>
          <li>
            <a class="f" href="<?php echo \dash\url::this();?>/menu/roster?id=<?php echo a($value, 'id'); ?>">
              <div class="key"><?php echo a($value, 'title');?></div>
              <div class="go"><?php echo \dash\fit::number(a($value, 'count_link')). ' '. T_("Link"); ?> </div>
            </a>
          </li>
        <?php } //enfor ?>
      </ul>
    </nav>
  <?php } //endif ?>
  <nav class="items">
    <ul>
      <li>
        <a class="f" href="<?php echo \dash\url::this(); ?>/menu/add">
          <div class="go plus ok"></div>
          <div class="key"><?php echo T_("Add New Meu");?></div>
        </a>
      </li>
    </ul>
  </nav>
</div>