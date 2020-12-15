<?php
namespace content_cms\category\remove;


class model
{
	public static function post()
	{
		$id     = \dash\request::get('id');
		$wd     = \dash\request::post('wd');
		$category_id = \dash\request::post('categoryid');

		if(!\dash\data::dataRow_count())
		{
			\dash\app\terms\remove::remove($id);
		}
		else
		{
			$wd = \dash\validate::enum($wd, false, ['enum' => ['wdn', 'wde']]);
			if(!$wd)
			{
				\dash\notif::error(T_("This category used in some post. Please specify what you want to do with these posts. Do you want to delete this category from them or select a new category for them?"), ['alerty' => true]);
				return false;
			}


			if($wd === 'wdn')
			{
				$type = 'select_new';

				$category_id = \dash\validate::code($category_id, false);
				if(!$category_id)
				{
					\dash\notif::error(T_("You must select one category from you list"), 'categoryid');
					return false;
				}
			}
			else
			{
				$type = 'delete_from_post';
			}

			$action =
			[
				'type'       => $type,
				'new_id' => $category_id,
			];

			\dash\app\terms\remove::remove_action($id, $action);
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