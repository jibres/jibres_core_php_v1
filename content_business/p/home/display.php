<div class="avand productPage">
  <div class="box">
      <div class="row">
        <div class="c-xs-12 c-auto">
          <?php require_once('blocks/gallery.php'); ?>
        </div>
        <div class="c-xs-12 c">
          <?php require_once('blocks/detail.php'); ?>
      </div>
  </div>

  <?php if(\dash\data::dataRow_desc()) {?><div class="box productDesc"><?php echo \dash\data::dataRow_desc();?></div><?php } //endif ?>
  <div class="box shareBox">
    <nav class="row align-center">
      <div class="c">
        <a data-copy="<?php echo \dash\url::kingdom(). '/p/'. \dash\data::dataRow_id(); ?>" href="<?php echo \dash\url::kingdom(). '/p/'. \dash\data::dataRow_id(); ?>"><?php echo T_("Product Code"); ?> <span class="txtB"><?php echo \dash\fit::number(\dash\data::dataRow_id()); ?></span></a>
      </div>
      <div class="c-auto share1">
        <a target="_blank" title='<?php echo T_("facebook"); ?>' href="https://www.facebook.com/sharer/sharer.php?u=<?php echo \dash\url::pwd(); ?>" class="facebook">
          <?php echo \dash\face::site(); ?> <?php echo T_("facebook"); ?>
        </a>

        <a target="_blank" title='<?php echo T_("twitter"); ?>' href="https://twitter.com/intent/tweet?url=<?php echo urlencode(\dash\url::pwd()); ?>&amp;text=<?php echo urlencode(\dash\face::desc()); ?>" class="twitter">
          <?php echo \dash\face::site(). ' '. T_("twitter"); ?>
        </a>

        <a target="_blank" title='<?php echo T_("linkedin"); ?>' href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo \dash\url::pwd(); ?>&amp;title=<?php echo urlencode(\dash\face::title()); ?>&amp;summary=<?php echo urlencode(\dash\face::desc()); ?>" class="linkedin">
          <?php echo \dash\face::site(). ' '. T_("linkedin"); ?>
        </a>

        <a target="_blank" title='<?php echo T_("telegram"); ?>' href="https://t.me/share/url?url=<?php echo \dash\url::pwd(); ?>&amp;text=<?php echo urlencode(\dash\face::title()); ?>" class="telegram">
          <?php echo \dash\face::site(). ' '. T_("telegram"); ?>
        </a>

      </div>
    </nav>
  </div>


<?php if(\dash\data::propertyList()) { ?>
  <div class="box productInfo">
    <table class="tbl1 responsive v5">
<?php foreach (\dash\data::propertyList() as $property => $cat) {?>
      <tr class="group">
        <th colspan="2"><?php echo $cat['title']; ?></th>
      </tr>
<?php foreach ($cat['list'] as $key => $value) { if(is_null(a($value, 'value'))){ continue;}?>
      <tr>
        <th><?php echo $value['key']; ?></th>
        <td>
          <?php if(a($value, 'link')) {?>
            <a href="<?php echo a($value, 'link') ?>"><?php echo $value['value']; ?></a>
          <?php }else{ ?>
            <?php if(a($value, 'bold')) {?>
              <div class="txtB">
            <?php } //endif ?>
              <?php if(is_numeric($value['value'])){echo \dash\fit::number($value['value']);}else{echo $value['value'];}; ?>
              <?php if(a($value, 'unit')) { echo '<small class="fc-mute">'. a($value, 'unit'). '</small>';} ?>
            <?php if(a($value, 'bold')) {?>
              </div>
            <?php } //endif ?>
          <?php } //endif ?>
        </td>
      </tr>
<?php     } ?>
<?php   } ?>
    </table>
  </div>
<?php } ?>


<?php
if(\dash\data::productSettingSaved_comment())
{
  \dash\temp::set('set_product_comment', true);
  require_once(core. 'layout/comment/comment-add.php');
} //endif comment is closed
?>

<?php require_once(core. 'layout/comment/comment-list.php'); ?>



<?php if(\dash\data::similarProduct()) {?>
<h2 class="jTitle1"><?php echo T_("Related products") ?></h2>
  <?php \lib\website::product_list(\dash\data::similarProduct()); ?>
<?php } //endif ?>


</div>


</div>

