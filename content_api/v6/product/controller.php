<?php
namespace content_api\v6\product;


class controller
{
	public static function routing()
	{
		\content_api\v6\access::check();

		\content_api\v6\access::store();

		\content_api\v6\access::user();


		$detail    = [];

		$directory = \dash\url::directory();

		if($directory === 'v6/product/unit')
		{
			$detail = \content_api\v6\product\unit::route();
		}
		elseif($directory === 'v6/product/company')
		{
			$detail = \content_api\v6\product\company::route();
		}
		elseif($directory === 'v6/product/guarantee')
		{
			$detail = \content_api\v6\product\guarantee::route();
		}
		else
		{
			\content_api\v6::no(404);
		}

		\content_api\v6::bye($detail);

	}


}
?>