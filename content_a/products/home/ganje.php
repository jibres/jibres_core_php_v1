<?php
$html = '';

$html .= '<div class="w-2/4 m-auto">';
{
	if(\dash\data::ganjeSearch())
	{
		foreach (\dash\data::ganjeSearch() as $key => $value)
		{


			$html .= '<div class="flex flex-row bg-white mt-5 rounded-lg">';
			{

				$html .= '<div class="w-36 h-36">';
				{
					if(a($value, 'thumb'))
					{
						$html .= '<img class="object-cover w-36 h-36 rounded-lg " src="'. a($value, 'thumb'). '" alt="'.a($value, 'title').'">';
					}
				}
				$html .= '</div>';

				$html .= '<div class="flex-grow flex flex-col">';
				{

					$html .= '<div class="flex-grow">';
					{

						$html .= '<div class="flex flex-row">';
						{
							$html .= '<div class="flex-grow">';
							{
								$html .= '<div class="p-3">';
								{
									$html .= a($value, 'title');

									if(a($value, 'title2'))
									{
										$html .= '<div class="text-gray-500">';
										{
											$html .= a($value, 'title2');
										}
										$html .= '</div>';
									}


									if(a($value, 'category_list') && is_array($value['category_list']))
									{
										$html .= '<div class="mt-1">';
										{
											foreach ($value['category_list'] as $category)
											{
												$html .= '<span class="p-1 m-1 rounded-lg bg-gray-200">';
												{
													$html .= '#'. a($category, 'title');
												}
												$html .= '</span>';
											}
										}
										$html .= '</div>';
									}

								}
								$html .= '</div>';

							}
							$html .= '</div>';

							$html .= '<div class="flex-none">';
							{
								if(a($value, 'barcode') || a($value, 'barcode2'))
								{
									$barcode = null;
									if(a($value, 'barcode'))
									{
										$barcode .= ''. $value['barcode'];
									}
									if(a($value, 'barcode2'))
									{
										$barcode .= '|'. $value['barcode2'];
									}

									$html .= '<div class="p-1" title="'.$barcode.'">';
									{
										$html .= \dash\utility\icon::svg('upc', 'bootstrap', 'DarkGray', 'w-6 h-6');
									}
									$html .= '</div>';
								}

								if(a($value, 'gallery_array', 'files'))
								{
									$html .= '<div class="p-1" title="'.T_("Have gallery").'">';
									{
										$html .= \dash\utility\icon::svg('images', 'bootstrap', 'DarkGray', 'w-5 h-5');
									}
									$html .= '</div>';
								}
							}
							$html .= '</div>';
						}
						$html .= '</div>';
					}
					$html .= '</div>';

					$html .= '<div class="flex-none flex flex-row">';
					{
						$html .= '<div class="flex-grow">';
						{

						}
						$html .= '</div>';
						$html .= '<div class="flex-none p-1">';
						{

							$add_url         = \dash\url::this(). '/add?';
							$add_args        = [];
							$add_args['gid'] = a($value, 'id');

							if(isset($is_barcode_page) && $is_barcode_page)
							{
								$add_args['barcodepage'] = 1;
							}
							$add_args['iframe'] = 1;
							$add_args['ganje'] = 1;

							$add_url .= \dash\request::build_query($add_args);

							$html .= '<a href="'.$add_url.'" target="_blank" data-type="iframe" data-preload="false" data-fancybox class="btn-primary">'. T_("Add"). '</a>';
						}
						$html .= '</div>';
					}
					$html .= '</div>';

				}
				$html .= '</div>';
			}
			$html .= '</div>';

		}
	}

}
$html .= '</div>';

echo $html;
?>