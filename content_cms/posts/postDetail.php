<?php
switch (\dash\data::dataRow_status())
{
  case 'publish' :      $myIcon = 'check ok'; break;
  case 'draft' :    $myIcon = 'detail'; break;
  case 'deleted' :    $myIcon = 'times'; break;

}
?>
  <nav class="items long">
    <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/edit?id='. \dash\request::get('id');?>">
          <img src="<?php echo \dash\data::dataRow_thumb() ?>">
          <div class="key"><?php echo \dash\data::dataRow_title();?></div>
          <div class="value"><?php echo T_(\dash\data::dataRow_status());?></div>
          <div class="go <?php echo $myIcon ?>"></div>
        </a>
      </li>
    </ul>
  </nav>

