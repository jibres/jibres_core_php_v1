<?php
$list = \dash\app\ticket\filter::list('website');
$filter_title = T_("Show all ticket where");
require_once(core. 'layout/tools/display-search-filter.php');
?>