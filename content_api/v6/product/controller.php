<?php
namespace content_api\v6\product;


class controller
{
	public static function routing()
	{
		\content_api\v6\access::check();

		$detail    = [];

		$directory = \dash\url::directory();

		if($directory === 'v6/product/unit')
		{
			$detail = \content_api\v6\product\unit::route();
		}
		else
		{
			\content_api\v6::no(404);
		}

		\content_api\v6::bye($detail);

	}


}
?>