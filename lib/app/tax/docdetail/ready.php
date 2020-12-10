<?php
namespace lib\app\tax\docdetail;


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
				default:
					$result[$key] = $value;
					break;
			}
		}


		if(isset($result['debtor']) && $result['debtor'] && !a($result, 'creditor'))
		{
			$result['type'] = 'debtor';
			$result['value'] = $result['debtor'];
			$result['creditor'] = 0;
		}

		if(isset($result['creditor']) && $result['creditor'] && !a($result, 'debtor'))
		{
			$result['type'] = 'creditor';
			$result['value'] = $result['creditor'];
			$result['debtor'] = 0;
		}

		if(round($result['value']) == $result['value'])
		{
			$result['value'] = round($result['value']);
		}

		$result['remain'] = floatval(a($result, 'debtor')) - floatval(a($result, 'creditor'));

		return $result;
	}

}
?>