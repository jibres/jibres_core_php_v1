<?php
namespace content_site\options\file;


trait file
{
	public static function validator($_data)
	{
		return self::validator_upload_file($_data);
	}


	public static function validator_upload_file($_data)
	{

		if(\dash\request::files(\content_site\utility::className(__CLASS__)))
		{
			$image_path = \dash\upload\website::upload_image(\content_site\utility::className(__CLASS__));

			if(!\dash\engine\process::status())
			{
				return false;
			}

			// need redirect after add image to show image delete button
			\content_site\utility::need_redirect(true);

			return $image_path;
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
				// \dash\notif::error(T_("Please upload a file"));
				return false;
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


	public static function admin_html($_section_detail = null)
	{
		return self::html_upload_file(...func_get_args());
	}



	public static function html_upload_file($_section_detail = null)
	{

		$option_key = \content_site\utility::className(__CLASS__);

		$db_key     = self::db_key();

		$default = \content_site\section\view::get_current_index_detail($db_key);

		if(!$default)
		{
			$default = self::default();
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

		if(self::add_form_element())
		{
			$html .= '<form method="post" autocomplete="off" >';
		}
		// form
		{
			$html .= '<input type="hidden" name="opt_'.$option_key.'" value="1">';

			// need special save
			if(self::have_specialsave())
			{
				$html .= \content_site\options\generate::specialsave();;
			}

			$html .= '<div ';
			// upload attr
			$html .= ' data-uploader';
			$html .= ' data-name="'.$option_key.'"';
			$html .= ' data-final="#finalImage"';
			$html .= ' data-autoSend';
			$html .= ' data-file-max-size="'. \dash\data::maxFileSize().'"';

			$html .= ' data-ratio-free';
			// $html .= ' '. \dash\data::ratioHtml();

			if($default)
			{
				$html .= " data-fill";
			}

			$html .= '>';

			$html .= '<input type="file" accept="image/jpeg, image/png, image/gif, image/webp" id="myfile">';
			$html .= '<label for="myfile">'. T_('Drag &amp; Drop your files or Browse'). '</label>';

			if($default)
			{
				$myExt = substr($default, -3);

				if(in_array($myExt, ['png', 'jpg', 'gif', 'svg']) || in_array(substr($default, -4), ['webp']))
				{
					$html .= '<label for="myfile"><img id="finalImage" src="'. $default. '" alt="'. \dash\data::dataRow_title(). '"></label>';
				}
				else
				{
					$html .= '<label for="myfile"><img id="finalImage" src="" alt="'. \dash\data::dataRow_title(). '"></label>';
				}
			}
			else
			{
				$html .= '<label for="myfile"><img id="finalImage" alt="'. \dash\data::dataRow_title(). '"></label>';
			}

			if($default)
			{
				$delete_file_json =
				[
					'opt_'.$option_key => 1,
					'multioption'      => 'multi',
					'deletefile'       => 1,
				];

				if(self::have_specialsave())
				{
					$delete_file_json['specialsave'] = 'specialsave';
				}

				$delete_file_json = json_encode($delete_file_json);

				$html .= "<span class='imageDel' data-confirm data-data='$delete_file_json'></span>";
			}

			$html .= '</div>';
		}
		// form
		if(self::add_form_element())
		{
			$html .= '</form>';
		}

		return $html;
	}

}
?>