<?php
namespace content\domains\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Domain Registration'));
		\dash\face::desc(T_('Jibres offers cheap domain names with the most reliable service.'). ' '. T_('Buy or transfer a domain name today!'));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());





		$domainPrice =
		[
			'ir1year' => \lib\app\nic_domain\price::register('1year'),
			'ir5year' => \lib\app\nic_domain\price::register('5year'),
			'com1year' => \lib\app\onlinenic\price::price_com_1_year(),
		];

		\dash\data::domainPrice($domainPrice);
	}
}
?>