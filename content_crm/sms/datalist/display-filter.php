<?php
$list = \lib\app\sms\log\filter::list();
$filter_title = T_("Show all sms where");
require_once(core. 'layout/tools/display-search-filter.php');
?>