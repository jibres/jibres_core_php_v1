<?php
namespace content_site\header\h1;


class layout
{


	/**
	 * Layout blog html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{
		$html = '';

		$html .= "<div id='jHeader100' class='avand' data-circleEffect>";
		{
	  		$html .= '<div class="actionBar row align-center">';
	  		{
				$html .= '<div class="c-auto c-xs-0">';
				{

					$html .= '<a class="logo" href="'. \dash\url::kingdom(). '">';
					{
						$logo = \lib\pagebuilder::logo();
						if($logo)
						{
							$html .= '<img src="'. $logo. '" alt="'. a($_args, 'heading'). '">';
							$html .= '<h1>'. a($_args, 'heading'). '</h1>';
						}
						else
						{
							$html .= '<h1>'. a($_args, 'heading'). '</h1>';
						}
					}
					$html .= '</a>';

				}
				$html .= '</div>';

			    if(!\dash\data::nosale())
			    {
					$html .= '<div class="c s0"></div>';

					$html .= '<div class="c-auto">';
					{
						$html .= '<a class="search" href="'. \dash\url::kingdom().'/search"></a>';
					}
					$html .= '</div>';

					$html .= '<div class="c-auto">';
					{
						$html .= '<a class="cart" href="'. \dash\url::kingdom(). '/cart" data-count="'. \dash\fit::number(\lib\pagebuilder::cart_count()). '"><span class="d-xs-none">'. T_("Cart"). '</span></a>';
					}
					$html .= '</div>';

					$html .= '<div class="c-auto">';
					{
						if(\dash\user::login())
						{
							$html .= '<a class="enter" href="'. \dash\url::kingdom(). '/profile">'. T_("Profile"). '</a>';
						}
						else
						{
							$html .= '<a class="enter" href="'. \dash\url::kingdom(). '/enter">'. T_("Enter to account"). '</a>';
						}
					}
					$html .= '</div>';

				} //end nosale

			}
	  		$html .= '</div>';

			if(\lib\pagebuilder::have_header_menu())
			{
				$html .= '<div class="menuBar row">';
				{
					$html .= '<div class="c">'. \lib\pagebuilder::menu('header_menu_1'). '</div>';
					$html .= '<div class="c-auto os">'. \lib\pagebuilder::menu('header_menu_2', 'xs0'). '</div>';
				}
				$html .= '</div>';
			}

		}
		$html .= '</div>';

		return $html;
	}
}
?>
