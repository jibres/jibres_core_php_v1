<?php
$html = '';
$html .= '<div class="flex mt-10">';
$html .= '<div class="m-auto w-96">';
{
	if(\dash\data::ganjeSearch())
	{
		foreach (\dash\data::ganjeSearch() as $key => $value)
		{
			$html .= '<div class="box">';
			{
				$html .= '<div class="pad">';
				{
					$html .= '<div class="row">';
					{
						$html .= '<div class="c">';
						{

							if(a($value, 'thumb'))
							{
								$html .= '<img class="w-10 h-10" src="'. a($value, 'thumb'). '" alt="'.a($value, 'title').'">';
							}
							$html .= a($value, 'title');
						}
						$html .= '</div>';

						$html .= '<div class="cauto">';
						{

							$add_url         = \dash\url::this(). '/add?';
							$add_args        = [];
							$add_args['gid'] = a($value, 'id');

							if(isset($is_barcode_page) && $is_barcode_page)
							{
								$add_args['barcodepage'] = 1;
							}
							$add_args['iframe'] = 1;

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
$html .= '</div>';

echo $html;
?>