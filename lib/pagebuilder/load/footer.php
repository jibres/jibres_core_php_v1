<?php

\lib\pagebuilder\load\page::detect_footer();

$currentFooter = \dash\data::currentFooter();

if(isset($currentFooter['type']))
{
	$footer_addr = root. 'lib/pagebuilder/footer/'. $currentFooter['type']. '/website.php';
	if(is_file($footer_addr))
	{
		require_once($footer_addr);
	}
}
?>