<?php
namespace content_cms\comments\edit;

class view
{
	public static function config()
	{

		$id = \dash\request::get('id');

		$detail = \dash\app\comment::get($id);
		if(!$detail)
		{
			\dash\header::status(404, T_("Invalid id"));
		}

		\dash\data::dataRow($detail);

		\dash\face::title(T_("Edit comment"));

		\dash\data::action_link(\dash\url::this());
		\dash\data::action_text(T_('Back to list of comments'));



		if(\dash\data::dataRow_post_id())
		{
			$post_detail = \dash\app\posts::get(\dash\data::dataRow_post_id());
			\dash\data::dataRowPost($post_detail);
		}
	}
}
?>