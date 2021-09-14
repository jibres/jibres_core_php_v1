<?php
namespace dash\utility;

/**
 * This class describes a sitemap.
 * product
 * posts
 * tag
 * hashtag
 * f [forms]
 */
class sitemap
{

	/**
	 * Count lin per file
	 *
	 * @var        integer
	 */
	private static $count = 100;


	/**
	 * Load list once
	 *
	 * @var        array
	 */
	private static $load_list = [];


	/**
	 * Master group
	 *
	 * @var        array
	 */
	private static $master_group =
	[
		'products',
		'posts',
		'tags',
		'hashtag',
		'forms'
	];


	/**
	 * Generate and echo sitemap file
	 */
	public static function sitemap()
	{
		if(\dash\engine\store::inStore())
		{
			$sitemap = self::business_sitemap();
		}
		else
		{
			$sitemap = self::jibres_sitemap();
		}

		\dash\code::jsonBoom($sitemap, null, 'xml');
	}


	/**
	 * Generate maste sitemap for jibres
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function jibres_sitemap()
	{
		$myLang = \dash\language::current() === 'fa' ? 'fa' : 'en';

		$loc = \dash\url::dl(). '/';
		$loc .= 'sitemap/';
		$loc .= $myLang. '/';

		$sitemap = '';
		$sitemap .= '<?xml version="1.0" encoding="UTF-8"?>';
		$sitemap .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

		$sitemap .= '<sitemap>';
		$sitemap .= '<loc>'.$loc.'pages/pages.xml</loc>';
		$sitemap .= '</sitemap>';

		$sitemap .= '<sitemap>';
		$sitemap .= '<loc>'.$loc.'posts/posts.xml</loc>';
		$sitemap .= '</sitemap>';

		$sitemap .= '<sitemap>';
		$sitemap .= '<loc>'.$loc.'tags/tags.xml</loc>';
		$sitemap .= '</sitemap>';

		$sitemap .= '</sitemapindex>';

		return $sitemap;
	}


	/**
	 * Get the master sitemap url
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function url()
	{
		if(\dash\engine\store::inStore())
		{
			$url = \lib\store::url();
		}
		else
		{
			$url = \dash\url::base();
		}

		$url .= '/sitemap.xml';
		return $url;
	}


	/**
	 * Generate master sitemap for every store
	 *
	 * @return     string  The sitempa xml string
	 */
	private static function business_sitemap()
	{
		$addr = \dash\url::cloud(). '/';
		$addr .= \dash\store_coding::encode_raw(). '/';
		$addr .= 'sitemap/';


		$sitemap = '';
		$sitemap .= '<?xml version="1.0" encoding="UTF-8"?>';
		$sitemap .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

		foreach (self::$master_group as $group)
		{
			$loc = $addr . $group. '/'. $group. '.xml';
			$sitemap .= '<sitemap>';
			$sitemap .= '<loc>'. $loc. '</loc>';
			$sitemap .= '</sitemap>';
		}

		$sitemap .= '</sitemapindex>';

		return $sitemap;
	}

	private static $scp_upload = null;

	public static function file($_addr, $_action, $_data_file = null)
	{
		if(self::$scp_upload === null)
		{
			$is_scp = \dash\upload\file::upload_other_server_scp();

			if($is_scp)
			{
				if(\dash\scp::uploader_connection())
				{
					self::$scp_upload = true;
				}
				else
				{
					self::$scp_upload = false;
				}
			}
			else
			{
				self::$scp_upload = false;
			}
		}

		// test
		$is_scp = self::$scp_upload;
		// $is_scp = false;

		if($is_scp)
		{
			$_addr = str_replace(YARD, '', $_addr);
		}

		switch ($_action)
		{
			case 'is_file':
				if($is_scp)
				{
					return \dash\scp::check_dir($_addr);
				}
				else
				{
					return is_file($_addr);
				}
				break;

			case 'delete':
				if($is_scp)
				{
					return \dash\scp::delete($_addr);
				}
				else
				{
					return \dash\file::delete($_addr);
				}
				break;

			case 'write':
				if($is_scp)
				{
					// $local_tmp_file = tempnam("/tmp", "sitemap_scp_file_". md5($_addr));

					// file_put_contents($local_tmp_file, 'null');

					// $result = \dash\scp::send($local_tmp_file, $_addr);

					// \dash\file::delete($local_tmp_file);

					// return $result;
				}
				else
				{
					return \dash\file::write($_addr, null);
				}
				break;

			case 'copy_data':
				if($is_scp)
				{
					return \dash\scp::send($_data_file, $_addr);
				}
				else
				{
					return \dash\file::write($_addr, \dash\file::read($_data_file));
				}
				break;

			case 'read':
				if($is_scp)
				{
					$local_tmp_file = tempnam("/tmp", "sitemap_scp_file_". md5($_addr));

					\dash\scp::recv($_addr, $local_tmp_file);

					$result = \dash\file::read($local_tmp_file);

					\dash\file::delete($local_tmp_file);

					return $result;

				}
				else
				{
					return \dash\file::read($_addr);
				}
				break;

			case 'exists':
				if($is_scp)
				{
					return \dash\scp::check_dir($_addr);
				}
				else
				{
					return \dash\file::exists($_addr);
				}
				break;

			case 'makeDir':
				if($is_scp)
				{
					return \dash\scp::makeDir($_addr, null, true);
				}
				else
				{
					return \dash\file::makeDir($_addr, null, true);
				}
				break;


			default:
				return null;
				break;
		}
	}



