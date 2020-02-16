<?php
require_once (__DIR__ . '/../ticket/ticketTypes.php');


if(\dash\data::dataTable())
{
	require_once (__DIR__ .'/../ticket/ticketTable.php');
}
else
{
	echo '<p class="fs14 msg success2 pTB20">'. T_("Hi!"). ' <a href="'. \dash\url::base(). '/ticket/add">'. T_("Open new ticket!"). '</a></p>';
}
?>
