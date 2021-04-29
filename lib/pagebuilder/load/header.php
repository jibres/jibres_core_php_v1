<?php
if(!\lib\pagebuilder\load\page::$is_page)
{
	return null;
}

if(\dash\temp::get('pagebuilder_template'))
{
	return;
}

if(\dash\url::module() === 'app')
{
	return;
}

$website_header = \dash\data::website_header();

if(!is_array($website_header))
{
	$website_header = [];
}

// load announcement before header
require_once(root. 'lib/pagebuilder/header/announcement/website.php');

// load heade
if(!empty($website_header))
{
	foreach ($website_header as $key => $value)
	{
		$header_addr = root. 'lib/pagebuilder/header/'. $value['type']. '/website.php';
		if(is_file($header_addr))
		{
			require_once($header_addr);
		}
	}
}

?>