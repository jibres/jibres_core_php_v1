<?php

\lib\pagebuilder\load\page::detect_header();

$currentHeader = \dash\data::currentHeader();

require_once(root. 'lib/pagebuilder/header/announcement/website.php');

if(isset($currentHeader['type']))
{
	$header_addr = root. 'lib/pagebuilder/header/'. $currentHeader['type']. '/website.php';
	if(is_file($header_addr))
	{
		require_once($header_addr);
	}
}
?>