<?php
namespace content_site\options\checklist;


class checklist_remove
{

	public static function admin_html()
	{
	    $html = '';
		if(\dash\request::get('index'))
	    {
	     /**
	       * btn remove and hide
	       */
	      $delete_json    = json_encode(['delete' => 'block', 'opt_checklist_remove' => 1]);

	      $remove_title = T_("Are you sure to remove this checklist block?");
	      $html .= '<div class="text-left pt-5">';
	      {
	      	$html .= "<div class='btn-outline-danger mx-auto btn-wide' data-confirm data-title='$remove_title' data-data='$delete_json' >".T_("Remove checklist block")."</div>";
	      }
	      $html .= '</div>';

	    }

		return $html;
	}

}
?>