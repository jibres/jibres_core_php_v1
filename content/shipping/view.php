<?php
namespace content\shipping;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Shipping'));
		\dash\face::desc(T_("Save up to 90% on shipping and send your products with confidence using simplified tools that scale with your business."));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-shipping-1.jpg');

	}
}
?>