<?php
namespace content_site\options\file;


class file
{
	public static function validator($_data)
	{
		return static::validator_upload_file($_data);
	}


	public static function validator_upload_file($_data)
	{
		$CLASS = \content_site\utility::className(get_called_class());

		if(\dash\request::files($CLASS))
		{
			if(static::upload_video())
			{
				$file_path = \dash\upload\website::upload_image_or_video($CLASS);
			}
			else
			{
				$file_path = \dash\upload\website::upload_image($CLASS);
			}

			if(!\dash\engine\process::status())
			{
				return false;
			}

			// need redirect after add image to show image delete button
			\content_site\utility::need_redirect(true);

			return $file_path;
		}
		else
		{
			if(a($_data, 'deletefile'))
			{
				// need redirect after remove image
				\content_site\utility::need_redirect(true);
				return null;
			}
			else
			{
				$type = [];
				$type[] = 'image';
				if(static::upload_video())
				{
					$type[] = 'video';
				}


				if($file_id = \dash\validate::code(a($_data, 'fileid'), false))
				{
					$file_path = \dash\upload\website::upload_by_file_id($file_id, $type);

					if(!\dash\engine\process::status())
					{
						return false;
					}
					\content_site\utility::need_redirect(true);

					return $file_path;
				}
				elseif($file_addr = \dash\validate::string_1000(a($_data, 'fileaddr'), false))
				{
					$analyze_url = \dash\validate\url::parseUrl($file_addr);
					if(!$analyze_url)
					{
						\dash\notif::error_once(T_("Can not support this file"));
						return false;
					}


					$file_path = \dash\upload\website::upload_by_file_addr($file_addr, $type);

					if(!\dash\engine\process::status())
					{
						return false;
					}
					\content_site\utility::need_redirect(true);


					return $file_path;
				}
				else
				{

					return false;
				}
			}
		}
	}


	public static function default()
	{
		return null;
	}


	public static function db_key()
	{
		return 'file';
	}


	public static function have_specialsave()
	{
		return false;
	}

	public static function add_form_element()
	{
		return true;
	}


	public static function visible()
	{
		return true;
	}


	public static function admin_html()
	{
		if(!static::visible())
		{
			return '';
		}

		return static::html_upload_file(...func_get_args());
	}

	public static function upload_video()
	{
		return false;
	}

	public static function file_action_meta()
	{
		return [];
	}

	public static function have_label()
	{
		return false;
	}


	public static function label()
	{
		return null;
	}

	public static function html_upload_file($_section_detail = null)
	{

		$option_key = \content_site\utility::className(get_called_class());

		$db_key     = static::db_key();

		$default = \content_site\section\view::get_current_index_detail($db_key);

		if(!$default)
		{
			$default = static::default();
		}

		if($default)
		{
			$default = \lib\filepath::fix($default);
		}

		$ratio = \content_site\options\ratio\ratio::default();

		if(isset($_section_detail['preview']['ratio']))
		{
			$ratio = $_section_detail['preview']['ratio'];
		}

		\lib\ratio::data_ratio_html($ratio);

		$html = '';

		if(static::add_form_element())
		{
			$html .= \content_site\options\generate::form();
		}
		// form
		{
			$html .= \content_site\options\generate::opt_hidden(get_called_class());
			$html .= \content_site\options\generate::multioption();

			// need special save
			if(static::have_specialsave())
			{
				$html .= \content_site\options\generate::specialsave();
			}


			if(static::have_label())
			{
				$html .= '<label>';
				{
					$html .=  static::label();
				}
				$html .= '</label>';
			}

			$html .= '<div ';
			// upload attr
			$html .= ' data-uploader';
			$html .= ' data-name="'.$option_key.'"';
			$html .= ' data-final="#finalImage-'.$option_key.'"';
			$html .= ' data-autoSend';
			$html .= ' data-file-max-size="'. \dash\data::maxFileSize().'"';

			$html .= ' data-ratio-free';
			// $html .= ' '. \dash\data::ratioHtml();

			if($default)
			{
				$html .= " data-fill";
			}

			$html .= '>';


			$accept =
			[
				'image/jpeg',
				'image/png',
				'image/gif',
				'image/webp',
			];

			if(static::upload_video())
			{
				$accept = array_merge($accept,
				[
					'video/*'
				]);
			}

			$html .= '<input type="file" accept="'.implode(',', $accept).'" id="'.$option_key.'-id">';
			$html .= '<label for="'.$option_key.'-id">'. T_('Drag &amp; Drop your files or Browse'). '</label>';


			$file_detail = \lib\filepath::get_detail($default);

			$html .= '<label for="'.$option_key.'-id">';
			{
				if($default)
				{
					if($file_detail['type'] === 'video')
					{
						$html .= '<video controls>';
						$html .= '<source src="'. $default. '" type="'. $file_detail['mime']. '">';
						$html .= '</video>';
					}
					else if($file_detail['type'] === 'audio')
					{
						$html .= '<audio controls>';
						$html .= '<source src="'. $default. '" type="'. $file_detail['mime']. '">';
						$html .= '</audio>';
					}
					else if($file_detail['type'] === 'image')
					{
						$html .= '<img id="finalImage-'.$option_key.'" src="'. $default. '" alt="'. T_("Image"). '">';
					}
					else if($file_detail['type'] === 'pdf')
					{
						$html .= '<div class="file"><a data-fancybox="galleryPreview" data-type="pdf" target="_blank" href="'. $default. '"><i class="sf-file-pdf-o"></i>' . T_("PDF"). '</a></div>';
					}
					else if($file_detail['type'] === 'zip')
					{
						$html .= '<div class="file"><a target="_blank" href="'. $default. '"><i class="sf-file-archive-o"></i>'. T_("ZIP"). '</a></div>';
					}
					else
					{
						$html .= '<div class="file"><a target="_blank" href="'. $default. '"><i class="sf-file-o"></i>'. T_("File"). '</a></div>';
					}
				}
				else
				{
					$html .= '<img id="finalImage-'.$option_key.'" src="" alt="File">';
				}
			}
			$html .= '</label>';

			$meta_action                     = static::file_action_meta();
			$meta_action['opt_'.$option_key] = 1;
			$meta_action['multioption']      = 'multi';


			if(static::have_specialsave())
			{
				$meta_action['specialsave'] = 'specialsave';
			}

			if($default)
			{
				$meta_action_delete               = $meta_action;
				$meta_action_delete['deletefile'] = 1;

				$meta_action_delete = json_encode($meta_action_delete);

				$html .= "<span class='imageDel' data-confirm data-data='$meta_action_delete'></span>";
			}
			// uploader div
			$html .= '</div>';

			$meta_action['callback'] = \dash\url::path();

			$choose_url = \dash\url::here(). '/gallery';
			$choose_url .= '?'. \dash\request::build_query($meta_action);

			$choose_title = T_("Choose from gallery");
			$html .= '<div class="">';
			{
				$html .= "<a class='block link-info leading-9 text-sm text-center' href='$choose_url'>$choose_title</a>";
			}
			$html .= '</div>';
		}
		// form
		if(static::add_form_element())
		{
			$html .= \content_site\options\generate::_form();
		}

		return $html;
	}

}
?>