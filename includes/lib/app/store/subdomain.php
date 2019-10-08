<?php
namespace lib\app\store;


class subdomain
{

	public static function validate($_subdomain)
	{
		$_subdomain = \dash\utility\convert::to_en_number($_subdomain);
		$_subdomain = mb_strtolower($_subdomain);
		$_subdomain = trim($_subdomain);
		$_subdomain = preg_replace("/\_{2,}/", "_", $_subdomain);
		$_subdomain = preg_replace("/\-{2,}/", "-", $_subdomain);

		if(self::system_keyword($_subdomain))
		{
			\dash\notif::error(T_("You can not choose this subdomain"), 'subdomain');
			return false;
		}

		if(mb_strlen($_subdomain) < 5)
		{
			\dash\notif::error(T_("Slug must have at least 5 character"), 'subdomain');
			return false;
		}

		if(mb_strlen($_subdomain) > 50)
		{
			\dash\notif::error(T_("Please set the subdomain less than 50 character"), 'subdomain');
			return false;
		}

		if(!preg_match("/^[A-Za-z0-9\-\_]+$/", $_subdomain))
		{
			\dash\notif::error(T_("Only [A-Za-z0-9-_] can use in subdomain"), 'subdomain');
			return false;
		}

		if(is_numeric($_subdomain))
		{
			\dash\notif::error(T_("Slug should contain a Latin letter"), 'subdomain');
			return false;
		}

		if(is_numeric(substr($_subdomain, 0, 1)))
		{
			\dash\notif::error(T_("The subdomain must begin with latin letters"), 'subdomain');
			return false;
		}

		if(substr_count($_subdomain, '-') > 1)
		{
			\dash\notif::error(T_("The subdomain must have one separator"), 'subdomain');
			return false;
		}

		if(substr_count($_subdomain, '_') > 1)
		{
			\dash\notif::error(T_("The subdomain must have one separator"), 'subdomain');
			return false;
		}

		if(strpos($_subdomain, 'jibres') !== false)
		{
			\dash\notif::error(T_("Can not use subdomain by jibres keyword"), 'subdomain');
			return false;
		}

		if(self::black_list($_subdomain))
		{
			\dash\notif::error(T_("You can not choose this subdomain"), 'subdomain', 'arguments');
			return false;
		}

		return $_subdomain;
	}


	private static function system_keyword($_subdomain)
	{
		$system_keyword =
		[
			'ssl',			'www',						'ns1',
			'http',			'https',					'vps',
			'jibres',		'ermile',					'phpmyadmin',
			'azvir',		'sarshomar',				'php',
			'tejarak',		'demo',						'nginx',
			'talambar',		'benefits',					'phpcode',
			'pricing',		'help',						'apache',
			'admin',		'enter',					'apache2',
			'about',		'social-responsibility',	'hook',
			'social',		'terms',					'payment',
			'privacy',		'changelog',				'telegram',
			'logo',			'contact',					'instagram',
			'api',			'branch',					'twitter',
			'team',			'member',					'facebook',
			'add',			'edit',						'github',
			'delete',		'user',						'smartgit',
			'hours',		'report',					'trello',
			'last',			'daily',					'gmail',
			'account',		'for',						'vps1',
			'files',		'static',					'subdomain',
			'private',		'public',					'protected',
			'dollar',		'android',					'ubuntu',
			'wwww',			'wwwww',					'wwwwww',
			'api',  		'application',				'domain',
			'server',		'download',					'domains',
			'dl',
		];

		return in_array($_subdomain, $system_keyword);
	}


	private static function black_list($_subdomain)
	{
		$file = \dash\file::read(__DIR__. '/subdomain_black_list.txt');

		if($file)
		{
			$get = explode("\n", $file);
			if(is_array($get))
			{
				return in_array($_subdomain, $get);
			}
		}

		return false;
	}
}
?>