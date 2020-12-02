<?php
namespace content_crm\member\address;


class view
{
	public static function config()
	{
		\content_crm\member\master::view();

		$args               = [];
		$args['user_id']    = \dash\coding::decode(\dash\request::get('id'));
		$args['pagenation'] = false;
		$args['status']     = 'enable';

		$dataTable          = \dash\app\address::list(null, $args);
		\dash\data::dataTable($dataTable);

		\dash\data::myUrlAddress(\dash\url::this(). '/address');

		\dash\face::title(T_('Customer addresses'));

	}

}
?>