<?php
namespace content_a\products\property;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		$property = self::get_property();

		if(!$property)
		{
			\dash\notif::error(T_("Please set stock and price of product"));
			return false;
		}

		\lib\app\product\property::set($property, $id);


		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}



	private static function get_property()
	{
		$post = \dash\request::post();

		$avalible = [];
		$cat      = [];
		$key      = [];
		$value    = [];


		foreach ($post as $post_key => $post_value)
		{
			if(substr($post_key, 0, 4) === 'cat_' && is_numeric(substr($post_key, 4)))
			{
				$cat[substr($post_key, 4)] = $post_value;
			}
			elseif(substr($post_key, 0, 4) === 'key_' && is_numeric(substr($post_key, 4)))
			{
				$key[substr($post_key, 4)] = $post_value;
			}
			elseif(substr($post_key, 0, 6) === 'value_' && is_numeric(substr($post_key, 6)))
			{
				$value[substr($post_key, 6)] = $post_value;
			}
		}


		$final_list = [];

		foreach ($cat as $rand_key => $nothing)
		{
			$final_list[] =
			[
				'cat'   => array_key_exists($rand_key, $cat) ? $cat[$rand_key] : null,
				'key'   => array_key_exists($rand_key, $key) ? $key[$rand_key] : null,
				'value' => array_key_exists($rand_key, $value) ? $value[$rand_key] : null,
			];

		}

		return $final_list;

	}



}
?>