<?php

$options_list   = \dash\data::currentOptionList();

echo \lib\sitebuilder\options::admin_html($options_list, \dash\data::currentSectionDetail());
?>
