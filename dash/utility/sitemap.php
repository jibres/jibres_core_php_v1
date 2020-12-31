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

	// every file have 100 record
	private static $count = 100;


	/**
	 * Creates all sitemap
	 */
	public static function create_all()
	{
		// self::create_all_products();
		// self::create_all_posts();
		// self::create_all_tags();
		self::create_all_hashtag();

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
			'file_name' => $from . '-'. $to,
		];

		return $result;

	}


	/**
	 * Get sitemap business addr
	 *
	 * @param      string  $_type  The type
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function business_addr($_type = null)
	{
		$addr = \dash\upload\directory::move_to('business');

		$addr .= \dash\store_coding::encode_raw(). '/';
		$addr .= 'sitemap/';

		if($_type)
		{
			$addr .= $_type. '/';
		}

		if(!\dash\file::exists($addr))
		{
			\dash\file::makeDir($addr, null, true);
		}


		return $addr;
	}



	public static function create_all_products()
	{
		$result = null;
		$start  = 1;

		do
		{
			$result = self::products($start);
			$start  = $start + self::$count;
		}
		while ($result);
	}


	public static function products($_id)
	{

		$calculate = self::calculate($_id);

		if(!$calculate)
		{
			return false;
		}

		$result = \lib\app\product\get::sitemap_list($calculate['from'], $calculate['to']);

		if(!$result)
		{
			return false;
		}

		$addr = self::business_addr('products');
		$addr .= 'products-'. $calculate['file_name'];

		$sitemap = new \dash\utility\sitemap_xml($addr);

		foreach ($result as $key => $value)
		{
			$sitemap->addItem($value['url'], $value['datemodified'], '0.9');
		}

		$sitemap->endSitemap();

		return true;
	}




	public static function create_all_posts()
	{
		$result = null;
		$start  = 1;

		do
		{
			$result = self::posts($start);
			$start  = $start + self::$count;
		}
		while ($result);
	}


	public static function posts($_id)
	{

		$calculate = self::calculate($_id);

		if(!$calculate)
		{
			return false;
		}

		$result = \dash\app\posts\get::sitemap_list($calculate['from'], $calculate['to']);

		if(!$result)
		{
			return false;
		}

		$addr = self::business_addr('posts');
		$addr .= 'posts-'. $calculate['file_name'];

		$sitemap = new \dash\utility\sitemap_xml($addr);

		foreach ($result as $key => $value)
		{
			$sitemap->addItem($value['link'], $value['datemodified'], '0.9');
		}

		$sitemap->endSitemap();

		return true;
	}




	public static function create_all_tags()
	{
		$result = null;
		$start  = 1;

		do
		{
			$result = self::tags($start);
			$start  = $start + self::$count;
		}
		while ($result);
	}


	public static function tags($_id)
	{

		$calculate = self::calculate($_id);

		if(!$calculate)
		{
			return false;
		}

		$result = \dash\app\terms\get::sitemap_list($calculate['from'], $calculate['to']);

		if(!$result)
		{
			return false;
		}

		$addr = self::business_addr('tags');
		$addr .= 'tags-'. $calculate['file_name'];

		$sitemap = new \dash\utility\sitemap_xml($addr);

		foreach ($result as $key => $value)
		{
			$sitemap->addItem($value['link'], $value['datemodified'], '0.9');
		}

		$sitemap->endSitemap();

		return true;
	}



	public static function create_all_hashtag()
	{
		$result = null;
		$start  = 1;

		do
		{
			$result = self::hashtag($start);
			$start  = $start + self::$count;
		}
		while ($result);
	}


	public static function hashtag($_id)
	{

		$calculate = self::calculate($_id);

		if(!$calculate)
		{
			return false;
		}

		$result = \lib\app\tag\get::sitemap_list($calculate['from'], $calculate['to']);

		if(!$result)
		{
			return false;
		}

		$addr = self::business_addr('hashtag');
		$addr .= 'hashtag-'. $calculate['file_name'];

		$sitemap = new \dash\utility\sitemap_xml($addr);

		foreach ($result as $key => $value)
		{
			$sitemap->addItem($value['link'], $value['datemodified'], '0.9');
		}

		$sitemap->endSitemap();

		return true;
	}

}
?>