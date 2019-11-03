<?php
namespace lib\app\product;


class gallery
{
	public static function load_detail($_data)
	{
		$gallery_raw = isset($_data['gallery']['files']) ? $_data['gallery']['files'] : null;
		if(!$gallery_raw)
		{
			return $_data;
		}

		if(is_array($gallery_raw))
		{

			foreach ($gallery_raw as $key => $value)
			{
				if(isset($value['path']))
				{
					$gallery_raw[$key]['path'] = \dash\app\file::fix_path($value['path']);
				}
			}

			return $gallery_raw;
		}
		else
		{
			return $_data;
		}

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

		$product_gallery_field = $load_product_gallery['gallery'];

		if(is_string($product_gallery_field) && (substr($product_gallery_field, 0, 1) === '{' || substr($product_gallery_field, 0, 1) === '['))
		{
			$product_gallery_field = json_decode($product_gallery_field, true);
		}
		elseif(is_array($product_gallery_field))
		{
			// no thing
		}
		else
		{
			$product_gallery_field = [];
		}

		$result =
		[
			'gallery' => $product_gallery_field,
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

		$product_gallery_field    = $load_gallery['gallery'];
		$product_id = $load_gallery['id'];


		if(isset($product_gallery_field['gallery']) && is_array($product_gallery_field['gallery']))
		{
			if(!in_array($file_path, $product_gallery_field['gallery']))
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

		$product_gallery_field = $load_gallery['gallery'];
		$product_id            = $load_gallery['id'];
		$product_detail        = $load_gallery['detail'];

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

			$fileid = isset($_file_detail['id']) ? $_file_detail['id'] : null;

			if(isset($product_gallery_field['gallery']) && is_array($product_gallery_field['gallery']) && isset($product_gallery_field['gallery']['files']) && is_array($product_gallery_field['gallery']['files']))
			{
				foreach ($product_gallery_field['gallery']['files'] as $key => $one_file)
				{
					if(isset($one_file['path']) && $one_file['path'] === $file_path)
					{
						\dash\notif::error(T_("Duplicate file in this gallery"));
						return false;
					}
				}

				$product_gallery_field['files'][] = ['id' => $fileid, 'path' => $file_path];
			}
			else
			{
				$product_gallery_field['files']   = [];
				$product_gallery_field['files'][] = ['id' => $fileid, 'path' => $file_path];
			}

			// if(isset($product_detail['thumb']) && !in_array($product_detail['thumb'], $product_gallery_field['gallery']))
			// {
			// 	unset($product_detail['thumb']);
			// }

			// if(array_key_exists('thumb', $product_detail) && !$product_detail['thumb'])
			// {
			// 	\lib\db\products\db::update_thumb($file_path, $product_id);
			// }
		}
		else
		{
			$file_path = \dash\app\file::unpath($_file_detail);

			if(!$file_path)
			{
				\dash\notif::error(T_("Invalid file path"));
				return false;
			}

			if(isset($product_gallery_field['gallery']) && is_array($product_gallery_field['gallery']))
			{
				if(!in_array($file_path, $product_gallery_field['gallery']))
				{
					\dash\notif::error(T_("Invalid gallery id"));
					return false;
				}

				if(isset($product_detail['thumb']) && !in_array($product_detail['thumb'], $product_gallery_field['gallery']))
				{
					unset($product_detail['thumb']);
				}

				unset($product_gallery_field['gallery'][array_search($file_path, $product_gallery_field['gallery'])]);

				$next_image = null;
				foreach ($product_gallery_field['gallery'] as $key => $value)
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

		$product_gallery_field = json_encode($product_gallery_field, JSON_UNESCAPED_UNICODE);

		\lib\db\products\db::update_gallery($product_gallery_field, $product_id);

		return true;

	}

}
?>