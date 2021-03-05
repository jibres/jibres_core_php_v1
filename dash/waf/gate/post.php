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
			\dash\waf\gate\toys\only::something($key);

			\dash\waf\gate\toys\only::string($key);

			\dash\waf\gate\toys\block::tags($key);

			\dash\waf\gate\toys\general::len($key, 1, 50);

			\dash\waf\gate\toys\only::a_z0_9_dash($key);

			if($key === 'html')
			{
				\dash\waf\gate\toys\only::string($key);

				\dash\waf\gate\toys\general::len($value, 0, 100000);
				// ok can send html
			}
			else
			{
				if(is_array($value))
				{
					foreach ($value as $key2 => $value2)
					{
						\dash\waf\gate\toys\only::string($key2);

						if(!is_numeric($key2))
						{
							\dash\waf\gate\toys\block::tags($key2);
						}

						\dash\waf\gate\toys\general::len($key2, 1, 50);

						\dash\waf\gate\toys\general::len($value2, 0, 5000);
						// not allow tag in value of post
						\dash\waf\gate\toys\block::tags($value2, $key2);
					}
				}
				else
				{
					\dash\waf\gate\toys\general::len($value, 0, 5000);
					// not allow tag in value of post
					\dash\waf\gate\toys\block::tags($value, $key);
				}
			}
		}
	}
}
?>
