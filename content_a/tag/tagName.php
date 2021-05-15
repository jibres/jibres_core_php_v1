<nav class="items long">
  <ul>
    <li>
      <a class="item f" href="<?php echo \dash\url::this(). '/edit?id='. \dash\request::get('id');?>">
        <div class="key"><?php echo \dash\data::dataRow_title();?></div>
        <div class="go"></div>
      </a>
    </li>
  </ul>
</nav>