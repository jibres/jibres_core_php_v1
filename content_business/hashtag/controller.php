<?php
namespace content_business\hashtag;

class controller
{
	public static function routing()
	{
		$child = \dash\url::child();
		if(!$child)
		{
			\dash\redirect::to(\dash\url::kingdom());
		}


		\dash\open::get();
	}
}
?>