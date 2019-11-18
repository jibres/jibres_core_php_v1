<?php
namespace lib\app\customer;

class export
{

	public static function csv($_type)
	{
		\dash\log::set('customerExportCsvFile');

		set_time_limit(60 * 10);
		ini_set('memory_limit', '-1');
		ini_set("max_execution_time", "-1");

		$args             = [];
		$args['users.store_id'] = \lib\store::id();
		// $args['users.status']   = 'enable';
		switch ($_type)
		{
			case 'staff':
			case 'supplier':
			case 'customer':
				$args['users.'. $_type] = 1;
				break;

			default:
				// nothing
				break;
		}

		$args['pagenation'] = false;
		$args['limit']      = 1000;
		$my_limit           = 1000;
		$link               = null;

		$result             = \lib\db\users::search(null, $args);

		while ($result)
		{
			$result              = array_map(['\lib\app\customer', 'ready'], $result);
			$link                = self::put_csv($result);
			$args['start_limit'] = $my_limit;
			$args['end_limit']   = 1000;
			$result              = \lib\db\users::search(null, $args);
			$my_limit            = $my_limit + 1000;
		}

		return $link;
	}


	private static function put_csv($_data)
	{
		if(!is_array($_data))
		{
			return false;
		}

		$result = [];
		foreach ($_data as $key => $value)
		{
			$temp                          = [];
			$temp['id']                    = @$value['id'];
			$temp['user_id']               = @$value['user_id'];
			$temp['customer']              = @$value['customer'] ? T_("Yes") : T_("No");
			$temp['staff']                 = @$value['staff'] ? T_("Yes") : T_("No");
			$temp['supplier']              = @$value['supplier'] ? T_("Yes") : T_("No");
			$temp['mobile']                = @$value['mobile'];
			$temp['phone']                 = @$value['phone'];
			$temp['fax']                   = @$value['fax'];
			$temp['email']                 = @$value['email'];
			$temp['displayname']           = @$value['displayname'];
			$temp['gender']                = @$value['gender'];
			$temp['marital']               = @$value['marital'];
			$temp['permission']            = @$value['permission'];
			$temp['firstname']             = @$value['firstname'];
			$temp['lastname']              = @$value['lastname'];
			$temp['father']                = @$value['father'];
			$temp['birthday']              = @\dash\datetime::fit($value['birthday'], false, 'date');;
			$temp['nationalcode']          = @$value['nationalcode'];
			$temp['shcode']                = @$value['shcode'];
			$temp['pasportcode']           = @$value['pasportcode'];
			$temp['nationality']           = @$value['nationality'];
			$temp['birthcity']             = @$value['birthcity'];
			$temp['shfrom']                = @$value['shfrom'];
			$temp['companyname']           = @$value['companyname'];
			$temp['companyeconomiccode']   = @$value['companyeconomiccode'];
			$temp['companynationalid']     = @$value['companynationalid'];
			$temp['companyregisternumber'] = @$value['companyregisternumber'];
			$temp['status']                = @$value['status'];
			$temp['taxexempt']             = @$value['taxexempt'] ? T_("Yes") : T_("No");
			$temp['marketing']             = @$value['marketing'] ? T_("Yes") : T_("No");
			$temp['credit']                = @$value['credit'];
			$temp['datecreated']           = @\dash\datetime::fit($value['datecreated'], true);
			$temp['datemodified']          = @\dash\datetime::fit($value['datemodified'], true);

			// $temp['store_id']           = @$value['store_id'];
			// $temp['avatar']                = @$value['avatar'];
			// $temp['postion']               = @$value['postion'];
			// $temp['code']                  = @$value['code'];
			// $temp['desc']               = @$value['desc'];
			// $temp['genderString']       = @$value['genderString'];
			// $temp['address_id']         = @$value['address_id'];
			// $temp['visitor']            = @$value['visitor'];
			// $temp['visitor2']           = @$value['visitor2'];
			// $temp['totalorder']         = @$value['totalorder'];
			// $temp['totalspent']         = @$value['totalspent'];
			// $temp['companyaddress_id']  = @$value['companyaddress_id'];
			// $temp['file']               = @$value['file'];


			$result[]                                    = $temp;

		}
		return \dash\utility\export::csv_file(['name' => 'ThirdParyExport', 'data' => $result]);
	}


}
?>