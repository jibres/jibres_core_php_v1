<?php
namespace dash\validate;
/**
 * Class for validate args
 */
class url
{

	public static function url($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 3, 'max' => 100]);

		if($data === false || $data === null)
		{
			return $data;
		}

		$data = filter_var($data, FILTER_SANITIZE_URL);

		if(!filter_var($data, FILTER_VALIDATE_URL))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Url is invalid"), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}


	public static function domain($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 3, 'max' => 100]);
		if($data === false || $data === null)
		{
			return $data;
		}


		if(strpos($data, '.') === false)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Domain must be contain one dot character."), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		if(substr_count($data, '.') > 3)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Domain can contain maximum 3 dot character"), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		$check_is_ip = self::ip($data, false);
		if($check_is_ip)
		{
			\dash\notif::error(T_("This is not a valid domain. This is an IP!"), ['element' => $_element, 'code' => 1605]);
			return false;
		}

		$data = self::domain_clean($data, $_notif, $_element, $_field_title);

		return $data;
	}


	public static function domain_clean($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = $_data;
		$data = preg_replace("/\s/", '', $data);
		$data = urldecode($data);
		$data = mb_strtolower($data);
		$data = \dash\utility\convert::to_en_number($data);

		$data = str_replace('http://', '', $data);
		$data = str_replace('https://', '', $data);
		$data = preg_replace("/^(.*)\:\/\//", '', $data);
		$data = preg_replace("/\:\d+/", '', $data);
		$data = str_replace(':', '', $data);

		if(strpos($data, '/') !== false)
		{
			$data = str_replace(substr($data, strpos($data, '/')), '', $data);
		}

		$data = str_replace('/', '', $data);

		if(in_array(substr($data, 0, 1), ['.']))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Domain can not start by dot character"), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;
		}


		return $data;
	}


	public static function domain_root($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 3, 'max' => 100]);
		if($data === false || $data === null)
		{
			return $data;
		}

		if(substr_count($data, '.') > 2)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Domain can contain maximum 3 dot character"), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		$data = self::domain_clean($data, $_notif, $_element, $_field_title);

		return $data;
	}


	public static function ir_domain($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 3, 'max' => 100]);

		if($data === false || $data === null)
		{
			return $data;
		}

		$data = self::domain_clean($data, $_notif, $_element, $_field_title);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(!preg_match("/\.(ir|ایران|ايران|id\.ir|gov\.ir|co\.ir|net\.ir|org\.ir|sch\.ir|ac\.ir)$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("This is not an IR domain"), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;

		}

		return $data;
	}



	public static function ip($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 3, 'max' => 100]);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(!filter_var($data, FILTER_VALIDATE_IP))
		{
			if($_notif)
			{
				\dash\notif::error(T_("IP is invalid"), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}



	public static function ipv4($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 3, 'max' => 100]);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(!filter_var($data, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4))
		{
			if($_notif)
			{
				\dash\notif::error(T_("IP is invalid"), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}

	public static function ipv6($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 3, 'max' => 100]);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(!filter_var($data, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6))
		{
			if($_notif)
			{
				\dash\notif::error(T_("IP is invalid"), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		return $data;
	}


	public static function dns($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 3, 'max' => 100]);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(!preg_match("/^[a-zA-Z0-9\-\.]+$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("DNS is invalid"), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;
		}

		$data = urldecode($data);
		$data = mb_strtolower($data);


		return $data;
	}


	public static function allow_post_url($_url, $_type, $_id)
	{
		// remove / from fist or end of url
		$raw_url = str_replace('/', '', $_url);

		if(mb_strlen($raw_url) === 1 || mb_strlen($_url) === 1)
		{
			\dash\notif::error(T_("You cannot select one character for addresses"), ['element' => ['url', 'slug', 'title']]);
			return false;
		}

		if($_type === 'tag')
		{
			/* no problem to use tag with 2 url*/
		}
		else
		{
			if(mb_strlen($raw_url) === 2 || mb_strlen($_url) === 2)
			{
				\dash\notif::error(T_("You cannot select two character for addresses"), ['element' => ['url', 'slug', 'title']]);
				return false;
			}
		}

		if(substr_count($_url, '/') > 3)
		{
			\dash\notif::error(T_("You cannot use more than 3 slash in url"), ['element' => ['url', 'slug', 'title']]);
			return false;
		}

		$first_url = $_url;

		if(strpos($_url, '/') !== false)
		{
			$first_url = strtok($_url, '/');
		}

		$disallow =
		[
			'tag',
			// 'file',
			'files',
			'static',
			'sitemap',
			/* this item exist in content_business as a module*/
			'category',
			'collection',
			'apk',
			'app',
			'home',
			'comment',
			'orders',
			'order',
			'profile',
			'search',
			'shipping',
			// 'audio',
			// 'podcast',
			// 'gallery',
			// 'image',
			// 'images',
			// 'video',
			// 'blog',

		];

		$disallow = array_merge($disallow, \dash\engine\content::content_list());

		if(in_array($raw_url, $disallow) || in_array($_url, $disallow) || in_array($first_url, $disallow))
		{
			\dash\notif::error(T_("This address is a system keyword and cannot be selected"), ['element' => ['url', 'slug', 'title']]);
			return false;
		}

		return true;
	}



	/**
	 * This function tested by this domain
	 *
	 * abc.com
	 * http://abc.com
	 * http://abc.com:2020
	 * http://noshahr.gov.ir
	 * noshahr.gov.ir
	 * subdomain.noshahr.gov.ir
	 * https://www.abc.com/
	 * www.abc.com
	 * 127.0.0.2
	 * http://username:password@hostname:9090/path?arg=value#anchor
	 * //www.example.com/path?googleguy=googley
	 * user:pass@example.com:8080/path/to/index.html
	 * http://127.0.0.2:2020/
	 * https://username:password@x.subdomain.noshahr.gov.ir:9090/path?arg=value#anchor
	 *
	 * @param      <type>   $_url   The url
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function parseUrl($_url)
	{
		$url = \dash\validate::string_1000($_url, false);
		if(!$url)
		{
			return false;
		}

		if(substr($url, 0, 2) === '//')
		{
			$url = substr($url, 2);
		}

		$remove_protocol = false;
		if(preg_match("/^(http|https|ftp|mailto|file|data|irc)\:\/\/(.*)/", $url))
		{
			// nothing
		}
		else
		{
			if(strpos($url, '://') === false)
			{
				$remove_protocol = true;
				$url = 'http://'. $url;
			}
		}


		$parse_url = parse_url($url);

		if($parse_url === false || !is_array($parse_url))
		{
			return false;
		}

		$default =
		[
			'protocol'  => null,
			'root'      => null,
			'domain'    => null,
			'tld'       => null,
			'subdomain' => null,


			// -- from path info
			'scheme'   => null,
			'host'     => null,
			'port'     => null,
			'user'     => null,
			'pass'     => null,
			'path'     => null,
			'query'    => null,
			'fragment' => null,
		];


		$parse_url = array_merge($default, $parse_url);

		if($parse_url['scheme'])
		{
			if(is_string($parse_url['scheme']) && in_array($parse_url['scheme'], ['http','https','ftp','mailto','file','data','irc']))
			{
				$parse_url['protocol'] = $parse_url['scheme'];
			}
		}

		if($parse_url['host'] && is_string($parse_url['host']))
		{
			$parse_url['domain'] = $parse_url['host'];
		}

		$domain = $parse_url['domain'];

		$subdomain = null;
		$root      = null;
		$tld       = null;

		if($domain)
		{
			$my_domain = $domain;

			if(\dash\validate::ip($my_domain, false))
			{
				// host is ip
			}
			else
			{
				$my_domain = explode('.', $my_domain);

				// remove empty character for example reza.
				$my_domain = array_filter($my_domain);
				$my_domain = array_values($my_domain);

				if(count($my_domain) >= 4)
				{

					$subdomain = $my_domain[0];

					array_shift($my_domain);
					reset($my_domain);

					$root      = $my_domain[0];

					array_shift($my_domain);
					reset($my_domain);

					$tld       = implode('.', $my_domain);
				}
				elseif(count($my_domain) === 3)
				{
					$subdomain = $my_domain[0];
					$root      = $my_domain[1];
					$tld       = $my_domain[2];

					$check_tld = $root. '.'. $tld;

					if(in_array($check_tld, self::special_tld()))
					{
						$tld       = $check_tld;
						$root      = $subdomain;
						$subdomain = null;
					}
				}
				elseif(count($my_domain) === 2)
				{
					$root      = $my_domain[0];
					$tld       = $my_domain[1];
				}
				else
				{
					// invalid domain!
				}
			}
		}

		$parse_url['subdomain'] = $subdomain;
		$parse_url['root']      = $root;
		$parse_url['tld']       = $tld;

		// the protocol was set only for validate url
		if($remove_protocol)
		{
			$parse_url['scheme']   = null;
			$parse_url['protocol'] = null;
		}

		return $parse_url;
	}


	public static function is_legal_ir_domain($_domain, $_get_tld = false)
	{
		$special_tld = self::special_tld(true);
		foreach ($special_tld as $key => $tld)
		{
			if(substr($_domain, -(strlen($tld) + 1)) === '.'. $tld )
			{
				if($_get_tld)
				{
					return $tld;
				}

				return true;
			}
		}

		return false;
	}


	/**
	 * Special tld
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function special_tld($_only_ir = false)
	{
		$list_ir =
		[
			// ir special domain tld
			'id.ir',
			'co.ir',
			'net.ir',
			'gov.ir',
			'co.ir',
			'sch.ir',
			'ac.ir',
			'org.ir',
		];

		$list_international =
		[

			// international special domain : get from onlinenic domain allow list
			'aaa.pro',
			'ac.vn',
			'aca.pro',
			'acct.pro',
			'avocat.pro',
			'bar.pro',
			'co.ag',
			'co.in',
			'co.lc',
			'co.uk',
			'com.ag',
			'com.co',
			'com.lc',
			'com.tw',
			'com.vc',
			'cpa.pro',
			'edu.vn',
			'eng.pro',
			'firm.in',
			'gen.in',
			'gov.vn',
			'health.vn',
			'ind.in',
			'info.vn',
			'int.vn',
			'jur.pro',
			'l.lc',
			'law.pro',
			'ltd.uk',
			'me.uk',
			'med.pro',
			'name.vn',
			'net.ag',
			'net.co',
			'net.in',
			'net.lc',
			'net.tw',
			'net.uk',
			'net.vc',
			'net.vn',
			'nom.ag',
			'nom.co',
			'org.ag',
			'org.in',
			'org.lc',
			'org.tw',
			'org.uk',
			'org.vc',
			'org.vn',
			'p.lc',
			'plc.uk',
			'pro.vn',
			'recht.pro',

		];

		if($_only_ir)
		{
			return $list_ir;
		}

		return array_merge($list_ir, $list_international);
	}

}
?>