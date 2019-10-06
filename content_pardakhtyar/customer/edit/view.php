<?php
namespace content_pardakhtyar\customer\edit;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Edit customer"));
		\dash\data::page_desc(T_('Edit name or description of this customer or change status of it.'));
		\dash\data::page_pictogram('edit');

		\dash\data::badge_link(\dash\url::this());
		\dash\data::badge_text(T_('Back to list of customers'));

		$id     = \dash\request::get('id');
		$result = \lib\pardakhtyar\app\customer::get($id);

		if(!$result)
		{
			\dash\header::status(403, T_("Invalid customer id"));
		}

		\dash\data::dataRowCustomer($result);

	}
}
?>