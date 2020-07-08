<?php
namespace lib\app\irvat;


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

	private static function get_gallery_field($_irvat_id)
	{

		$load_irvat_gallery = \lib\app\irvat\get::inline_get($_irvat_id);

		if(!$load_irvat_gallery || !is_array($load_irvat_gallery) || !isset($load_irvat_gallery['id']))
		{
			\dash\notif::error(T_("Product detail not found"));
			return false;
		}

		if(!array_key_exists('file', $load_irvat_gallery))
		{
			\dash\notif::error(T_("Product gallery not found"));
			return false;
		}

		$irvat_gallery_field = $load_irvat_gallery['file'];

		if(is_string($irvat_gallery_field) && (substr($irvat_gallery_field, 0, 1) === '{' || substr($irvat_gallery_field, 0, 1) === '['))
		{
			$irvat_gallery_field = json_decode($irvat_gallery_field, true);
		}
		elseif(is_array($irvat_gallery_field))
		{
			// no thing
		}
		else
		{
			$irvat_gallery_field = [];
		}

		$result =
		[
			'file'   => $irvat_gallery_field,
			'detail' => $load_irvat_gallery,
			'id'     => $load_irvat_gallery['id'],
		];

		return $result;
	}




	public static function gallery($_irvat_id, $_file_detail, $_type = 'add')
	{
		if(!\lib\store::in_store())
		{
			\dash\notif::error(T_("Your are not in this store!"));
			return false;
		}

		$load_gallery = self::get_gallery_field($_irvat_id);
		if(!$load_gallery)
		{
			return false;
		}

		$irvat_gallery_field = $load_gallery['file'];
		$irvat_id            = $load_gallery['id'];
		$irvat_detail        = $load_gallery['detail'];

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

			if(isset($irvat_gallery_field) && is_array($irvat_gallery_field) && isset($irvat_gallery_field['files']) && is_array($irvat_gallery_field['files']))
			{
				foreach ($irvat_gallery_field['files'] as $key => $one_file)
				{
					if(isset($one_file['path']) && $one_file['path'] === $file_path)
					{
						\dash\notif::error(T_("Duplicate file in this gallery"));
						return false;
					}
				}

				$irvat_gallery_field['files'][] = ['id' => $fileid, 'path' => $file_path];
			}
			else
			{
				$irvat_gallery_field['files']   = [];
				$irvat_gallery_field['files'][] = ['id' => $fileid, 'path' => $file_path];
			}


			// check max gallery image
			if(isset($irvat_gallery_field['files']) && is_array($irvat_gallery_field['files']))
			{
				if(count($irvat_gallery_field['files']) > 30)
				{
					\dash\notif::error(T_("Maximum count of gallery file is 30"));
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

			if(isset($irvat_gallery_field['files']) && is_array($irvat_gallery_field['files']))
			{
				$find_in_gallery = false;
				$remove_file_id = null;
				foreach ($irvat_gallery_field['files'] as $key => $one_file)
				{
					if(isset($one_file['id']) && floatval($one_file['id']) === floatval($fileid))
					{
						$remove_file_id = $one_file['id'];
						$find_in_gallery = true;
						unset($irvat_gallery_field['files'][$key]);
					}
				}

				if(!$find_in_gallery)
				{
					\dash\notif::error(T_("Invalid gallery id"));
					return false;
				}

				if($find_in_gallery && $remove_file_id)
				{
					\dash\upload\irvat::remove_irvat_gallery($irvat_id, $remove_file_id);
				}

			}

		}

		$irvat_gallery_field = json_encode($irvat_gallery_field, JSON_UNESCAPED_UNICODE);

		\lib\db\irvat\update::gallery($irvat_gallery_field, $irvat_id);

		return true;

	}

}
?>