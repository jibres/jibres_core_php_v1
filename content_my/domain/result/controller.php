<?php
namespace content_my\domain\result;


class controller
{
	public static function routing()
	{
		$dataResult = \dash\session::get('register_domain_result');
		if(!$dataResult)
		{
			\dash\redirect::to(\dash\url::this());
		}

		\dash\data::dataResult($dataResult);
	}
}
?>