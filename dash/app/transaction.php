<?php
namespace dash\app;

class transaction
{
	use \dash\app\transaction\datalist;

	public static function total_paid($_where = null)
	{
		$total_paid = \dash\db\transactions::total_paid($_where);
		return floatval($total_paid);
	}

	public static function total_paid_count($_where = null)
	{
		$total_paid = \dash\db\transactions::total_paid_count($_where);
		return floatval($total_paid);
	}


	public static function total_paid_date($_date, $_where = null)
	{
		$total_paid = \dash\db\transactions::total_paid_date($_date, $_where);
		return floatval($total_paid);
	}


	public static function ready($_data)
	{
		if(!is_array($_data))
		{
			$_data = [];
		}

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'currency':
					$result[$key] = $value;
					if($value)
					{
						$result['currency_name'] = \lib\currency::name($value);
					}
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