<?php

$options_list   = \content_site\section\blog\controller::options();
$section_detail = \dash\data::currentSectionDetail();

echo \lib\sitebuilder\options::admin_html($options_list, $section_detail);

?>