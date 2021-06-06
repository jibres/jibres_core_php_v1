<?php

$options_list   = \content_site\section\gallery\controller::options();
$section_detail = \dash\data::currentSectionDetail();

$image_list = [];
if(isset($section_detail['preview']['list']) && is_array($section_detail['preview']['list']))
{
  $image_list = $section_detail['preview']['list'];
}

?>

<nav class="items">
  <ul>
    <?php foreach ($image_list as $key => $value) {?>
      <li>
      <a class="item f" href="<?php \dash\url::that(). \dash\request::full_get(['image' => a($value, 'imagekey')]) ?>">
        <img src="<?php echo \dash\utility\icon::url('Image', 'major'); ?>">
        <div class="key"><?php echo a($value, 'alt') ?></div>
        <div class="go"></div>
      </a>
    </li>
    <?php } //endif ?>
    <li>
      <div class="item f" data-ajaxify data-data='{"addimage": "addimage"}'>
        <img src="<?php echo \dash\utility\icon::url('Add', 'major'); ?>">
        <div class="key"><?php echo T_("Add image") ?></div>
        <div class="go"></div>
      </div>
    </li>
  </ul>
</nav>

<?php
echo \lib\sitebuilder\options::admin_html($options_list, $section_detail);
echo \lib\sitebuilder\section_tools::remove_hide_html($section_detail);
?>