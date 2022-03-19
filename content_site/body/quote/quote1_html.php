<?php
namespace content_site\body\quote;


class quote1_html
{

	public static function html($_args)
	{
		$html             = '';

		$list = [];

		if(isset($_args['quote_list']) && is_array($_args['quote_list']))
		{
			$list = $_args['quote_list'];
		}

		$html .= "<section class='text-gray-600 body-font'>";
		{

		  $html .= "<div class='container px-5 py-24 mx-auto'>";
		  {
			$heading = a($_args, 'heading');

			$html .= "<h1 class='text-3xl font-medium title-font text-gray-900 mb-12 text-center'>$heading</h1>";

			$html .= "<div class='flex flex-wrap -m-4'>";
			{
				foreach ($list as $key => $value)
				{
					$html .= "<div class='p-4 md:w-1/2 w-full'>";
					{
						$html .= "<div class='h-full bg-gray-100 p-8 rounded'>";
						{
							$html .= "<svg xmlns='http://www.w3.org/2000/svg' fill='currentColor' class='block w-5 h-5 text-gray-400 mb-4' viewBox='0 0 975.036 975.036'>";
							{
								$html .= "<path d='M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z'></path>";
							}
							$html .= "</svg>";

							$quote = a($value, 'text');

							$html .= "<p class='leading-relaxed mb-6'>$quote</p>";

							$html .= "<a class='inline-flex items-center'>";
							{
								$avatar = null;
								if(a($value, 'avatar'))
								{
									$avatar = \lib\filepath::fix(a($value, 'avatar'));
									$html .= "<img alt='author' src='$avatar' class='w-12 h-12 rounded-full shrink-0 object-cover object-center'>";
								}

								$html .= "<span class='flex-grow flex flex-col pl-4 pr-4'>";
								{
									$displayname = a($value, 'displayname');
									$job         = a($value, 'job');

									$html .= "<span class='title-font font-medium text-gray-900'>$displayname</span>";
									$html .= "<span class='text-gray-500 text-sm'>$job</span>";
								}
								$html .= "</span>";
							}
							$html .= "</a>";
						}
						$html .= "</div>";
					}
					$html .= "</div>";
				} // endif
			}
			$html .= "</div>";
		  }
		  $html .= "</div>";
		}
		$html .= "</section>";

		return $html;
	}


}
?>