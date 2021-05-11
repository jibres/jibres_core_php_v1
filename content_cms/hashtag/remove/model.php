<?php
namespace content_cms\hashtag\remove;


class model
{
	public static function post()
	{
		$id     = \dash\request::get('id');
		$wd     = \dash\request::post('wd');
		$tag_id = \dash\request::post('tagid');

		if(!\dash\data::dataRow_count())
		{
			\dash\app\terms\remove::remove($id);
		}
		else
		{
			$wd = \dash\validate::enum($wd, false, ['enum' => ['wdn', 'wde']]);
			if(!$wd)
			{
				\dash\notif::error(T_("This tag used in some post. Please specify what you want to do with these posts. Do you want to delete this tag from them or select a new tag for them?"), ['alerty' => true]);
				return false;
			}


			if($wd === 'wdn')
			{
				$type = 'select_new';

				$tag_id = \dash\validate::code($tag_id, false);
				if(!$tag_id)
				{
					\dash\notif::error(T_("You must select one category from you list"), 'tagid');
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
				'new_id' => $tag_id,
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