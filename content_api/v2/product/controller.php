<?php
namespace content_api\v2\product;


class controller
{
	public static function routing()
	{
		$detail    = [];

		$directory = \dash\url::directory();

		if($directory === 'v2/product/unit')
		{
			\content_api\v2::check_apikey();
			$detail = \content_api\v2\product\unit::route();
		}
		elseif($directory === 'v2/product/company')
		{
			\content_api\v2::check_apikey();
			$detail = \content_api\v2\product\company::route();
		}
		elseif($directory === 'v2/product/comment')
		{
			// need less to check user
			$detail = \content_api\v2\product\comment::route();
		}
		elseif($directory === 'v2/product/add')
		{
			// need less to check user
			$detail = \content_api\v2\product\add::route();
		}
		elseif($directory === 'v2/product')
		{
			\content_api\v2::check_store_init();
			$detail = \content_api\v2\product\get::route();
		}
		else
		{
			\content_api\v2::invalid_url();
		}

		\content_api\v2::say($detail);

	}


}
?>