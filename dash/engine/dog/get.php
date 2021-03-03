<?php
namespace dash\engine\dog;

/**
 * This class describes a get.
 */
class get
{
	public static function inspection()
	{
		$get = \dash\request::get();

		if(!$get)
		{
			return;
		}

		self::check_order($get);

		self::check_sort($get);

		self::check_q($get);
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
			\dash\engine\dog\toys\only::text($q);

			\dash\engine\dog\toys\general::len($q, 1, 70);

			// disallow html tags
			\dash\engine\dog\toys\block::tags($q);

			// disallow some char inside ip
			\dash\engine\dog\toys\block::word($q, '<');
			\dash\engine\dog\toys\block::word($q, '>');
			\dash\engine\dog\toys\block::word($q, '"');
			\dash\engine\dog\toys\block::word($q, "'");
			\dash\engine\dog\toys\block::word($q, "\n");
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
			\dash\engine\dog\toys\only::text($sort);
			\dash\engine\dog\toys\block::tags($sort);
			\dash\engine\dog\toys\general::len($sort, 1, 20);

			if(!preg_match("/^[A-Za-z0-9\_]+$/", $sort))
			{
				\dash\header::status(428, 'sort !');
			}
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

			\dash\engine\dog\toys\only::text($order);

			if($order === 'desc' || $order === 'asc')
			{
				// ok
			}
			else
			{
				\dash\header::status(428, 'order !');
			}
		}
	}
}
?>
