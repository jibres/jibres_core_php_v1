<?php 
if(!\dash\request::get('index') && \dash\request::get('sid') && !\dash\url::subchild())
{

  /*====================================
  =            Change model            =
  ====================================*/
	$model_url = \dash\url::that(). '/model'. \dash\request::full_get();

	$html .= '<nav class="items long mt-4">';
	{
	    $html .= '<ul>';
	    {
	      $html .= '<li>';
	      {
	          $html .= "<a class='item f' href='$model_url'>";
	          {
	            $html .= '<img class="bg-gray-100 hover:bg-gray-200 p-2" alt="Replace" src="'. \dash\utility\icon::url('Replace'). '">';
	            $html .= '<div class="key">'. T_("Change to another model"). '</div>';
	            $html .= '<div class="go"></div>';
	          }
	          $html .= '</a>';
	      }
	      $html .= '</li>';
	    }
	    $html .= '</ul>';
	}
	$html .= '</nav>';
  /*=====  End of Change model  ======*/

  /*=================================
  =            View/Hide            =
  =================================*/
  $html .= \content_site\options\generate::form();
  {
    $checked_hide_show = false;
    if(a(\dash\data::currentSectionDetail(), 'status_preview') === 'hidden')
    {
      $checked_hide_show = true;
    }
    $html .= \content_site\options\generate::hidden('hide_view', 'toggle');
    $html .= \content_site\options\generate::checkbox('hide_view_check', T_("Hidden"), $checked_hide_show);
  }
  $html .= \content_site\options\generate::_form();
  /*=====  End of View/Hide  ======*/




  /*======================================
  =            Delete section            =
  ======================================*/
  $delete_json    = json_encode(['delete' => 'section']);
  $remove_title = T_("Are you sure to remove this section?");


  $html .= "<div data-confirm data-data='$delete_json' data-title='$remove_title' class='btn-outline-danger  mb-2 flex align-center'>";
  {
    $html .= '<img class="w-5 block" src="'. \dash\utility\icon::url('Delete', 'minor'). '" alt="Delete">';
    $html .= '<span class="px-2">'. T_("Remove section").'</span>';
  }
  $html .= '</div>';
  /*=====  End of Delete section  ======*/







  /*====================================
  =            Download PHP            =
  ====================================*/
  if(\dash\url::isLocal() && \dash\permission::supervisor() && !\dash\url::subchild() && \dash\url::child())
  {
    $downloadSupervisor = \dash\url::current(). \dash\request::full_get(['downloadjson' => 1]);

    $myFile = \dash\url::child(). '-'. \dash\request::get('sid'). '.php';
    $html .= "<a href='$downloadSupervisor' class='btn-outline-secondary btn-sm mb-2 flex align-center' title='".T_("Download PHP")."' download='$myFile' target='_blank'>";
    $html .= '<img class="w-5 block" src="'. \dash\utility\icon::url('Code'). '" alt="Download php">';
        $html .= '<span class="px-2">'. T_("Download Template").'</span>';
    $html .= '</a>';
  }
  /*=====  End of Download PHP  ======*/


}
?>