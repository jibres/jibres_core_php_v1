<div class="f">
<?php if (\dash\data::groupByStatus() && is_array(\dash\data::groupByStatus()))  {?>
    <?php foreach (\dash\data::groupByStatus() as $status => $count) {?>
        <div class="c pRa5">
            <a href="<?php echo \dash\url::that(). '?status='. $status ?>" class="stat x70 <?php if(\dash\request::get('status') == $status) { echo ' active';} ?>" >
                <h3><?php echo T_($status); ?></h3>
                <div class="val"><?php echo \dash\fit::number($count); ?></div>
            </a>
        </div>
    <?php } // endfor ?>
<?php } // endif ?>

</div>

<?php
if(\dash\data::dataTable())
{
    if(\dash\data::isFiltered())
    {
        htmlSearchBox();
        htmlTable();
        htmlFilter();
    }
    else
    {
        htmlSearchBox();
        htmlTable();
    }

}
else
{
    if(\dash\data::isFiltered())
    {
        htmlSearchBox();

        htmlFilter();
    }
    else
    {
        htmlStartAddNew();
    }
}
?>







<?php function htmlSearchBox() {?>
    <form method="get" action="<?php echo \dash\url::that(); ?>">
        <?php if(\dash\request::get('autorenew')) {?><input type="hidden" name="autorenew" value="<?php echo \dash\request::get('autorenew'); ?>"><?php } //endif ?>
        <?php if(\dash\request::get('lock')) {?><input type="hidden" name="lock" value="<?php echo \dash\request::get('lock'); ?>"><?php } //endif ?>
        <div class="searchBox">
            <div class="f">
                <div class="cauto pRa10">
                    <a class="btn light3 <?php if(in_array('autorenew', array_keys(\dash\request::get())) || in_array('lock', array_keys(\dash\request::get()))) { echo 'apply'; }?>" data-kerkere-icon="close" data-kerkere='.filterBox'><?php echo T_("Filter"); ?></a>
                </div>
                <div class="c pRa10">
                    <div>
                        <div class="input search <?php if(\dash\request::get('q')) { echo 'apply'; }?>">
                            <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" data-default data-pass='submit' autocomplete='off' autofocus>
                            <button class="addon btn light3 s0"><i class="sf-search"></i></button>
                        </div>
                    </div>
                </div>

                <div class="cauto">
                    <select class="select22 <?php if(\dash\request::get('sort') || \dash\request::get('order')) { echo 'apply'; }?>" data-link>
                        <option value="<?php echo \dash\url::that(); ?>"><i class="sf-sort mRa5"></i><span><?php echo T_("Sort"); ?></span></div>
                        <?php foreach (\dash\data::mySort() as $key => $value) {?>
                            <option value="<?php echo \dash\url::that(). '?'. $value['link']; ?>" <?php if(\dash\request::get('sort') == $value['sort'] && \dash\request::get('order') == $value['order']) { echo 'selected'; }?> ><?php echo $value['title']; ?></option>
                        <?php } //endif ?>

                        </select>
                    </div>
                </div>
            </div>


            <div class="filterBox" data-kerkere-content='hide'>

                <p><?php echo T_("Show domain where"); ?></p>

                <div class="f align-center">

                    <div class="c">
                        <a class='btn <?php if(\dash\request::get('autorenew') === 'on') { echo 'primary2'; }else{ echo 'light';} ?>  mB5 ' href="<?php echo \dash\url::that(); ?>?autorenew=on"><?php echo T_("Autorenew On"); ?></a>
                        <a class='btn <?php if(\dash\request::get('autorenew') === 'off') { echo 'primary2'; }else{ echo 'light';} ?>  mB5 ' href="<?php echo \dash\url::that(); ?>?autorenew=off"><?php echo T_("Autorenew Off"); ?></a>

                        <a class='btn <?php if(\dash\request::get('lock') === 'on') { echo 'primary2'; }else{ echo 'light';} ?>  mB5 ' href="<?php echo \dash\url::that(); ?>?lock=on"><?php echo T_("Locked"); ?></a>
                        <a class='btn <?php if(\dash\request::get('lock') === 'off') { echo 'primary2'; }else{ echo 'light';} ?>  mB5 ' href="<?php echo \dash\url::that(); ?>?lock=off"><?php echo T_("Unlocked"); ?></a>
                        <a class='btn <?php if(\dash\request::get('lock') === 'unknown') { echo 'primary2'; }else{ echo 'light';} ?>  mB5 ' href="<?php echo \dash\url::that(); ?>?lock=unknown"><?php echo T_("Unknown lock status"); ?></a>

                    </div>
                </div>
            </div>
    </form>

<?php } //endfunction ?>


