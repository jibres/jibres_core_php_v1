<?php
namespace dash\layout\m2;



class pageNav
{
  public static function html()
  {
    if(\dash\face::boxTitle() === false)
    {
      return null;
    }

    $html = '<div class="titleBox-v2 h-10 mb-2.5">';
    {
      $html .= '<div class="flex flex-wrap content-center align-center">';
      {
        if(\dash\data::back_text() && \dash\data::back_link())
        {
          $html .= self::backBtn();
        }
        $html .= '<div class="flex-grow px-5 font-bold">'. \dash\face::title(). '</div>';
        // actionGroup
        $html .= '<nav class="actionExtra flex-none mx-1">';
        {
          $html .= self::btn(\dash\face::btnImport(), T_("Import"), ['icon' => 'import', 'iconGroup' => 'minor']);
          $html .= self::btn(\dash\face::btnExport(), T_("Export"), ['icon' => 'export', 'iconGroup' => 'minor']);
          $html .= self::btn(\dash\face::btnNew(), T_("New"), ['icon' => 'add']);
          $html .= self::btn(\dash\face::btnDuplicate(), T_("Duplicate"), ['icon' => 'duplicate', 'iconGroup' => 'minor']);
          $html .= self::btn(\dash\face::btnSetting(), T_("Advance"),  ['icon' => 'tools']);
          $html .= self::btn(\dash\face::btnPreview(), T_("Preview"),  ['icon' => 'view', 'iconGroup' => 'minor', 'special' => 'preview']);
          $html .= self::btn(\dash\face::btnPrint(), T_("Print"),  ['icon' => 'print', 'iconGroup' => null, 'special' => 'print']);
          $html .= self::btn(\dash\face::btnView(), T_("View"),  ['icon' => 'view', 'iconGroup' => null, 'special' => 'view']);
          $html .= self::btn(\dash\face::help(), T_("Help"),  ['icon' => 'Question Mark', 'iconGroup' => 'minor', 'special' => 'help']);
        }
        $html .= '</nav>';
        if(\dash\face::btnPrev() || \dash\face::btnNext() or 1)
        {
          $html .= self::nextPrevBtn();
        }

        if(\dash\face::btnSave() || \dash\face::btnInsert() || \dash\data::action_link())
        {
          $html .= '<nav class="actionPrimary flex justify-between">';
          if(\dash\data::action_text() && \dash\data::action_link())
          {
            $btnClass = "btn-primary";
            $html .= '<a class="'. $btnClass. '" href="'. \dash\data::action_link(). '" data-shortkey="120"><span>'. \dash\data::action_text(). '</span>';
            $html .= ' <kbd class="mx-1">F9</kbd></a>';
          }
          if(\dash\face::btnSave())
          {
            $html .= self::saveBtn();
          }
          if(\dash\face::btnInsert())
          {
            $html .= self::insertBtn();
          }
          $html .= '</nav>';
        }
      }
      $html .= '</div>';
    }
    $html .= '</div>';

    return $html;
  }


  private static function backBtn()
  {
    $html = '';
    $html .= '<div class="flex-none backBtn">';
    {
      $desc = T_("Press F8 to go back");
      $html .= '<a class="btn-light btn-icon btn-sm" data-shortkey="119" title="'. $desc. '" href="'. \dash\data::back_link(). '" ';
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
        $html .= '<span>'. \dash\data::back_text(). '</span>';
        // $html .= '<kbd class="mx-1">F8</kbd>';

      }
      $html .= '</a>';
    }
    $html .= '</div>';
    return $html;
  }


  private static function btn($_link, $_text = null, $_arg = null)
  {
    $html = '';
    if($_link)
    {
      $html .= '<a';
      {
        $html .= ' class="btn-light btn-icon btn-sm mx-0.5 my-0.5';
        if($_link === 'disabled')
        {
          $html .= ' disabled';
        }
        $html .= '"';
        if($_link)
        {
          $html .= ' href="'. $_link. '"';
        }

        if(a($_arg, 'desc'))
        {
          $html .= ' title="'. a($_arg, 'desc'). '"';
        }

        switch (a($_arg, 'special'))
        {
          case 'preview':
            $html .= ' target="_blank" data-type="iframe" data-preload="false" data-fancybox="btnPreview"';
            break;

          case 'view':
            $html .= ' target="_blank" data-type="iframe" data-preload="false" data-fancybox="btnView"';
            break;

          case 'help':
            $html .= ' target="_blank"';
            break;

          case 'print':
            $html .= ' data-exec="print"';
            break;

          default:
            break;
        }
        $html .= '>';
        $html .= \dash\utility\icon::svg(a($_arg, 'icon'), a($_arg, 'iconGroup'));
        if($_text)
        {
          $html .= '<span>'. $_text. '</span>';
        }
      }
      $html .= '</a>';
    }
    return $html;
  }


  private static function saveBtn()
  {
    $html = '';
    $desc = T_("Press F4 to save");
    $html .= '<button class="btn-success btnSave" data-shortkey="115" title="'. $desc. '"';
    if(\dash\face::btnSave())
    {
      $html .= ' form="'. \dash\face::btnSave(). '"';
    }
    $html .= " name='submitall'";
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
    // $html .= ' <kbd class="mx-1">F4</kbd>';
    $html .= "</button>";

    return $html;
  }


  private static function insertBtn()
  {
    $html = '';
    $desc = T_("Press F4 to add");
    $html .= '<button class="btn-primary btnInsert" data-shortkey="115" title="'. $desc. '"';
    if(\dash\face::btnInsert())
    {
      $html .= ' form="'. \dash\face::btnInsert(). '"';
    }
    $html .= " name='submitall'";
    if(\dash\face::btnSaveValue())
    {
      $html .= " value='". \dash\face::btnSaveValue(). "'";
    }
    $html .= '>';
    if(\dash\face::btnInsertValue())
    {
      $html .= \dash\face::btnInsertValue();
    }
    else
    {
      $html .= T_("Add");
    }
    // $html .= ' <kbd class="mx-1">F4</kbd>';
    $html .= "</button>";

    return $html;
  }


  private static function nextPrevBtn()
  {
    $nextIcon = 'Arrow Right';
    $prevIcon = 'Arrow Left';
    if(\dash\language::dir() === 'rtl')
    {
      $nextIcon = 'Arrow Left';
      $prevIcon = 'Arrow Right';
    }

    $html = '';
    $html .= '<nav class="actionNextPrev mx-1">';
    {
      $html .= self::btn(\dash\face::btnPrev(), 'P', ['icon' => $prevIcon, 'iconGroup' => 'minor', 'desc' => T_("Previous item")]);
      $html .= self::btn(\dash\face::btnNext(), 'N', ['icon' => $nextIcon, 'iconGroup' => 'minor', 'desc' => T_("Next item")]);
    }
    $html .= '</nav>';
    return $html;
  }

}