<?php
namespace lib\app\tax\doc;


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

	private static function get_gallery_field($_tax_document_id)
	{

		$load_tax_document_gallery = \lib\app\tax\doc\get::get($_tax_document_id);

		if(!$load_tax_document_gallery || !is_array($load_tax_document_gallery) || !isset($load_tax_document_gallery['id']))
		{
			\dash\notif::error(T_("Product detail not found"));
			return false;
		}

		if(!array_key_exists('gallery', $load_tax_document_gallery))
		{
			\dash\notif::error(T_("Product gallery not found"));
			return false;
		}

		$tax_document_gallery_field = $load_tax_document_gallery['gallery'];

		if(is_string($tax_document_gallery_field) && (substr($tax_document_gallery_field, 0, 1) === '{' || substr($tax_document_gallery_field, 0, 1) === '['))
		{
			$tax_document_gallery_field = json_decode($tax_document_gallery_field, true);
		}
		elseif(is_array($tax_document_gallery_field))
		{
			// no thing
		}
		else
		{
			$tax_document_gallery_field = [];
		}

		$result =
		[
			'gallery' => $tax_document_gallery_field,
			'detail'  => $load_tax_document_gallery,
			'id'      => $load_tax_document_gallery['id'],
		];

		return $result;
	}


	public static function gallery($_tax_document_id, $_file_detail, $_type = 'add')
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		$load_gallery = self::get_gallery_field($_tax_document_id);
		if(!$load_gallery)
		{
			return false;
		}

		$tax_document_gallery_field = $load_gallery['gallery'];
		$tax_document_id            = $load_gallery['id'];
		$tax_document_detail        = $load_gallery['detail'];

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

			if(isset($tax_document_gallery_field) && is_array($tax_document_gallery_field) && isset($tax_document_gallery_field['files']) && is_array($tax_document_gallery_field['files']))
			{
				foreach ($tax_document_gallery_field['files'] as $key => $one_file)
				{
					if(isset($one_file['path']) && $one_file['path'] === $file_path)
					{
						\dash\notif::error(T_("Duplicate file in this gallery"));
						return false;
					}
				}

				$tax_document_gallery_field['files'][] = ['id' => $fileid, 'path' => $file_path];
			}
			else
			{
				$tax_document_gallery_field['files']   = [];
				$tax_document_gallery_field['files'][] = ['id' => $fileid, 'path' => $file_path];
			}


			// check max gallery image
			if(isset($tax_document_gallery_field['files']) && is_array($tax_document_gallery_field['files']))
			{
				if(count($tax_document_gallery_field['files']) > 10)
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

			if(isset($tax_document_gallery_field['files']) && is_array($tax_document_gallery_field['files']))
			{
				$find_in_gallery = false;
				$remove_file_id = null;
				foreach ($tax_document_gallery_field['files'] as $key => $one_file)
				{
					if(isset($one_file['id']) && floatval($one_file['id']) === floatval($fileid))
					{
						$remove_file_id = $one_file['id'];
						$find_in_gallery = true;
						unset($tax_document_gallery_field['files'][$key]);
					}
				}

				if(!$find_in_gallery)
				{
					\dash\notif::error(T_("Invalid gallery id"));
					return false;
				}

				if($find_in_gallery && $remove_file_id)
				{
					\dash\upload\tax_document::remove_tax_document_gallery($tax_document_id, $remove_file_id);
				}

			}

		}

		if(isset($tax_document_gallery_field['files']) && is_array($tax_document_gallery_field['files']))
		{
			$tax_document_gallery_field['files'] = array_values($tax_document_gallery_field['files']);
			if(empty($tax_document_gallery_field['files']))
			{
				$tax_document_gallery_field = null;
			}
		}

		if($tax_document_gallery_field)
		{
			$tax_document_gallery_field = json_encode($tax_document_gallery_field, JSON_UNESCAPED_UNICODE);

			\lib\db\tax_document\update::gallery($tax_document_gallery_field, $tax_document_id);
		}
		else
		{
			\lib\db\tax_document\update::gallery_set_null($tax_document_id);
		}

		return true;

	}

}
?>