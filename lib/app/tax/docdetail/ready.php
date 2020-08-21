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


		if(isset($result['debtor']) && $result['debtor'] && !\dash\get::index($result, 'creditor'))
		{
			$result['type'] = 'debtor';
			$result['value'] = $result['debtor'];
		}

		if(isset($result['creditor']) && $result['creditor'] && !\dash\get::index($result, 'debtor'))
		{
			$result['type'] = 'creditor';
			$result['value'] = $result['creditor'];
		}

		if(round($result['value']) == $result['value'])
		{
			$result['value'] = round($result['value']);
		}


		$result['remain'] = floatval(\dash\get::index($result, 'debtor')) - floatval(\dash\get::index($result, 'creditor'));

		return $result;
	}

}
?>