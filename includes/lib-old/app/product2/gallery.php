<?php
namespace lib\app\product2;


class gallery
{
	public static function load_detail($_data)
	{
		$file_id = isset($_data['gallery']) ? $_data['gallery'] : null;
		if(!$file_id)
		{
			return $_data;
		}

		$file_id = array_filter($file_id);
		$file_id = array_unique($file_id);

		if(!$file_id)
		{
			return $_data;
		}

		$load_files = \lib\app\file::multi_load($file_id);

		if($load_files)
		{
			return $load_files;
		}

		return $_data;
	}

	private static function get_gallery_field($_product_code)
	{

		$load_product_gallery = \lib\app\product2\get::by_code_inline($_product_code);

		if(!$load_product_gallery || !is_array($load_product_gallery) || !isset($load_product_gallery['id']))
		{
			\dash\notif::error(T_("Product detail not found"));
			return false;
		}

		if(!array_key_exists('gallery', $load_product_gallery))
		{
			\dash\notif::error(T_("Product gallery not found"));
			return false;
		}

		$gallery = $load_product_gallery['gallery'];

		if(is_string($gallery) && (substr($gallery, 0, 1) === '{' || substr($gallery, 0, 1) === '['))
		{
			$gallery = json_decode($gallery, true);
		}
		elseif(is_array($gallery))
		{
			// no thing
		}
		else
		{
			$gallery = [];
		}

		$result =
		[
			'gallery' => $gallery,
			'detail'  => $load_product_gallery,
			'id'      => $load_product_gallery['id'],
		];

		return $result;
	}


	public static function setthumb($_product_code, $_file_id)
	{

		$load_gallery = self::get_gallery_field($_product_code);
		if(!$load_gallery)
		{
			return false;
		}

		$gallery    = $load_gallery['gallery'];
		$product_id = $load_gallery['id'];

		$file_id = \dash\coding::decode($_file_id);

		if(!$file_id)
		{
			\dash\notif::error(T_("Invalid file id"));
			return false;
		}

		if(isset($gallery['gallery']) && is_array($gallery['gallery']))
		{
			if(!in_array($file_id, $gallery['gallery']))
			{
				\dash\notif::error(T_("Invalid gallery id"));
				return false;
			}
		}

		$result = \lib\db\products2\db::update_thumb($file_id, $product_id);
		return $result;
	}


	public static function gallery($_product_code, $_file_detail, $_type = 'add')
	{
		$load_gallery = self::get_gallery_field($_product_code);
		if(!$load_gallery)
		{
			return false;
		}

		$gallery        = $load_gallery['gallery'];
		$product_id     = $load_gallery['id'];
		$product_detail = $load_gallery['detail'];

		if($_type === 'add')
		{
			if(isset($_file_detail['id']))
			{
				$file_id = $_file_detail['id'];
			}
			else
			{
				\dash\notif::error(T_("File detail not found"));
				return false;
			}
			if(isset($gallery['gallery']) && is_array($gallery['gallery']))
			{
				if(in_array($file_id, $gallery['gallery']))
				{
					\dash\notif::error(T_("Duplicate gallery in this gallery"));
					return false;
				}
				array_push($gallery['gallery'], $file_id);
			}
			else
			{
				$gallery['gallery'] = [$file_id];
			}

			if(isset($product_detail['thumbid']) && !in_array($product_detail['thumbid'], $gallery['gallery']))
			{
				unset($product_detail['thumbid']);
			}

			if(array_key_exists('thumbid', $product_detail) && !$product_detail['thumbid'])
			{
				\lib\db\products2\db::update_thumb($file_id, $product_id);
			}
		}
		else
		{
			$file_id = \dash\coding::decode($_file_detail);

			if(!$file_id)
			{
				\dash\notif::error(T_("Invalid file id"));
				return false;
			}

			if(isset($gallery['gallery']) && is_array($gallery['gallery']))
			{
				if(!in_array($file_id, $gallery['gallery']))
				{
					\dash\notif::error(T_("Invalid gallery id"));
					return false;
				}

				if(isset($product_detail['thumbid']) && !in_array($product_detail['thumbid'], $gallery['gallery']))
				{
					unset($product_detail['thumbid']);
				}

				unset($gallery['gallery'][array_search($file_id, $gallery['gallery'])]);

				$next_image = null;
				foreach ($gallery['gallery'] as $key => $value)
				{
					$next_image = $value;
					break;
				}

				if((!isset($product_detail['thumbid']) || (array_key_exists('thumbid', $product_detail) && !$product_detail['thumbid'])) && $next_image)
				{
					\lib\db\products2\db::update_thumb($next_image, $product_id);
				}

				if(isset($product_detail['thumbid']) && intval($product_detail['thumbid']) === intval($file_id) && $next_image)
				{
					\lib\db\products2\db::update_thumb($next_image, $product_id);
				}

				if(!$next_image)
				{
					\lib\db\products2\db::update_thumb(null, $product_id);
				}

			}

		}

		$gallery = json_encode($gallery, JSON_UNESCAPED_UNICODE);

		\lib\db\products2\db::update_gallery($gallery, $product_id);

		return true;

	}

}
?>