	/**
	 * Creates all sitemap group
	 */
	public static function create_all()
	{
		if(\dash\engine\store::inStore())
		{
			foreach (self::$master_group as $group)
			{
				self::create_all_item($group);
			}
		}
		else
		{
			self::create_jibres_static_page();
			// self::create_all_item('posts');
			// self::create_all_item('tags');

		}
	}


	/**
	 * Deletes all sitemap file.
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function delete()
	{
		$path = self::sitemap_real_path();
		self::file($path, 'delete');
		return true;
	}


	/**
	 * Calcuate file name by record id
	 *
	 * @param      integer  $_id    The identifier
	 *
	 * @return     array    ( description_of_the_return_value )
	 */
	private static function calculate($_id)
	{

		if(!$_id || !is_numeric($_id))
		{
			return false;
		}

		// @reza @fix
		// 1 -> 1, 100
		// 100 -> 1, 100,
		// 101 -> 101, 200,
		// 200 -> 101, 200

		$from = (floor($_id / self::$count)*self::$count);
		$to   = $from + self::$count;

		$result =
		[
			'from'      => $from,
			'to'        => $to,
			'file_name' => $from . '-'. $to. '.xml',
		];

		return $result;

	}


	private static function get_path($_addr)
	{
		if(\dash\engine\store::inStore())
		{
			$path = str_replace(YARD. 'talambar_cloud/', '', $_addr);
		}
		else
		{
			$path = str_replace(YARD. 'talambar_dl/', '', $_addr);
		}

		$path = \lib\filepath::fix($path);
		return $path;
	}


	/**
	 * Manage master list
	 *
	 * @param      <type>  $_type  The type
	 * @param      <type>  $_id    The identifier
	 */
	private static function master_list($_type, $_addr, $_set_result = [])
	{
		$master_xml = str_replace(basename($_addr), '', $_addr);
		$master_xml .= $_type. '.xml';

		if(!self::file($master_xml, 'is_file'))
		{
			self::file($master_xml, 'write');
		}

		$result = [];

		try
		{
			$object = @new \SimpleXMLElement(self::file($master_xml, 'read'));

			foreach ($object as $key => $value)
			{
				$myValue = (array) $value->loc;

				if(isset($myValue[0]))
				{
					$result[] = $myValue[0];
				}
			}
		}
		catch (\Exception $e)
		{
			$result = [];
		}

		if($_set_result)
		{

			$local_tmp_file = tempnam("/tmp", "sitemap_xml_". md5($master_xml));

			$sitemap = new \dash\utility\sitemap_xml($local_tmp_file);

			$sitemap->siteampIndex();

			foreach ($_set_result as $key => $value)
			{
				$sitemap->addIndexItem($value);
			}

			$sitemap->endSitemap();

			self::file($master_xml, 'copy_data', $local_tmp_file);

			\dash\file::delete($local_tmp_file);

		}

		return $result;
	}


	private static function remove_from_list($_type, $_addr)
	{
		$load = self::master_list($_type, $_addr);

		$path = self::get_path($_addr);

		if(in_array($path, $load))
		{
			unset($load[array_search($path, $load)]);
			self::master_list($_type, $_addr, $load);
		}

	}


