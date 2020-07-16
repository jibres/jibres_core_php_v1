<?php

$here = root. 'content_business';

$module_url =
[
	'category' => $here. '/category/display.php',
	'app'      => $here. '/app/display.php',
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
			require_once(root. 'content_business/profile/notifications/display.php');
			break;

		case 'detail':
			require_once(root. 'content_business/profile/detail/display.php');
			break;

		case 'avatar':
			require_once(root. 'content_business/profile/avatar/display.php');
			break;

		case 'address':
			require_once(root. 'content_business/profile/address/display.php');
			break;

		default:
			require_once(root. 'content_business/profile/home/display.php');
			break;
	}
}
elseif(\dash\url::module() === 'orders')
{
	switch (\dash\url::child())
	{
		case 'view':
			require_once(root. 'content_business/orders/view/display.php');
			break;

		default:
			require_once(root. 'content_business/orders/display.php');
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