<?php
namespace content_a\customer;


class load
{

	public static function check_access()
	{
		$id = \dash\request::get('id');
		if($id)
		{
			$result = \lib\app\customer::get($id);
			if(!$result)
			{
				\dash\header::status(404, T_("Invalid customer id"));
			}
			\dash\data::dataRow($result);
		}
		else
		{
			\dash\header::status(404, T_("Thirdparty id not set"));
		}
	}


	/**
	 * load user data
	 */
	public static function dataRow()
	{
		$result = \dash\data::dataRow();
		if(!$result)
		{
			$id = \dash\request::get('id');
			if($id)
			{
				$result = \lib\app\customer::get($id);
				if(!$result)
				{
					\dash\header::status(404, T_("Invalid customer id"));
				}
				\dash\data::dataRow($result);
			}
			else
			{
				\dash\header::status(404, T_("Thirdparty id not set"));
			}
		}

		$accessType = self::typeTrans();

		// check permission
		if(\dash\data::isStaff())
		{
			\dash\permission::access('staffAccess');
		}

		if(\dash\data::isSupplier())
		{
			\dash\permission::access('supplierAccess');
		}

		if(\dash\data::isCustomer())
		{
			\dash\permission::access('customerAccess');
		}


		// add back level to summary link
		\dash\data::badge_link(\dash\url::this(). '?type='. self::typeTrans());
		\dash\data::badge_text(T_('Return to :types list', ['types' => T_(self::typeTrans(true))]));

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
					\dash\data::isSupplier(true);
				}

				if($customer)
				{
					$type = 'customer';
					\dash\data::isCustomer(true);
				}

				if($staff)
				{
					$type = 'staff';
					\dash\data::isStaff(true);
				}

			}
			elseif(($supplier + $customer + $staff ) === 2)
			{
				if($supplier)
				{
					$type = 'supplier';
					\dash\data::isSupplier(true);
				}

				if($staff)
				{
					$type = 'staff';
					\dash\data::isStaff(true);
				}
			}
			else
			{
				$type = 'customer';
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
				$type = 'customer';
			}
		}
		else
		{
			if(mb_strtolower($type) === 'customer')
			{
				if($_all)
				{
					$type = 'thirdparties';
				}
				else
				{
					$type = 'customer';
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

		if(!in_array($type, ['supplier', 'suppliers', 'customer', 'customers', 'staff', 'staffs', 'customer', 'thirdparties']))
		{
			if($_all)
			{
				$type = 'thirdparties';
			}
			else
			{
				$type = 'customer';
			}
		}


		if(in_array($type, ['customer', 'customers']))
		{
			\dash\data::isCustomer(true);
		}

		if(in_array($type, ['staff', 'staffs']))
		{
			\dash\data::isStaff(true);
		}

		if(in_array($type, ['supplier', 'suppliers']))
		{
			\dash\data::isSupplier(true);
		}

		return $type;
	}



	public static function fixTitle()
	{
		$myName = \dash\data::dataRow_displayname();
		if($myName)
		{
			$myName = \dash\data::page_title(). ' | '. $myName;
			\dash\data::page_title($myName);
		}
	}

}
?>
