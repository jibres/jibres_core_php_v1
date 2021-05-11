<?php
namespace content_cms\hashtag\add;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Add new hashtag'));

		\dash\data::back_text(T_('Hashtags'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>