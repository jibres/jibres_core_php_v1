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


		$args               = [];
		$args['user_id']    = \dash\user::id();
		$args['pagenation'] = false;
		$args['status']     = 'enable';

		$dataTable          = \dash\app\address::list(null, $args);
		\dash\data::dataTable($dataTable);
	}
}
?>
