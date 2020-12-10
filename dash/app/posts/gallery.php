<?php
namespace dash\app\posts;


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

			$first_is_not_image = false;

			if(isset($gallery_raw[0]['type']) && $gallery_raw[0]['type'] !== 'image')
			{
				$first_is_not_image = true;
			}

			$new_gallery_raw = [];
			$temp_gallery_raw = $gallery_raw;

			if($first_is_not_image && count($gallery_raw) >= 2)
			{
				foreach ($temp_gallery_raw as $key => $value)
				{
					$break = false;

					if(isset($value['type']) && $value['type'] === 'image')
					{
						$new_gallery_raw[] = $value;
						unset($temp_gallery_raw[$key]);
						$break = true;
					}

					if($break)
					{
						break;
					}
				}

				$new_gallery_raw = array_merge($new_gallery_raw, $temp_gallery_raw);
				$gallery_raw = $new_gallery_raw;
			}

			return $gallery_raw;
		}
		else
		{
			return $_data;
		}

	}


	private static function get_gallery_field($_post_id)
	{

		$load_post_gallery = \dash\app\posts\get::inline_get($_post_id);

		if(!$load_post_gallery || !is_array($load_post_gallery) || !isset($load_post_gallery['id']))
		{
			\dash\notif::error(T_("Post detail not found"));
			return false;
		}

		if(!array_key_exists('gallery', $load_post_gallery))
		{
			\dash\notif::error(T_("Post gallery not found"));
			return false;
		}

		$post_gallery_field = $load_post_gallery['gallery'];

		if(is_string($post_gallery_field) && (substr($post_gallery_field, 0, 1) === '{' || substr($post_gallery_field, 0, 1) === '['))
		{
			$post_gallery_field = json_decode($post_gallery_field, true);
		}
		elseif(is_array($post_gallery_field))
		{
			// no thing
		}
		else
		{
			$post_gallery_field = [];
		}

		$result =
		[
			'gallery' => $post_gallery_field,
			'detail'  => $load_post_gallery,
			'id'      => $load_post_gallery['id'],
		];

		return $result;
	}


	public static function setthumb($_post_id, $_file_id)
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

		$load_gallery = self::get_gallery_field($_post_id);
		if(!$load_gallery)
		{
			return false;
		}

		$post_gallery_field    = $load_gallery['gallery'];
		$post_id = \dash\coding::decode($_post_id);

		if(isset($post_gallery_field['files']) && is_array($post_gallery_field['files']))
		{
			$thumb_path = null;

			foreach ($post_gallery_field['files'] as $key => $one_file)
			{
				if(isset($one_file['id']) && floatval($one_file['id']) === floatval($file_id) && isset($one_file['path']))
				{
					$post_gallery_field['thumbid'] = $one_file['id'];
					$thumb_path                       = $one_file['path'];

					$ext = substr(strrchr($thumb_path, '.'), 1);

					$mime_detail = \dash\upload\extentions::get_mime_ext($ext);
					if(isset($mime_detail['type']) && $mime_detail['type'] === 'image')
					{
						// ok
					}
					else
					{
						\dash\notif::error(T_("Only image file can be set on post thumb"));
						return false;
					}

				}
			}

			$new_gallery_field = [];
			foreach ($post_gallery_field['files'] as $key => $value)
			{
				if(isset($value['id']) && $value['id'] == $post_gallery_field['thumbid'])
				{
					$new_gallery_field[] = $value;
				}
			}

			foreach ($post_gallery_field['files'] as $key => $value)
			{
				if(isset($value['id']) && $value['id'] != $post_gallery_field['thumbid'])
				{
					$new_gallery_field[] = $value;
				}
			}

			$post_gallery_field['files'] = $new_gallery_field;
			$post_gallery_field          = json_encode($post_gallery_field, JSON_UNESCAPED_UNICODE);

			\dash\db\posts\update::gallery($post_gallery_field, $post_id);
			\dash\db\posts\update::thumb($thumb_path, $post_id);

			return true;
		}

		\dash\notif::error(T_("Invalid gallery id"));
		return false;
	}


	public static function gallery($_post_id, $_file_detail, $_type = 'add')
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		$load_gallery = self::get_gallery_field($_post_id);
		if(!$load_gallery)
		{
			return false;
		}

		$post_gallery_field = $load_gallery['gallery'];
		$post_id            = \dash\coding::decode($_post_id);
		$post_detail        = $load_gallery['detail'];

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

			if(isset($post_gallery_field) && is_array($post_gallery_field) && isset($post_gallery_field['files']) && is_array($post_gallery_field['files']))
			{
				foreach ($post_gallery_field['files'] as $key => $one_file)
				{
					if(isset($one_file['path']) && $one_file['path'] === $file_path)
					{
						\dash\notif::error(T_("Duplicate file in this gallery"));
						return false;
					}
				}

				$post_gallery_field['files'][] = ['id' => $fileid, 'path' => $file_path];
			}
			else
			{
				$post_gallery_field['files']   = [];
				$post_gallery_field['files'][] = ['id' => $fileid, 'path' => $file_path];
			}

			if(!isset($post_detail['thumb']) || (array_key_exists('thumb', $post_detail) && !$post_detail['thumb']))
			{
				$ext = substr(strrchr($file_path, '.'), 1);
				$mime_detail = \dash\upload\extentions::get_mime_ext($ext);
				if(isset($mime_detail['type']) && $mime_detail['type'] === 'image')
				{
					\dash\db\posts\update::thumb($file_path, $post_id);
					$post_gallery_field['thumbid'] = $fileid;
					// ok
				}
			}

			// check max gallery image
			if(isset($post_gallery_field['files']) && is_array($post_gallery_field['files']))
			{
				if(count($post_gallery_field['files']) > 10)
				{
					\dash\notif::error(T_("Maximum count of gallery file is 10"));
					return false;
				}
			}
		}
		else // remove image from gallery
		{
			$fileid = $_file_detail; // the file id
			$fileid = \dash\validate::code($fileid);
			$fileid = \dash\coding::decode($fileid);

			if(!$fileid)
			{
				\dash\notif::error(T_("Invalid file id"));
				return false;
			}

			if(isset($post_gallery_field['files']) && is_array($post_gallery_field['files']))
			{
				$find_in_gallery = false;
				$remove_file_id = null;
				foreach ($post_gallery_field['files'] as $key => $one_file)
				{
					if(isset($one_file['id']) && floatval($one_file['id']) === floatval($fileid))
					{
						$remove_file_id = $one_file['id'];
						$find_in_gallery = true;
						unset($post_gallery_field['files'][$key]);
					}
				}

				if(!$find_in_gallery)
				{
					\dash\notif::error(T_("Invalid gallery id"));
					return false;
				}

				if($find_in_gallery && $remove_file_id)
				{
					\dash\upload\cms::remove_post_gallery($post_id, $remove_file_id);
				}

				if(isset($post_detail['thumb']) && isset($post_gallery_field['thumbid']) && floatval($post_gallery_field['thumbid']) === floatval($fileid))
				{
					$post_detail['thumb'] = null;
				}

				$next_image = null;
				foreach ($post_gallery_field['files'] as $key => $value)
				{
					$ext = substr(strrchr($value['path'], '.'), 1);
					$mime_detail = \dash\upload\extentions::get_mime_ext($ext);
					if(isset($mime_detail['type']) && $mime_detail['type'] === 'image')
					{
						$next_image = $value;
						break;
					}

					if($next_image)
					{
						break;
					}
				}

				if((!isset($post_detail['thumb']) || (array_key_exists('thumb', $post_detail) && !$post_detail['thumb'])) && $next_image && isset($next_image['id']) && isset($next_image['path']))
				{
					\dash\db\posts\update::thumb($next_image['path'], $post_id);
					$post_gallery_field['thumbid'] = $next_image['id'];
				}

				if(!$next_image)
				{
					$post_gallery_field['thumbid'] = null;
					\dash\db\posts\update::thumb(null, $post_id);
				}

			}

		}

		if(isset($post_gallery_field['files']) && is_array($post_gallery_field['files']))
		{
			$post_gallery_field['files'] = array_values($post_gallery_field['files']);
			if(empty($post_gallery_field['files']))
			{
				$post_gallery_field = null;
			}
		}

		if($post_gallery_field)
		{
			$post_gallery_field = json_encode($post_gallery_field, JSON_UNESCAPED_UNICODE);

			\dash\db\posts\update::gallery($post_gallery_field, $post_id);
		}
		else
		{
			\dash\db\posts\update::gallery_set_null($post_id);
		}

		return true;

	}


	public static function set_sort($_sort, $_id)
	{
		$sort = [];
		if(!is_array($_sort))
		{
			\dash\notif::error(T_("Invalid sort arguments"));
			return false;
		}

		foreach ($_sort as $key => $value)
		{
			if(is_numeric($key) && \dash\validate::code($value, false))
			{
				$sort[$key] = \dash\coding::decode($value);
			}
		}

		$id = \dash\coding::decode($_id);

		$load_post = self::get_gallery_field($_id);

		if(!$load_post)
		{
			return false;
		}

		if(isset($load_post['gallery']['files']) && is_array($load_post['gallery']['files']))
		{
			$gallery_array = $load_post['gallery']['files'];
		}

		$current_thumb_id = null;
		if(isset($load_post['gallery']['thumbid']) && is_array($load_post['gallery']['thumbid']))
		{
			$current_thumb_id = $load_post['gallery']['thumbid'];
		}


		if(!$gallery_array)
		{
			\dash\notif::error(T_("No images founded for sorting"));
			return false;
		}

		// check count
		if(count($sort) === count($gallery_array))
		{
			// ok
		}
		else
		{
			\dash\notif::warn(T_("Please reload page to sort all image in this post gallery"));
			return false;
		}


		$new_gallery = [];

		foreach ($sort as $sort_index => $sort_id)
		{
			foreach ($gallery_array as $gallery)
			{
				if(isset($gallery['id']) && floatval($gallery['id']) === floatval($sort_id))
				{
					$new_gallery[] = $gallery;
				}
			}
		}

		$save_gallery = [];


		if(isset($new_gallery[0]['id']) && isset($new_gallery[0]['path']))
		{
			$ext = substr(strrchr($new_gallery[0]['path'], '.'), 1);
			$mime_detail = \dash\upload\extentions::get_mime_ext($ext);
			if(isset($mime_detail['type']) && $mime_detail['type'] === 'image')
			{
				\dash\db\posts\update::thumb($new_gallery[0]['path'], $id);
				$save_gallery['thumbid'] = $new_gallery[0]['id'];
			}
			else
			{
				$save_gallery['thumbid'] = $current_thumb_id;
			}
		}
		else
		{
			$save_gallery['thumbid'] = $current_thumb_id;
		}

		$save_gallery['files'] = $new_gallery;

		$update_gallery = json_encode($save_gallery, JSON_UNESCAPED_UNICODE);

		\dash\db\posts\update::gallery($update_gallery, $id);

		\dash\notif::ok(T_("Sort saved"));

	}

}
?>