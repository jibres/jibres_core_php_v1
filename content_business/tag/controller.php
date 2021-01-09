<?php
namespace content_business\tag;

class controller
{
	public static function routing()
	{
		$child = \dash\url::child();

		if($child)
		{
			// default route
			return false;
		}


		$load_hot_tag = \dash\app\terms\search::hot_tag();

		if(!$load_hot_tag)
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		\dash\data::dataTable($load_hot_tag);

	}
}
?>