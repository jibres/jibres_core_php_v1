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


		$load_hot_tag = \dash\app\terms\search::hot_tag();

		if(!$load_hot_tag)
		{
			\dash\redirect::to(\dash\url::kingdom());
		}



		\dash\open::get();
	}
}
?>