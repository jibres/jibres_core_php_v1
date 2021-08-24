<?php
namespace content_site\body\contactform\html;


class cf1
{

	public static function html($_args)
	{

		$html = '';

		$id               = a($_args, 'id');
		$type             = a($_args, 'type');
		$height           = a($_args, 'height:class');
		$background_style = a($_args, 'background:full_style');
		$section_id       = a($_args, 'secition:id');

		$classNames = $height;


		// $args['name']    = \dash\request::post('xun');
		// $args['mobile']  = \dash\request::post('xum');
		// $args['email']   = \dash\request::post('xue');
		// $args['content'] = \dash\request::post('xuc');

		// \dash\temp::set('tempTicketTitle', \dash\request::post('xut'));


		$heading = a($_args, 'heading');
		$desc    = a($_args, 'description');

		$form_action = \lib\store::url(). '/ticket/cf';

		$url = 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13128.74591632902!2d50.878973!3d34.6499932!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x8843ca95f5a8e4a1!2sJibres!5e0!3m2!1sen!2s!4v1629794013426!5m2!1sen!2s';

		if(a($_args, 'google_map_embed'))
		{
			$url = $_args['google_map_embed'];
		}

		$html .= "<section class='text-gray-600 body-font relative $classNames' data-type='$type' $background_style $section_id>";
		{
			$html .= '<div class="absolute inset-0 bg-gray-300">';
			{
				$html .= '<iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no" src="'.$url.'" style="filter: grayscale(1) contrast(1.2) opacity(0.4);" loading="lazy"></iframe>';
			}
			$html .= '</div>';

			$html .= '<form method="post" autocomplete="off" action="'.$form_action.'" data-refresh>';
			{
				$html .= '<div class="container px-5 py-24 mx-auto flex">';
				{
					$html .= '<div class="lg:w-1/3 sm:w-1/2 bg-white rounded-lg p-8 flex flex-col sm:ml-auto w-full mt-10 sm:mt-0 relative z-10 shadow-md">';
					{
						$html .= '<h2 class="text-gray-900 text-lg mb-1 font-medium title-font">'.a($_args, 'heading').'</h2>';

						$html .= '<p class="leading-relaxed mb-5 text-gray-600">'.a($_args, 'description').'</p>';

						if(a($_args, 'contact_get_email'))
						{
							$html .= '<div class="relative mb-4">';
							{

								$html .= '<label for="xue" class="leading-7 text-sm text-gray-600">'.T_("Email").'</label>';
								$html .= '<input type="email" id="xue" name="xue" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">';
							}
							$html .= '</div>';
						}

						if(a($_args, 'contact_get_mobile'))
						{
							$html .= '<div class="relative mb-4">';
							{

								$html .= '<label for="xum" class="leading-7 text-sm text-gray-600">'.T_("Mobile").'</label>';
								$html .= '<input type="tel" id="xum" name="xum" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">';
							}
							$html .= '</div>';
						}

						if(a($_args, 'contact_get_name'))
						{
							$html .= '<div class="relative mb-4">';
							{

								$html .= '<label for="xun" class="leading-7 text-sm text-gray-600">'.T_("Name").'</label>';
								$html .= '<input type="tel" id="xun" name="xun" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">';
							}
							$html .= '</div>';
						}

						$html .= '<div class="relative mb-4">';
						{

							$html .= '<label for="xuc" class="leading-7 text-sm text-gray-600">Message</label>';
							$html .= '<textarea id="content" name="xuc" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>';
						}
						$html .= '</div>';

						$html .= '<button class="btn-primary rounded text-lg">'.T_("Send").'</button>';
						$html .= '<p class="text-xs text-gray-500 mt-3">Chicharrones blog helvetica normcore iceland tousled brook viral artisan.</p>';
					}
					$html .= '</div>';
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