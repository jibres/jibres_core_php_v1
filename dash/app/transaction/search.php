<?php
namespace dash\app\transaction;

class search
{

	private static $is_filtered = false;


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function list($_query_string, $_args)
	{
		$condition =
			[
				'caller'        => 'string_100',
				'store_id'      => 'id',
				'order'         => 'order',
				'sort'          => 'string_50',
				'status'        => ['enum' => ['sale', 'buy', 'saleorder']],
				'show_type'     => ['enum' => ['verify', 'all']],
				'user_code'     => 'code',
				'start_date'    => 'date',
				'end_date'      => 'date',
				'user_history'  => 'bit',
				'need_calc_sum' => 'bit',
				'verify'        => 'y_n',
				'charge_type'   => 'y_n',
			];

		$require = [];
		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and           = [];
		$meta          = [];
		$or            = [];
		$order_sort    = null;
		$meta['limit'] = 15;
		$param         = [];

		if($data['user_code'])
		{
			$user_id           = \dash\coding::decode($data['user_code']);
			$and[]             = " transactions.user_id =  :user_id ";
			$param[':user_id'] = $user_id;

		}

		if($data['user_history'])
		{
			$and[] =
				"
				(
				 transactions.verify =  1
				 OR
				 (
				 	transactions.verify =  0 AND
				 	transactions.condition = 'verify_error' AND
				 	transactions.payment = 'zarinpal' AND
				 	(transactions.payment_response3 IS NULL OR transactions.payment_response3 = '' OR transactions.payment_response3 = '[]' )
				 )
				)
			";

		}
		else
		{
			if($data['show_type'] === 'verify')
			{
				$and[] = " transactions.verify =  1 ";
			}
			else
			{
				/*nothing*/
			}

			if($data['verify'] === 'y')
			{
				$and[]             = " transactions.verify =  1 ";
				self::$is_filtered = true;
			}
			elseif($data['verify'] === 'n')
			{
				$and[]             = " ( transactions.verify = 0 OR transactions.verify IS NULL ) ";
				self::$is_filtered = true;
			}
		}


		if($data['charge_type'] === 'y')
		{
			$and[]             = " transactions.plus > 0 ";
			self::$is_filtered = true;
		}
		elseif($data['charge_type'] === 'n')
		{
			$and[]             = " transactions.minus > 0 ";
			self::$is_filtered = true;
		}

		if($data['start_date'])
		{
			$data['start_date']   = $data['start_date'] . ' 00:00:00';
			$and[]                = " transactions.date >= :start_date ";
			$param[':start_date'] = $data['start_date'];
			self::$is_filtered    = true;
		}

		if($data['end_date'])
		{
			$data['end_date']   = $data['end_date'] . ' 23:59:59';
			$and[]              = " transactions.date <= :end_date ";
			$param[':end_date'] = $data['end_date'];
			self::$is_filtered  = true;
		}


		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			if($int = \dash\validate::int($query_string, false))
			{
				$or[]         = " transactions.id = :q1 ";
				$or[]         = " transactions.plus = :q2 ";
				$or[]         = " transactions.minus = :q3 ";
				$param[':q1'] = $int;
				$param[':q2'] = $int;
				$param[':q3'] = $int;
			}
			elseif($mobile = \dash\validate::mobile($query_string, false))
			{
				$or[]             = " users.mobile = :mobile ";
				$param[':mobile'] = $mobile;
			}
			else
			{
				$or[]         = " transactions.title LIKE :q4 ";
				$or[]         = " users.displayname LIKE :q5 ";
				$param[':q4'] = "%$query_string%";
				$param[':q5'] = "%$query_string%";
			}


			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(\dash\app\transaction\filter::check_allow($data['sort'], $data['order']))
			{
				if($data['sort'] === 'minus' || $data['sort'] === 'plus')
				{
					$order_sort = " ORDER BY ISNULL(transactions.$data[sort]), $data[sort] $data[order]";

				}
				else
				{
					$order_sort = " ORDER BY $data[sort] $data[order]";
				}
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY transactions.date DESC ";
		}

		$list = \dash\db\transactions\search::list($param, $and, $or, $order_sort, $meta);

		if($data['need_calc_sum'])
		{
			$sum = \dash\db\transactions\search::list_sum($param, $and, $or, $order_sort, $meta);
			\dash\temp::set('transactionCalcSum', $sum);
		}

		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\transaction', 'ready'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;
	}


	public static function user_history($_user_id)
	{
		$args                 = [];
		$args['user_code']    = \dash\coding::encode($_user_id);
		$args['user_history'] = true;

		$list = self::list(null, $args);

		return $list;
	}

}

?>
