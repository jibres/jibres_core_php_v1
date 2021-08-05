<?php
namespace content_site\body\blog;


class b3
{
	public static function html($_args, $_blogList, $_id, $_show_author, $_show_date, $_show_excerpt, $_show_readingtime)
	{

<div class="divide-y divide-gray-200">
	<div class="pt-6 pb-8 space-y-2 md:space-y-5">
		<h1 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl md:text-[4rem] md:leading-[3.5rem]">Latest</h1>
		<p class="text-lg text-gray-500">All the latest Tailwind CSS news, straight from the team.</p>
	</div>
	<ul class="divide-y divide-gray-200">
		<li class="py-12">
			<article class="space-y-2 xl:grid xl:grid-cols-4 xl:space-y-0 xl:items-baseline">
				<dl>
					<dt class="sr-only">Published on</dt>
					<dd class="text-base font-medium text-gray-500">
						<time datetime="2021-07-29T12:00:00.000Z">July 29, 2021</time>
					</dd>
				</dl>
				<div class="space-y-5 xl:col-span-3">
					<div class="space-y-6">
						<h2 class="text-2xl font-bold tracking-tight">
							<a class="text-gray-900" href="/headless-ui-v1-4">Headless UI v1.4: The One With Tabs</a>
						</h2>
						<div class="prose max-w-none text-gray-500">
							<div class="prose max-w-none">
								<p>We just released Headless UI v1.4, which includes a brand new <code>Tab</code> component, and new APIs for manually closing <code>Popover</code> and <code>Disclosure</code> components more easily.</p>
							</div>
						</div>
					</div>
					<div class="text-base font-medium">
						<a class="text-teal-600 hover:text-teal-700" aria-label="Read &quot;Headless UI v1.4: The One With Tabs&quot;" href="/headless-ui-v1-4">Read more →</a>
					</div>
				</div>
			</article>
		</li>
	</ul>
<div>
		$html             = '';
		if(a($_args, 'heading') !== null)
		{
			$html .= '<header>';
			{
				$heading_class = \content_site\options\heading::class_name($_args);
				$text_color    = \content_site\assemble\text_color::full_style($_args);
				$font_class    = \content_site\assemble\font::class($_args);

				$html .= "<h3 class='font-bold text-4xl mb-10 $heading_class $font_class' $text_color data-sync-apply='heading-$_id'>";
				{
					$html .= a($_args, 'heading');
				}
				$html .= '</h3>';
			}
			$html .= '</header>';
		}

		$html .= "<div class='max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl'>";
		{
			foreach ($_blogList as $key => $value)
			{
				// a img
				// h2 a
				$myLink      = a($value, 'link');
				$myTitle     = a($value, 'title');
				$myThumb     = \dash\fit::img(a($value, 'thumb'), 460);
				$myExcerpt   = a($value, 'excerpt');
				$myDate      = a($value, 'publishdate');

				$html .= '<div class="md:flex">';
				{
					// thumb
					if($myThumb)
					{
						$html .= "<div class='md:flex-shrink-0'>";
						{
							$html .= "<img class='h-48 w-full object-cover md:w-48' src='$myThumb' alt='$myTitle'>";
						}
						$html .= "</div>";
					}


				    $html .= "<div class='p-8'>";
				    {
						// $html .= "<div class='uppercase tracking-wide text-sm text-indigo-500 font-semibold'>Case study</div>";
						$html .= "<a href='$myLink' class='block mt-1 text-lg leading-tight font-medium text-black hover:underline'>$myTitle</a>";

						if($myExcerpt && $_show_excerpt)
						{
							$html .= "<p class='mt-2 text-gray-500'>$myExcerpt</p>";
						}
				    }
				    $html .= "</div>";
				}
				$html .= '</div>';
			}
		}
		$html .= '</div>';

		return $html;
	}
}
?>