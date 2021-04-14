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
				$html .= self::video($myGalleryTopMedia, \dash\data::dataRow_cover());
				// $html .= self::postTitleBox();
				$html .= self::title();
				$html .= self::excerpt();
				break;

			case 'audio':
				$html .= self::postTitleBox();
				$html .= self::audio($myGalleryTopMedia);
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
			$html .= '<div class="c-xs-12 c-auto">';
			{
				if(\dash\detect\device::detectPWA())
				{
					$html .= self::thumb(780);
				}
				else
				{
					$html .= self::thumb(220);
				}
			}
			$html .= '</div>';

			$html .= '<div class="x-xs-12 c">';
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
		if(\dash\data::dataRow_excerpt())
		{
			return '<p class="excerpt">'. \dash\data::dataRow_excerpt(). '</p>';
		}
			return '';
	}


	public static function thumb($_size = 1100)
	{
		if(!\dash\data::dataRow_thumb())
		{
			return null;
		}
		return '<img src="'. \dash\fit::img(\dash\data::dataRow_thumb(), $_size). '" alt="'. \dash\data::dataRow_title(). '">';
	}


	public static function postArticle()
	{
		$html = '';
		$html .= '<div class="text">';
		$html .= \dash\data::dataRow_content();
		$html .= \dash\layout\post\part::tagLine();
		$html .= '</div>';

		return $html;
	}


	public static function tagLine()
	{
		$html = '';
		$tags = \dash\data::dataRow_tags();

		if($tags && is_array($tags))
		{
			$html .= '<div class="tagLine">';
			foreach ($tags as $key => $value)
			{
				$html .= '<a class="btn light mRa5 mB5" href="'. a($value, 'url'). '">';
				$html .= a($value, 'title');
				$html .= "</a> ";
			}
			$html .= '</div>';
		}

		return $html;
	}


	public static function video($_data, $_poster = null)
	{
		$htmlVideo = '';

		if(a($_data, 'type') === 'video')
		{
			$htmlVideo .= '<video controls preload="metadata"';
			if($_poster)
			{
				$htmlVideo .= ' poster="'. $_poster . '"';
			}
			$htmlVideo .= '>';
			$htmlVideo .= '<source src="'. a($_data, 'path'). '" type="'. a($_data, 'mime'). '">';
			$htmlVideo .= '</video>';
		}

		return $htmlVideo;
	}


	public static function audio($_data)
	{
		$htmlAudio = '';

		if(a($_data, 'type') === 'audio')
		{
			$htmlAudio .= '<audio controls preload="metadata">';
			$htmlAudio .= '<source src="'. a($_data, 'path'). '" type="'. a($_data, 'mime'). '">';
			$htmlAudio .= '</audio>';
		}

		return $htmlAudio;
	}


	public static function gallery()
	{
		if(\dash\data::dataRow_subtype() === 'video' ||  \dash\data::dataRow_subtype() === 'audio')
		{
			// do not repeat video and audio
			return null;
		}

		$html = '';
		$galleryArr = a(\dash\data::dataRow(), 'gallery_array');
		if(!is_array($galleryArr))
		{
			return null;
		}

		$html .= '<div class="gallery" id="lightgallery">';
		{
			$html .= '<div class="row">';
			foreach ($galleryArr as $key => $myMedia)
			{
				if(a($myMedia, 'path'))
				{
					switch (a($myMedia, 'type'))
					{
						case 'image':
							$html .= '<div class="c-xs-6 c-sm-6 c-md-4 c-lg-3" data-type="'. a($myMedia, 'type'). '">';
							{
								$html .= '<a data-action href="'. $myMedia['path'].'" data-fancybox="productGallery">';
								$html .= '<img src="'. \dash\fit::img($myMedia['path'], 460). '" alt="'. \dash\data::dataRow_title(). '">';
								$html .= '</a>';
							}
							$html .= '</div>';
							break;

						case 'audio':
							$html .= '<div class="c-12" data-type="'. a($myMedia, 'type'). '">';
							{
								$html .= self::audio($myMedia);
							}
							$html .= '</div>';
							break;

						case 'video':
							$html .= '<div class="c-12" data-type="'. a($myMedia, 'type'). '">';
							{
								$html .= self::video($myMedia);
							}
							$html .= '</div>';
							break;

						case 'pdf':
							$html .= '<div class="c-xs-6 c-sm-6 c-md-4 c-lg-3 c-xxl-2" data-type="'. a($myMedia, 'type'). '">';
							{
								$html .= '<a class="file" target="_blank" href="'. $myMedia['path'].'">';
								$html .= '<i class="sf-file-pdf-o"></i>';
								$html .= T_("Download PDF");
								$html .= '</a>';
							}
							$html .= '</div>';
							break;

						case 'zip':
							$html .= '<div class="c-xs-6 c-sm-6 c-md-4 c-lg-3 c-xxl-2" data-type="'. a($myMedia, 'type'). '">';
							{
								$html .= '<a class="file" target="_blank" href="'. $myMedia['path'].'">';
								$html .= '<i class="sf-file-archive-o"></i>';
								$html .= T_("Download ZIP");
								$html .= '</a>';
							}
							$html .= '</div>';
							break;

						default:
							$html .= '<div class="c-xs-6 c-sm-6 c-md-4 c-lg-3 c-xxl-2" data-type="'. a($myMedia, 'type'). '">';
							{
								$html .= '<a class="file" target="_blank" href="'. $myMedia['path'].'">';
								$html .= '<i class="sf-file-o"></i>';
								$html .= T_("Download File");
								$html .= '</a>';
							}
							$html .= '</div>';
							break;
					}
				}
			}
			$html .= '</div>';
		}
		$html .= '</div>';

		 return $html;
	}


	public static function infoBox()
	{
		$html = '';
		$html .= '<div class="msg minimal infoBox">';
		{
			$html .= '<div class="row align-center ">';
			{
				$html .= '<div class="c-xs-6 c-auto">';
				{
					$html .= self::publishDate();
				}
				$html .= '</div>';
				$html .= '<div class="c-xs-6 c-auto txtL">';
				{
					$html .= self::readingTime();
				}
				$html .= '</div>';
				$html .= '<div class="c-xs-2 c txtL">';
				{
					$html .= T_("Share");
				}
				$html .= '</div>';
				$html .= '<nav class="c-xs-10 c-auto share1 txtL">';
				{
					$html .= self::shareLink();
				}
				$html .= '</nav>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';

		return $html;
	}


	public static function publishDate()
	{
		$html = '';

		if(\dash\data::dataRow_allowshowpublishdate())
		{
			if(\dash\data::dataRow_publishdate())
			{
				$html .= '<time class="ltr compact"';
				$html .= ' datetime="'. \dash\data::dataRow_publishdate(). '"';
				$html .= ' title="'. T_("This post published at :val", ['val' => \dash\fit::datetime_full(\dash\data::dataRow_publishdate()) ]). '"';
				$html .= '>';
				$html .= \dash\fit::date_time(\dash\data::dataRow_publishdate());
				$html .= '</time>';
			}
			else
			{

			}
		}

		return $html;
	}


	public static function readingTime()
	{
		$html = '';

		if(\dash\data::dataRow_readingtime())
		{
			$val = ['val' => \dash\fit::number(\dash\data::dataRow_readingtime())];
			$html .= '<abbr title="'. T_("We are estimate you can read this post within :val.", $val). '">';
			$html .= T_(":val read", $val);
			$html .= '</abbr>';
		}

		return $html;
	}


	public static function shareLink()
	{
		$html = '';
		// facebook
		{
			$html .= '<a target="_blank" class="facebook" title="'. T_("Share of Facebook"). '"';
			$html .= ' href="https://www.facebook.com/sharer/sharer.php?u='. \dash\url::pwd(). '"';
			$html .= '>';
			$html .= T_("Share of Facebook");
			$html .= '</a>';
		}
		// twitter
		{
			$html .= '<a target="_blank" class="twitter" title="'. T_("Share of Twitter"). '"';
			$html .= ' href="https://twitter.com/home?status='. \dash\url::pwd(). '"';
			$html .= '>';
			$html .= T_("Share of Twitter");
			$html .= '</a>';
		}
		// linkedin
		{
			$html .= '<a target="_blank" class="linkedin" title="'. T_("Share of Linkedin"). '"';
			$html .= ' href="https://www.linkedin.com/shareArticle?mini=true&url='. \dash\url::pwd(). '&title='. urlencode(\dash\face::title()).'&summary='. urlencode(\dash\face::desc()) . '"';
			$html .= '>';
			$html .= T_("Share of Linkedin");
			$html .= '</a>';
		}
		// telegram
		{
			$html .= '<a target="_blank" class="telegram" title="'. T_("Share of Telegram"). '"';
			$html .= ' href="https://t.me/share/url?url='. \dash\url::pwd(). '&text='. urlencode(\dash\face::title()). '"';
			$html .= '>';
			$html .= T_("Share of Telegram");
			$html .= '</a>';
		}
		// copy shortLink
		{
			$html .= '<a class="copy" title="'. T_("Copy Shortlink"). '"';
			$html .= ' data-copy="'. \dash\url::kingdom(). '/n/'. \dash\data::dataRow_id(). '"';
			$html .= ' data-copy-msg="'. T_("ShortLink of this page is copied. Paste in anywhere!"). '"';
			$html .= '>';
			$html .= T_("Copy Shortlink");
			$html .= '</a>';
		}

		return $html;
	}


	public static function similarPost()
	{
		$html = '';
		$myPostSimilar = \dash\app\posts\search::similar_post(\dash\data::dataRow_id());
		if($myPostSimilar)
		{
			$html .= '<section class="box similarPost">';
			{
				$html .= '<header>';
				{
					$html .= '<h4>'. T_("Recommended for you"). '</h4>';
				}
				$html .= '</header>';

				$html .= '<nav class="body">';
				foreach ($myPostSimilar as $key => $value)
				{
					$html .= '<a class="block" href="'. a($value, 'link') .'">'. $value['title']. '</a>';
				}
				$html .= '</nav>';
			}

			$html .= '</section>';
		}
		return $html;
	}


	public static function commentBox()
	{
		// add new comment
		if(\dash\data::dataRow_allowcomment())
		{
			require_once(core. 'layout/comment/comment-add.php');
		}
		// show list of comments
		require_once(core. 'layout/comment/comment-list.php');
	}

}
?>
