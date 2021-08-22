<?php
namespace content_site\options\remove;


class remove_gallery
{

	public static function specialsave($_data)
	{
		$result = \content_site\body\gallery\option::remove_current_gallery_item();

		if($result)
		{
			\content_site\utility::need_redirect_to_back();
		}
	}


	public static function admin_html()
	{
	    $html = '';
		if(\dash\request::get('index'))
	    {
	     /**
	       * btn remove and hide
	       */
	      $delete_json    = json_encode(['specialsave' => 'specialsave', 'opt_remove_gallery' => 1]);

	      $remove_title = T_("Are you sure to remove this image block?");

	      $html .= '<div class="row w-full mt-10">';
	      $html .= '<div class="cauto">';
	      $html .= "<div tabindex=0 class='inline-block bg-gray-50 transition p-3 rounded-lg' data-confirm data-title='$remove_title' data-data='$delete_json'>";
	      $html .= '<img class="w-8 inline-block" src="'. \dash\utility\icon::url('Delete', 'minor'). '" alt="Delete">';
	      $html .= '<span class="inline-block align-middle ps-2">'. T_("Remove image block").'<span>';
	      $html .= '</div>';
	      $html .= '</div>';
	      $html .= '<div class="c"></div>';
	      $html .= "<div class='cauto os' >";
	      $html .= '</div>';
	      $html .= '</div>';

	    }

		return $html;
	}

}
?>