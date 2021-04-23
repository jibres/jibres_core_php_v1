<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {
      $date_title = '';
      if(a($value, 'datemodified'))
      {
        $date_title .= T_("Date modified"). ': '. \dash\fit::date_time(a($value, 'datemodified')). "\n";
      }
      if(a($value, 'publishdate'))
      {
        $date_title .= T_("Publish date"). ': '. \dash\fit::date_time(a($value, 'publishdate'));
      }
    ?>
     <li>
      <a class="item f align-center" href="<?php echo \dash\url::this(). '/build?id='.  a($value, 'id') ?>">
<?php if(a($value, 'thumb')) {?>
        <?php echo '<img src="'. \dash\fit::img(a($value, 'thumb')). '" alt="'. T_("Post image"). '">'; ?>
<?php } else {
$type = 'news';
switch (a($value, 'subtype'))
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
        <div class="key"><?php echo a($value, 'title'); ?></div>
        <time class="value" datatime="<?php echo $date_title; ?>"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></time>
        <div class="go <?php echo $value['icon_list'] ?>"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php \dash\utility\pagination::html(); ?>