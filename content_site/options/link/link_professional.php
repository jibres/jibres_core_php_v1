<?php
namespace content_site\options\link;


trait link_professional
{

	public static function validator($_data)
	{
		$data = \dash\validate::absolute_url($_data, true);
		return $data;
	}

	public static function db_key()
	{
		return 'link';
	}

	public static function option_key()
	{
		return 'link_professional';
	}

	public static function have_specialsave()
	{
		return false;
	}


	public static function admin_html()
	{
		$link    = \content_site\section\view::get_current_index_detail('link');
		$pointer = \content_site\section\view::get_current_index_detail('pointer');
		$target  = \content_site\section\view::get_current_index_detail('target');
		$target  = \content_site\section\view::get_current_index_detail('target');

		$html = '';

		$kingdom = \dash\url::kingdom();

		$html .= "<form method='post'  autocomplete='off'>";
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			if(self::have_specialsave())
			{
				$html .= '<input type="hidden" name="specialsave" value="specialsave">';
			}

			$option_key = self::option_key();

			$html .= "<input type='hidden' name='opt_{$option_key}' value='1'>";

			$html .= "<div class='mb-5'>";
			{

				$html .= "<label for='pointer'>". T_('Hint to'). "</label>";
				$html .= "<select name='pointer' class='select22'>";
				{

					$html .= "<option value='>". T_('Please select an item'). "</option>";

					$list =
					[
						'homepage'      => ['title' => T_('Homepage'),		'api_link' => null, ],
						'products'      => ['title' => T_('Products'),		'api_link' => '/a/products/api?json=true', ],
						'posts'         => ['title' => T_('Posts'),			'api_link' => '/cms/posts/api?json=true', ],
						'tags'          => ['title' => T_('Tags'),			'api_link' => '/a/tag/api?json=true&getid=1', ],
						'hashtag'       => ['title' => T_('Hashtag'),		'api_link' => '/cms/hashtag/api?json=true&getid=1', ],
						'forms'         => ['title' => T_('Forms'),			'api_link' => '/a/form/api?json=true', ],
						'socialnetwork' => ['title' => T_('Socialnetwork'),	'api_link' => null, ],
						'other'         => ['title' => T_('Other'),			'api_link' => null, ],
					];

					foreach ($list as $key => $value)
					{
						$selected = null;
						$html .= "<option value='$key' $selected>$value[title]</option>";
					}
				}
				$html .= '</select>';
			}
			$html .= '</div>';

			foreach ($list as $key => $value)
			{
				if($key === 'socialnetwork')
				{
					$html .= "<div data-response='pointer' data-response-where='$key' $data_response_hide>";
				   	{
						$social = \lib\store::social();

						$html .= "<select name='socialnetwork' class='select22'>";
						{
				        	$html .= "<option value='>". T_('Select social network'). "</option>";

				        	foreach ($social as $key => $value)
				        	{
				        		$selected = null;
				          		$html .= "<option value='$key' $selected>". a($value, 'title'). "</option>";

				        	} // endfor
						}
				      	$html .= "</select>";
			          	// <a class='btn link' href='<?php echo \dash\url::kingdom(). '/a/setting/social''>". T_('Click here'). "</a>
				    }
				    $html .= '</div>';
				}
				elseif($key === 'homepage')
				{

				}
				elseif($key === 'other')
				{
					$html .= "<div data-response='pointer' data-response-where='$key' $data_response_hide>";
					{
						$html .= '<div class="input ltr mb-5">';
						{
				    		$html .= '<input type="url" name="opt_link_raw" value="'. $link. '" placeholder="URL">';
						}
						$html .= "</div>";

						$html .= '<div class="check1 py-0">';
						{
							$html .= '<input type="checkbox" name="target" id="target"'.$target.'>';
							$html .= '<label for="target">'. T_('Open in new windows'). '</label>';
						}
						$html .= '</div>';
					}
					$html .= '</div>';
				}
				else
				{

					$data_response_hide = 'data-response-hide';
					if($pointer === $key)
					{
						$data_response_hide = null;
					}

				   	$html .= "<div data-response='pointer' data-response-where='$key' $data_response_hide>";
				   	{
				      	$html .= "<select name='{$key}_id' class='select22' id='{$key}search'  data-model='html'  data-ajax--delay='100' data-ajax--url='{$kingdom}$value[api_link]' data-shortkey-search data-placeholder='". T_('Search in :val', ['val' => $value['title']]). "'>";
				          // <option value='<?php echo \dash\coding::encode(\dash\data::dataRow_related_id()). "' selected><?php echo \dash\data::postTitle(). "</option>

				        $html .= "</select>";
				   	}
				   	$html .= "</div>";
				}
			}
		}
		$html .= "</form>";


		return $html;
	}

}
?>