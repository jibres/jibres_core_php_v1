<?php
namespace dash\engine\dog;

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

		\dash\engine\dog\toys\only::array($post);

		\dash\engine\dog\toys\general::array_count($post, 0, 1000);

		foreach ($post as $key => $value)
		{
			\dash\engine\dog\toys\only::something($key);

			\dash\engine\dog\toys\only::string($key);

			\dash\engine\dog\toys\block::tags($key);

			\dash\engine\dog\toys\general::len($key, 1, 50);

			\dash\engine\dog\toys\only::a_z0_9_dash($key);

			if($key === 'html')
			{
				\dash\engine\dog\toys\only::string($key);

				\dash\engine\dog\toys\general::len($value, 0, 50000);
				// ok can send html
			}
			else
			{
				if(is_array($value))
				{
					foreach ($value as $key2 => $value2)
					{
						\dash\engine\dog\toys\only::string($key2);

						if(!is_numeric($key2))
						{
							\dash\engine\dog\toys\block::tags($key2);
						}

						\dash\engine\dog\toys\general::len($key2, 1, 50);

						\dash\engine\dog\toys\general::len($value2, 0, 500);
						// not allow tag in value of post
						\dash\engine\dog\toys\block::tags($value2);
					}
				}
				else
				{
					\dash\engine\dog\toys\general::len($value, 0, 500);
					// not allow tag in value of post
					\dash\engine\dog\toys\block::tags($value);
				}
			}
		}
	}
}
?>
