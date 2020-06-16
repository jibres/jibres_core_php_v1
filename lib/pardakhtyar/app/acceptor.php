<?php
namespace lib\pardakhtyar\app;


class acceptor
{

	public static $sort_field = [];

	public static function add($_args)
	{
		\dash\app::variable($_args);

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		// check args
		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args['creator']     = \dash\user::id();
		$args['datecreated'] = date("Y-m-d H:i:s");
		$return = [];

		$acceptor_id = \lib\pardakhtyar\db\acceptor::insert($args);

		if(!$acceptor_id)
		{
			\dash\app::log('dbErrorCanNotAddAcceptor');
			\dash\notif::error(T_("No way to insert Acceptor"), 'db', 'system');
			return false;
		}

		$return['id'] = \dash\coding::encode($acceptor_id);
		if(\dash\engine\process::status())
		{
			\dash\log::set('addNewAcceptor', ['code' => $acceptor_id]);
			\dash\notif::ok(T_("Acceptor successfuly added"));
		}

		return $return;
	}


	public static function edit($_args, $_id)
	{
		\dash\app::variable($_args);

		$result = self::get($_id);

		$id = $_id;
		if(!$result)
		{
			return false;
		}

		// $id = \dash\coding::decode($_id);

		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!\dash\app::isset_request('iin')) unset($args['iin']);
		if(!\dash\app::isset_request('acceptorCode')) unset($args['acceptorCode']);
		if(!\dash\app::isset_request('acceptorType')) unset($args['acceptorType']);
		if(!\dash\app::isset_request('facilitatorAcceptorCode')) unset($args['facilitatorAcceptorCode']);
		if(!\dash\app::isset_request('cancelable')) unset($args['cancelable']);
		if(!\dash\app::isset_request('refundable')) unset($args['refundable']);
		if(!\dash\app::isset_request('blockable')) unset($args['blockable']);
		if(!\dash\app::isset_request('chargeBackable')) unset($args['chargeBackable']);
		if(!\dash\app::isset_request('settledSeparately')) unset($args['settledSeparately']);
		if(!\dash\app::isset_request('allowScatteredSettlement')) unset($args['allowScatteredSettlement']);
		if(!\dash\app::isset_request('acceptCreditCardTransaction')) unset($args['acceptCreditCardTransaction']);
		if(!\dash\app::isset_request('allowIranianProductsTrx')) unset($args['allowIranianProductsTrx']);
		if(!\dash\app::isset_request('allowKaraCardTrx')) unset($args['allowKaraCardTrx']);
		if(!\dash\app::isset_request('allowGoodsBasketTrx')) unset($args['allowGoodsBasketTrx']);
		if(!\dash\app::isset_request('allowFoodSecurityTrx')) unset($args['allowFoodSecurityTrx']);
		if(!\dash\app::isset_request('allowJcbCardTrx')) unset($args['allowJcbCardTrx']);
		if(!\dash\app::isset_request('allowUpiCardTrx')) unset($args['allowUpiCardTrx']);
		if(!\dash\app::isset_request('allowVisaCardTrx')) unset($args['allowVisaCardTrx']);
		if(!\dash\app::isset_request('allowMasterCardTrx')) unset($args['allowMasterCardTrx']);
		if(!\dash\app::isset_request('allowAmericanExpressTrx')) unset($args['allowAmericanExpressTrx']);
		if(!\dash\app::isset_request('allowOtherInternationaCardsTrx')) unset($args['allowOtherInternationaCardsTrx']);
		if(!\dash\app::isset_request('Description')) unset($args['Description']);

