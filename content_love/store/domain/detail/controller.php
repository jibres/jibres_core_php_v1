<?php
namespace content_love\store\domain\detail;


class controller
{
	public static function routing()
	{
		$rawrequest = \dash\request::get('rawrequest');
		$domain     = \dash\request::get('domain');

		if($rawrequest && $domain)
		{
			$result = [];
			switch ($rawrequest)
			{

				case 'get_arvan_request':
					$result = \lib\arvancloud\api::get_arvan_request($domain);

					break;

				case 'get_domain':
					$result = \lib\arvancloud\api::get_domain($domain);

					break;

				case 'get_ns_key':
					$result = \lib\arvancloud\api::get_ns_key($domain);

					break;

				case 'get_dns_record':
					$result = \lib\arvancloud\api::get_dns_record($domain);

					break;

				case 'https':
					$result = \lib\arvancloud\api::get_arvan_request($domain);
						// set_arvan_request_https
					break;

				default:
					# code...
					break;
			}

			\dash\code::jsonBoom($result);
		}
	}
}
?>
