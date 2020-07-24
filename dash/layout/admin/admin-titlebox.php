
<?php
if(\dash\face::boxTitle() !== false)
{
?>
  <div class="titleBox">
   <div class="row padLess align-center">
<?php if(\dash\data::back_text() && \dash\data::back_link()) { ?>
    <div class="c-auto">
     <a class="btn master back" href="<?php echo \dash\data::back_link(); ?>"><i class="pRa5 sf-chevron-<?php if(\dash\language::dir() === 'rtl') { echo 'right'; } else { echo 'left'; } ?>"></i><span class="s0"><?php echo \dash\data::back_text(); ?></span></a>
    </div>
    <?php } // ?>
    <div class="c pageTitle">
     <h2><?php echo \dash\face::title(); ?></h2>
    </div>
    <nav class="c-auto actions">
<?php if(\dash\face::btnImport()) { ?>
     <a class="btn light" href="<?php echo \dash\face::btnImport(); ?>"><i class="pRa5 compact sf-in"></i><span><?php echo T_("Import"); ?></span></a>
<?php } // endif ?>
<?php if(\dash\face::btnExport()) { ?>
     <a class="btn light" href="<?php echo \dash\face::btnExport(); ?>"><i class="pRa5 compact sf-out"></i><span><?php echo T_("Export"); ?></span></a>
<?php } // endif ?>
<?php if(\dash\face::btnDuplicate()) { ?>
     <a class="btn light" href="<?php echo \dash\face::btnDuplicate(); ?>"><i class="pRa5 compact sf-files-o"></i><span><?php echo T_("Duplicate"); ?></span></a>
<?php } // endif ?>
<?php if(\dash\face::btnSetting()) { ?>
     <a class="btn light" href="<?php echo \dash\face::btnSetting(); ?>"><i class="pRa5 compact sf-gear"></i><span><?php echo T_("Setting"); ?></span></a>
<?php } // endif ?>
<?php if(\dash\face::btnPreview()) { ?>
     <a class="btn light" href="<?php echo \dash\face::btnPreview(); ?>" target="_blank"><i class="pRa5 compact sf-binoculars"></i><span><?php echo T_("Preview"); ?></span></a>
<?php } // endif ?>
<?php if(\dash\face::btnView()) { ?>
     <a class="btn light" href="<?php echo \dash\face::btnView(); ?>" target="_blank"><i class="pRa5 compact sf-eye"></i><span><?php echo T_("View"); ?></span></a>
<?php } // endif ?>
<?php if(\dash\face::help()) { ?>
     <a class="btn light" href="<?php echo \dash\face::help(); ?>" target="_blank"><i class="pRa5 compact sf-question-circle"></i><span><?php echo T_("Help"); ?></span></a>
<?php } // endif ?>
    </nav>
<?php if(\dash\face::btnPrev() || \dash\face::btnNext()) { ?>
    <nav class="c-auto os nav">
     <a class="btn light <?php if(\dash\face::btnPrev() === 'disabled') { echo 'disabled'; } ?>" <?php if(\dash\face::btnPrev() !== 'disabled') { echo 'href="'. \dash\face::btnPrev().'"'; } ?> title='<?php echo T_("Previous item"); ?>'><i class="sf-chevron-<?php if(\dash\language::dir() === 'rtl') { echo 'right'; } else { echo 'left'; } ?>"></i></a>
     <a class="btn light <?php if(\dash\face::btnNext() === 'disabled') { echo 'disabled'; } ?>" <?php if(\dash\face::btnNext() !== 'disabled') { echo 'href="'. \dash\face::btnNext().'"'; } ?>  title='<?php echo T_("Next item"); ?>'><i class="sf-chevron-<?php if(\dash\language::dir() === 'rtl') { echo 'left'; } else { echo 'right'; } ?>"></i></a>
    </nav>
<?php } // endif ?>
<?php if(\dash\data::action_text() && \dash\data::action_link()) { ?>
    <nav class="c-auto os">
     <a class="btn master" href="<?php echo \dash\data::action_link(); ?>" data-shortkey="120"><span><?php echo \dash\data::action_text(); ?></span> <kbd>F9</kbd></a>
    </nav>
<?php } // endif ?>
<?php if(\dash\face::btnSave()) { ?>
    <nav class="c-auto os btnSave"><?php
  echo '<button class="btn master save" form="';
  echo \dash\face::btnSave();
  echo '"';
  echo " name='submitall'";
  if(\dash\face::btnSaveValue())
  {
    echo " value='". \dash\face::btnSaveValue(). "'";
  }
  echo '>';
  if(\dash\face::btnSaveText())
  {
    echo \dash\face::btnSaveText();
  }
  else
  {
    echo T_("Save");
  }
  echo "</button>";
 ?></nav>
<?php } // endif ?>
   </div>
<?php if(\dash\face::breadcrumb() && false)  {?>
   <nav class="breadcrumb">
    <?php foreach (\dash\face::breadcrumb() as $key => $value)
    {
      echo '<a';
      if(isset($value['link']) && $value['link'])
      {
        echo ' href="'. $value['link']. '"';
      }

      if(isset($value['title']) && $value['title'])
      {
        echo ' title="'. $value['title']. '"';
      }


      if(isset($value['attr']) && $value['attr'])
      {
        echo $value['attr'];
      }

      echo '>';

      if(isset($value['icon']) && $value['icon'])
      {
        echo '<span class="sf-'. $value['icon'].' mRa5"></span>';
      }

      if(isset($value['text']))
      {
        echo $value['text'];
      }

      echo '</a>';
    }
    ?>
   </nav>
<?php } // endif ?>
  </div>
<?php } // endif ?>
