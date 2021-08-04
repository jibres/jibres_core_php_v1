<nav class="items long">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {  if(strtotime(a($value, 'date')) < time()){continue;}?>
     <li>
      <a class="item f align-center" href="<?php echo \dash\url::that(). '/edit?id='. a($value, 'id'); ?>">
        <div class="key"><?php echo strip_tags(a($value, 'title')); ?></div>
        <div class="value"><?php echo htmlGenerateTag($value) ?></div>
        <time class="value"><?php if(a($value, 'date')) { echo \dash\fit::date(a($value, 'date'));}else{echo T_("Soon");} ?></time>
        <div class="go"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<nav class="items long">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {  if(strtotime(a($value, 'date')) > time()){continue;}?>
     <li>
      <a class="item f align-center" href="<?php echo \dash\url::that(). '/edit?id='. a($value, 'id'); ?>">
        <div class="key"><?php echo strip_tags(a($value, 'title')); ?></div>
        <div class="value"><?php echo htmlGenerateTag($value) ?></div>
        <time class="value"><?php if(a($value, 'date')) { echo \dash\fit::date(a($value, 'date'));}else{echo T_("Soon");} ?></time>
        <div class="go"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php \dash\utility\pagination::html(); ?>
<?php

function htmlGenerateTag($value)
{
  $html = '';
  for ($i=1; $i <= 5 ; $i++)
  {
    if(a($value, 'tag'. $i))
    {
      $html .= '<i>#'. $value['tag'.$i].'</i> ';
    }
  }

  return $html;
}
?>