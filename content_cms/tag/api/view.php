<?php
namespace content_cms\tag\api;


class view
{
	public static function config()
	{
		$new_list = [];

		if(\dash\request::get('q'))
		{
			// show dropdown of product list
			$list = \dash\app\terms\search::list(\dash\request::get('q'), ['type' => 'tag', 'pagination' => false, 'limit' => 20]);
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
	}
}
?>
