<?php

namespace lib\app\sms_charge;

class charge
{

	public static function getDetail($_force = false)
	{
		if($_force)
		{
			$result = self::getFromAPI();
		}

		$result = self::settingRecord();

		if(!$result || self::syncRequired())
		{
			$result = self::getFromAPI();

			self::setSynced();

			self::saveSMSSettingRecord($result);
		}

		$result['currency'] = \lib\currency::jibres_currency(true);

		return $result;
	}


	private static function getFromAPI()
	{
		$detail = \lib\api\jibres\api::sms_charge_detail();

		if(isset($detail['result']))
		{
			return $detail['result'];
		}

		return [];
	}


	private static function setSynced()
	{
		\lib\db\setting\update::overwirte_cat_key(date("Y-m-d H:i:s"), 'sms', 'synced');
	}


	private static function saveSMSSettingRecord($_data)
	{
		\lib\db\setting\update::overwirte_cat_key(json_encode($_data), 'sms', 'charge');
	}


	public static function sync_required()
	{
		\lib\db\setting\update::overwirte_cat_key('no', 'sms', 'synced');
	}


	private static function syncRequired()
	{
		$planSyncSetting = \lib\db\setting\get::by_cat_key('sms', 'synced');

		if(isset($planSyncSetting['value']))
		{
			if($planSyncSetting['value'] === 'no')
			{
				$syncRequired = true;
			}
			elseif($syncTime = strtotime($planSyncSetting['value']))
			{
				if($syncTime < (time() - (60 * 30)))
				{
					$syncRequired = true;
				}
				else
				{
					$syncRequired = false;
				}
			}
			else
			{
				$syncRequired = true;
			}
		}
		else
		{
			$syncRequired = true;
		}

		return $syncRequired;

	}


	private static function settingRecord()
	{
		$smsSettingRecord = \lib\db\setting\get::by_cat_key('sms', 'charge');

		if(!is_array($smsSettingRecord))
		{
			$smsSettingRecord = [];
		}

		if(isset($smsSettingRecord['value']))
		{
			$smsSettingRecord = json_decode($smsSettingRecord['value'], true);
			if(!is_array($smsSettingRecord))
			{
				$smsSettingRecord = [];
			}
		}
		else
		{
			$smsSettingRecord = [];
		}


		return $smsSettingRecord;
	}


	public static function newPay(array $_args)
	{
		$data = self::checkArgs($_args);

		$amount = $data['amount'];

		$amount = self::checkAmount($amount);

		if(!$amount)
		{
			return false;
		}
		$data['amount'] = $amount;


		$detail = \lib\api\jibres\api::sms_charge_charge($data);

		if(isset($detail['result']['payLink']) && $detail['result']['payLink'])
		{
			\dash\redirect::to($detail['result']['payLink']);
		}
		else
		{
			return false;
		}

	}


