<nav class="items long">
  <ul>
    <li>
      <a class="item f" href="<?php echo \dash\url::this(). '/edit?id='. \dash\request::get('id');?>">
      <?php if(\dash\data::productDataRow_thumb()) { echo '<img src="'. \dash\fit::img(\dash\data::productDataRow_thumb()). '" alt="'. \dash\data::productDataRow_title(). '">'; }?>
        <div class="key"><?php echo \dash\data::productDataRow_title();?></div>
        <div class="go"></div>
      </a>
    </li>
  </ul>
</nav>