<?php function htmlTable() {?>
<?php $sortLink = \dash\data::sortLink(); ?>

<div class="fs12">
    <table class="tbl1 v1 responsive">
        <thead>
            <tr class="fs09">
                <th colspan="2"><?php echo T_("Domain"); ?></th>
                <th class="txtC"><?php echo T_("Status"); ?></th>
                <th class="txtL"><?php echo T_("Expire date"); ?></th>
                <th class="txtL"><?php echo T_("Create date"); ?><br><?php echo T_("Date modified"); ?></th>
                <th class="txtL"><?php echo T_("DNS"); ?></th>
            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr <?php  if(\dash\get::index($value, 'status') === 'disable') { echo 'class="negative"'; }?> >
                <td>
                    <!-- <a target="_blank" href="http://<?php echo \dash\get::index($value, 'name'); ?>"><i class="sf-link"></i></a> -->
                    <a href="<?php echo \dash\url::this(); ?>/setting?domain=<?php echo \dash\get::index($value, 'name'); ?>" class="link flex"> <i class="sf-edit"></i> <code><?php echo \dash\get::index($value, 'name'); ?></code></a>
                </td>
                <td class="collapsing">

                    <a <?php if(\dash\get::index($value, 'verify')) {?> href="<?php echo \dash\url::this(). '/setting/transfer?domain='. \dash\get::index($value, 'name'); ?>" <?php } //endif ?>>
                        <div class="ibtn x30 wide">
                            <?php if(isset($value['lock']) && $value['lock'] == 1 ) { echo '<span>'.T_("Lock"). '</span>'; echo '<i class="sf-lock fc-green"></i>'; } elseif(isset($value['lock']) && $value['lock'] == 0){ echo '<span>'.T_("Lock"). '</span>'; echo '<i class="sf-unlock fc-red"></i>'; }else{echo '<span>'.T_("Unknown"). '</span>'; echo '<i class="sf-lock"></i>';}?>
                        </div>
                    </a>

                    <a href="<?php echo \dash\url::this(). '/setting?domain='. \dash\get::index($value, 'name'); ?>">
                    <div class="ibtn x30 wide"><?php echo '<span>'.T_("Autorenew"). '</span>'; if(isset($value['autorenew']) && $value['autorenew']) { echo '<i class="sf-refresh fc-blue"></i>'; } else{ echo '<i class="sf-times fc-red"></i>'; }?></div>
                    </a>
                </td>
                <td class="txtC">
                  <?php echo \dash\get::index($value, 'status_html'); ?>
                </td>
                <td class="collapsing txtL fs09"><?php echo \dash\fit::date(\dash\get::index($value, 'dateexpire')); ?></td>
                <td class="collapsing txtL fs09">
                  <div><?php echo \dash\fit::date(\dash\get::index($value, 'dateregister')); ?></div>
                  <div><?php echo \dash\fit::date(\dash\get::index($value, 'dateupdate')); ?></div>
                </td>
                <td class="collapsing ltr txtL">
                    <code><?php echo \dash\get::index($value, 'ns1'); ?></code>
                    <br>
                    <code><?php echo \dash\get::index($value, 'ns2'); ?></code>
                </td>

            </tr>
            <?php } //endfor ?>
        </tbody>
    </table>
</div>
<?php \dash\utility\pagination::html(); ?>

<?php } //endfunction ?>




<?php function htmlFilter() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>

<?php } //endfunction ?>





<?php function htmlStartAddNew() {?>

<div class="fs14 msg info2 pTB20">
  <p><?php echo T_("Hi!"); ?></p>
  <p><a href="<?php echo \dash\url::that(); ?>/buy"><?php echo T_("Buy your first winning domain!"); ?></a></p>

</div>

<?php } //endfunction ?>

