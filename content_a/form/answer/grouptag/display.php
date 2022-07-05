<?php

$html = '';
$html .= '<div class="justify-center flex"><div class="w-full lg:w-4/5 m-2">';
{

	$html .= '<form method="post" autocomplete="off">';
	{

		$html .= '<div class="avand-md">';
		{


			$html .= '<div  class="box impact mB25-f">';
			{

				$html .= '<header><h2>'. T_("Add tag to all filtered result"). '</h2></header>';
				$html .= '<div class="body">';
				{
					$html .= '<p>';
					{
						$total_rows = \dash\utility\pagination::get_total_rows();
						$html .= '<div class="alert-danger font-bold">'.T_("This tag will be added to :val answer", ['val' => \dash\fit::number($total_rows)]). ' </div>';
					}
					$html .= '</p>';
					$html .= '<div>';
					{
						$html .= '<div class="row align-center">';
						{
							$html .= '<div class="c"><label for="tag">'. T_("Select tag"). '</label></div>';

							$html .= '<div class="c-auto os">';
							{
								$html .= '<a class="text-sm" ';

								if(!\dash\detect\device::detectPWA())
								{
									$html .= " target='_blank' ";
								}

								$html .= ' href="'. \dash\url::this(). '/tag?id='.\dash\request::get('id').'">'. T_("Manage"). ' <i class="sf-link-external"></i></a></div>';
							}
							$html .= '</div>';
						}
						$html .= '<select name="newtag" id="tag" class="select22" data-model="tag" data-placeholder="'. T_("Enter new tag or select one tag") . '"  data-ajax--delay="100" data-ajax--url="';
						$html .=  \dash\url::this(). '/tag/api?id='.\dash\request::get('id').'&json=true">';
						$html .= '</select>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				$html .= '<footer class="txtRa">';
				{
					$html .= '<button  class="btn-success">'. T_("Save"). '</button>';
				}
				$html .= '</footer>';
			}
			$html .= '</div>';

		}
		$html .= '</div>';

	}
	$html .= '</form>';


}
$html .= '</div></div>';

echo $html;
?>