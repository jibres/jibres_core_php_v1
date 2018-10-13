<?php
namespace content_a\thirdparty\address;


class view
{
	public static function config()
	{
		\dash\permission::access('aThirdPartyEdit');
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Edit address'). \dash\data::page_title());
		\dash\data::page_desc(T_('set current location and full address'));

		\dash\utility\location\cites::html_data();

		$args               = [];
		$args['user_id']    = \lib\userstore::user_id();
		$args['pagenation'] = false;
		$args['status']     = 'enable';
		$args['subdomain']  = \dash\url::subdomain();
		$dataTable          = \dash\app\address::list(null, $args);

		\dash\data::dataTable($dataTable);

		$id = \dash\request::get('addressid');
		if($id)
		{
			$dataRow = \dash\app\address::get($id);
			if(!isset($dataRow['user_id']))
			{
				\dash\header::status(404, T_("Invalid address id"));
			}

			if(intval(\dash\coding::decode($dataRow['user_id'])) !== intval(\lib\userstore::user_id()))
			{
				\dash\header::status(403, T_("This is not your address!"));
			}

			\dash\data::addressDataRow($dataRow);

		}
	}
}
?>
