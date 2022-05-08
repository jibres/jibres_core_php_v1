<?php
namespace lib\app\nic_credit;


class get
{
	public static function fetch($_silent_notif = false)
	{
		$result = \lib\api\nic\exec\contact_credit::credit();

		$must_insert = [];
		if(!is_array($result))
		{
			$result = [];
		}

		foreach ($result as $key => $value)
		{
			if(isset($value['roid']) && isset($value['date']))
			{
				$check_duplicate = \lib\db\nic_credit\get::check_duplicate($value['date'], $value['roid']);

				if(!$check_duplicate)
				{
					$value['datecreated'] = date("Y-m-d H:i:s");
					$must_insert[] = $value;
				}
			}
		}

		if(!empty($must_insert))
		{
			\lib\db\nic_credit\insert::multi_insert($must_insert);
		}


		if(!$_silent_notif)
		{
			$last = self::last();
			if(isset($last['balance']) && is_numeric($last['balance']))
			{
				// nic credit have less than 100 unit
				if(floatval($last['balance']) < 500)
				{
					$my_code = date("Y-m-d"). '-'. $last['balance'];

					if(!\dash\app\log::check_caller_code('domain_creditLow', $my_code))
					{
						\dash\log::set('domain_creditLow', ['code' => $my_code, 'my_balance' => $last['balance']]);
					}
				}
			}
		}

		return $result;
	}


	public static function last()
	{
		$last = \lib\db\nic_credit\get::last();
		$last = \lib\app\nic_credit\ready::row($last);
		return $last;
	}


	public static function check_refund()
	{
		$need_check_refound = \lib\db\nic_credit\get::check_refund();
		if(!$need_check_refound || !is_array($need_check_refound))
		{
			return;
		}

		foreach ($need_check_refound as $key => $value)
		{
			$transaction_id = \lib\app\nic_poll\get::back_money($value['domain']);
			$meta = null;
			if(!$transaction_id)
			{
				$meta = 'Can not refund money';
				$transaction_id = null;
			}

			$update = ['refund_transaction_id' => $transaction_id, 'meta' => $meta];

			\lib\db\nic_credit\update::record($update, $value['id']);

		}
	}
}
?>