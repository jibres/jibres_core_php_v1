<?php

$options_list   = \content_site\section\gallery\controller::options();
$section_detail = \dash\data::currentSectionDetail();

?>

<nav class="items">
  <ul>
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