<?php
namespace content_a\product\units;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Unit of products'));
		\dash\data::page_desc(T_('You can manage your units manually.'). ' '. T_("Don't worry! we are add units automatically on add new product"));
		\dash\data::page_pictogram('eye-galsses');

		if(is_array($_GET) && array_key_exists('edit', $_GET))
		{
			\dash\data::page_title(T_('Edit product unit'));
		}

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>