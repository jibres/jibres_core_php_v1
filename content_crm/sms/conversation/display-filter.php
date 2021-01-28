<?php
$list = \lib\app\sms\filter::list();
$filter_title = T_("Show all sms where");
require_once(core. 'layout/tools/display-search-filter.php');
?>