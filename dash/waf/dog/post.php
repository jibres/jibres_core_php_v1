<?php
namespace dash\waf\dog;

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

		\dash\waf\dog\toys\only::array($post);

		\dash\waf\dog\toys\general::array_count($post, 0, 1000);

		foreach ($post as $key => $value)
		{
			\dash\waf\dog\toys\only::something($key);

			\dash\waf\dog\toys\only::string($key);

			\dash\waf\dog\toys\block::tags($key);

			\dash\waf\dog\toys\general::len($key, 1, 50);

			\dash\waf\dog\toys\only::a_z0_9_dash($key);

			if($key === 'html')
			{
				\dash\waf\dog\toys\only::string($key);

				\dash\waf\dog\toys\general::len($value, 0, 50000);
				// ok can send html
			}
			else
			{
				if(is_array($value))
				{
					foreach ($value as $key2 => $value2)
					{
						\dash\waf\dog\toys\only::string($key2);

						if(!is_numeric($key2))
						{
							\dash\waf\dog\toys\block::tags($key2);
						}

						\dash\waf\dog\toys\general::len($key2, 1, 50);

						\dash\waf\dog\toys\general::len($value2, 0, 500);
						// not allow tag in value of post
						\dash\waf\dog\toys\block::tags($value2);
					}
				}
				else
				{
					\dash\waf\dog\toys\general::len($value, 0, 500);
					// not allow tag in value of post
					\dash\waf\dog\toys\block::tags($value);
				}
			}
		}
	}
}
?>
