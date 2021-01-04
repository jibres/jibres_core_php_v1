<?php
namespace dash\app\files;


class ready
{
	public static function row($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'creator':
					if($value)
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'type':
				case 'mime':
				case 'ext':
				case 'folder':
					$result[$key] = $value;
					break;

				case 'path':
					$result[$key] = \lib\filepath::fix($value);
					break;

				case 'size':
					$result[$key] = $value;
					break;


				default:
					$result[$key] = $value;
					break;
			}
		}

		if(isset($result['type']))
		{
			switch ($result['type'])
			{
				case 'image':
					$result['t_type'] = T_("Image");
					$result['thumb'] = self::getImgThumb(a($result, 'path'));
					$result['thumb_raw'] = a($result, 'path');

					break;

				case 'archive':
					$result['t_type'] = T_("Archive");
					$result['thumb'] = \dash\app::static_image_url();
					break;

				case 'audio':
					$result['t_type'] = T_("Audio");
					$result['thumb'] = \dash\app::static_image_url();
					break;

				case 'pdf':
					$result['t_type'] = T_("PDF");
					$result['thumb'] = \dash\app::static_image_url();
					break;

				case 'video':
					$result['t_type'] = T_("Video");
					$result['thumb'] = \dash\app::static_image_url();
					break;

				case 'word':
					$result['t_type'] = T_("Word");
					$result['thumb'] = \dash\app::static_image_url();
					break;

				case 'excel':
					$result['t_type'] = T_("Excel");
					$result['thumb'] = \dash\app::static_image_url();
					break;

				case 'powerpoint':
					$result['t_type'] = T_("Power Point");
					$result['thumb'] = \dash\app::static_image_url();
					break;

				case 'code':
					$result['t_type'] = T_("Code");
					$result['thumb'] = \dash\app::static_image_url();
					break;

				case 'text':
					$result['t_type'] = T_("Text");
					$result['thumb'] = \dash\app::static_image_url();
					break;

				case 'file':
				default:
					$result['t_type'] = T_("File");
					$result['thumb'] = \dash\app::static_image_url();
					break;
			}
		}

		if(isset($result['thumb']) && !isset($result['thumb_raw']))
		{
			$result['thumb_raw'] = $result['thumb'];
		}

		if(\dash\temp::get('isApi'))
		{
			unset($result['domain']);
			unset($result['t_type']);
			unset($result['thumb_raw']);
		}

		return $result;
	}


	public static function row_usage()
	{
		return self::row(...func_get_args());
	}




	private static function getImgThumb($_src)
	{
		$dotPosition = strrpos($_src, '.');
		if(!$dotPosition)
		{
			return '';
		}
		$imgExt = substr($_src, $dotPosition);
		switch ($imgExt)
		{
			case '.jpg':
			case '.png':
			case '.gif':
				return substr($_src, 0, $dotPosition). '-w120.webp';
				break;

			default:
				return $_src;
		}
	}

}
?>