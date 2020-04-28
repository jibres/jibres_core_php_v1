<?php
namespace lib\app\shaparak\acceptor;


class ready
{

	// remove useless field to send to shaparak
	public static function for_shaparak($_data)
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




}
?>