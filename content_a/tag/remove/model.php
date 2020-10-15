<?php
namespace content_a\tag\remove;


class model
{
	public static function post()
	{
		$id     = \dash\request::get('id');
		$wd     = \dash\request::post('wd');
		$tag_id = \dash\request::post('tagid');

		if(!\dash\data::dataRow_count())
		{
			\lib\app\tag\remove::remove($id);
		}
		else
		{
			$wd = \dash\validate::enum($wd, false, ['enum' => ['wdn', 'wde']]);
			if(!$wd)
			{
				\dash\notif::error(T_("This tag used in some product. Please specify what you want to do with these products. Do you want to delete this tag from them or select a new tag for them?"), ['alerty' => true]);
				return false;
			}


			if($wd === 'wdn')
			{
				$type = 'select_new_tag';

				$tag_id = \dash\validate::id($tag_id, false);
				if(!$tag_id)
				{
					\dash\notif::error(T_("Please choose new tag"), 'tagid');
					return false;
				}
			}
			else
			{
				$type = 'delete_from_product';
			}

			$action =
			[
				'type'       => $type,
				'new_tag_id' => $tag_id,
			];

			\lib\app\tag\remove::remove_action($id, $action);
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}
		else
		{
			\dash\redirect::pwd();
		}

	}
}
?>