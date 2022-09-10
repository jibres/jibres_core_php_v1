<?php
namespace dash\db\transactions;


trait set
{
	use \dash\db\transactions\code_list;

	/**
	 * set a record of transactions
	 *
	 * @param      <type>  $_caller  The caller
	 */
	public static function set($_args)
	{
		$default_args =
		[
			'debug'       => true,
			'user_id'     => null,
			'caller'      => null,
			'title'       => null,
			'status'      => 'enable',
			'verify'      => 0,
			'currency'    => null,
			'minus'       => null,
			'plus'        => null,
			'type'        => null,
			'payment'     => null,
			'factor_id'   => null,
			'date'        => null,
			'other_field' => [],

		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_args, $_args);

		$other_field = [];

		if(is_array($_args['other_field']))
		{
			$other_field = $_args['other_field'];
		}

		unset($_args['other_field']);

		$debug = true;

		if(!$_args['debug'])
		{
			$debug = false;
		}
		unset($_args['debug']);

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'args'    => func_get_args(),
			]
		];

		$caller = $_args['caller'];
		// unset($_args['caller']);

		$insert = array_merge($other_field, $_args);

		if(isset($_args['store_id']) && $_args['store_id'])
		{
			$insert['store_id'] = $_args['store_id'];
		}

		// save ip id
		$insert['ip_id']    = \dash\utility\ip::id();

		// save agent id
		$insert['agent_id'] = \dash\agent::get(true);


		$insert['payment'] = $_args['payment'];

		// check and make error on user_id
		$insert['user_id'] = $_args['user_id'] ? $_args['user_id'] : null;

		$insert['code'] = self::get_code($caller);
		// check and make error on code
		if(!$insert['code'])
		{
			$insert['code'] = 251;
			// if($debug)
			// {
			// 	\dash\db\logs::set('transactions:set:code:is:null', null, $log_meta);
			// 	\dash\notif::error(T_("Transaction caller can not be null"));
			// }
			// return false;
		}
		// check and make error on title
		$insert['title'] = $_args['title'];
		if(!$insert['title'])
		{
			if($debug)
			{
				\dash\db\logs::set('transactions:set:title:is:null', $_args['user_id'], $log_meta);
				\dash\notif::error(T_("Transaction title can not be null"));
			}
			return false;
		}
		// check and make error on type
		$insert['type'] = $_args['type'];
		if(!$insert['type'])
		{
			if($debug)
			{
				\dash\db\logs::set('transactions:set:type:is:null', $_args['user_id'], $log_meta);
				\dash\notif::error(T_("Transaction type can not be null"));
			}
			return false;
		}
		// check and make error on status
		$insert['status'] = $_args['status'];
		if(!$insert['status'])
		{
			if($debug)
			{
				\dash\db\logs::set('transactions:set:status:is:null', $_args['user_id'], $log_meta);
				\dash\notif::error(T_("Transaction status can not be null"));
			}
			return false;
		}
		// check and make error on verify
		$insert['verify'] = $_args['verify'];
		if(!in_array($insert['verify'], [0,1, '0', '1']))
		{
			if($debug)
			{
				\dash\db\logs::set('transactions:set:verify:is:invalid', $_args['user_id'], $log_meta);
				\dash\notif::error(T_("Invalid transaction verify field"));
			}
			return false;
		}

		$currency = $_args['currency'];
		if(!$currency)
		{
			$currency = \lib\currency::default();
		}

		if(!$currency)
		{
			if($debug)
			{
				\dash\db\logs::set('transactions:set:currency:is:null', $_args['user_id'], $log_meta);
				\dash\notif::error(T_("Transaction currency can not be null"));
			}
			return false;

		}

		$insert['currency'] = $currency;



		if($_args['factor_id'] && is_numeric($_args['factor_id']))
		{
			$insert['factor_id'] = $_args['factor_id'];
		}

		if(!\dash\engine\store::inStore())
		{
			unset($insert['factor_id']);
		}


		$minus = null;
		if($_args['minus'])
		{
			if(!is_numeric($_args['minus']))
			{
				\dash\notif::error(T_("Amount must be a number"));
				return false;
			}

			if(\dash\number::is_larger($_args['minus'], 9999999999999))
			{
				\dash\notif::error(T_("Amount is out of range"));
				return false;
			}
			$minus = floatval($_args['minus']);
		}

		$plus = null;
		if($_args['plus'])
		{
			if(!is_numeric($_args['plus']))
			{
				\dash\notif::error(T_("Amount must be a number"));
				return false;
			}

			if(\dash\number::is_larger($_args['plus'], 9999999999999))
			{
				\dash\notif::error(T_("Amount is out of range"));
				return false;
			}
			$plus = floatval($_args['plus']);
		}



		$insert['minus']         = $minus;
		$insert['plus']          = $plus;

		if(intval($insert['verify']) === 1)
		{
			$budget_before           = self::budget($_args['user_id'], ['type' => $_args['type'], 'currency' => $insert['currency']]);
			$budget_before           = floatval($budget_before);

			$budget                  = $budget_before + (floatval($plus) - floatval($minus));

			$insert['budget_before'] = $budget_before;
			$insert['budget']        = $budget;

			if(!isset($_args['dateverify']))
			{
				$insert['dateverify'] = time();
			}
			else
			{
				$insert['dateverify'] = intval($_args['dateverify']);
			}
		}

		unset($insert['unit']);
		unset($insert['unit_id']);

		if(!a($_args, 'date'))
		{
			$insert['date'] = date("Y-m-d H:i:s");
		}
		else
		{
			$insert['date'] = $_args['date'];
		}

		$insert['datecreated'] = date("Y-m-d H:i:s");

		$insert_id = self::insert($insert);

		// \dash\db\logs::set('transactions:insert', $_args['user_id'], $log_meta);
		return $insert_id;
	}

}
?>
