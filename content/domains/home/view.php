<?php
namespace content\domains\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Domain Registration'));
		\dash\face::desc(T_('Jibres offers cheap domain names with the most reliable service.'). ' '. T_('Buy or transfer a domain name today!'));

		\dash\face::seo(T_('Domain Names'). ' - '. T_("Register Domains with Jibres") . ' - '. T_("Buy a Domain Name"));
		\dash\face::headTitle(T_('Buy A Domain'));

		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-domain-1.jpg');


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