<?php
namespace content\contact;


class view extends \content_support\ticket\contact_ticket\view
{
	public static function config()
	{
		\dash\face::title(T_('Contact Us'). ' | '. T_("Jibres"));
		\dash\data::page_desc(T_('Knowing your valuable comments about bugs and problems and more importantly your precious offers will help us in this way.'));
		self::codeurl();

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
	}
}
?>