	private static function add_to_list($_type, $_addr)
	{
		$load = self::master_list($_type, $_addr);

		$path = self::get_path($_addr);

		if(!in_array($path, $load))
		{
			$load[] = $path;
			self::master_list($_type, $_addr, $load);
		}

	}



	private static function make($_type, $_id, $_field, $_fn)
	{

		$calculate = self::calculate($_id);

		if(!$calculate)
		{
			return false;
		}

		$addr = self::sitemap_real_path($_type);
		$addr .= $_type. '-'. $calculate['file_name'];

		// delete to create again
		self::file($addr, 'delete');

		$result = $_fn::sitemap_list($calculate['from'], $calculate['to']);

		if(!$result)
		{
			self::remove_from_list($_type, $addr);
			return false;
		}

		// create tmp file
		$local_tmp_file = @tempnam("/tmp", "sitemap_xml_". md5($addr));

		$sitemap = new \dash\utility\sitemap_xml($local_tmp_file);

		$sitemap->startSitemap();

		foreach ($result as $key => $value)
		{
			if(isset($value[$_field]))
			{
				$sitemap->addItem($value[$_field], $value['datemodified'], '0.9');
			}
		}

		$sitemap->endSitemap();

		self::file($addr, 'copy_data', $local_tmp_file);

		\dash\file::delete($local_tmp_file);

		self::add_to_list($_type, $addr);

		return true;
	}

	/**
	 * Get sitemap business addr
	 *
	 * @param      string  $_type  The type
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function sitemap_real_path($_type = null)
	{
		if(\dash\engine\store::inStore())
		{
			// $addr = \dash\upload\directory::move_to('business', false, true);
			$addr = \dash\upload\directory::move_to('business');
			$addr .= \dash\store_coding::encode_raw(). '/';
			$addr .= 'sitemap/';
		}
		else
		{
			$addr = \dash\upload\directory::move_to('jibres');
			$addr .= 'sitemap/';
			$myLang = \dash\language::current() === 'fa' ? 'fa' : 'en';
			$addr .= $myLang. '/';
		}

		if($_type)
		{
			$addr .= $_type. '/';
		}

		if(!self::file($addr, 'exists'))
		{
			self::file($addr, 'makeDir');
		}

		if($_type)
		{
			$master_xml = $addr . $_type. '.xml';

			if(!self::file($master_xml, 'is_file'))
			{
				self::file($master_xml, 'write');
			}
		}


		return $addr;
	}



	public static function create_all_item($_type)
	{
		$result = null;
		$start  = 1;

		do
		{
			$result = self::$_type($start);
			$start  = $start + self::$count;
		}
		while ($result);
	}



	private static function create_jibres_static_page()
	{
		$list =
		[
			'about',
			'api',
			// 'app',
			// 'billborad',
			// 'careers',
			// 'benefits',
			// 'blog',
			'brand',
			'bug',
			'catalog',
			'certificates',
			'changelog',
			'contact',
			'domains',
			'domains/pricing',
			'domains/search',
			// 'enterprise',
			// 'free',
			// 'help',
			// 'help/faq',
			'ip',
			'logo',
			'mission',
			// 'press',
			// 'pricing',
			'privacy',
			'shipping',
			'shipping/irpost',
			'socialresponsibility',
			// 'status',
			'story',
			// 'subscribe',

			'team',
			'terms',
			'values',
			'vision',
			'whois',
		];

		$addr = self::sitemap_real_path('pages');
		$addr .= 'pages.xml';

		$sitemap = new \dash\utility\sitemap_xml($addr);

		$sitemap->startSitemap();

		foreach ($list as $key => $value)
		{
			$url = \dash\url::site().'/'. $value;

			$sitemap->addItem($url, null, '0.9');
		}

		$sitemap->endSitemap();

		return true;
	}


	public static function products($_id)
	{
		return self::make('products', $_id, 'url', '\\lib\\app\\product\\get');
	}

	public static function posts($_id)
	{
		return self::make('posts', $_id, 'link', '\\dash\\app\\posts\\get');
	}

	public static function hashtag($_id)
	{
		return self::make('hashtag', $_id, 'link', '\\dash\\app\\terms\\get');
	}

	public static function tags($_id)
	{
		return self::make('tags', $_id, 'url', '\\lib\\app\\tag\\get');
	}

	public static function forms($_id)
	{
		return self::make('forms', $_id, 'url', '\\lib\\app\\form\\form\\get');
	}

}
?>