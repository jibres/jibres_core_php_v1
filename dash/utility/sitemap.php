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
		$sitemap = '';
		$sitemap .= '<?xml version="1.0" encoding="UTF-8"?>';
		$sitemap .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

		$sitemap .= '<sitemap>';
		$sitemap .= '<loc>http://jibres.local/sitemap/static_page.xml</loc>';
		$sitemap .= '</sitemap>';

		$sitemap .= '<sitemap>';
		$sitemap .= '<loc>http://jibres.local/sitemap/posts.xml</loc>';
		$sitemap .= '</sitemap>';

		$sitemap .= '<sitemap>';
		$sitemap .= '<loc>http://jibres.local/sitemap/tags.xml</loc>';
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
			self::create_all_item('posts');
			self::create_all_item('tags');
			// self::create_jibres_static_page();

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
		\dash\file::delete($path);
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
		$path = str_replace(YARD. 'talambar_cloud/', '', $_addr);
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

		if(!is_file($master_xml))
		{
			\dash\file::write($master_xml, null);
		}

		$result = [];

		try
		{
			$object = @new \SimpleXMLElement(\dash\file::read($master_xml));

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
			$sitemap = new \dash\utility\sitemap_xml($master_xml);

			$sitemap->siteampIndex();

			foreach ($_set_result as $key => $value)
			{
				$sitemap->addIndexItem($value);
			}

			$sitemap->endSitemap();

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
		\dash\file::delete($addr);

		$result = $_fn::sitemap_list($calculate['from'], $calculate['to']);

		if(!$result)
		{
			self::remove_from_list($_type, $addr);
			return false;
		}

		$sitemap = new \dash\utility\sitemap_xml($addr);

		$sitemap->startSitemap();

		foreach ($result as $key => $value)
		{
			$sitemap->addItem($value[$_field], $value['datemodified'], '0.9');
		}

		$sitemap->endSitemap();

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
			$addr = \dash\upload\directory::move_to('business');
			$addr .= \dash\store_coding::encode_raw(). '/';
			$addr .= 'sitemap/';
		}
		else
		{
			$addr = root. 'public_html/';
		}

		if($_type)
		{
			$addr .= $_type. '/';
		}

		if(!\dash\file::exists($addr))
		{
			\dash\file::makeDir($addr, null, true);
		}

		if($_type)
		{
			$master_xml = $addr . $_type. '.xml';

			if(!is_file($master_xml))
			{
				\dash\file::write($master_xml, null);
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


	public static function products($_id)
	{
		return self::make('products', $_id, 'url', '\\lib\\app\\product\\get');
	}

	public static function posts($_id)
	{
		return self::make('posts', $_id, 'link', '\\dash\\app\\posts\\get');
	}

	public static function tags($_id)
	{
		return self::make('tags', $_id, 'link', '\\dash\\app\\terms\\get');
	}

	public static function hashtag($_id)
	{
		return self::make('hashtag', $_id, 'link', '\\lib\\app\\tag\\get');
	}

	public static function forms($_id)
	{
		return self::make('forms', $_id, 'url', '\\lib\\app\\form\\form\\get');
	}

}
?>