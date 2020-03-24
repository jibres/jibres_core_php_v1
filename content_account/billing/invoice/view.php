<?php
namespace content_account\billing\invoice;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Invoice Detail"));
		$invoice_detail = \dash\db\invoices::load(\dash\request::get('id'), \dash\user::id());
		\dash\data::invoice($invoice_detail);

		\dash\data::back_link(\dash\url::here(). '/billing');
		\dash\data::back_text(T_('Back'));

	}
}
?>