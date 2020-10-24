<?php
namespace content_a\form\tag\remove;


class model
{
	public static function post()
	{
		$id     = \dash\request::get('id');
		$wd     = \dash\request::post('wd');
		$tag_id = \dash\request::post('tagid');

		if(!\dash\data::dataRow_count())
		{
			\lib\app\form\tag\remove::remove($id);
		}
		else
		{
			$wd = \dash\validate::enum($wd, false, ['enum' => ['wdn', 'wde']]);
			if(!$wd)
			{
				\dash\notif::error(T_("This tag used in some form. Please specify what you want to do with these forms. Do you want to delete this tag from them or select a new tag for them?"), ['alerty' => true]);
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
				$type = 'delete_from_form';
			}

			$action =
			[
				'type'       => $type,
				'new_tag_id' => $tag_id,
			];

			\lib\app\form\tag\remove::remove_action($id, $action);
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that());
		}
		else
		{
			\dash\redirect::pwd();
		}

	}
}
?>