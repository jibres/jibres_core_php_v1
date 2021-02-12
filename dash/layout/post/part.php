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
		if(is_array($myGallery) && count($myGallery) === 1)
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

    if(a($_data, 'type') === 'video')
    {
      $htmlVideo .= '<video controls';
      if(\dash\data::dataRow_cover())
      {
      	$htmlVideo .= ' poster="'. \dash\data::dataRow_cover(). '"';
      }
      $htmlVideo .= '>';
      $htmlVideo .= '<source src="'. a($_data, 'path'). '" type="'. a($_data, 'mime'). '">';
      $htmlVideo .= '</video>';
    }

    return $htmlVideo;
	}


	public static function topAudio($_data)
	{
		$htmlAudio = '';

		if(a($_data, 'type') === 'audio')
    {
      $htmlAudio .= '<audio controls>';
      $htmlAudio .= '<source src="'. a($_data, 'path'). '" type="'. a($_data, 'mime'). '">';
      $htmlAudio .= '</audio>';
    }

    return $htmlAudio;
	}


	public static function gallery()
	{
		$html = '';
		$galleryArr = a(\dash\data::dataRow(), 'gallery_array');
		if(!is_array($galleryArr))
		{
			return null;
		}

	  $html .= '<div class="gallery" id="lightgallery">';
	  {
	    $html .= '<div class="row">';
	    foreach ($galleryArr as $key => $myUrl)
	    {
	      if(a($myUrl, 'path'))
	      {
	      	switch (a($myUrl, 'type'))
	      	{
	      		case 'image':
		          $html .= '<div class="c-xs-6 c-sm-6 c-md-4 c-lg-3 c-xxl-2">';
		          {
		            $html .= '<a data-action href="'. $myUrl['path'].'" data-fancybox="productGallery">';
		            $html .= '<img src="'. \dash\fit::img($myUrl['path'], 460). '" alt="'. \dash\data::dataRow_title(). '">';
		            $html .= '</a>';
		          }
		          $html .= '</div>';
	      			break;

	      		default:
	      			# code...
	      			break;
	      	}
	      }
	    }
	    $html .= '</div>';
	  }
	  $html .= '</div>';

		 return $html;
	}
}
?>
