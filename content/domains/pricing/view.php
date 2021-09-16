<?php
namespace content\domains\pricing;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Hundreds Of Domains At Great Prices'));
		\dash\face::desc(T_('Use our domain price search tool to find the cost of popular domains.'). ' '. T_('Buy or transfer a domain name today!'));

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-domain-pricing-1.jpg');

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::kingdom(). '/domains');

		$year = '1 year';
		switch (\dash\request::get('yr'))
		{
			case '2':
			case '3':
			case '4':
			case '5':
			case '6':
			case '7':
			case '8':
			case '9':
			case '10':
				$year = \dash\request::get('yr'). ' years';
				$newTitle = ' - '. \dash\fit::number(\dash\request::get('yr')) . ' '. T_("year");
				\dash\face::title(\dash\face::title(). $newTitle);
				break;

			default:
				break;
		}



		$price = \lib\app\onlinenic\price::price_table(controller::requestType(), controller::requestCurrency(), $year);
		\dash\data::dataTable($price);

		$special =
		[
			'.com',
			'.net',
			// '.org',
			// '.io',
			'.app',
			'.me',
			'.xyz',
			// '.co',
			// '.info',
			// '.pro',
			'.ir',
		];
		$specialTLD = [];
		foreach ($special as $tld)
		{
			if(isset($price[$tld]))
			{
				$specialTLD[$tld] = $price[$tld];
			}
		}

		\dash\data::specialTLD($specialTLD);
	}

}
?>