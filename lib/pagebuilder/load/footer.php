<?php
$website_footer = [];

if(isset(\lib\pagebuilder\load\page::$homepage_header_footer['footer']))
{
	$website_footer = \lib\pagebuilder\load\page::$homepage_header_footer['footer'];
}
else
{
	if(!\lib\pagebuilder\load\page::$is_page)
	{
		return null;
	}

	if(\dash\temp::get('pagebuilder_template'))
	{
		return;
	}
}


$current_module_footer = \dash\data::website_footer();
if(is_array($current_module_footer))
{
	$website_footer = $current_module_footer;

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