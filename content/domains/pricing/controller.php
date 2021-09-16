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
				\dash\open::get();
				break;

			case 'json':
				// if(\dash\permission::supervisor())
				{
					\dash\open::get();
					$type = \dash\request::get('type');
					switch ($type)
					{
						case 'register':
						case 'renew':
						case 'transfer':
							$price = \lib\app\onlinenic\price::domain_price('domain'. $type);

							break;

						default:
							$price = \lib\app\onlinenic\price::domain_price();
							break;
					}

					\dash\code::jsonBoom($price, true);
				}
				break;

			default:
				// do nothing
				break;
		}
	}

}
?>