<?php
namespace content_crm\member\address;


class view
{
	public static function config()
	{
		\content_crm\member\main\view::dataRowMember();

		$args               = [];
		$args['user_id']    = \dash\coding::decode(\dash\request::get('id'));
		$args['pagenation'] = false;
		$args['status']     = 'enable';

		$dataTable          = \dash\app\address::list(null, $args);
		\dash\data::dataTable($dataTable);

		\dash\data::myUrlAddress(\dash\url::this(). '/address');

		\dash\data::page_title(T_('Member address'));
		\dash\data::page_desc(T_('set current location and full address'));


	}
}
?>