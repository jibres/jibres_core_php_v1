<?php
$options_list   = \content_site\section\blog\controller::options();

echo \lib\sitebuilder\options::admin_html($options_list, \dash\data::currentSectionDetail());
?>
