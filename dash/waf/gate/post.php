<?php
namespace dash\waf\gate;

/**
 * This class describes a post.
 */
class post
{
	public static function inspection()
	{
		$post = $_POST;

		if(!$post)
		{
			return;
		}

		\dash\waf\gate\toys\only::array($post);

		\dash\waf\gate\toys\general::array_count($post, 0, 1000);

		foreach ($post as $key => $value)
		{
			self::check_key($key);

			if($key === 'html')
			{
				self::check_value($value, $key, true);
			}
			else
			{
				if(is_array($value))
				{
					foreach ($value as $key2 => $value2)
					{
						self::check_key($key2);
						self::check_value($value2, $key2);
					}
				}
				else
				{
					self::check_value($value, $key);
				}
			}
		}
	}


	/**
	 * Call self and in phpinput
	 *
	 * @param      <type>   $value       The value
	 * @param      <type>   $key         The key
	 * @param      boolean  $_need_html  The need html
	 */
	public static function check_value($value, $key = null, $_need_html = false)
	{
		\dash\waf\gate\toys\only::string($value);

		\dash\waf\gate\toys\block::hex($value);

		\dash\waf\gate\toys\block::script($value);

		if($_need_html)
		{
			\dash\waf\gate\toys\general::len($value, 0, 50000);
		}
		else
		{
			\dash\waf\gate\toys\general::len($value, 0, 5000);
			// not allow tag in value of post
			\dash\waf\gate\toys\block::tags($value, $key);
		}
	}

	/**
	 * call self and phpinput
	 *
	 * @param      <type>  $key    The key
	 */
	public static function check_key($key)
	{
		\dash\waf\gate\toys\only::string($key);

		\dash\waf\gate\toys\general::len($key, 1, 50);

		\dash\waf\gate\toys\only::a_z0_9_dash($key);

		// tag never go here a-z
		// ' " \n //' never go here a-z
	}
}
?>
