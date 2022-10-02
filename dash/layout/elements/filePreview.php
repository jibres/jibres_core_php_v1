<?php
namespace dash\layout\elements;


class filePreview
{

	public static function byExtension($_path, $_meta = []) : string
	{
		if(!$_path || !is_string($_path))
		{
			return '';
		}

		$split = explode('.', $_path);
		$ext   = end($split);
		if(!$ext)
		{
			return '';
		}

		$fileExtDetail = \dash\upload\extentions::get_mime_ext($ext);
		if(!$fileExtDetail || !isset($fileExtDetail['type']))
		{
			return '';
		}

		$html = '';

		switch ($fileExtDetail['type'])
		{
			case 'pdf':
			case 'archive':
			case 'word':
			case 'powerpoint':
			case 'text':
			case 'file':
				$html .= self::downloadButton($_path, $fileExtDetail, $_meta);
				break;

			case 'audio':
				$html .= self::audio($_path, $fileExtDetail, $_meta);
				break;

			case 'image':
				$html .= self::image($_path, $fileExtDetail, $_meta);
				break;

			case 'video':
				$html .= self::video($_path, $fileExtDetail, $_meta);
				break;

			default:
				// do nothing
				break;

		}


		return $html;
	}


	private static function downloadButton(string $_path, array $fileExtDetail, mixed $_meta)
	{
		$html = '';
		$html .= '<div class="text-center">';
		{
			$html .= sprintf('<a href="%s" target="_blank" class="btn-secondary">', $_path);
			{
				$html .= $fileExtDetail['type'];
				$html .= ' ';
				$html .= T_("Download");

			}
			$html .= '</a>';
		}
		$html .= '</div>';

		return $html;
	}


	private static function audio(string $_path, array $fileExtDetail, mixed $_meta)
	{
		$html = '';
		$html .= '<audio controls preload="metadata" class="block">';
		$html .= '<source src="' . $_path . '" type="' . $fileExtDetail['mime'] . '">';
		$html .= '</audio>';
		return $html;
	}


	public static function video($_path, $fileExtDetail)
	{
		$html = '';

		$html .= '<video controls preload="metadata" class="block w-full"';
		// if($_poster)
		// {
		// 	$html .= ' poster="' . $_poster . '"';
		// }
		$html .= '>';
		$html .= '<source src="' . $_path . '" type="' . $fileExtDetail['mime'] . '">';
		$html .= '</video>';

		return $html;
	}


	private static function image(string $_path, array $fileExtDetail, mixed $_meta)
	{
		$html = '';
		$html .= '<a data-action href="'. $_path.'" data-fancybox="productGallery">';
		$html .= '<img src="'. \dash\fit::img($_path, 460). '" alt="'. a($_meta, 'title'). '">';
		$html .= '</a>';
		return $html;
	}


}
