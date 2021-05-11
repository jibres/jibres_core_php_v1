<?php
namespace content_love\business\sitemap;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Sitemap'));

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());
	}
}
?>