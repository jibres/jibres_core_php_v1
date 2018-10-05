<?php
namespace lib\app;


class inventory
{

	use \lib\app\inventory\add;
	use \lib\app\inventory\datalist;
	use \lib\app\inventory\edit;
	use \lib\app\inventory\get;


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check($_id = null)
	{


		$name = \dash\app::request('name');
		if(\dash\app::isset_request('name') && !$name)
		{
			\dash\notif::error(T_("Please fill the name"), 'name');
			return false;
		}

		if($name && mb_strlen($name) > 100)
		{
			\dash\notif::error(T_("Plese set name less than 100 character"), 'name');
			return false;
		}

		$default = \dash\app::request('default') ? 1 : null;
		$online  = \dash\app::request('online') ? 1 : null;
		$sale    = \dash\app::request('sale') ? 1 : null;

		$status = \dash\app::request('status');
		if($status && !in_array($status, ['enable','disable','delete']))
		{
			\dash\notif::error(T_("Invalid status"), 'status');
			return false;
		}

		$args            = [];
		$args['name']    = $name;
		$args['status']  = $status;
		$args['default'] = $default;
		$args['online']  = $online;
		$args['sale']    = $sale;

		return $args;
	}



	/**
	 * ready data of member to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
				case 'store_id':

					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}
		// var_dump($result);exit();
		return $result;
	}

}
?>
