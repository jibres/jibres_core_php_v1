<nav class="items ltr">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="item f align-center" href="<?php echo \dash\url::this(). '/view?id='.  a($value, 'id') ?>">
        <img src="<?php echo a($value, 'thumb'); ?>" alt="<?php echo T_("Post image") ?>">
        <div class="key"><?php echo a($value, 'filename'). '.'. a($value, 'ext'); ?></div>

        <div class="value fileSize s0"><?php echo \dash\fit::file_size(a($value, 'size'), true); ?></div>

<?php
$fType = 'file';
switch (a($value, 'type'))
{
  case 'image':
    $fType = 'file-image-o';
    break;

  case 'audio':
    $fType = 'music';
    break;

  case 'video':
    $fType = 'file-video-o';
    break;

  case 'pdf':
    $fType = 'file-pdf-o';
    break;

  case 'zip':
    $fType = 'file-zip-o';
    break;

  default:
    $fType = 'file-o';
    break;
}
echo "<i class='sf-". $fType. "' title='". a($value, 't_type'). "'>". "</i>";
?>
        <time class="value s0" datetime="<?php echo a($value, 'datecreated'); ?>"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></time>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>

<?php \dash\utility\pagination::html(); ?>