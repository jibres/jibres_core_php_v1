<?php
namespace content_cms\posts\edit;

class controller
{

	public static function routing()
	{

		$id = \dash\request::get('id');
		$detail = \dash\app\posts\get::load_post($id);
		if(!$detail)
		{
			\dash\header::status(403, T_("Invalid id"));
		}

		if(a($detail, 'type') === 'post' && \dash\url::module() !== 'posts')
		{
			\dash\header::status(404, T_("This item is not a post!"));
		}

		if(a($detail, 'type') === 'page' && \dash\url::module() !== 'pages')
		{
			\dash\header::status(404, T_("This item is not a page!"));
		}

		if(a($detail, 'type') === 'help' && \dash\url::module() !== 'help')
		{
			\dash\header::status(404, T_("This item is not a help!"));
		}

		\dash\data::dataRow($detail);

	}
}
?>