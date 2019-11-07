<?php
namespace content_a\customer\address;


class view
{
	public static function config()
	{
		\content_a\customer\load::dataRow();

		\dash\data::page_title(T_('Addresses'));
		\dash\data::page_desc(T_('Check addresses and add new one or edit existing address.'));
		\dash\data::page_pictogram('map-marker');

		\dash\data::dataRowMember(\dash\data::dataRow());


		\dash\data::myUrlAddress(\dash\url::this(). '/address');

		\dash\utility\location\cites::html_data();

		$args               = [];
		$args['user_id']    = \dash\coding::decode(\dash\data::dataRow_user_id());
		$args['pagenation'] = false;
		$args['status']     = 'enable';
		$args['subdomain']  = \dash\url::subdomain();

		$dataTable          = \dash\app\address::list(null, $args);

		\dash\data::dataTable($dataTable);

		$id = \dash\request::get('addressid');
		if($id)
		{
			$dataRowAddress = \dash\app\address::get($id);

			if(!isset($dataRowAddress['user_id']))
			{
				\dash\header::status(404, T_("Invalid address id"));
			}

			if(!isset($dataRowAddress['subdomain']) || (isset($dataRowAddress['subdomain']) && $dataRowAddress['subdomain'] !== \dash\url::subdomain()))
			{
				\dash\header::status(403, T_("This is not your address!"));
			}

			\dash\permission::access('customerAddressEdit');

			\dash\data::dataRowAddress($dataRowAddress);

		}

		\content_a\customer\load::fixTitle();
	}
}
?>
