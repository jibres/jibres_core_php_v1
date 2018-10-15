<?php
namespace lib\app;


class fund
{

	use \lib\app\fund\add;
	use \lib\app\fund\datalist;
	use \lib\app\fund\edit;
	use \lib\app\fund\get;


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check($_id = null)
	{


		$title = \dash\app::request('title');
		if(\dash\app::isset_request('title') && !$title)
		{
			\dash\notif::error(T_("Please fill the title"), 'title');
			return false;
		}

		if($title && mb_strlen($title) > 100)
		{
			\dash\notif::error(T_("Plese set title less than 100 character"), 'title');
			return false;
		}

		$status = \dash\app::request('status');
		if($status && !in_array($status, ['enable','disable','delete']))
		{
			\dash\notif::error(T_("Invalid status"), 'status');
			return false;
		}

		$args           = [];
		$args['title']  = $title;
		$args['status'] = $status;


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

		return $result;
	}

}
?>
