<?php
namespace lib\app\product;


class gallery
{
	public static function load_detail($_data)
	{
		$file_path = isset($_data['gallery']) ? $_data['gallery'] : null;
		if(!$file_path)
		{
			return $_data;
		}

		$file_path = array_filter($file_path);
		$file_path = array_unique($file_path);

		if(!$file_path)
		{
			return $_data;
		}

		$load_files = \dash\app\file::fix_path_array($file_path);

		if($load_files)
		{
			return $load_files;
		}

		return $_data;
	}

	private static function get_gallery_field($_product_id)
	{

		$load_product_gallery = \lib\app\product\get::inline_get($_product_id);

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


	public static function setthumb($_product_id, $_file_path)
	{
		$file_path = \dash\app\file::unpath($_file_path);

		if(!$file_path)
		{
			\dash\notif::error(T_("Invalid file path"));
			return false;
		}

		$load_gallery = self::get_gallery_field($_product_id);
		if(!$load_gallery)
		{
			return false;
		}

		$gallery    = $load_gallery['gallery'];
		$product_id = $load_gallery['id'];


		if(isset($gallery['gallery']) && is_array($gallery['gallery']))
		{
			if(!in_array($file_path, $gallery['gallery']))
			{
				\dash\notif::error(T_("Invalid gallery id"));
				return false;
			}
		}

		$result = \lib\db\products\db::update_thumb($file_path, $product_id);
		return $result;
	}


	public static function gallery($_product_id, $_file_detail, $_type = 'add')
	{
		$load_gallery = self::get_gallery_field($_product_id);
		if(!$load_gallery)
		{
			return false;
		}

		$gallery        = $load_gallery['gallery'];
		$product_id     = $load_gallery['id'];
		$product_detail = $load_gallery['detail'];

		if($_type === 'add')
		{
			if(isset($_file_detail['path']))
			{
				$file_path = $_file_detail['path'];
			}
			else
			{
				\dash\notif::error(T_("File detail not found"));
				return false;
			}

			if(isset($gallery['gallery']) && is_array($gallery['gallery']))
			{
				if(in_array($file_path, $gallery['gallery']))
				{
					\dash\notif::error(T_("Duplicate gallery in this gallery"));
					return false;
				}
				array_push($gallery['gallery'], $file_path);
			}
			else
			{
				$gallery['gallery'] = [$file_path];
			}

			if(isset($product_detail['thumb']) && !in_array($product_detail['thumb'], $gallery['gallery']))
			{
				unset($product_detail['thumb']);
			}

			if(array_key_exists('thumb', $product_detail) && !$product_detail['thumb'])
			{
				\lib\db\products\db::update_thumb($file_path, $product_id);
			}
		}
		else
		{
			$file_path = \dash\app\file::unpath($_file_detail);

			if(!$file_path)
			{
				\dash\notif::error(T_("Invalid file path"));
				return false;
			}

			if(isset($gallery['gallery']) && is_array($gallery['gallery']))
			{
				if(!in_array($file_path, $gallery['gallery']))
				{
					\dash\notif::error(T_("Invalid gallery id"));
					return false;
				}

				if(isset($product_detail['thumb']) && !in_array($product_detail['thumb'], $gallery['gallery']))
				{
					unset($product_detail['thumb']);
				}

				unset($gallery['gallery'][array_search($file_path, $gallery['gallery'])]);

				$next_image = null;
				foreach ($gallery['gallery'] as $key => $value)
				{
					$next_image = $value;
					break;
				}

				if((!isset($product_detail['thumb']) || (array_key_exists('thumb', $product_detail) && !$product_detail['thumb'])) && $next_image)
				{
					\lib\db\products\db::update_thumb($next_image, $product_id);
				}

				if(isset($product_detail['thumb']) && $product_detail['thumb'] === $file_path && $next_image)
				{
					\lib\db\products\db::update_thumb($next_image, $product_id);
				}

				if(!$next_image)
				{
					\lib\db\products\db::update_thumb(null, $product_id);
				}

			}

		}

		$gallery = json_encode($gallery, JSON_UNESCAPED_UNICODE);

		\lib\db\products\db::update_gallery($gallery, $product_id);

		return true;

	}

}
?>