		if(!empty($args))
		{
			$args['datemodified'] = date("Y-m-d H:i:s");

			$update = \lib\pardakhtyar\db\acceptor::update($args, $id);

			if(\dash\engine\process::status())
			{
				\dash\log::set('editAcceptor', ['code' => $id,]);
				\dash\notif::ok(T_("Acceptor successfully updated"));
			}
		}
	}



	public static function get($_id)
	{
		if(!is_numeric($_id))
		{
			\dash\notif::error(T_("Acceptor id not set"));
			return false;
		}

		$get = \lib\pardakhtyar\db\acceptor::get(['id' => $_id, 'limit' => 1]);

		if(!$get)
		{
			\dash\notif::error(T_("Invalid Acceptor id"));
			return false;
		}

		$result = self::ready($get);

		return $result;
	}


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check($_id = null)
	{

		$user_id = \dash\app::request('user_id');
		if($user_id && !is_numeric($user_id))
		{
			\dash\notif::error(T_("Invalid user id"), 'user_id');
			return false;
		}

		$customer_id = \dash\app::request('customer_id');
		if($customer_id && !is_numeric($customer_id))
		{
			\dash\notif::error(T_("Invalid user id"), 'customer_id');
			return false;
		}

		$iin = \dash\app::request('iin');
		if($iin && mb_strlen($iin) > 9)
		{
			\dash\notif::error("iin is out of range! maximum 9", 'iin');
			return false;
		}

		if($iin && mb_strlen($iin) < 6)
		{
			\dash\notif::error("iin is out of range! minimum 6", 'iin');
			return false;
		}

		// if(!$iin)
		// {
		// 	\dash\notif::error("iin is required", 'iin');
		// 	return false;
		// }

		$acceptorCode = \dash\app::request('acceptorCode');
		if($acceptorCode && mb_strlen($acceptorCode) !== 15)
		{
			\dash\notif::error("acceptorCode is out of range! exacliy 15", 'acceptorCode');
			return false;
		}

		if(!$acceptorCode)
		{
			\dash\notif::error("acceptorCode is required", 'acceptorCode');
			return false;
		}

		$acceptorType = \dash\app::request('acceptorType');
		$acceptorType = 2;


		$facilitatorAcceptorCode = \dash\app::request('facilitatorAcceptorCode');
		if($facilitatorAcceptorCode && mb_strlen($facilitatorAcceptorCode) !== 15)
		{
			\dash\notif::error("facilitatorAcceptorCode is out of range! exacliy 15", 'facilitatorAcceptorCode');
			return false;
		}

		$cancelable                     = \dash\app::request('cancelable') ? 1 : null;
		$refundable                     = \dash\app::request('refundable') ? 1 : null;
		$blockable                      = \dash\app::request('blockable') ? 1 : null;
		$chargeBackable                 = \dash\app::request('chargeBackable') ? 1 : null;
		$settledSeparately              = \dash\app::request('settledSeparately') ? 1 : null;
		$acceptCreditCardTransaction    = \dash\app::request('acceptCreditCardTransaction') ? 1 : null;
		$allowIranianProductsTrx        = \dash\app::request('allowIranianProductsTrx') ? 1 : null;
		$allowKaraCardTrx               = \dash\app::request('allowKaraCardTrx') ? 1 : null;
		$allowGoodsBasketTrx            = \dash\app::request('allowGoodsBasketTrx') ? 1 : null;
		$allowFoodSecurityTrx           = \dash\app::request('allowFoodSecurityTrx') ? 1 : null;
		$allowJcbCardTrx                = \dash\app::request('allowJcbCardTrx') ? 1 : null;
		$allowUpiCardTrx                = \dash\app::request('allowUpiCardTrx') ? 1 : null;
		$allowVisaCardTrx               = \dash\app::request('allowVisaCardTrx') ? 1 : null;
		$allowMasterCardTrx             = \dash\app::request('allowMasterCardTrx') ? 1 : null;
		$allowAmericanExpressTrx        = \dash\app::request('allowAmericanExpressTrx') ? 1 : null;
		$allowOtherInternationaCardsTrx = \dash\app::request('allowOtherInternationaCardsTrx') ? 1 : null;

		$allowScatteredSettlement = \dash\app::request('allowScatteredSettlement');
		$allowScatteredSettlement = null; // use in feature


		$Description = \dash\app::request('Description');
		if($Description && mb_strlen($Description) > 255)
		{
			\dash\notif::error("Description is out of range", 'Description');
			return false;
		}



		$check_duplicate_args =
		[
			'iin'          => $iin,
			'acceptorCode' => $acceptorCode,
		];

		$check_duplicate = \lib\pardakhtyar\db\acceptor::check_duplicate($check_duplicate_args, $_id);
		if(isset($check_duplicate['id']))
		{
			if(floatval($check_duplicate['id']) === floatval($_id))
			{
				// no problem to edit record
			}
			else
			{
				\dash\notif::error("This data is duplicate");
				return false;
			}
		}


		$args                                   = [];
		$args['customer_id']                    = $customer_id;
		$args['user_id']                        = $user_id;
		$args['user_id']                        = $user_id;
		$args['customer_id']                    = $customer_id;
		$args['iin']                            = $iin;
		$args['acceptorCode']                   = $acceptorCode;
		$args['acceptorType']                   = $acceptorType;
		$args['facilitatorAcceptorCode']        = $facilitatorAcceptorCode;
		$args['cancelable']                     = $cancelable;
		$args['refundable']                     = $refundable;
		$args['blockable']                      = $blockable;
		$args['chargeBackable']                 = $chargeBackable;
		$args['settledSeparately']              = $settledSeparately;
		$args['acceptCreditCardTransaction']    = $acceptCreditCardTransaction;
		$args['allowIranianProductsTrx']        = $allowIranianProductsTrx;
		$args['allowKaraCardTrx']               = $allowKaraCardTrx;
		$args['allowGoodsBasketTrx']            = $allowGoodsBasketTrx;
		$args['allowFoodSecurityTrx']           = $allowFoodSecurityTrx;
		$args['allowJcbCardTrx']                = $allowJcbCardTrx;
		$args['allowUpiCardTrx']                = $allowUpiCardTrx;
		$args['allowVisaCardTrx']               = $allowVisaCardTrx;
		$args['allowMasterCardTrx']             = $allowMasterCardTrx;
		$args['allowAmericanExpressTrx']        = $allowAmericanExpressTrx;
		$args['allowOtherInternationaCardsTrx'] = $allowOtherInternationaCardsTrx;
		$args['allowScatteredSettlement']       = $allowScatteredSettlement;
		$args['Description']                    = $Description;

		return $args;
	}



	// remove useless field to send to shaparak
	public static function ready_for_shaparak($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{

				case 'iin':
					$result[$key] = \lib\pardakhtyar\acceptor::get_iin();
					break;

				case 'facilitatorAcceptorCode':
					$result[$key] = \lib\pardakhtyar\acceptor::get_facilitatorAcceptorCode();
					break;

				case 'allowScatteredSettlement':
					$result[$key] = 0;
					break;

				case 'acceptorCode':
				case 'acceptorType':
					$result[$key] = $value;
					break;

				case 'cancelable':
				case 'refundable':
				case 'blockable':
				case 'chargeBackable':
				case 'settledSeparately':
				case 'acceptCreditCardTransaction':
				case 'allowIranianProductsTrx':
				case 'allowKaraCardTrx':
				case 'allowGoodsBasketTrx':
				case 'allowFoodSecurityTrx':
				case 'allowJcbCardTrx':
				case 'allowUpiCardTrx':
				case 'allowVisaCardTrx':
				case 'allowMasterCardTrx':
				case 'allowAmericanExpressTrx':
				case 'allowOtherInternationaCardsTrx':
					$result[$key] = 'false';
					break;

				case 'Description':
				default:
					// nothing
					break;
			}
		}

		return $result;
	}

	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{

				case 'birthCrtfctSeriesLetter':
				case 'vitalStatus':
				case 'residencyType':
				case 'gender':
				case 'merchantType':
					$fn = 'title_'. $key;
					$result[$key.'_title'] = \lib\pardakhtyar\type::$fn($value);
					$result[$key] = $value;
					break;
				case 'birthDate':
					$result[$key. '_title'] = \dash\datetime::fit($value, 'human');
					$result[$key] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


	public static function list($_string, $_args)
	{
		if(!\dash\user::id())
		{
			return false;
		}

		$default_meta =
		[
			'sort'  => null,
			'order' => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_meta, $_args);

		if($_args['sort'] && !in_array($_args['sort'], self::$sort_field))
		{
			$_args['sort'] = null;
		}


		$result            = \lib\pardakhtyar\db\acceptor::search($_string, $_args);
		$temp              = [];

		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}

}
?>