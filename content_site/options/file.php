<?php
namespace content_site\options;


class file
{

	public static function admin_html()
	{
		$html = '';

		$html .= '<form method="post" autocomplete="off" >';
		{
			$html .= '<div ';
			// upload attr
			$html .= ' data-uploader';
			$html .= ' data-name="file"';
			$html .= ' data-final="#finalImage"';
			$html .= ' data-file-max-size="'. \dash\data::maxFileSize().'"';
			$html .= ' data-autoSend';

			if(\dash\data::dataRow_imageurl())
			{
				$html .= " data-fill";
			}

			$html .= \dash\data::ratioHtml();
			$html .= '>';

			$html .= '<input type="file" accept="image/jpeg, image/png" id="myfile">';
			$html .= '<label for="myfile">'. T_('Drag &amp; Drop your files or Browse'). '</label>';

			if(\dash\data::dataRow_imageurl())
			{
				$myExt = substr(\dash\data::dataRow_imageurl(), -3);

				if(in_array($myExt, ['png', 'jpg', 'gif']))
				{
					$html .= '<label for="myfile"><img id="finalImage" src="'. \dash\data::dataRow_imageurl(). '" alt="'. \dash\data::dataRow_title(). '"></label>';
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