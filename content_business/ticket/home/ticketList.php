<?php
if(!\dash\data::dataTable())
{
	echo '<div class="msg text-center font-bold">'. T_("No ticket found"). '</div>';
}
else
{
	require_once(root. 'content_crm/ticket/datalist/display.php');
}
?>