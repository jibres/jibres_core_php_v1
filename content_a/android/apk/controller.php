<?php
namespace content_a\android\apk;


class controller
{
	public static function routing()
	{
		$isReadyToCreate = \lib\app\application\detail::is_ready_to_create();
		if(!$isReadyToCreate['ok'])
		{
			\dash\redirect::to(\dash\url::this(). '/review');
		}

	}
}
?>
