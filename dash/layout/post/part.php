<?php
namespace dash\layout\post;


class part
{
	public static function header($_subType)
	{
		$html = '';

		// check gallery items
		$myGallery = \dash\data::dataRow_gallery_array();
		$myGalleryTopMedia = null;
		if(count($myGallery) === 1)
		{
			$myGalleryTopMedia = $myGallery[0];
		}

    $html .= '<header>';
    // show
    switch ($_subType)
    {
      case 'video':
        $html .= self::topVideo($myGalleryTopMedia);
        // $html .= self::postTitleBox();
        $html .= self::title();
        $html .= self::excerpt();
        break;

      case 'audio':
        $html .= self::postTitleBox();
        $html .= self::topAudio($myGalleryTopMedia);
        break;

      case 'standard':
      case 'gallery':
      default:
        $html .= self::thumb(1100);
        $html .= self::title();
        $html .= self::excerpt();
        break;
    }

    $html .= '</header>';

    return $html;
	}

	public static function postTitleBox()
	{
		$html = '';
		$html .= '<div class="row align-center postTitleBox" data-space="high">';
		{
			$html .= '<div class="c-auto">';
			{
				$html .= self::thumb(220);
			}
			$html .= '</div>';

			$html .= '<div class="c">';
			{
				$html .= self::title();
				$html .= self::excerpt();
			}
			$html .= '</div>';

		}
		$html .= '</div>';

		return $html;
	}


	public static function title($_heading = 2)
	{
		return '<h'. $_heading. '>'. \dash\data::dataRow_title(). '</h'. $_heading. '>';
	}


	public static function excerpt()
	{
		if(\dash\data::dataRow_autoexcerpt())
		{
			return null;
		}
		return '<p class="excerpt">'. \dash\data::dataRow_excerpt(). '</p>';
	}


	public static function thumb($_size = 1100)
	{
		if(!\dash\data::dataRow_thumb())
		{
			return null;
		}
		return '<img src="'. \dash\fit::img(\dash\data::dataRow_thumb(), $_size). '" alt="'. \dash\data::dataRow_title(). '">';
	}


	public static function article()
	{
		$html = '';
    $html .= '<article>';
    $html .= \dash\data::dataRow_content();
    $html .= '</article>';

    return $html;
	}


	public static function topVideo($_data)
	{
		$htmlVideo = '';

		switch (a($_data, 'ext'))
		{
			case 'mp4':
			case 'ogg':
			case 'webm':
				// do nothing
				break;

			default:
				return null;

				break;
		}

		$path   = a($_data, 'path');
		$endUrl = substr($path, -4);
    if(in_array($endUrl, ['.mp4', '.ogg', 'webm']))
    {
      $htmlVideo .= '<video controls';
      if(\dash\data::dataRow_cover())
      {
      	$htmlVideo .= ' poster="'. \dash\data::dataRow_cover(). '"';
      }
      $htmlVideo .= '>';
      $htmlVideo .= '<source src="'. $path. '" type="'. a($_data, 'mime'). '">';
      $htmlVideo .= '</video>';
    }

    return $htmlVideo;
	}


	public static function topAudio($_data)
	{
		$htmlAudio = '';

		switch (a($_data, 'ext'))
		{
			case 'mp3':
			case 'ogg':
			case 'wav':
				// do nothing
				break;

			default:
				return null;

				break;
		}

		$path   = a($_data, 'path');
		$endUrl = substr($path, -4);
    if(in_array($endUrl, ['.mp3', '.ogg', '.wav']))
    {
      $htmlAudio .= '<audio controls>';
      $htmlAudio .= '<source src="'. $path. '" type="'. a($_data, 'mime'). '">';
      $htmlAudio .= '</audio>';
    }

    return $htmlAudio;
	}
}
?>
