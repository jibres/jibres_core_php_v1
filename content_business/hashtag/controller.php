<?php
namespace content_business\hashtag;

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

		if(\dash\request::get('id'))
		{
			$id = \dash\validate::code(\dash\request::get('id'));
			if($id)
			{
				$load = \dash\app\terms\get::get($id, true);
				if(a($load, 'link'))
				{
					\dash\redirect::to($load['link']);
				}
			}
		}

		$load_hot_tag = \dash\app\terms\search::hot_tag();

		if(!$load_hot_tag)
		{
			\dash\redirect::to(\dash\url::kingdom());
		}

		\dash\data::dataTable($load_hot_tag);

		\dash\open::get();
	}
}
?>