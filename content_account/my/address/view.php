<?php
namespace content_account\my\address;


class view
{

	public static function config()
	{
		\dash\face::title(T_('Addresses'));


		\dash\data::myUrlAddress(\dash\url::that());

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('Personal info'));


		// back
		\dash\data::back_text(T_('Personal info'));
		\dash\data::back_link(\dash\url::this());


		$dataTable          = \dash\app\address::user_address_list(\dash\user::code());
		\dash\data::dataTable($dataTable);
	}
}
?>
