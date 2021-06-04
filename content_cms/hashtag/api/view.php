<?php
namespace content_cms\hashtag\api;


class view
{
	public static function config()
	{
		$new_list = [];

		if(\dash\validate::search_string())
		{
			// show dropdown of product list
			$list = \dash\app\terms\search::list(\dash\validate::search_string(), ['type' => 'tag', 'pagination' => false, 'limit' => 20, 'sort' => 'title', 'order' => 'asc']);
			if(!is_array($list))
			{
				$list = [];
			}

			foreach ($list as $key => $value)
			{
				if(\dash\request::get('getid'))
				{
					$id = $value['id'];
				}
				else
				{
					$id = $value['title'];
				}

				$new_list[] = ['id' => $id, 'text' => $value['title']];
			}

		}


		\dash\notif::results($new_list);
		\dash\code::end();
	}
}
?>
