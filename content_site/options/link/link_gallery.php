<?php
namespace content_site\options\link;


class link_gallery
{

	use link_professional;

	public static function specialsave($_data)
	{

		$args =
		[
			'pointer'       => a($_data, 'pointer'),
			'url'           => a($_data, 'url'),
			'target'        => a($_data, 'target'),

			'product_id'    => a($_data, 'products_id'),
			'post_id'       => a($_data, 'posts_id'),
			'page_id'       => a($_data, 'pages_id'),
			'category_id'   => a($_data, 'tags_id'),
			'hashtag_id'    => a($_data, 'hashtag_id'),
			'form_id'       => a($_data, 'forms_id'),
			'socialnetwork' => a($_data, 'socialnetwork'),
		];

		return \content_site\body\gallery\option::update_one_gallery_item($args);
	}


	public static function have_specialsave()
	{
		return true;
	}

}
?>