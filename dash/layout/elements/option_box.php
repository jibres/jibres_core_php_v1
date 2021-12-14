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
				if(a($_args, 'option_mode') === 'file')
				{
					foreach ($_args['input'] as $key => $value)
					{
						if(a($value, 'type') === 'file')
						{
							$value['class']         = 'action';
							$value['not_close_div'] = true;
							$html .= \dash\layout\elements\input::file($value);
							unset($_args['input'][$key]);
							break;
						}
					}
					$html .= \dash\layout\elements\input::multiple_html($_args['input']);

					// close input file div
					$html .= '</div>';

				}
				else
				{
					$html .= '<div class="action">';
					{
						switch (a($_args, 'option_mode'))
						{
							case 'input':
							case 'file':
								$html .= \dash\layout\elements\input::multiple_html($_args['input']);
								break;

							default:
							case 'btn':
								$html .= self::action_btn($_args);
								break;
						}
					}
					$html .= '</div>';
				}

			}
			$html .= '</form>';

			if(a($_args, 'footer1') || a($_args, 'footer2'))
			{
				$html .= '<footer>';
				{
					$html .= '<div class="row">';
					{
						$html .= '<div class="c-auto">';
						{
							if(is_array(a($_args, 'footer2')))
							{
								foreach ($_args['footer2'] as $key => $value)
								{
									$html .= ' '. self::footer_link($value);
								}
							}
						}
						$html .= '</div>';

						$html .= '<div class="c"></div>';

						$html .= '<div class="c-auto">';
						{
							if(is_array(a($_args, 'footer1')))
							{
								foreach ($_args['footer1'] as $key => $value)
								{
									$html .= ' '. self::footer_link($value);
								}
							}
						}
						$html .= '</div>';
					}
					$html .= '</div>';
				}
				$html .= '</footer>';

			}
		}
		$html .= '</section>';



		return $html;
	}


	/**
	 * Generate html btn
	 *
	 * @param      array   $_args  The arguments
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	private static function action_btn(array $_args)
	{
		$btn_class = 'btn-primary';
		if(a($_args, 'btn_class'))
		{
			$btn_class = $_args['btn_class'];
		}

		if(a($_args, 'btn_html'))
		{
			return $_args['btn_html'];
		}
		else
		{
			return '<a class="'.$btn_class.'" href="'. a($_args, 'btn_link') .'">'. a($_args, 'btn_title').'</a>';
		}

	}


	private static function footer_link(array $_args)
	{
		if(a($_args, 'btn_html'))
		{
			return $_args['btn_html'];
		}
		else
		{
			return '<a class="link-secondary" href="'. a($_args, 'btn_link') .'">'. a($_args, 'btn_title').'</a>';
		}
	}


}
?>