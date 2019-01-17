<?php
namespace content_a\thirdparty\address;


class view
{
	public static function config()
	{
		\content_a\thirdparty\load::dataRow();

		\dash\data::page_title(T_('Addresses'));
		\dash\data::page_desc(T_('Check addresses and add new one or edit existing address.'));
		\dash\data::page_pictogram('map-marker');

		\dash\data::dataRowMember(\dash\data::dataRow());

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

			\dash\permission::access('thirdpartyAddressEdit');

			\dash\data::dataRowAddress($dataRow);

		}

		\content_a\thirdparty\load::fixTitle();
	}
}
?>
