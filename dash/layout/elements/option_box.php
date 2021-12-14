<?php
namespace dash\layout\elements;


class option_box
{
	/**
	 * Generate multiple option box
	 *
	 * @param      array   $_list  The list
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function multiple_html(array $_list)
	{
		$html = '';
		foreach ($_list as $key => $value)
		{
			$html .= self::generate_html($value);
		}

		return $html;
	}


	/**
	 * Generate html of option box
	 *
	 * @param      array   $_args  The arguments
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function generate_html(array $_args)
	{
		$html = '';

		$html .= '<section class="f" data-option="">';
		{
			$html .= '<div class="c8 s12">';
			{
				$html .= '<div class="data">';
				{
					$html .= '<h3>'.a($_args, 'title').'</h3>';
					$html .= '<div class="body">';
					{
						if(a($_args, 'desc'))
						{
							$html .= '<p>'. $_args['desc']. '</p>';
						}

						if(a($_args, 'html'))
						{
							$html .= $_args['html'];
						}
					}
					$html .= '</div>';
				}
				$html .= '</div>';
			}
			$html .= '</div>';

			$html .= '<form class="c4 s12" method="post" data-patch>';
			{
				$html .= '<div class="action">';
				{
					switch (a($_args, 'mode'))
					{

						default:
						case 'btn':
							$html .= '<a class="btn-primary" href="'. a($_args, 'btn_link') .'">'. a($_args, 'btn_title').'</a>';
							break;
					}

				}
				$html .= '</div>';
			}
			$html .= '</form>';
		}
		$html .= '</section>';



		return $html;
	}
}
?>