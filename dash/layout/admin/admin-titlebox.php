
<?php
if(\dash\data::page_titleBox() !== false && !\dash\detect\device::detectPWA())
{
?>

<div class="titleBox">
  <div class="f align-center">
    <?php if(\dash\data::back_text() && \dash\data::back_link()) { ?>
      <div class="cauto pRa10">
        <a class="btn master back" href="<?php echo \dash\data::back_link(); ?>"><i class="pRa5 sf-chevron-<?php if(\dash\language::dir() === 'rtl') { echo 'right'; } else { echo 'left'; } ?>"></i><span class="s0"><?php echo \dash\data::back_text(); ?></span></a>
      </div>
    <?php } // ?>

    <div class="c s10 pRa10 pageTitle">
      <h2><?php echo \dash\face::title(); ?></h2>
    </div>
    <nav class="cauto actions">

<?php if(\dash\face::import()) { ?>
      <a class="btn light" href="<?php echo \dash\face::import(); ?>"><i class="pRa5 compact sf-in"></i><span><?php echo T_("Import"); ?></span></a>
<?php } // endif ?>
<?php if(\dash\face::export()) { ?>
      <a class="btn light" href="<?php echo \dash\face::export(); ?>"><i class="pRa5 compact sf-out"></i><span><?php echo T_("Export"); ?></span></a>
<?php } // endif ?>
<?php if(\dash\data::page_duplicate()) { ?>
      <a class="btn light" href="<?php echo \dash\data::page_duplicate(); ?>"><i class="pRa5 compact sf-files-o"></i><span><?php echo T_("Duplicate"); ?></span></a>
<?php } // endif ?>
<?php if(\dash\data::page_view()) { ?>
      <a class="btn light" href="<?php echo \dash\data::page_view(); ?>" target="_blank"><i class="pRa5 compact sf-eye"></i><span><?php echo T_("View"); ?></span></a>
<?php } // endif ?>
<?php if(\dash\face::help()) { ?>
      <a class="btn light" href="<?php echo \dash\face::help(); ?>" target="_blank"><i class="pRa5 compact sf-question-circle"></i><span><?php echo T_("Help"); ?></span></a>
<?php } // endif ?>
    </nav>

<?php if(\dash\data::page_prev() || \dash\data::page_next()) { ?>

    <nav class="cauto os pLa10 nav">
       <a class="btn <?php if(\dash\data::page_prev() === 'disabled') { echo 'disabled'; } ?>" <?php if(\dash\data::page_prev() !== 'disabled') { echo 'href="'. \dash\data::page_prev().'"'; } ?> title='<?php echo T_("Previous item"); ?>'><i class="sf-chevron-<?php if(\dash\language::dir() === 'rtl') { echo 'right'; } else { echo 'left'; } ?>"></i></a>
       <a class="btn <?php if(\dash\data::page_next() === 'disabled') { echo 'disabled'; } ?>" <?php if(\dash\data::page_next() !== 'disabled') { echo 'href="'. \dash\data::page_next().'"'; } ?>  title='<?php echo T_("Next item"); ?>'><i class="sf-chevron-<?php if(\dash\language::dir() === 'rtl') { echo 'left'; } else { echo 'right'; } ?>"></i></a>
    </nav>
<?php } // endif ?>


<?php if(\dash\data::action_text() && \dash\data::action_link()) { ?>
    <nav class="cauto os pLa10">
       <a class="btn master" href="<?php echo \dash\data::action_link(); ?>" data-shortkey="120"><span><?php echo \dash\data::action_text(); ?></span> <kbd>F9</kbd></a>
    </nav>
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


