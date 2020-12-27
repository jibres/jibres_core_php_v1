<?php
$template = \dash\data::website_template();

if(!$template)
{
	$template = 'visitcard';
}

if($template === 'comingsoon' || $template === 'visitcard')
{
	require_once('template/'. $template. '.php');
	// not generate display line in visitcard and comingsoon page
	return;
}
// if $template == 'publish' generate display


if(\dash\engine\template::$finded_template)
{
	// load the business post
	require_once(root. 'content_n/home/display.php');
}
else
{
	// body generator
	$lines = \lib\app\website\generator::get_body_line();

	foreach ($lines as $key => $line_detail)
	{
		if(isset($line_detail['value']['publish']) && $line_detail['value']['publish'])
		{
			if(isset($line_detail['value']['type']))
			{
				$addr = __DIR__. '/body/'. $line_detail['value']['type']. '.php';

				if(is_file($addr))
				{
					require($addr);
				}
			}
		}
	}

}
?>