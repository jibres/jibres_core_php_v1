
<nav class="items long">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="item f align-center" href="<?php echo \dash\url::that(). '/edit?id='. a($value, 'id'); ?>">
        <div class="key"><?php echo a($value, 'title'); ?></div>
        <div class="value"><?php echo htmlGenerateTag($value) ?></div>
        <time class="value"><?php echo T_(ucfirst(strval(a($value, 'industry')))) ?></time>
        <time class="value"><?php echo a($value, 'language') ?></time>
        <div class="go <?php if(a($value, 'status') === 'accept') {echo 'ok';} ?>"></div>
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