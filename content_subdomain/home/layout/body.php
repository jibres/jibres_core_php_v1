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
elseif(\dash\url::module() === 'p')
{
	// load product detail
	require_once(root. 'content_subdomain/p/home/display.php');
}
elseif(\dash\url::module() === 'cart')
{
	// load cart detail
	require_once(root. 'content_subdomain/cart/display.php');
}
elseif(\dash\url::module() === 'tag')
{
	// load tag detail
	require_once(root. 'content_subdomain/tag/display.php');
}
elseif(\dash\url::module() === 'shiping')
{
	// load shiping detail
	require_once(root. 'content_subdomain/shiping/display.php');
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