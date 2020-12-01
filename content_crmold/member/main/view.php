<?php
namespace content_crm\member\main;


class view
{
	/**
	 * load user data
	 */
	public static function dataRowMember()
	{
		$result = null;

		$id = \dash\request::get('id');

		if(!$id)
		{
			\dash\header::status(404, T_("Invalid user id"));
		}

		$result = \dash\app\user::get($id);

		if(!$result)
		{
			\dash\header::status(404, T_("Invalid user id"));
		}

		if(isset($result['birthday']) && $result['birthday'])
		{
			$result['jalali_birthday'] = \dash\utility\jdate::date("Y-m-d", $result['birthday'], false);
		}

		\dash\data::dataRowMember($result);

		// add back level to summary link
		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('Customers'));


	}


	public static function static_var()
	{
		$parentList =
		[
			"father"              => T_("Father"),
			"mother"              => T_("Mother"),
			"sister"              => T_("Sister"),
			"brother"             => T_("Brother"),
			"grandfather"         => T_("Grandfather"),
			"grandmother"         => T_("Grandmother"),
			"aunt"                => T_("Aunt"),
			"husband of the aunt" => T_("Husband of the aunt"),
			"uncle"               => T_("Uncle"),
			"boy"                 => T_("Boy"),
			"girl"                => T_("Girl"),
			"spouse"              => T_("Spouse"),
			"stepmother"          => T_("Stepmother"),
			"stepfather"          => T_("Stepfather"),
			"neighbor"            => T_("Neighbor"),
			"member"              => T_("Member"),
			"friend"              => T_("Friend"),
			"boss"                => T_("Boss"),
			"supervisor"          => T_("Supervisor"),
			"child"               => T_("Child"),
			"grandson"            => T_("Grandson"),
		];

		\dash\data::parentList(implode(',' ,array_values($parentList)));

		$countryList = \dash\utility\location\countres::$data;
		\dash\data::countryList($countryList);

		$cityList    = \dash\utility\location\cites::$data;
		$proviceList = \dash\utility\location\provinces::key_list('localname');

		$new = [];
		foreach ($cityList as $key => $value)
		{
			$temp = '';

			if(isset($value['province']) && isset($proviceList[$value['province']]))
			{
				$temp .= $proviceList[$value['province']]. ' - ';
			}
			if(isset($value['localname']))
			{
				$temp .= $value['localname'];
			}
			$new[$key] = $temp;
		}
		asort($new);

		\dash\data::cityList($new);

		// \dash\data::proviceList($proviceList);
	}



}
?>