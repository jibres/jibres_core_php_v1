<?php
if(\dash\data::postIsLoaded())
{
	require_once(__DIR__. '/body/body_load_post.php');
}
elseif(\dash\url::module() === 'category')
{
	// load category detail
	require_once(root. 'content_subdomain/category/display.php');
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