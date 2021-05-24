<?php
namespace dash\app;

class transaction
{

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
				case 'user_id':
					$result[$key] = $value;
					$result['user_code'] = \dash\coding::encode($value);

					break;

				case 'displayname':
					if(!$value && $value != '0')
					{
						$value = T_("Without name");
					}
					$result[$key] = $value;
					break;
				case 'avatar':
					if($value)
					{
						$avatar = \lib\filepath::fix($value);
					}
					else
					{
						$avatar = \dash\app::static_avatar_url('unknown');
					}

					$result[$key] = $avatar;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		if(
			a($result, 'payment_response2') &&
			!a($result, 'verify') &&
			a($result, 'payment') === 'zarinpal' &&
			(
				(is_array(a($result, 'payment_response3')) && empty($result['payment_response3'])) ||
				!a($result, 'payment_response3') || a($result, 'payment_response3') == '[]' || a($result, 'payment_response3') == '{}'
			)
		)
		{
			$result['verify_again'] = true;
		}

		if(\dash\temp::get('isApi'))
		{
			unset($result['user_id']);
            unset($result['code']);
            unset($result['caller']);
            unset($result['amount_request']);
            unset($result['amount_end']);
            unset($result['parent_id']);
            unset($result['related_user_id']);
            unset($result['related_foreign']);
            unset($result['related_id']);
            unset($result['payment_response']);
            unset($result['meta']);
            unset($result['payment_response1']);
            unset($result['payment_response2']);
            unset($result['payment_response3']);
            unset($result['payment_response4']);
            unset($result['token']);
            unset($result['banktoken']);
            unset($result['finalmsg']);
            unset($result['factor_id']);
		}

		return $result;
	}
}
?>