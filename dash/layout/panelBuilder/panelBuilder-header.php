<?php
$html = '';

$html .= '<div class="h-full flex flex-wrap content-center px-3">';
{
  $html .= '<div class="backBtn">';
  {

    $html .= '<a class="btn-light btn-sm" href="'. \dash\data::back_link(). '" ';
    if(\dash\data::back_direct())
    {
      $html .= 'data-direct';
    }
    $html .= '>';
    {

      if(\dash\language::dir() === 'rtl')
      {
       $html .= \dash\utility\icon::svg('ChevronRight', 'minor');
      }
      else
      {
       $html .= \dash\utility\icon::svg('ChevronLeft', 'minor');
      }

      $html .= '<span class="px-1">'. \dash\data::back_text(). '</span>';
    }
    $html .= '</a>';
  }
  $html .= '</div>';

  $html .= '<div class="flex-grow px-5 font-bold">'. \dash\face::title(). '</div>';

  $html .= '<div class="actionBtn">';
  {

    if(\dash\data::action_link() && \dash\data::action_text())
    {
      $html .= '<a href="'. \dash\data::action_link(). '" class="btn-secondary">'. \dash\data::action_text(). '</a>';
    }

    if(\dash\data::btnSaveSiteBuilder())
    {
      $html .= '<form method="post" autocomplete="off" action="'. \dash\url::here(). '/page?id='. \dash\request::get('id'). '">';
      {
        $html .= '<input type="hidden" name="savepage" value="savepage">';
        $html .= '<button class="btn-primary">'. T_("Save & Publish"). '</button>';
      }
      $html .= '</form>';
    }
    if(\dash\data::btnSaveSiteBuilderHtml())
    {
      $html .= '<button form="savehtmlform" class="btn-secondary">'. T_("Save HTML"). '</button>';
    }
    if(\dash\data::btnSaveSiteBuilderEditor())
    {
      $html .= '<button form="sectioneditorhtml" class="btn-secondary">'. T_("Save Text"). '</button>';
    }

    if(\dash\face::btnSave())
    {
      $html .= '<button class="btn-success" form="';
      $html .= \dash\face::btnSave();
      $html .= '"';

      if(\dash\face::btnSaveName())
      {
        $btnSaveName = \dash\face::btnSaveName();
      }
      else
      {
        $btnSaveName = 'submitall';
      }

      $html .= " name='".$btnSaveName. "'";

      if(\dash\face::btnSaveValue())
      {
        $html .= " value='". \dash\face::btnSaveValue(). "'";
      }

      $html .= '>';

      if(\dash\face::btnSaveText())
      {
        $html .= \dash\face::btnSaveText();
      }
      else
      {
        $html .= T_("Save");
      }
      $html .= "</button>";

    }

  }
  $html .= '</div>';

}
$html .= '</div>';


echo $html;
?>