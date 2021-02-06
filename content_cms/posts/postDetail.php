<nav class="items long">
  <ul>
    <li>
      <a class="item f" href="<?php echo \dash\url::this(). '/edit?id='. \dash\request::get('id');?>">
        <img src="<?php echo \dash\data::dataRow_thumb() ?>">
        <div class="key"><?php echo \dash\data::dataRow_title();?></div>
        <div class="value"><?php echo T_(\dash\data::dataRow_tstatus());?></div>
        <div class="go <?php echo \dash\data::dataRow_icon_list() ?>"></div>
      </a>
    </li>
  </ul>
</nav>

