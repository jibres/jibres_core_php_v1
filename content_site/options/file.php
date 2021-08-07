<?php
namespace content_site\options;


class file
{
	public static function validator($_data)
	{
		if(\dash\request::files('file'))
		{
			$image_path = \dash\upload\website::upload_image('file');

			if(!\dash\engine\process::status())
			{
				return false;
			}

			return $image_path;
		}
		else
		{
			\dash\notif::error(T_("Please upload a file"));
			return false;
		}
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html($_section_detail = null)
	{
		$default = \content_site\section\view::get_current_index_detail('file');

		if(!$default)
		{
			$default = self::default();
		}

		if($default)
		{
			$default = \lib\filepath::fix($default);
		}

		$ratio = \content_site\options\ratio::default();

		if(isset($_section_detail['preview']['ratio']))
		{
			$ratio = $_section_detail['preview']['ratio'];
		}

		\lib\ratio::data_ratio_html($ratio);

		$html = '';

		$html .= '<form method="post" autocomplete="off" >';
		{
			$html .= '<input type="hidden" name="opt_file" value="1">';
			$html .= '<div ';
			// upload attr
			$html .= ' data-uploader';
			$html .= ' data-name="file"';
			$html .= ' data-final="#finalImage"';
			$html .= ' data-autoSend';
			$html .= ' data-file-max-size="'. \dash\data::maxFileSize().'"';

			$html .= ' data-ratio-free';
			$html .= ' '. \dash\data::ratioHtml();

			if($default)
			{
				$html .= " data-fill";
			}

			$html .= '>';

			$html .= '<input type="file" accept="image/jpeg, image/png" id="myfile">';
			$html .= '<label for="myfile">'. T_('Drag &amp; Drop your files or Browse'). '</label>';

			if($default)
			{
				$myExt = substr($default, -3);

				if(in_array($myExt, ['png', 'jpg', 'gif', 'svg']))
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

			$html .= '</div>';
		}
		$html .= '</form>';

		return $html;
	}

}
?>