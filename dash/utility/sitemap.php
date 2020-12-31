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
		self::create_all_item('products');
		self::create_all_item('posts');
		self::create_all_item('tags');
		self::create_all_item('hashtag');
		self::create_all_item('forms');

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


	private static function make($_type, $_id, $_field, $_fn)
	{
		$addr = self::business_addr($_type);

		$calculate = self::calculate($_id);

		if(!$calculate)
		{
			return false;
		}

		$result = $_fn::sitemap_list($calculate['from'], $calculate['to']);

		if(!$result)
		{
			return false;
		}

		$addr .= $_type. '-'. $calculate['file_name'];

		$sitemap = new \dash\utility\sitemap_xml($addr);

		foreach ($result as $key => $value)
		{
			$sitemap->addItem($value[$_field], $value['datemodified'], '0.9');
		}

		$sitemap->endSitemap();

		return true;
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
		return self::make('forms', $_id, 'link', '\\lib\\app\\form\\form\\get');
	}

}
?>