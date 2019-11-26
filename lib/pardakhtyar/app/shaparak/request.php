<?php
namespace lib\pardakhtyar\app\shaparak;


class request
{
	public static function load_error($_code)
	{
		$error = [];
		$file  = root. 'lib/pardakhtyar/error_list.json';
		if(is_file($file))
		{
			$error = \dash\file::read($file);
			$error = json_decode($error, true);
		}

		if(!is_array($error))
		{
			$error = [];
		}

		$error = array_flip($error);
		if(isset($error[$_code]))
		{
			return $error[$_code];
		}
		else
		{
			return 'Unknown';
		}
	}


	public static function load_customer($_id, $_for_shaparak = true)
	{
		if(!$_id)
		{
			\dash\notif::error("id not set");
			return false;
		}

		if(!is_numeric($_id))
		{
			\dash\notif::error("id must be a number");
			return false;
		}

		$merchant = \lib\pardakhtyar\db\customer::get_by_id($_id);

		if(!$merchant)
		{
			\dash\notif::error('data not found');
			return false;
		}

		if($_for_shaparak)
		{
			$merchant = \lib\pardakhtyar\app\customer::ready_for_shaparak($merchant);
		}

		return $merchant;
	}


	public static function load_shop($_id)
	{
		$shop = \lib\pardakhtyar\db\shop::get_by_customer_id($_id);

		if(!$shop)
		{
			\dash\notif::error('Shop detail not set');
			return false;
		}
		$shop = \lib\pardakhtyar\app\shop::ready_for_shaparak($shop);

		return $shop;
	}


	public static function load_acceptor($_id, $_load_terminal = true, $_load_iban = true)
	{
		$acceptor = \lib\pardakhtyar\db\acceptor::get_by_customer_id($_id);

		if(!$acceptor)
		{
			\dash\notif::error('Acceptor detail not set');
			return false;
		}

		$acceptor = \lib\pardakhtyar\app\acceptor::ready_for_shaparak($acceptor);

		$ibans = \lib\pardakhtyar\db\merchantIbans::get_by_customer_id($_id);
		if(is_array($ibans))
		{
			$merchantIban = array_column($ibans, 'merchantIban');
			if(!$_load_iban)
			{
				$merchantIban = null;
			}
			$acceptor['shaparakSettlementIbans'] = $merchantIban;
		}

		if($_load_terminal)
		{
			$terminal = \lib\pardakhtyar\db\terminal::get_by_customer_id($_id);
			if(!$terminal)
			{
				\dash\notif::error('terminal not set');
			}
			else
			{
				$terminal = \lib\pardakhtyar\app\terminal::ready_for_shaparak($terminal);
				$acceptor['terminals'] = [$terminal];
			}
		}

		return $acceptor;
	}


	public static function analyze_result($_result, $_id)
	{
		if(isset($_result['response']) && is_string($_result['response']))
		{
			\dash\notif::warn($_result['response']);
		}

		if(isset($_result['response'][0]) && is_array($_result['response'][0]))
		{
			if(array_key_exists('success', $_result['response'][0]))
			{
				if($_result['response'][0]['success'])
				{
					\dash\notif::ok("Request success");
				}
				else
				{
					\dash\notif::error("Request not success");
				}
			}


			if(isset($_result['response'][0]['requestRejectionReasons']) && is_array($_result['response'][0]['requestRejectionReasons']))
			{
				foreach ($_result['response'][0]['requestRejectionReasons'] as $key => $value)
				{
					$errorTitle = "Undefined";
					$erroCode = 0;
					if(isset($value['codeExceptionValue']))
					{
						$erroCode = $value['codeExceptionValue'];
						$errorTitle = self::load_error($value['codeExceptionValue']);
					}

					$fieldName = null;
					if(isset($value['fieldName']))
					{
						$fieldName = $value['fieldName'];
					}

					$msg = '';
					if($erroCode)
					{
						$msg .= "Error code : ". $erroCode. ' | ';
					}

					$msg .= $errorTitle;

					if($fieldName)
					{
						$msg .= " - IN - ". $fieldName;
					}

					\dash\notif::error($msg, $fieldName);
				}
			}
		}

		$update_customer = [];
		if(isset($_result['response'][0]['trackingNumber']))
		{
			$update_customer['trackingNumber'] = $_result['response'][0]['trackingNumber'];
		}

		if(isset($_result['response'][0]['status']))
		{
			$update_customer['status'] = $_result['response'][0]['status'];
		}

		$updateField =
		[
			'firstNameFa',
			'lastNameFa',
			'fatherNameFa',
			'firstNameEn',
			'lastNameEn',
			'fatherNameEn',
			'registerNumber',
			'comNameFa',
			'comNameEn',
			'birthCrtfctNumber',
			'commercialCode',
			'foreignPervasiveCode',
			'passportNumber',
			'Description',
			'telephoneNumber',
			'emailAddress',
			'webSite',
			'fax',
			'gender',
			'merchantType',
			'residencyType',
			'vitalStatus',
			'birthCrtfctSeriesLetter',
			'birthCrtfctSeriesNumber',
			'birthDate',
			'registerDate',
			'passportExpireDate',
			'nationalCode',
			'birthCrtfctSerial',
			'nationalLegalCode',
			'countryCode',
			'cellPhoneNumber',
		];

		$load_customer = self::load_customer($_id, false);

		if(is_array($load_customer))
		{
			foreach ($load_customer as $key => $value)
			{
				if(in_array($key, $updateField))
				{
					if(isset($_result['response'][0]['merchant'][$key]) && $_result['response'][0]['merchant'][$key] && !$value)
					{
						$update_customer[$key] = $_result['response'][0]['merchant'][$key];
					}
				}
			}
		}


		if(!empty($update_customer))
		{
			\lib\pardakhtyar\db\customer::update($update_customer, $_id);
		}

		return $_result;
	}


	public static function fetch($_id)
	{
		$merchant = self::load_customer($_id, false);

		if(!isset($merchant['trackingNumber']))
		{
			\dash\notif::error('trackingNumber not set');
			return false;
		}

		$send =
		[
			'trackingNumbers'    => [$merchant['trackingNumber']],
		];

		$result = \lib\pardakhtyar\start::run($send, ['addr' => 'read', 'table' => 'customer', 'request_id' => $_id]);

		return self::analyze_result($result, $_id);

	}

}
?>