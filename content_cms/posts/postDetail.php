<nav class="items long">
  <ul>
    <li>
      <a class="item f" href="<?php echo \dash\url::this(). '/edit?id='. \dash\request::get('id');?>">
<?php if(\dash\data::dataRow_thumb()) {?>
        <?php echo '<img src="'. \dash\fit::url_thumb(\dash\data::dataRow_thumb()). '" alt="'. \dash\data::dataRow_title(). '">'; ?>
<?php } else {
$type = 'news';
switch (\dash\data::dataRow_subtype())
{
  case 'standard':
    $type = 'news';
    break;

  case 'gallery':
    $type = 'picture';
    break;

  case 'video':
    $type = 'film';
    break;

  case 'audio':
    $type = 'music';
    break;

  default:
    break;
}
echo '<i class="sf-'. $type. '"></i>';
}?>
        <div class="key"><?php echo \dash\data::dataRow_title();?></div>
        <div class="value"><?php echo T_(\dash\data::dataRow_tstatus());?></div>
        <div class="go <?php echo \dash\data::dataRow_icon_list() ?>"></div>
      </a>
    </li>
  </ul>
</nav>

