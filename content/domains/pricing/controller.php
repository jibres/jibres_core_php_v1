<?php
namespace content\domains\pricing;


class controller
{
	public static function routing()
	{
		switch (\dash\url::subchild())
		{
			// case 'register':
			// case 'renew':
			// case 'transfer':
			// 	\dash\open::get();
			// 	break;

			case 'json':
				// if(\dash\permission::supervisor())
				{
					\dash\open::get();
					// get price list
					$price = \lib\app\onlinenic\price::domain_price(self::requestType(), self::requestCurrency());
					// show in json format
					\dash\code::jsonBoom($price, true);
				}
				break;

			case 'table':
				// if(\dash\permission::supervisor())
				{
					\dash\open::get();
					// get price list
					$price = \lib\app\onlinenic\price::price_table(self::requestType(), self::requestCurrency());
					// show in json format
					\dash\code::jsonBoom($price, true);
				}
				break;


			default:
				// do nothing
				break;
		}
	}


	public static function requestType()
	{
		$type = \dash\request::get('type');
		switch ($type)
		{
			case 'register':
			case 'renew':
			case 'transfer':
				// it's okay
				break;

			default:
				$type = null;
				break;
		}

		if($type)
		{
			$type = 'domain'. $type;
		}

		return $type;
	}


	public static function requestCurrency()
	{
		$unit = '$';
		if(\dash\language::current() === 'fa')
		{
			$unit = 'IRT';
		}
		if(\dash\request::get('currency') === '$')
		{
			$unit = '$';
		}

		return $unit;
	}


	public static function priceEl($_val, $_optimizeForMobile = null)
	{
		if(!$_val)
		{
			return null;
		}

		$currency = self::requestCurrency();
		$html = '<div class="">';
		if($currency === '$')
		{
			$html .= '<span class="fc-mute">';
			$html .= '$';
			$html .= '</span>';
			$html .= \dash\fit::number($_val, false);
		}

		else if($currency === 'IRT')
		{
			$html .= \dash\fit::number($_val);
			if($_optimizeForMobile)
			{
				$html .= '<small class="fc-mute s0">';
			}
			else
			{
				$html .= '<small class="fc-mute">';
			}
			$html .= ' '. T_("Hezar Toman");
			$html .= '</small>';
		}
		$html .= '</div>';

		return $html;
	}

}
?>