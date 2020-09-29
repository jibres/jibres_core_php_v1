<?php
namespace lib\app\product;


class gallery
{
	public static function load_detail($_data)
	{
		$gallery_raw = isset($_data['files']) ? $_data['files'] : null;

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
					$gallery_raw[$key]['path'] = \lib\filepath::fix($value['path']);
					$ext = substr(strrchr($value['path'], '.'), 1);
					$gallery_raw[$key]['ext'] = $ext;


					$mime_detail = \dash\upload\extentions::get_mime_ext($ext);
					if(isset($mime_detail['type']))
					{
						$gallery_raw[$key]['type'] = $mime_detail['type'];
					}

					if(isset($mime_detail['mime']))
					{
						$gallery_raw[$key]['mime'] = $mime_detail['mime'];
					}
				}

				if(isset($value['id']))
				{
					$gallery_raw[$key]['id'] = \dash\coding::encode($value['id']);
				}
			}

			return $gallery_raw;
		}
		else
		{
			return $_data;
		}

	}


	public static function upload_from_url($_id, $_url)
	{
		$uploaded_file = \dash\upload\product::set_product_gallery_from_url(\dash\request::get('id'), $_url);

		if($uploaded_file)
		{
			\lib\app\product\gallery::gallery($_id, $uploaded_file, 'add');
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


	public static function setthumb($_product_id, $_file_id)
	{
		$file_id = \dash\validate::code($_file_id);
		$file_id = \dash\coding::decode($file_id);

		if(!$file_id)
		{
			\dash\notif::error(T_("Invalid file id"));
			return false;
		}

		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		$load_gallery = self::get_gallery_field($_product_id);
		if(!$load_gallery)
		{
			return false;
		}

		$product_gallery_field    = $load_gallery['gallery'];
		$product_id = $load_gallery['id'];

		if(isset($product_gallery_field['files']) && is_array($product_gallery_field['files']))
		{
			$thumb_path = null;

			foreach ($product_gallery_field['files'] as $key => $one_file)
			{
				if(isset($one_file['id']) && floatval($one_file['id']) === floatval($file_id) && isset($one_file['path']))
				{
					$product_gallery_field['thumbid'] = $one_file['id'];
					$thumb_path                       = $one_file['path'];

					$ext = substr(strrchr($thumb_path, '.'), 1);

					$mime_detail = \dash\upload\extentions::get_mime_ext($ext);
					if(isset($mime_detail['type']) && $mime_detail['type'] === 'image')
					{
						// ok
					}
					else
					{
						\dash\notif::error(T_("Only image file can be set on product thumb"));
						return false;
					}

				}
			}

			$new_gallery_field = [];
			foreach ($product_gallery_field['files'] as $key => $value)
			{
				if(isset($value['id']) && $value['id'] == $product_gallery_field['thumbid'])
				{
					$new_gallery_field[] = $value;
				}
			}

			foreach ($product_gallery_field['files'] as $key => $value)
			{
				if(isset($value['id']) && $value['id'] != $product_gallery_field['thumbid'])
				{
					$new_gallery_field[] = $value;
				}
			}

			$product_gallery_field['files'] = $new_gallery_field;
			$product_gallery_field          = json_encode($product_gallery_field, JSON_UNESCAPED_UNICODE);

			\lib\db\products\update::gallery($product_gallery_field, $product_id);
			\lib\db\products\update::thumb($thumb_path, $product_id);

			return true;
		}

		\dash\notif::error(T_("Invalid gallery id"));
		return false;
	}


	public static function gallery($_product_id, $_file_detail, $_type = 'add')
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

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

			if(isset($product_gallery_field) && is_array($product_gallery_field) && isset($product_gallery_field['files']) && is_array($product_gallery_field['files']))
			{
				foreach ($product_gallery_field['files'] as $key => $one_file)
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

			if(!isset($product_detail['thumb']) || (array_key_exists('thumb', $product_detail) && !$product_detail['thumb']))
			{
				$ext = substr(strrchr($file_path, '.'), 1);
				$mime_detail = \dash\upload\extentions::get_mime_ext($ext);
				if(isset($mime_detail['type']) && $mime_detail['type'] === 'image')
				{
					\lib\db\products\update::thumb($file_path, $product_id);
					$product_gallery_field['thumbid'] = $fileid;
					// ok
				}
			}

			// check max gallery image
			if(isset($product_gallery_field['files']) && is_array($product_gallery_field['files']))
			{
				if(count($product_gallery_field['files']) > 10)
				{
					\dash\notif::error(T_("Maximum count of gallery file is 10"));
					return false;
				}
			}
		}
		else
		{
			$fileid = $_file_detail; // the file id
			$fileid = \dash\validate::code($fileid);
			$fileid = \dash\coding::decode($fileid);

			if(!$fileid)
			{
				\dash\notif::error(T_("Invalid file id"));
				return false;
			}

			if(isset($product_gallery_field['files']) && is_array($product_gallery_field['files']))
			{
				$find_in_gallery = false;
				$remove_file_id = null;
				foreach ($product_gallery_field['files'] as $key => $one_file)
				{
					if(isset($one_file['id']) && floatval($one_file['id']) === floatval($fileid))
					{
						$remove_file_id = $one_file['id'];
						$find_in_gallery = true;
						unset($product_gallery_field['files'][$key]);
					}
				}

				if(!$find_in_gallery)
				{
					\dash\notif::error(T_("Invalid gallery id"));
					return false;
				}

				if($find_in_gallery && $remove_file_id)
				{
					\dash\upload\product::remove_product_gallery($product_id, $remove_file_id);
				}

				if(isset($product_detail['thumb']) && isset($product_gallery_field['thumbid']) && floatval($product_gallery_field['thumbid']) === floatval($fileid))
				{
					$product_detail['thumb'] = null;
				}

				$next_image = null;
				foreach ($product_gallery_field['files'] as $key => $value)
				{
					$next_image = $value;
					break;
				}

				if((!isset($product_detail['thumb']) || (array_key_exists('thumb', $product_detail) && !$product_detail['thumb'])) && $next_image && isset($next_image['id']) && isset($next_image['path']))
				{
					\lib\db\products\update::thumb($next_image['path'], $product_id);
					$product_gallery_field['thumbid'] = $next_image['id'];
				}

				if(!$next_image)
				{
					$product_gallery_field['thumbid'] = null;
					\lib\db\products\update::thumb(null, $product_id);
				}

			}

		}

		if(isset($product_gallery_field['files']) && is_array($product_gallery_field['files']))
		{
			$product_gallery_field['files'] = array_values($product_gallery_field['files']);
			if(empty($product_gallery_field['files']))
			{
				$product_gallery_field = null;
			}
		}

		if($product_gallery_field)
		{
			$product_gallery_field = json_encode($product_gallery_field, JSON_UNESCAPED_UNICODE);

			\lib\db\products\update::gallery($product_gallery_field, $product_id);
		}
		else
		{
			\lib\db\products\update::gallery_set_null($product_id);
		}

		return true;

	}

}
?>