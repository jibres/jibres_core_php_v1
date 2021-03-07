<?php
namespace dash\waf\gate;

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

		unset($get['sort']);
		unset($get['order']);

		if(empty($get))
		{
			return;
		}

		\dash\waf\gate\toys\only::array($get);

		\dash\waf\gate\toys\general::array_count($get, 0, 30);

		\dash\waf\gate\toys\block::key_exists('html', $get);

		foreach ($get as $key => $value)
		{
			// check key
			\dash\waf\gate\toys\only::something($key);

			\dash\waf\gate\toys\only::string($key);

			\dash\waf\gate\toys\block::tags($key);

			\dash\waf\gate\toys\general::len($key, 1, 50);

			// only a-z0-o can be set on get index
			\dash\waf\gate\toys\only::a_z0_9_dash($key);


			// check value
			\dash\waf\gate\toys\only::string($value);

			\dash\waf\gate\toys\general::len($value, 0, 2000);

			\dash\waf\gate\toys\block::word($value, "'");
			\dash\waf\gate\toys\block::word($value, '"');
			\dash\waf\gate\toys\block::word($value, "`");
			\dash\waf\gate\toys\block::word($value, '<');
			\dash\waf\gate\toys\block::word($value, '>');
			\dash\waf\gate\toys\block::word($value, "\n");

			// not allow tag in value of tag
			\dash\waf\gate\toys\block::tags($value, $key);

			\dash\waf\gate\toys\block::hex($value);

			\dash\waf\gate\toys\block::script($value, true);

		}
	}


	/**
	 * Check sort args in url
	 * key === sort
	 * value a-z0-9_-
	 *
	 * @param      <type>  $get    The get
	 */
	private static function check_sort($get)
	{
		// check sort field
		if(isset($get['sort']) && $get['sort'])
		{
			$sort = $get['sort'];
			\dash\waf\gate\toys\only::text($sort);
			\dash\waf\gate\toys\block::tags($sort);
			\dash\waf\gate\toys\general::len($sort, 1, 20);
			\dash\waf\gate\toys\only::a_z0_9_dash($sort);
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

			\dash\waf\gate\toys\only::text($order);
			\dash\waf\gate\toys\only::order($order);
		}
	}
}
?>
