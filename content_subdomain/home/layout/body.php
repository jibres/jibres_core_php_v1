<?php

$here = root. 'content_subdomain';

$module_url =
[
	'category' => $here. '/category/display.php',
	'orders'   => $here. '/orders/display.php',
	'p'        => $here. '/p/home/display.php',
	'cart'     => $here. '/cart/display.php',
	'tag'      => $here. '/tag/display.php',
	'shipping' => $here. '/shipping/display.php',

];

if(\dash\data::postIsLoaded())
{
	// load the business post
	require_once(__DIR__. '/body/body_load_post.php');
}
elseif(array_key_exists(\dash\url::module(), $module_url))
{
	// load some static module url
	require_once($module_url[\dash\url::module()]);
}
elseif(\dash\url::module() === 'profile')
{
	switch (\dash\url::child())
	{
		case 'notifications':
			require_once(root. 'content_subdomain/profile/notifications/display.php');
			break;

		case 'detail':
			require_once(root. 'content_subdomain/profile/detail/display.php');
			break;

		case 'avatar':
			require_once(root. 'content_subdomain/profile/avatar/display.php');
			break;

		case 'address':
			require_once(root. 'content_subdomain/profile/address/display.php');
			break;

		default:
			require_once(root. 'content_subdomain/profile/home/display.php');
			break;
	}
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