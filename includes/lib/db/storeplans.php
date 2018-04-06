<?php
namespace lib\db;
use \lib\db;

class storeplans
{
	/**
	 * the plan change nae whit number of curren permission group
	 *
	 * @var        array
	 */
	public static $PLANS = [];


	/**
	 * get plan list
	 */
	public static function config()
	{
		if(empty(self::$PLANS))
		{
			self::$PLANS = \lib\utility\plan::list(true, true);
		}
	}


	/**
	 * return the plan code
	 *
	 * @param      <type>  $_name  The name
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function plan_code($_name)
	{
		self::config();

		if(isset(self::$PLANS[$_name]))
		{
			return self::$PLANS[$_name];
		}
	}

	/**
	 * get the plan name
	 *
	 * @param      <type>  $_code  The code
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function plan_name($_code)
	{
		self::config();

		$temp = array_flip(self::$PLANS);

		if(isset($temp[$_code]))
		{
			return $temp[$_code];
		}
	}

	/**
	 * add new storeplans
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function insert()
	{
		return db\config::public_insert('storeplans', ...func_get_args());
	}


	/**
	 * update storeplans record
	 */
	public static function update()
	{
		return db\config::public_update('storeplans', ...func_get_args());
	}


	/**
	 * get current store plan
	 *
	 * @param      <type>   $_store_id  The store identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function current($_store_id)
	{
		if(!$_store_id || !is_numeric($_store_id))
		{
			return false;
		}
		$query =
		"
			SELECT
				*
			FROM
				storeplans
			WHERE
				storeplans.store_id = $_store_id AND
				storeplans.status = 'enable'
			ORDER BY
				storeplans.id DESC
			LIMIT 1
		";
		$result = \lib\db::get($query, null, true);
		if(isset($result['plan']))
		{
			$result['plan_name'] = self::plan_name($result['plan']);
		}
		return $result;
	}


	/**
	 * set plan of store
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function set($_args)
	{
		$default_args =
		[
			'store_id'       => null,
			'plan'          => null,
			'start'         => date("Y-m-d H:i:s"),
			'lastcalcdate'  => date("Y-m-d H:i:s"),
			'end'           => null,
			'creator'       => null,
			'desc'          => null,
		];

		if(is_array($_args))
		{
			$_args = array_merge($default_args, $_args);
		}

		$log_meta =
		[
			'meta' =>
			[
				'input'   => $_args,
			],
		];

		if(!$_args['store_id'] || !$_args['plan'] || !$_args['start'])
		{
			return false;
		}

		$store_details = \lib\store::detail();

		$log_meta['meta']['store_details'] = $store_details;

		if(!\lib\store::is_creator())
		{
			\dash\db\logs::set('plan:change:not:creator', $_args['creator'], $log_meta);
			\lib\notif::error(T_("Just creator of store can change the plan"));
			return false;
		}

		$_args['status'] = 'enable';

		$_args['plan'] = self::plan_code($_args['plan']);
		if(!$_args['plan'])
		{
			\dash\db\logs::set('plan:cannot:support', $_args['creator'], $log_meta);
			return false;
		}

		$current = self::current($_args['store_id']);

		if(isset($current['plan']) && intval($current['plan']) === intval($_args['plan']))
		{
			\lib\notif::error(T_("This plan is already active for you"));
			return false;
		}

		if(isset($current['plan_name']) && isset($current['createdate']))
		{
			$createdate_current_plan = strtotime($current['createdate']);

			switch ($current['plan_name'])
			{
				case 'standard':
					if(time() - strtotime($current['createdate']) < (29 * 24 * 60 * 60))
					{
						\lib\notif::error(T_("You can not choose another plan before the current course is completed"));
						return false;
					}
					break;
				case 'standard_year':
					if(time() - strtotime($current['createdate']) < (364 * 24 * 60 * 60))
					{
						\lib\notif::error(T_("You can not choose another plan before the current course is completed"));
						return false;
					}
					break;
				case 'free':
				default:
					// no problem to change plan!
					break;
			}
			// no problem to continue;
			// the user want to change her plan from free to other plan
		}

		$update_storeplans        = [];
		$update_storeplans['end'] = date("Y-m-d H:i:s");

		$prepayment_new           = \lib\utility\plan::get_detail($_args['plan']);

		if(is_array($prepayment_new ) && array_key_exists('prepayment', $prepayment_new ) && $prepayment_new ['prepayment'] === true)
		{
			$prepayment_new  = true;
		}
		else
		{
			$prepayment_new  = false;
		}

		$prepayment_old = false;
		if(isset($current['plan']))
		{
			$prepayment_old  = \lib\utility\plan::get_detail($current['plan']);

			if(is_array($prepayment_old ) && array_key_exists('prepayment', $prepayment_old ) && $prepayment_old['prepayment'] === true)
			{
				$prepayment_old  = true;
			}
			else
			{
				$prepayment_old  = false;
			}

		}

		if($prepayment_new || $prepayment_old)
		{

			if(!self::make_plan_invoice($_args['plan']))
			{
				return false;
			}
		}

		if(isset($current['id']))
		{
			self::update($update_storeplans, $current['id']);
		}

		$log_meta['meta']['current'] = $current;

		\dash\db\logs::set('plan:changed', $_args['creator'], $log_meta);
		// insert new storeplans
		self::insert($_args);

		$update_store =
		[
			'plan'         => self::plan_name($_args['plan']),
			'startplan'    => date("Y-m-d H:i:s"),
			'startplanday' => date("d"),
		];

		\lib\db\stores::update($update_store, $_args['store_id']);

		\lib\store::clean();

		return true;
	}


	public static function search($_string = null, $_options = [])
	{
		if(!is_array($_options))
		{
			$_options = [];
		}

		$default_option =
		[
			'search_field' =>
			"
				(
					stores.name LIKE '%__string__%'
				)

			",
			'public_show_field' =>
				"
					storeplans.*,
					stores.name, stores.shortname
				",
			'master_join'         => " INNER JOIN stores ON stores.id = storeplans.store_id ",
		];

		$_options = array_merge($default_option, $_options);

		return \dash\db\config::public_search('storeplans', $_string, $_options);

	}



	/**
	 * Makes a full invoice.
	 *
	 * @param      <type>   $_store_id  The store identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	private static function make_plan_invoice($_plan_code)
	{
		$amount = 0;

		$plan_detail = \lib\utility\plan::get_detail($_plan_code);

		if(isset($plan_detail['amount']))
		{
			$amount = $plan_detail['amount'];
		}
		// for the free plan
		if(!$amount)
		{
			\dash\db\logs::set('invoice:store:full:make:amount:0:return:true', null, \dash\app::log_meta());
			return true;
		}

        // get user budget
        $user_budget = \dash\db\transactions::budget(\lib\store::creator(), ['unit' => 'toman']);

        if($user_budget && is_array($user_budget))
        {
        	$user_budget = array_sum($user_budget);
        }

        if(intval($user_budget) < intval($amount))
        {
			\dash\db\logs::set('invoice:store:full:money>credit', null, \dash\app::log_meta());
        	\lib\notif::error(T_("Your credit is less than amount of this plan, please charge your account"));
        	return false;
        }

       	$invoice_title = \lib\store::name();

		$title = T_("Active plan of :store", ['store' => \lib\store::name()]);

		$meta = [];

		$new_invoice =
		[
			'date'    => date("Y-m-d H:i:s"),
			'user_id' => \lib\store::creator(),
			'title'   => $invoice_title,
			'total'   => $amount,
		];


		$new_invoice_detail =
		[
			'title'      => $title,
			'price'      => $amount,
			'count'      => 1,
			'total'      => $amount,
		];

        $invoice = new \lib\db\invoices;
        $invoice->add($new_invoice);
        $invoice->add_child($new_invoice_detail);
        $invoice_id = $invoice->save();


		//       $notify_text = T_("You have new invoice for :store by amount :amount :unit",
		// [
		// 	'store'   => $this->store_details['name'],
		// 	'amount' => \dash\utility\human::number(number_format($amount), \lib\language::current()),
		// 	'unit'   => T_("toman"),
		// ]);

		// // save notification to send to user
		// $notify_set =
		//       [
		// 	'to'      => $this->store_details['creator'],
		// 	'content' => $notify_text,
		// 	'cat'     => 'invoice',
		//       ];

		//       \dash\db\notifications::set($notify_set);


		$transaction_set =
        [
			'caller'          => 'invoice:store',
			'title'           => T_("Change plan of :store", ['store' => \lib\store::name()]),
			'user_id'         => \lib\store::creator(),
			'minus'           => $amount,
			'payment'         => null,
			'related_foreign' => 'stores',
			'related_id'      => \lib\store::id(),
			'verify'          => 1,
			'type'            => 'money',
			'unit'            => 'toman',
			'date'            => date("Y-m-d H:i:s"),
			'invoice_id'      => $invoice_id,
        ];

        \dash\db\transactions::set($transaction_set);

        if(\lib\engine\process::status())
        {
        	return true;
        }
        return false;
	}
}
?>