<?php
namespace content_site\options\link;


trait link_professional
{

	public static function validator($_data)
	{

		$args =
		[
			'pointer'       => a($_data, 'pointer'),
			'url'           => a($_data, 'link'),
			'target'        => a($_data, 'target'),

			'product_id'    => a($_data, 'products_id'),
			'post_id'       => a($_data, 'posts_id'),
			'tag_id'        => a($_data, 'tags_id'),
			'hashtag_id'    => a($_data, 'hashtag_id'),
			'form_id'       => a($_data, 'forms_id'),
			'socialnetwork' => a($_data, 'socialnetwork'),
		];

		$data = \lib\app\menu\check::variable($args, true);

		unset($data['parent1']);
		unset($data['parent2']);
		unset($data['parent3']);
		unset($data['parent4']);
		unset($data['parent5']);

		return [self::db_key() => $data];
	}


	public static function db_key()
	{
		return 'link_professional';
	}

	public static function have_specialsave()
	{
		return false;
	}


	public static function admin_html()
	{
		if(self::have_specialsave())
		{
			$url           = \content_site\section\view::get_current_index_detail('url');
			$pointer       = \content_site\section\view::get_current_index_detail('pointer');
			$target        = \content_site\section\view::get_current_index_detail('target');
			$related_id    = \content_site\section\view::get_current_index_detail('related_id');
			$socialnetwork = \content_site\section\view::get_current_index_detail('socialnetwork');

		}
		else
		{
			$preview       = \dash\data::currentSectionDetail_preview();
			$url           = a($preview, self::db_key(), 'url');
			$pointer       = a($preview, self::db_key(), 'pointer');
			$target        = a($preview, self::db_key(), 'target');
			$related_id    = a($preview, self::db_key(), 'related_id');
			$socialnetwork = a($preview, self::db_key(), 'socialnetwork');
		}

		$html = '';

		$kingdom = \dash\url::kingdom();

		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			if(self::have_specialsave())
			{
				$html .= \content_site\options\generate::specialsave();;
			}

			$option_key = \content_site\utility::className(__CLASS__);

			$html .= \content_site\options\generate::opt_hidden(__CLASS__);

			$html .= "<div class='mb-5'>";
			{

				$html .= "<label for='pointer'>". T_('Hint to'). "</label>";
				$html .= "<select name='pointer' class='select22'>";
				{

					$html .= "<option value=''>". T_('Please select an item'). "</option>";

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
						'selffile'      => ['title' => T_('Self file addr'),'api_link' => null, ],
					];

					foreach ($list as $key => $value)
					{
						$selected = null;
						if($pointer === $key)
						{
							$selected = 'selected';
						}
						$html .= "<option value='$key' $selected>$value[title]</option>";
					}
				}
				$html .= '</select>';
			}
			$html .= '</div>';

			foreach ($list as $key => $value)
			{
				$data_response_hide = 'data-response-hide';
				if($pointer === $key)
				{
					$data_response_hide = null;
				}

				if($key === 'socialnetwork')
				{
					$html .= "<div data-response='pointer' data-response-where='$key' $data_response_hide>";
				   	{
						$social = \lib\store::social();

						$html .= "<select name='socialnetwork' class='select22'>";
						{
				        	$html .= "<option value=''>". T_('Select social network'). "</option>";

				        	foreach ($social as $social_key => $social_value)
				        	{
				        		$selected = null;
				        		if($socialnetwork === $social_key)
				        		{
				        			$selected = 'selected';
				        		}
				          		$html .= "<option value='$social_key' $selected>". a($social_value, 'title'). "</option>";

				        	} // endfor
						}
				      	$html .= "</select>";
				      	$html .= '<div class="msg mt-5">';
				      	{
				      		$html .= T_("Only active socialnetwork can be displayd. To manage you socialnetwork ID");
			          		$html .= " <a class='link' target='_blank' href='". \dash\url::kingdom(). "/a/setting/social'>". T_('Click here'). "</a>";
				      	}
				      	$html .= '</div>';
				    }
				    $html .= '</div>';
				}
				elseif($key === 'homepage')
				{

				}
				elseif($key === 'selffile')
				{

				}
				elseif($key === 'other')
				{
					$html .= "<div data-response='pointer' data-response-where='$key' $data_response_hide>";
					{
						$html .= '<div class="input ltr mb-5">';
						{
				    		$html .= '<input type="url" name="url" value="'. $url. '" placeholder="URL">';
						}
						$html .= "</div>";

						$html .= \content_site\options\generate::checkbox('target', T_('Open in new windows'), $target);

					}
					$html .= '</div>';
				}
				else
				{



				   	$html .= "<div data-response='pointer' data-response-where='$key' $data_response_hide>";
				   	{
				      	$html .= "<select name='{$key}_id' class='select22' id='{$key}search'  data-model='html'  data-ajax--delay='100' data-ajax--url='{$kingdom}$value[api_link]' data-shortkey-search data-placeholder='". T_('Search in :val', ['val' => $value['title']]). "'>";
				      	if($related_id && $pointer === $key)
				      	{
				      		$selected = self::fill_selected($pointer, $related_id);
				          	$html .= "<option value='$selected[id]' selected>$selected[title]</option>";
				      	}

				        $html .= "</select>";
				   	}
				   	$html .= "</div>";
				}
			}
		}
		$html .= "</form>";


		return $html;
	}

	private static function fill_selected($_pointer, $_related_id)
	{
		if(!$_pointer || !$_related_id)
		{
			return;
		}

		$selected_title = null;

		switch ($_pointer)
		{
			case 'products':
				$loadProduct = \lib\app\product\get::get($_related_id);

				if(isset($loadProduct['title']))
				{
					$selected_title = $loadProduct['title'];
				}
				break;

			case 'posts':
				$_related_id = \dash\coding::encode($_related_id);
				$loadPost = \dash\app\posts\get::get($_related_id);
				if(isset($loadPost['title']))
				{
					$selected_title = $loadPost['title'];
				}
				break;

			case 'tags':
				$loadTag = \lib\app\tag\get::get($_related_id);
				if(isset($loadTag['title']))
				{
					$selected_title = $loadTag['title'];
				}
				break;

			case 'hashtag':
				$_related_id = \dash\coding::encode($_related_id);
				$loadHashtag = \dash\app\terms\get::get($_related_id);
				if(isset($loadHashtag['title']))
				{
					$selected_title = $loadHashtag['title'];
				}
				break;

			case 'forms':
				$loadForm = \lib\app\form\form\get::get($_related_id);
				if(isset($loadForm['title']))
				{
					$selected_title = $loadForm['title'];
				}
				break;

			default:
				// code...
				break;
		}

		return ['id' => $_related_id, 'title' => $selected_title];

	}

}
?>