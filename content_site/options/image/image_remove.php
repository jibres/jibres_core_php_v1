<?php
namespace content_site\options\image;


class image_remove
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
	      $html .= '<div class="text-left pt-5">';
	      {
	      	$html .= "<div class='btn-outline-danger mx-auto btn-wide' data-confirm data-title='$remove_title' data-data='$delete_json' >".T_("Remove image block")."</div>";
	      }
	      $html .= '</div>';

	    }

		return $html;
	}

}
?>