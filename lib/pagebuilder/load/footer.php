<?php
if(!\lib\pagebuilder\load\page::$is_page)
{
	return null;
}

if(\dash\temp::get('pagebuilder_template'))
{
	return;
}


$website_footer = \dash\data::website_footer();

if(!is_array($website_footer))
{
	$website_footer = [];
}

if(!empty($website_footer))
{
	foreach ($website_footer as $key => $value)
	{
		$footer_addr = root. 'lib/pagebuilder/footer/'. $value['type']. '/website.php';
		if(is_file($footer_addr))
		{
			require_once($footer_addr);
		}
	}
}

?>