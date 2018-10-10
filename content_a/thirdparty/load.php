<?php
namespace content_a\thirdparty;


class load
{

	/**
	 * load user data
	 */
	public static function dataRow()
	{
		$result = null;

		$id = \dash\request::get('id');
		if($id)
		{
			$result = \lib\app\thirdparty::get($id);
			if(!$result)
			{
				\dash\header::status(404, T_("Invalid thirdparty id"));
			}
			\dash\data::dataRow($result);
		}
		else
		{
			\dash\header::status(404, T_("Thirdparty id not set"));
		}

		// add back level to summary link
		\dash\data::badge_link(\dash\url::this(). '?type='. self::typeTrans());
		\dash\data::badge_text(T_(':types list', ['types' => T_(self::typeTrans(true))]));

		if(isset($result['user_id']))
		{
			$myUserId = \dash\coding::decode($result['user_id']);

			if($myUserId && intval($myUserId) === intval(\dash\user::id()))
			{
				\dash\data::itsMe(true);
			}
		}
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


	public static function typeTrans($_all = false)
	{
		if(\dash\data::dataRow())
		{
			$customer = intval(\dash\data::dataRow_customer());
			$supplier = intval(\dash\data::dataRow_supplier());
			$staff    = intval(\dash\data::dataRow_staff());
			if(($supplier + $customer + $staff ) === 1)
			{
				if($supplier)
				{
					$type = 'supplier';
				}

				if($customer)
				{
					$type = 'customer';
				}

				if($staff)
				{
					$type = 'staff';
				}

			}
			elseif(($supplier + $customer + $staff ) === 2)
			{
				if($supplier)
				{
					$type = 'supplier';
				}

				if($staff)
				{
					$type = 'staff';
				}
			}
			else
			{
				$type = 'thirdparty';
			}

		}
		else
		{
			$type = \dash\request::get('type');
		}

		if(!$type)
		{
			if($_all)
			{
				$type = 'thirdparties';
			}
			else
			{
				$type = 'thirdparty';
			}
		}
		else
		{
			if(mb_strtolower($type) === 'thirdparty')
			{
				if($_all)
				{
					$type = 'thirdparties';
				}
				else
				{
					$type = 'thirdparty';
				}
			}
			else
			{
				if($_all)
				{
					$type = $type. 's';
				}
			}
		}

		if(!in_array($type, ['supplier', 'suppliers', 'customer', 'customers', 'staff', 'staffs', 'thirdparty', 'thirdparties']))
		{
			if($_all)
			{
				$type = 'thirdparties';
			}
			else
			{
				$type = 'thirdparty';
			}
		}

		return $type;
	}
}
?>
