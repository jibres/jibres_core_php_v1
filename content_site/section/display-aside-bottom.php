<?php
$remove_block = false;

if(\dash\url::child())
{

  if(\dash\request::get('index'))
  {
    $remove_block = true;
  }

  if(\dash\url::subchild() && \dash\url::subchild() === 'type')
  {
    // in type moudle needless tho show delete or hide button
  }
  else
  {

    $html = '';

    $currentSectionDetail = \dash\data::currentSectionDetail();

    if(a($currentSectionDetail, 'status_preview') === 'deleted')
    {
      //  /**
      //  * btn remove and hide
      //  */
      // $restore_json    = json_encode(['restore' => 'section']);


      // $restore_title = T_("Are you sure to restore this section?");

      // $html .= '<div class="row w-full">';
      // {
      //   $html .= '<div class="cauto">';
      //   {
      //     $html .= "<div class='inline-block bg-gray-50 hover:bg-gray-100 focus:bg-gray-200 active:bg-gray-300 hover:text-red-500 focus:text-red-600 active:text-red-700 transition p-2 rounded-lg' data-confirm data-title='$restore_title' data-data='$restore_json'>";
      //     {
      //       $html .= '<img class="w-5 block" src="'. \dash\utility\icon::url('Redo', 'major'). '" alt="Delete">';
      //       $html .= '<span class="inline-block align-middle ps-2">'. T_("Restore section").'</span>';
      //     }
      //     $html .= '</div>';
      //   }
      //   $html .= '</div>';

      //   $html .= '<div class="c"></div>';

      //   $html .= "<div class='cauto os'>";
      //   {

      //   }
      //   $html .= '</div>';

      // }
      // $html .= '</div>';

    }
    elseif(!$remove_block && \dash\request::get('sid'))
    {
      /**
       * btn remove and hide
       */
      $delete_json    = json_encode(['delete' => 'section']);
      $hide_view_json = json_encode(['hide_view' => 'toggle']);

      $remove_title = T_("Are you sure to remove this section?");

      if(\dash\url::isLocal() && \dash\permission::supervisor() && !\dash\url::subchild() && \dash\url::child())
      {
        $downloadSupervisor = \dash\url::current(). \dash\request::full_get(['downloadjson' => 1]);

        $myFile = \dash\url::child(). '-'. \dash\request::get('sid'). '.php';
        $html .= "<a href='$downloadSupervisor' class='btn-outline-warning btn-sm mb-2 flex align-center' title='".T_("Download PHP")."' download='$myFile' target='_blank'>";
        $html .= '<img class="w-5 block" src="'. \dash\utility\icon::url('Code'). '" alt="Download php">';
            $html .= '<span class="px-2">'. T_("Download Template").'</span>';
        $html .= '</a>';
      }

      $html .= '<div class="flex w-full">';
      {
        $html .= '<div class="cauto">';
        {
          $html .= "<div class='inline-block flex align-center bg-gray-50 transition p-2 rounded-lg cursor-pointer' data-confirm data-title='$remove_title' data-data='$delete_json'>";
          {
            $html .= '<img class="w-5" src="'. \dash\utility\icon::url('Delete', 'minor'). '" alt="Delete">';
            $html .= '<span class="px-2">'. T_("Remove section").'</span>';
          }
          $html .= '</div>';
        }
        $html .= '</div>';




        $html .= "<div class='cauto os pLa5'>";
        {
          $html .= "<a class='inline-block bg-gray-50 hover:bg-gray-100 focus:bg-gray-200 active:bg-gray-300 transition p-2 rounded-lg' data-ajaxify data-data='$hide_view_json' title='". T_("Hide/Show") ."'>";
          {
            if(a(\dash\data::currentSectionDetail(), 'status_preview') === 'hidden')
            {
              $html .= '<img class="w-5 block" src="'. \dash\utility\icon::url('hide', 'minor'). '" alt="hide">';
            }
            elseif(in_array(a(\dash\data::currentSectionDetail(), 'status_preview'), ['enable', 'draft', null]))
            {
              $html .= '<img class="w-5 block" src="'. \dash\utility\icon::url('view', 'minor'). '" alt="view">';
            }
          }
          $html .= '</a>';

        }
        $html .= '</div>';

      }
      $html .= '</div>';

    }


    echo $html;

  }
}
?>