<?php if(\dash\request::get('print')) {?>

   <div class="printArea" data-size='A4'>
      <div class="alert-info text-left ltr font-bold text-sm">
      <div class="f">
        <div class="cauto">
          <span><?php echo T_("Answer ID") ?></span>
          <span><code class="inline-block font-bold"><?php echo \dash\request::get('id'). '_'.\dash\request::get('aid'); ?></code></span>
        </div>
        <div class="c"></div>
        <div class="cauto">
          <a class="font-14 p-0" href="<?php echo \dash\url::current(). \dash\request::full_get(['print' => null]) ?>"><?php echo T_("Back") ?></a>
        </div>
      </div>


    </div>
  <table class="tbl1 v6">
    <tbody class="text-sm">
<?php $i=0; foreach (\dash\data::dataTable() as $key => $value) { $i++;  ?>
      <?php  if($i % 2) { ?>
        <tr>
      <?php } //endif ?>
          <th class=""><?php echo a($value, 'item_title'); ?></th>
          <td class="">
            <?php  echo \lib\app\form\answer\get::HTMLshowDetaiRecrod($value) ?>
          </td>
      <?php  if(!($i % 2)) { ?>
        </tr>
      <?php } //endif ?>
<?php } //endif ?>
    </tbody>
  </table>
  </div>
  <?php \dash\utility\pagination::html(); ?>
<?php }else{ ?>

<div class="row">
   <div class="c-xs-12 c-sm-12 c-md-6">
    <div class="alert-info text-left ltr font-bold text-sm">
      <div class="f">
        <div class="cauto">
          <span><?php echo T_("Answer ID") ?></span>
          <span><code class="inline-block font-bold"><?php echo \dash\request::get('id'). '_'.\dash\request::get('aid'); ?></code></span>
        </div>
        <div class="c"></div>
        <div class="cauto">
          <a class="font-14" href="<?php echo \dash\url::current(). \dash\request::full_get(['print' => 1]) ?>"><i class="sf-print"></i></a>
        </div>
        <div class="cauto hidden">
          <a class="btn-primary btn-sm" href="<?php echo \dash\url::current(). \dash\request::full_get(['print' => 1]) ?>"><?php echo T_("Edit") ?></a>
        </div>
      </div>
    </div>

    <?php if(\dash\data::answerTransactionDetail()) {?>

        <a href="<?php echo \dash\url::kingdom(). '/crm/transactions/detail?id='. \dash\data::answerDetail_transaction_id() ?>">
          <div class="<?php if(\dash\data::answerTransactionDetail_verify()) {echo 'alert-success';}else{echo 'alert-danger';} ?>">
            <div class="row">

              <div class="c-auto">
                <?php echo T_("Total amount") ?>
                <span class="font-bold mx-4"><?php echo \dash\fit::number(\dash\data::answerTransactionDetail_plus()). ' '. \lib\store::currency() ?> </span>
              </div>

              <div class="c"></div>

              <div class="c-auto">

              <?php if(\dash\data::answerTransactionDetail_verify()) { ?>
                <?php echo T_("Successful payment"); ?>
              <?php }else{ ?>
                <?php echo T_("Unsuccess"); ?>
              <?php } // endif ?>
              </div>
            </div>

          </div>
        </a>
      <?php } // endif ?>

      <?php if(a(\dash\data::answerDetail(), 'factor_id')) {?>
    <div class="alert-info text-left ltr font-bold text-sm">
        <a href="<?php echo \dash\url::kingdom(). '/a/order/comment?id='. a(\dash\data::answerDetail(), 'factor_id'); ?>"><?php echo T_("View Order") ?></a>
      </div>
      <?php } //endif ?>


  <table class="tbl1 v6 responsive">
    <tbody class="text-sm">
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>
          <th class=""><?php echo a($value, 'item_title'); ?></th>
          <td class="">
            <?php echo \lib\app\form\answer\get::HTMLshowDetaiRecrod($value); ?>
            </td>
        </tr>
<?php } //endif ?>
    </tbody>
  </table>
  </div>
  <?php \dash\utility\pagination::html(); ?>

  <div class="c-xs-12 c-sm-12 c-md-6 p-0">

     <form method="post" id="markasreview">
      <input type="hidden" name="review" value="review">
    </form>

    <form method="post" id="form1">
      <input type="hidden" name="addtag" value="addtag">
      <div class="box">
        <div class="pad">
           <div>
          <div class="row align-center">
            <div class="c"><label for='tag'><?php echo T_("Tag"); ?></label></div>
            <div class="c-auto os"><a class="text-sm"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?> href="<?php echo \dash\url::here(). '/form/tag'. \dash\request::full_get() ?>"><?php echo T_("Manage"); ?> <i class="sf-link-external"></i></a></div>
          </div>
          <select name="tag[]" id="tag" class="select22" data-model="tag" multiple="multiple">
            <?php foreach (\dash\data::allTagList() as $key => $value) {?>
              <option value="<?php echo $value['title']; ?>" <?php if(in_array($value['title'], \dash\data::tagsSavedTitle())) { echo 'selected';} ?>><?php echo $value['title']; ?></option>
            <?php } //endfor ?>
          </select>
        </div>
        </div>
        <footer class="txtRa">
          <button class="btn-outline-secondary btn-sm"><?php echo T_("Save") ?></button>
        </footer>
      </div>
    </form>

       <form method="post" autocomplete="off">
      <div class="box">
        <header><h2><?php echo T_("Add comment to this answer") ?></h2></header>
        <div class="body padLess">
          <input type="hidden" name="formcomment" value="formcomment">
          <div class="mb-4">
            <textarea id="comment" name="comment" class="txt" rows="3"></textarea>
          </div>
          <div class="row">
            <div class="c-xs-6 c-sm-6">
              <div class="radio3">
                <input type="radio" name="privacy" value="public" checked id="privacypublic">
                <label for="privacypublic"><?php echo T_("Public") ?></label>
              </div>
            </div>
            <div class="c-xs-6 c-sm-6">
              <div class="radio3">
                <input type="radio" name="privacy" value="private" id="privacyprivate">
                <label for="privacyprivate"><?php echo T_("Private") ?></label>
              </div>
            </div>
          </div>

        </div>
        <footer class="f">

          <div class="c"></div>
          <div class="cauto"><button class="btn-outline-secondary btn-sm"><?php echo T_("Add comment") ?></button></div>
        </footer>
      </div>
    </form>

    <?php if(\dash\data::commentList()) {?>
      <div class="box">
        <div class="pad">
          <h2><?php echo T_("Answer comment") ?></h2>

              <?php foreach (\dash\data::commentList() as $key => $value) {?>
                <div class="alert-secondary">
                  <div class="m-2"><?php echo a($value, 'content') ?></div>
                  <div class="row">
                    <div class="c"><?php echo a($value, 'displayname'); ?></div>
                    <div class="c"><?php echo T_(ucfirst(a($value, 'privacy'))); ?></div>
                    <div class="c"><?php echo \dash\fit::date_time(a($value, 'datecreated'));?></div>
                    <?php if(\dash\permission::check('FormRemoveAnswer')) {?>
                      <div class="c-auto"><div data-confirm data-data='{"removecomment" : "removecomment", "id" : "<?php echo a($value, 'id') ?>"}' class=""><?php echo \dash\utility\icon::svg('trash', 'bootstrap', 'red', 'w-3') ?></div></div>
                    <?php }//endif ?>
                  </div>
                </div>

              <?php } //endfor ?>

        </div>

      </div>


  <?php } //endif ?>
  </div>
</div>
<?php } //endif ?>
