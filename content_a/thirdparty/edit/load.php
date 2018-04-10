<?php
namespace content_a\thirdparty\edit;


class load
{
	public static function memberDetail()
	{
		// \dash\data::listGrades(\lib\utility\grade::list());
		// $parent_list =
		// [
		// 	"father"              => T_("Father"),
		// 	"mother"              => T_("Mother"),
		// 	"sister"              => T_("Sister"),
		// 	"brother"             => T_("Brother"),
		// 	"grandfather"         => T_("Grandfather"),
		// 	"grandmother"         => T_("Grandmother"),
		// 	"aunt"                => T_("Aunt"),
		// 	"husband of the aunt" => T_("Husband of the aunt"),
		// 	"uncle"               => T_("Uncle"),
		// 	"boy"                 => T_("Boy"),
		// 	"girl"                => T_("Girl"),
		// 	"spouse"              => T_("Spouse"),
		// 	"stepmother"          => T_("Stepmother"),
		// 	"stepfather"          => T_("Stepfather"),
		// 	"neighbor"            => T_("Neighbor"),
		// 	"teacher"             => T_("Teacher"),
		// 	"friend"              => T_("Friend"),
		// 	"boss"                => T_("Boss"),
		// 	"supervisor"          => T_("Supervisor"),
		// 	"child"               => T_("Child"),
		// 	"grandson"            => T_("Grandson"),
		// ];
		// \dash\data::listParents(implode(',' ,array_values($parent_list)));

		$country_list = \dash\utility\location\countres::list('name', 'name - localname');
		\dash\data::listCountries(implode(',', $country_list));

		$city_list    = \dash\utility\location\cites::list('localname');
		$city_list    = array_unique($city_list);
		\dash\data::listCities(implode(',', $city_list));

		$provice_list = \dash\utility\location\provinces::list('localname');
		$provice_list = array_unique($provice_list);
		\dash\data::listProvices(implode(',', $provice_list));



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
