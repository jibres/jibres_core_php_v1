<?php
namespace content_cms\hashtag\edit;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit Hashtag'));

		\dash\data::back_text(T_('Hashtags'));
		\dash\data::back_link(\dash\url::this());

		\dash\face::btnView(\dash\data::dataRow_link());


	}
}
?>