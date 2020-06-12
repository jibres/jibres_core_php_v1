<?php
namespace dash\engine;
/**
 * this lib handle content of our PHP framework, Dash
 * v 0.1
 */
class content
{
	private static $name = null;
	private static $addr = null;


	public static function content_list()
	{
		$dash_contents =
		[
			'a',
			'account',
			'cms',
			'crm',
			'developers',
			'enter',
			'hook',
			'love',
			'my',
			'n',
			'p',
			'pay',
			'r10',
			'su',
			// 'subdomain',
			'support',
			'v2',
		];

		return $dash_contents;
	}


	/**
	 * check specefic name for content is exist or not
	 * @param  [type] $_content_name [description]
	 * @return [type]                [description]
	 */
	public static function load($_content_name)
	{
		// list of contents exist in dash,
		$myrep = 'content_'.$_content_name;
		// check content_aaa folder is exist in project folder
		if(in_array($_content_name, self::content_list()))
		{
			return self::set($myrep);
		}
		elseif($_content_name && is_dir(root. $myrep))
		{
			return self::set($myrep);
		}
		elseif(in_array(\dash\url::subdomain(), ['developers', 'core', 'api']))
		{
			self::set('content_developers');
		}
		elseif($dynamic_sub_domain = self::dynamic_subdomain())
		{
			// only init set
			self::set($dynamic_sub_domain);
		}
		elseif(self::enterprise_customers())
		{
			self::set(self::enterprise_customers());
		}
		else
		{
			// only init set
			self::set('content');
		}

		return null;
	}

	/**
	 * List of api contents
	 */
	public static function api_content()
	{
		if(in_array(\dash\url::subdomain(), ['core', 'api', 'business']))
		{
			return true;
		}

		return false;
	}


	public static function set($_name, $_addr = null)
	{
		// set name
		self::$name = $_name;
		// set addr of repository
		if($_addr)
		{
			self::$addr = $_addr. $_name;
		}
		else
		{
			// fix addr of enterprise mode
			self::$addr = root. str_replace('\\', '/', $_name);
		}
		self::$addr = rtrim(self::$addr,'/').'/';

		return self::$addr;
	}

	public static function get()
	{
		if(!self::$name)
		{
			self::load(null);
		}
		return self::$name;
	}

	public static function get_addr()
	{
		if(!self::$addr)
		{
			self::load(null);
		}
		return self::$addr;
	}

	/**
	 * check for dynamic subdomain content exist or not
	 * @return [type] [description]
	 */
	private static function dynamic_subdomain()
	{
		if(\dash\url::subdomain())
		{
			// if we are in subdomain without finded repository
			// check if we have content_subDomain route in this folder
			if(is_dir(root. 'content_subdomain'))
			{
				return 'content_subdomain';
			}
			return false;
		}
		return null;
	}



	/**
	 * check enterprise customer and return special content of them
	 * @return [type] [description]
	 */
	public static function enterprise_customers()
	{
		$myDomainFile = root. 'enterprise/list/'. \dash\url::domain().'.conf';
		if(file_exists(\autoload::fix_os_path($myDomainFile)))
		{
			$myCustomer = trim(file_get_contents($myDomainFile));
			$myEnterprise = 'enterprise/'. $myCustomer;
			if(is_dir(\autoload::fix_os_path(root. $myEnterprise)))
			{
				@header("X-Ermile-Enterprise: ". $myCustomer);
				return str_replace('/', '\\', $myEnterprise);
			}
		}
		return null;
	}
}
?>
