<?php
namespace dash\waf\dog;

/**
 * This class describes a get.
 */
class get
{
	public static function inspection()
	{
		$get = $_GET;

		if(!$get)
		{
			return;
		}

		self::check_order($get);

		self::check_sort($get);

		self::check_q($get);

		unset($get['q']);
		unset($get['sort']);
		unset($get['order']);

		if(empty($get))
		{
			return;
		}
		\dash\waf\dog\toys\only::array($get);

		\dash\waf\dog\toys\general::array_count($get, 0, 30);

		\dash\waf\dog\toys\block::key_exists('html', $get);

		foreach ($get as $key => $value)
		{
			\dash\waf\dog\toys\only::something($key);

			\dash\waf\dog\toys\only::string($key);

			\dash\waf\dog\toys\block::tags($key);

			\dash\waf\dog\toys\general::len($key, 1, 50);

			\dash\waf\dog\toys\only::a_z0_9_($key);

			// not allow tag in value of tag
			\dash\waf\dog\toys\block::tags($value);
		}
	}


	/**
	 * Check q of search
	 *
	 * @param      <type>  $get    The get
	 */
	private static function check_q($get)
	{
		if(isset($get['q']) && $get['q'])
		{
			$q = $get['q'];

			// only can be text
			\dash\waf\dog\toys\only::text($q);

			\dash\waf\dog\toys\general::len($q, 1, 70);

			// disallow html tags
			\dash\waf\dog\toys\block::tags($q);

			// disallow some char inside ip
			\dash\waf\dog\toys\block::word($q, '<');
			\dash\waf\dog\toys\block::word($q, '>');
			\dash\waf\dog\toys\block::word($q, '"');
			\dash\waf\dog\toys\block::word($q, "'");
			\dash\waf\dog\toys\block::word($q, "\n");
		}
	}


	/**
	 * Check sort args in url
	 *
	 * @param      <type>  $get    The get
	 */
	private static function check_sort($get)
	{
		// check sort field
		if(isset($get['sort']) && $get['sort'])
		{
			$sort = $get['sort'];
			\dash\waf\dog\toys\only::text($sort);
			\dash\waf\dog\toys\block::tags($sort);
			\dash\waf\dog\toys\general::len($sort, 1, 20);
			\dash\waf\dog\toys\only::a_z0_9_($sort);
		}
	}


	/**
	 * Check order
	 *
	 * @param      <type>  $get    The get
	 */
	private static function check_order($get)
	{
		// check order query
		if(isset($get['order']) && $get['order'])
		{
			$order = $get['order'];

			\dash\waf\dog\toys\only::text($order);
			\dash\waf\dog\toys\only::order($order);
		}
	}
}
?>
