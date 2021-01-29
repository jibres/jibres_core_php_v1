<?php
$list = \dash\app\transaction\filter::list(\dash\url::child());
$filter_title = T_("Show transaction where");
require_once(core. 'layout/tools/display-search-filter.php');
?>