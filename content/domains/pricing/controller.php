<?php
namespace content\domains\pricing;


class controller
{
	public static function routing()
	{
		switch (\dash\url::subchild())
		{
			case 'register':
			case 'renew':
			case 'transfer':
			// case 'json':
				\dash\open::get();
				break;

			case 'convert':
				if(\dash\permission::supervisor())
				{
					self::convert_csv_to_json();
				}
				break;

			default:
				// do nothing
				break;
		}
	}

	private static function convert_csv_to_json()
	{
		$price = \lib\app\onlinenic\price::domain_price_json();

		\dash\file::write(__DIR__, $price);

		var_dump($price);
		exit();
	}

}
?>