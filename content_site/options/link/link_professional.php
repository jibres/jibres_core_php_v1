<?php
namespace content_site\options\link;


class link_professional
{

	public static function validator($_data)
	{

		$args =
		[
			'pointer'       => a($_data, 'pointer'),
			'url'           => a($_data, 'url'),
			'target'        => a($_data, 'target'),
			'product_id'    => a($_data, 'products_id'),
			'post_id'       => a($_data, 'posts_id'),
			'page_id'       => a($_data, 'pages_id'),
			'category_id'   => a($_data, 'category_id'),
			'hashtag_id'    => a($_data, 'hashtag_id'),
			'form_id'       => a($_data, 'forms_id'),
			'socialnetwork' => a($_data, 'socialnetwork'),
		];

		$data = \lib\app\menu\check::variable($args, true);

		if(a($_data, 'umenufile') === 'umenufile')
		{
			$file_path = \dash\upload\website::upload_everything('menufile');

			if($file_path)
			{
				$data['url'] = $file_path;

				\content_site\utility::need_redirect(true);
			}
			else
			{
				return false;
			}
		}

		unset($data['parent1']);
		unset($data['parent2']);
		unset($data['parent3']);
		unset($data['parent4']);
		unset($data['parent5']);
		unset($data['title']);
		unset($data['target']);
		unset($data['sort']);
		unset($data['for']);
		unset($data['for_id']);
		unset($data['file']);
		unset($data['description']);


		\dash\notif::tada('#linkProfessionalPreview',  self::html_preview_link($data));


		return [static::db_key() => $data];
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

		if(static::have_specialsave())
		{
			$url           = \content_site\section\view::get_current_index_detail('url');
			$pointer       = \content_site\section\view::get_current_index_detail('pointer');
			$target        = \content_site\section\view::get_current_index_detail('target');
			$related_id    = \content_site\section\view::get_current_index_detail('related_id');
			$socialnetwork = \content_site\section\view::get_current_index_detail('socialnetwork');

		}
		else
		{
			$my_detail     = \content_site\section\view::get_current_index_detail();

			$url           = a($my_detail, static::db_key(), 'url');
			$pointer       = a($my_detail, static::db_key(), 'pointer');
			$target        = a($my_detail, static::db_key(), 'target');
			$related_id    = a($my_detail, static::db_key(), 'related_id');
			$socialnetwork = a($my_detail, static::db_key(), 'socialnetwork');

		}

		$link_detail =
		[
			'url'           => $url,
			'pointer'       => $pointer,
			'target'        => $target,
			'related_id'    => $related_id,
			'socialnetwork' => $socialnetwork,
		];

		$html = '';

		$kingdom = \dash\url::kingdom();

		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			if(static::have_specialsave())
			{
				$html .= \content_site\options\generate::specialsave();;
			}

			// $option_key = \content_site\utility::className(get_called_class());

			$html .= \content_site\options\generate::opt_hidden(get_called_class());

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
						'pages'         => ['title' => T_('Site Builder'),	'api_link' => '/cms/posts/api?json=true&ptype=page', ],
						'posts'         => ['title' => T_('Posts'),			'api_link' => '/cms/posts/api?json=true', ],
						'category'      => ['title' => T_('Categories'),	'api_link' => '/a/category/api?json=true&getid=1', ],
						'hashtag'       => ['title' => T_('Hashtag'),		'api_link' => '/cms/hashtag/api?json=true&getid=1', ],
						'forms'         => ['title' => T_('Forms'),			'api_link' => '/a/form/api?json=true', ],
						'socialnetwork' => ['title' => T_('Socialnetwork'),	'api_link' => null, ],
						'other'         => ['title' => T_('Other'),			'api_link' => null, ],
						'file'          => ['title' => T_('File'),'api_link' => null, ],
						// 'selffile'      => ['title' => T_('Self file addr'),'api_link' => null, ],
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
				elseif($key === 'file')
				{
					$html .= "<div data-response='pointer' data-response-where='$key' $data_response_hide>";
					{
						$html .= \content_site\options\generate::hidden('umenufile', 'umenufile');


						$html .= '<div data-uploader data-name="menufile" data-final="#finalImage" data-autoSend data-file-max-size="'. \dash\data::maxFileSize(). '"';
						if($url)
						{
							$html .=  "data-fill";
						}

						$html .= '>';
						{

							$html .= '<input type="file" accept="image/jpeg, image/png" id="image1">';
							$html .= '<label for="image1">'. T_('Drag &amp; Drop your files or Browse'). '</label>';

							if($url)
							{
								$myExt = substr($url, -3);
								if(in_array($myExt, ['png', 'jpg', 'gif']))
								{
									$html .= '<label for="image1"><img id="finalImage" src="'. \lib\filepath::fix($url). '" alt="File"></label>';
									// $html .= '<span class="imageDel" data-confirm data-data=\'{"deletefile" : 1}\'></span>';
								}
							}
							else
							{
								$html .= '<label for="image1"><img id="finalImage" alt="File"></label>';
							}
						}
						$html .= '</div>';
					}
					$html .= '</div>';
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

						// $html .= \content_site\options\generate::checkbox('target', T_('Open in new windows'), $target);

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
				      		$selected = static::fill_selected($pointer, $related_id);
				          	$html .= "<option value='$selected[id]' selected>$selected[title]</option>";
				      	}

				        $html .= "</select>";
				   	}
				   	$html .= "</div>";
				}
			}

			$html .= self::html_preview_link($link_detail);

		}
		$html .= "</form>";


		return $html;
	}


	/**
	 * Generate html of preview link
	 * call in spesical save function
	 *
	 * @param      <type>  $_link_detail  The link detail
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function html_preview_link($_link_detail)
	{
		$html = '';
		$link = \content_site\assemble\link::generate($_link_detail, true);
		if($link)
		{
			$html .= '<div id="linkProfessionalPreview">';
			{
				$html .= '<a class="btn-light block mt-2" href="'. $link . '" target="_blank">';
				{
					$html .= \dash\utility\icon::svg('box-arrow-up-right', 'bootstrap', null, 'w-4 mx-2');
					$html .= T_('View link');
				}
				$html .= '</a>';
			}
			$html .= '</div>';
		}

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
			case 'pages':
				$_related_id = \dash\coding::encode($_related_id);
				$loadPost = \dash\app\posts\get::get($_related_id);
				if(isset($loadPost['title']))
				{
					$selected_title = $loadPost['title'];
				}
				break;

			case 'category':
				$loadCategory = \lib\app\category\get::get($_related_id);
				if(isset($loadCategory['title']))
				{
					$selected_title = $loadCategory['title'];
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