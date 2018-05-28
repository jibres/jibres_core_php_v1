<?php
namespace content_a\thirdparty;


class load
{
	public static function memberDetail()
	{
		$countryList = \dash\utility\location\countres::$data;
		\dash\data::countryList($countryList);

		$cityList    = \dash\utility\location\cites::key_list('localname');
		\dash\data::cityList($cityList);

		$proviceList = \dash\utility\location\provinces::key_list('localname');
		\dash\data::proviceList($proviceList);


		$userstore_id = \dash\request::get('id');
		$userstore_id = \dash\coding::decode($userstore_id);

		if(!$userstore_id)
		{
			\dash\header::status(404, T_("Thirdparty id not found"));
		}

		$thirdparty = \lib\app\thirdparty::get(\dash\request::get('id'));

		if(isset($thirdparty['supplier']) || (isset($thirdparty['type']) && $thirdparty['type'] === 'supplier'))
		{
			\dash\data::supplierMode(true);
		}

		\dash\data::thirdparty($thirdparty);

		if(isset($thirdparty['displayname']))
		{
			\dash\data::page_title(' | '. $thirdparty['displayname']);
		}

		\dash\data::badge_text(T_('Add new thirdparty'));
		\dash\data::badge_link(\dash\url::this(). '/add');

	}
}
?>
