<?php
namespace content_a\category\remove;


class model
{
	public static function post()
	{
		$id     = \dash\request::get('id');
		$wd     = \dash\request::post('wd');
		$cat_id = \dash\request::post('catid');

		if(!\dash\data::dataRow_count())
		{
			\lib\app\category\remove::remove($id);
		}
		else
		{
			$wd = \dash\validate::enum($wd, false, ['enum' => ['wdn', 'wde']]);
			if(!$wd)
			{
				\dash\notif::error(T_("This category used in some product. Please specify what you want to do with these products. Do you want to delete this category from them or select a new category for them?"), ['alerty' => true]);
				return false;
			}


			if($wd === 'wdn')
			{
				$type = 'select_new_category';

				$cat_id = \dash\validate::id($cat_id, false);
				if(!$cat_id)
				{
					\dash\notif::error(T_("Please choose new category"), 'catid');
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
				'new_cat_id' => $cat_id,
			];

			\lib\app\category\remove::remove_action($id, $action);
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