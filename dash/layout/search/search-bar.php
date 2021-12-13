<?php

$html = '';

$html .= '<form method="get" action="'. \dash\data::listEngine_search(). '" autocomplete="off">';
{
	if(\dash\data::listEngine_search())
	{

		$html .= '<div class="searchBox">';
		{
			$html .= '<div class="row">';
			{
				if(\dash\data::listEngine_filter())
				{
					$html .= '<div class="c-auto">';
					{
						$html .= '<a class="btn-light ';
						if(\dash\data::isFiltered())
						{
							$html .=  'apply';
						}
						$html .= '" data-kerkere-icon="close" data-kerkere=".filterBox">'. T_("Filter"). '</a>';
					}
					$html .= '</div>';
				}

				$html .= '<div class="c">';
				{
					$html .= '<div>';
					{
						$html .= '<div class="input search '. (\dash\validate::search_string() ?  'apply' : null). '">';
						{
							$html .= '<input type="search" name="q" placeholder="'. T_("Search"). '" id="q" value="'. \dash\validate::search_string(). '" class="barCode" data-default data-pass="submit" autocomplete="off" >';
							$html .= '<button class="addon btn-light3 s0"><span class="w-5">'. \dash\utility\icon::svg('Search', 'major') . '</span></button>';
						}
						$html .= '</div>';
					}
					$html .= '</div>';
				}
				$html .= '</div>';

				if(\dash\data::listEngine_filter())
				{
					$html .= '<div class="c-2 c-xs-3 sortBox">';
					{
						$html .= '<select class="select22 ';
						if(\dash\request::get('sort') || \dash\request::get('order'))
						{
							$html .= 'apply';
						}

						$html .= '" data-link data-placeholder='. T_("Sort"). '>';
						{
							if(\dash\data::sortList())
							{
								foreach (\dash\data::sortList() as $key => $value)
								{
									$html .= "<option";
									if(a($value, 'clear') === true)
									{
										$html .= ' value=""';
									}
									else
									{
										$html .= ' value="';
										$html .= \dash\url::that();
										if(a($value, 'query_string'))
										{
											$html .= "?". a($value, 'query_string');
										}
										$html .= '"';
									}

									if(\dash\request::get('sort') == a($value, 'query', 'sort') && \dash\request::get('order') == a($value, 'query', 'order'))
									{
										$html .= ' selected';
									}
									$html .= ">";
									$html .= a($value, 'title');
									$html .= "</option>";
								}
							}
						}
						$html .= '</select>';
					}
					$html .= '</div>';
				}
			}
			$html .= '</div>';
		}
		$html .= '</div>';
	}

	if(\dash\data::listEngine_filter())
	{
		$html .= '<div class="filterBox" data-kerkere-content="hide">';
		{
			$html .= \dash\layout\search\search_filter::get_html_filters();
		}
		$html .= '</div>';
	}

		/*=======================================
		=            Fill hidden GET            =
		=======================================*/
		$all_get = \dash\request::get();

		$input_loaded = \dash\layout\search\search_filter::get_form_hidden_input();

		unset($all_get['page']);
		unset($all_get['q']);

		if($all_get)
		{
			foreach ($all_get as $key => $value)
			{
				if(!in_array($key, $input_loaded))
				{
					$html .= '<input type="hidden" name="'. $key. '" value="'. $value .'">';
				}
			}
		}
		/*=====  End of Fill hidden GET  ======*/
}
$html .= '</form>';

echo $html;
?>