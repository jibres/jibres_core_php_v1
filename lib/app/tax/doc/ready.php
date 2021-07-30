<?php
namespace lib\app\tax\doc;


class ready
{

	public static function row($_data)
	{
		if(!is_array($_data))
		{
			$_data = [];
		}

		$result     = [];

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'gallery':
					$result[$key] = $value;
					if($value)
					{
						$result['gallery_array'] = json_decode($value, true);
						$result['gallery_array'] = \lib\app\tax\doc\gallery::load_detail($result['gallery_array']);

					}
					else
					{
						$result['gallery_array'] = null;
					}
					break;

				case 'status':
					$tvalue = null;
					switch ($value)
					{
						case 'draft':
							$tvalue = T_("Draft");
							break;

						case 'lock':
							$tvalue = T_("Permanent");
							break;

						case 'temp':
							$tvalue = T_("Temp");
							break;

						default:
							# code...
							break;
					}
					$result['tstatus'] = $tvalue;
					$result[$key] = $value;
					break;

				case 'template':
					$result['template_title'] = self::factor_type_translate($value);
					$result[$key] = $value;
					break;
				default:
					$result[$key] = $value;
					break;
			}
		}


		return $result;
	}


	public static function factor_template_list()
	{
		return
		[
			'income',
			'cost' ,
			'petty_cash',
			'partner',
			'asset',
			'bank_partner',
			'costasset',
			'bank_profit',
		];
	}




	public static function factor_type_translate($_type)
	{
		switch ($_type)
		{
			case 'cost':
				$tvalue = T_("Cost");
				break;

			case 'income':
				$tvalue = T_("Income");
				break;

			case 'petty_cash':
				$tvalue = T_("Petty cash");
				break;

			case 'partner':
				$tvalue = T_("Accounting Partner");
				break;

			case 'asset':
				$tvalue = T_("Asset");
				break;

			case 'bank_partner':
				$tvalue = T_("Charge bank from partner");
				break;

			case 'costasset':
				$tvalue = T_("Cost + Asset");
				break;

			case 'bank_profit':
				$tvalue = T_("Bank profit");
				break;

			case 'doc':
				$tvalue = T_("Accounting Documents");
				break;

			default:
				$tvalue = T_("Accounting factor");
				break;
		}

		return $tvalue;
	}



	public static function report($_data)
	{
		if(!is_array($_data))
		{
			$_data = [];
		}

		$result     = [];

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'debtor':
				case 'creditor':
					$result[$key] = floatval($value);
					break;
				default:
					$result[$key] = $value;
					break;
			}
		}

		if(array_key_exists('debtor', $result) && array_key_exists('creditor', $result))
		{
			$diff = floatval($result['debtor']) - floatval($result['creditor']);

			if($diff > 0)
			{
				$result['remain_debtor'] = abs($diff);
				$result['remain_creditor'] = 0;
			}
			else
			{
				$result['remain_debtor'] = 0;
				$result['remain_creditor'] = abs($diff);
			}
		}


		return $result;
	}

}
?>