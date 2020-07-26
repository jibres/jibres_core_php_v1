<?php
namespace lib\app\domains;


class check
{
	public static function multi_check($_domain)
	{
		$domain = \dash\validate::string_200($_domain);
		$domain = \dash\validate::domain_clean($domain, false);

		if(!$domain)
		{
			\dash\notif::error(T_("Please enter a valid domain for check"));
			return false;
		}

		$tld = null;

		$real_domain = \dash\validate::domain($domain, false);
		$ir_domain   = \dash\validate::ir_domain($domain, false);

		if($ir_domain)
		{
			// user search jibres.ir
		}
		elseif($real_domain)
		{
			// user search jibres.com

			$explode = explode('.', $real_domain);
			$tld = end($explode);

		}
		else
		{
			// user search jibres

		}


		$check_tld =
		[
			// person
			'ir',
			// 'ایران', // Not enable!
			'id.ir',
			// gov
			'gov.ir',
			'co.ir',
			'net.ir',
			'org.ir',
			// edu
			'sch.ir',
			'ac.ir',
		];


		$domain = urldecode($domain);
		$domain = mb_strtolower($domain);

		$myDomainName = $domain;

		if(strpos($domain, '.') !== false)
		{
			$domain_tld = substr($domain, strpos($domain, '.'));
			$myDomainName = str_replace($domain_tld, '', $domain);
		}

		$domains = [];
		foreach ($check_tld as $tld)
		{
			$domains[] = $myDomainName. '.'. $tld;
		}

		$check_nic_domain = json_decode('{
    "adsaasdfsdf.ir": {        "name": "adsaasdfsdf",        "available": true,        "domain_restricted": false,        "domain_name_valid": true,        "price_1year": 4000,        "compareAtPrice_1year": 16000,        "price_5year": 14000,        "compareAtPrice_5year": 48000,        "unit": "تومان",        "tld": "ir",        "paperwork": null    },    "adsaasdfsdf.id.ir": {        "name": "adsaasdfsdf",        "available": true,        "domain_restricted": false,        "domain_name_valid": true,        "price_1year": 4000,        "compareAtPrice_1year": 16000,        "price_5year": 14000,        "compareAtPrice_5year": 48000,        "unit": "تومان",        "tld": "id.ir",        "paperwork": "نیازمند شناسه ایرنیک شخص حقیقی"    },    "adsaasdfsdf.gov.ir": {        "name": "adsaasdfsdf",        "available": true,        "domain_restricted": false,        "domain_name_valid": true,        "price_1year": 4000,        "compareAtPrice_1year": 16000,        "price_5year": 14000,        "compareAtPrice_5year": 48000,        "unit": "تومان",        "tld": "gov.ir",        "paperwork": "نیازمند شناسه ایرنیک وزارتخانه، سازمان یا شرکت دولتی"    },    "adsaasdfsdf.co.ir": {        "name": "adsaasdfsdf",        "available": true,        "domain_restricted": false,        "domain_name_valid": true,        "price_1year": 4000,        "compareAtPrice_1year": 16000,        "price_5year": 14000,        "compareAtPrice_5year": 48000,        "unit": "تومان",        "tld": "co.ir",        "paperwork": "نیازمند شناسه ایرنیک شرکت، موسسه یا نهاد غیردولتی"    },    "adsaasdfsdf.net.ir": {        "name": "adsaasdfsdf",        "available": true,        "domain_restricted": false,        "domain_name_valid": true,        "price_1year": 4000,        "compareAtPrice_1year": 16000,        "price_5year": 14000,        "compareAtPrice_5year": 48000,        "unit": "تومان",        "tld": "net.ir",        "paperwork": "نیازمند شناسه ایرنیک شرکت، موسسه یا نهاد غیردولتی"    },    "adsaasdfsdf.org.ir": {        "name": "adsaasdfsdf",        "available": true,        "domain_restricted": false,        "domain_name_valid": true,        "price_1year": 4000,        "compareAtPrice_1year": 16000,        "price_5year": 14000,        "compareAtPrice_5year": 48000,        "unit": "تومان",        "tld": "org.ir",        "paperwork": "نیازمند شناسه ایرنیک شرکت یا مرکز آموزشی"    },    "adsaasdfsdf.sch.ir": {        "name": "adsaasdfsdf",        "available": true,        "domain_restricted": false,        "domain_name_valid": true,        "price_1year": 4000,        "compareAtPrice_1year": 16000,        "price_5year": 14000,        "compareAtPrice_5year": 48000,        "unit": "تومان",        "tld": "sch.ir",        "paperwork": "نیازمند شناسه ایرنیک مرکز آموزشی و پژوهشی"    },    "adsaasdfsdf.ac.ir": {        "name": "adsaasdfsdf",        "available": true,        "domain_restricted": false,        "domain_name_valid": true,        "price_1year": 4000,        "compareAtPrice_1year": 16000,        "price_5year": 14000,        "compareAtPrice_5year": 48000,        "unit": "تومان",        "tld": "ac.ir",        "paperwork": "نیازمند شناسه ایرنیک مرکز آموزشی و پژوهشی"    }
}', true);
		$check_nic_domain = \lib\nic\exec\domain_check::multi_check($domains);



		$check_tld =
		[
			'com',
			'net',
			'org',
			'xyz',
			'me',
			'io',
			'info',
			'app',
			// 'tv',
			// 'club',
			// 'dev',
		];

		// also check valid tld
		if($tld && !in_array($tld, $check_tld))
		{
			array_push($check_tld, $tld);
		}

		$international_domain = [];
		foreach ($check_tld as  $tld)
		{
			$international_domain[] = $myDomainName. '.'. $tld;
		}

		$check_namecheap_domain = json_decode('{"adsaasdfsdf.com":{"name":"adsaasdfsdf.com","available":true,"ErrorNo":"0","Description":"","domain_restricted":false,"PremiumRegistrationPrice":"0","PremiumRenewalPrice":"0","PremiumRestorePrice":"0","PremiumTransferPrice":"0","IcannFee":"0","EapFee":"0.0","tld":"com"},"adsaasdfsdf.net":{"name":"adsaasdfsdf.net","available":true,"ErrorNo":"0","Description":"","domain_restricted":false,"PremiumRegistrationPrice":"0","PremiumRenewalPrice":"0","PremiumRestorePrice":"0","PremiumTransferPrice":"0","IcannFee":"0","EapFee":"0.0","tld":"net"},"adsaasdfsdf.org":{"name":"adsaasdfsdf.org","available":true,"ErrorNo":"0","Description":"","domain_restricted":false,"PremiumRegistrationPrice":"0","PremiumRenewalPrice":"0","PremiumRestorePrice":"0","PremiumTransferPrice":"0","IcannFee":"0","EapFee":"0.0","tld":"org"},"adsaasdfsdf.xyz":{"name":"adsaasdfsdf.xyz","available":true,"ErrorNo":"0","Description":"","domain_restricted":false,"PremiumRegistrationPrice":"0","PremiumRenewalPrice":"0","PremiumRestorePrice":"0","PremiumTransferPrice":"0","IcannFee":"0","EapFee":"0.0","tld":"xyz"},"adsaasdfsdf.me":{"name":"adsaasdfsdf.me","available":true,"ErrorNo":"0","Description":"","domain_restricted":false,"PremiumRegistrationPrice":"0","PremiumRenewalPrice":"0","PremiumRestorePrice":"0","PremiumTransferPrice":"0","IcannFee":"0","EapFee":"0.0","tld":"me"},"adsaasdfsdf.io":{"name":"adsaasdfsdf.io","available":true,"ErrorNo":"0","Description":"","domain_restricted":false,"PremiumRegistrationPrice":"0","PremiumRenewalPrice":"0","PremiumRestorePrice":"0","PremiumTransferPrice":"0","IcannFee":"0","EapFee":"0.0","tld":"io"},"adsaasdfsdf.info":{"name":"adsaasdfsdf.info","available":true,"ErrorNo":"0","Description":"","domain_restricted":false,"PremiumRegistrationPrice":"0","PremiumRenewalPrice":"0","PremiumRestorePrice":"0","PremiumTransferPrice":"0","IcannFee":"0","EapFee":"0.0","tld":"info"},"adsaasdfsdf.app":{"name":"adsaasdfsdf.app","available":true,"ErrorNo":"0","Description":"","domain_restricted":false,"PremiumRegistrationPrice":"0","PremiumRenewalPrice":"0","PremiumRestorePrice":"0","PremiumTransferPrice":"0","IcannFee":"0","EapFee":"0.0","tld":"app"},"adsaasdfsdf.tv":{"name":"adsaasdfsdf.tv","available":true,"ErrorNo":"0","Description":"","domain_restricted":false,"PremiumRegistrationPrice":"0","PremiumRenewalPrice":"0","PremiumRestorePrice":"0","PremiumTransferPrice":"0","IcannFee":"0","EapFee":"0.0","tld":"tv"}}', true);
		$check_namecheap_domain = \lib\namecheap\api::check_domain($international_domain);


		if(!is_array($check_namecheap_domain))
		{
			$check_namecheap_domain = [];
		}

		if(!is_array($check_nic_domain))
		{
			$check_nic_domain = [];
		}

		$result = array_merge($check_namecheap_domain, $check_nic_domain);

		$result['ir_list'] = $check_nic_domain;
		$result['com_list'] = $check_namecheap_domain;



		\lib\app\domains\detect::domain_check_multi($result);

		// var_dump($result);exit();/
		return $result;
	}


	public static function check($_domain)
	{
		if(!\dash\validate::domain($_domain))
		{
			return false;
		}

		if(\dash\validate::ir_domain($_domain, false))
		{
			return \lib\app\nic_domain\check::check($_domain);
		}
		else
		{
			return \lib\app\onlinenic\check::check($_domain, 'register');
		}
	}


}
?>