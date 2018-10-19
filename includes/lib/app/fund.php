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

		$pos = \dash\app::request('pos');
		$new_pos = null;
		if($pos)
		{
			$pos = explode(',', $pos);
			if(is_array($pos))
			{
				$new_pos = [];
				foreach ($pos as $key => $value)
				{
					$check = \lib\app\store\pos::check($value);
					if(!$check)
					{
						\dash\notif::error(T_("Pos :pos not found in your active store pos", ['pos' => $value]), 'pos');
						return false;
					}
					else
					{
						$new_pos[$value] = ['status' => true];
					}
				}

				if(!empty($new_pos))
				{
					$new_pos = json_encode($new_pos, JSON_UNESCAPED_UNICODE);
				}
			}
		}

		$args           = [];
		$args['title']  = $title;
		$args['status'] = $status;
		$args['pos']    = $new_pos;


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

				case 'pos':
					if($value && is_string($value))
					{
						$result[$key] = json_decode($value, true);
					}
					else
					{
						$result[$key] = $value;
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
