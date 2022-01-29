<?php
namespace content_a\products\barcode;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Quick add product from ganje"));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		$search_string = \dash\validate::search_string();

		if($search_string)
		{
			$ganje = \lib\app\product\ganje::search($search_string);

			\dash\data::ganjeSearch($ganje);
		}
	}
}
?>
