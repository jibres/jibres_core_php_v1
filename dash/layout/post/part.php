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
        $html .= self::title();
        break;

      case 'standard':
      case 'gallery':
      default:
        $html .= self::title();
        break;
    }

    $html .= '</header>';

    return $html;
	}


	public static function title($_heading = 2)
	{
		return '<h'. $_heading. '>'. \dash\data::dataRow_title(). '</h'. $_heading. '>';
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
      $htmlVideo .= '<video controls>';
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


	public static function thumb()
	{

	}

}
?>
