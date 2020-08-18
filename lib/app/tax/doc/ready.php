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
				case 'status':
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
				default:
					$result[$key] = $value;
					break;
			}
		}


		return $result;
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