	private static function checkArgs(array $_args)
	{
		$condition =
			[
				'turn_back'  => 'string_1000',
				'use_budget' => 'bit',
				'amount'     => 'price',
			];

		$require = ['amount'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}


	public static function pay($_business_id, array $_args)
	{
		$data = $_args;


		$userId = self::getUserId();

		$turnBack = $data['turn_back'];

		if(!$turnBack)
		{
			$turnBack = \dash\url::jibres_domain();
		}

		$amount = $data['amount'];

		$totalCharge = 10000000;

		$currentStoreCharge = self::getBalance($_business_id);

		if($currentStoreCharge + $amount >= $totalCharge)
		{
			\dash\notif::error(T_("Can not charge your sms panel more than :max :currency", ['max'      => \dash\fit::number($totalCharge),
																							 'currency' => \lib\currency::jibres_currency(true),
			]));
			return ['payLink' => null, 'needPay' => false, 'error' => true];
		}


		if($data['use_budget'])
		{
			$userBudget = \dash\app\transaction\budget::user($userId);
			$amount     = $amount - $userBudget;

			if($amount < 0)
			{
				$amount = 0;
			}
		}


		$payLink = null;

		if($amount)
		{
			$fn_args =
				[
					'store_id' => $_business_id,
					'user_id'  => $userId,
					'amount'   => $amount,
				];

			$needPay = true;
			// go to bank
			$meta =
				[
					'store_id' => $_business_id,
					'caller'   => 'business:sms:pay',

					'pay_on_jibres' => true,
					'msg_go'        => T_("Increase SMS panel charge"),
					'auto_go'       => false,
					'auto_back'     => true,
					'final_msg'     => false,
					'turn_back'     => $turnBack,
					'user_id'       => $userId,
					'amount'        => $amount,
					'final_fn'      => ['/lib/app/sms_charge/charge', 'after_pay'],
					'final_fn_args' => $fn_args,


				];

			$result_pay = \dash\utility\pay\start::api($meta);

			if(isset($result_pay['url']) && isset($result_pay['transaction_id']))
			{
				$payLink = $result_pay['url'];
			}
		}
		else
		{
			$needPay = false;
		}

		return ['payLink' => $payLink, 'needPay' => $needPay];
	}


	private static function getUserId()
	{
		if(\dash\engine\store::inStore())
		{
			$userId = \dash\user::jibres_user();
		}
		else
		{
			$userId = \dash\user::id();
		}

		return $userId;
	}


	public static function after_pay($_args, $_transaction_detail = [])
	{

		$transaction_id = a($_transaction_detail, 'id');
		$store_id       = a($_args, 'store_id');
		$user_id        = a($_args, 'user_id');
		$amount         = a($_args, 'amount');

		$insert_minus_transaction = self::minusTransaction($_args);

		if(!$insert_minus_transaction)
		{
			\dash\log::set('canNOtMinusSmsTransaction', ['my_data' => $_args]);
			return false;
		}

		$args =
			[
				'store_id'       => $store_id,
				'user_id'        => $user_id,
				'transaction_id' => $insert_minus_transaction,
				'amount'         => $amount,
			];

		self::addNewSMSChargeRecord($args);

	}


	private static function addNewSMSChargeRecord($_args)
	{

		$insert                = $_args;
		$insert['datecreated'] = date("Y-m-d H:i:s");

		\lib\db\sms_charge\insert::new_record($insert);

		\lib\api\business\api::sms_sync_required($insert['store_id']);

		$log = $_args;

		$log['balance'] = self::getBalance($insert['store_id']);

		\dash\log::set('sms_newSMSCharge', ['myData' => $log]);

	}


	private static function minusTransaction(array $_args)
	{

		$title = T_("Charge sms");

		$insert_transaction =
			[
				'caller'   => 'business:sms:minus',
				'store_id' => $_args['store_id'],
				'user_id'  => $_args['user_id'],
				'title'    => $title,
				'amount'   => floatval($_args['amount']),

			];

		return \dash\app\transaction\budget::minus($insert_transaction);

	}


	private static function checkAmount($_amount)
	{
		if(!$_amount || !is_numeric($_amount))
		{
			\dash\notif::error(T_("Amount is required"));
			return false;
		}

		$amount = intval($_amount);


		$minimum = 50000;
		$maximum = 5000000;

		if($amount < $minimum)
		{
			\dash\notif::error(T_("The minimum charge for SMS is :val :currency", [
				'val'      => \dash\fit::number($minimum),
				'currency' => \lib\currency::jibres_currency(true),
			]));
			return false;
		}

		if($amount > $maximum)
		{
			\dash\notif::error(T_("The maximum charge for SMS is :val :currency", [
				'val'      => \dash\fit::number($maximum),
				'currency' => \lib\currency::jibres_currency(true),
			]));
			return false;
		}

		$amountRound = round($amount, -3, PHP_ROUND_HALF_DOWN);
		if($amount != $amountRound)
		{
			\dash\notif::warn(T_("Your amount changed to :val", ['val' => \dash\fit::number($amountRound)]));

		}

		$amount = $amountRound;


		return $amount;
	}


	public static function getBalance($_business_id)
	{

		$charge = \lib\db\sms_charge\get::store_total_charge($_business_id);
		$spent  = \lib\db\sms\get::store_spent($_business_id);

		$balance = $charge - $spent;

		return $balance;

	}


	public static function checkBusinessChargeOnSendingSMS(array &$jibres_sms) : bool
	{
		$store_id = $jibres_sms['store_id'];

		$balance = self::getBalance($store_id);

		if(!$balance || $balance <= 0)
		{
			return false;
		}

		if(\dash\validate::is_ltr($jibres_sms['message']))
		{
			$planSMSCost = \lib\app\plan\planCheck::jibresCheck($store_id, 'sms', 'cost', 'en');
		}
		else
		{
			$planSMSCost = \lib\app\plan\planCheck::jibresCheck($store_id, 'sms', 'cost', 'fa');
		}


		if(!$planSMSCost)
		{
			$planSMSCost = 100;
		}

		$cost = $planSMSCost * floatval($jibres_sms['smscount']);

		$jibres_sms['final_cost']   = $cost;
		$jibres_sms['initial_cost'] = $cost;

		return true;

	}


	public static function setManual(array $_args)
	{
		$condition =
			[
				'store_id' => 'id',
				'amount'   => 'price',
				'desc'     => 'desc',
				'type'     => ['enum' => ['minus', 'plus']],
			];

		$require = ['amount', 'store_id', 'type'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$amount = abs($data['amount']);

		if($data['type'] === 'minus')
		{
			$amount = $amount * -1;
		}


		$args =
			[
				'store_id'       => $data['store_id'],
				'user_id'        => \dash\user::id(),
				'transaction_id' => null,
				'amount'         => $amount,
				'desc'           => $data['desc'],
			];

		self::addNewSMSChargeRecord($args);


	}


}