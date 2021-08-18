<?php

$html     = '';

$html .= '<div data-xhr="sitebuilderOptionXhr">';

if(\dash\data::sidebarSectionList())
{
 require_once('part/preview_list.php');
}
elseif(\dash\data::groupSectionList())
{
  if(\dash\data::changeSectionTypeMode())
  {
    // nothing
  }
  else
  {
   require_once('part/section_group.php');
  }
}
else
{
  /**
   * Load options of one section
   */

  $currentSectionDetail = \dash\data::currentSectionDetail();

  if(a($currentSectionDetail, 'status_preview') === 'deleted')
  {
     require_once('part/restore.php');
  }
  else
  {

    $options_list = \dash\data::currentOptionList();
    $child        = \dash\url::child();
    $subchild     = \dash\url::subchild();
    $folder       = \dash\data::currentSectionDetail_mode();

    if($subchild && isset($options_list[$subchild]) && is_array($options_list[$subchild]))
    {
      foreach ($options_list[$subchild] as $key => $option)
      {
        if($option === 'background_pack')
        {
          $html .= \content_site\call_function::option_admin_html($option, $currentSectionDetail);
          break;
        }
        else
        {
          $html .= \content_site\call_function::option_admin_html($option, $currentSectionDetail);

        }
      }
    }
    elseif(is_array($options_list))
    {
      foreach ($options_list as $key => $option)
      {
        if(is_string($option))
        {
          $html .= \content_site\call_function::option_admin_html($option, $currentSectionDetail);
        }
        elseif(is_array($option))
        {
          $html .= \content_site\call_function::option_admin_html($key, $currentSectionDetail);
        }
      }

    }
  }

 require_once('part/discard.php');
}

$html .= '</div>';

echo $html;


require_once('part/download_php.php');
?>