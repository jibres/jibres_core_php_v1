<div class="f">
    <div class="c pRa5">
        <a href="<?php echo \dash\url::that(). '?list=mydomain' ?>" class="stat x70 <?php if(\dash\request::get('list') == 'mydomain' || !\dash\request::get('list')) { echo ' active';} ?>" >
            <h3><?php echo T_("Your Domain"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(\dash\data::groupByStatus_mydomain()); ?></div>
        </a>
    </div>
    <div class="c pRa5">
        <a href="<?php echo \dash\url::that(). '?list=renew' ?>" class="stat x70 <?php if(\dash\request::get('list') == 'renew') { echo ' active';} ?>" >
            <h3><?php echo T_("Renewed Domain"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(\dash\data::groupByStatus_maybe()); ?></div>
        </a>
    </div>
    <?php if(\dash\data::groupByStatus_imported() > 0) {?>
    <div class="c pRa5">
        <a href="<?php echo \dash\url::that(). '?list=import' ?>" class="stat x70 <?php if(\dash\request::get('list') == 'import') { echo ' active';} ?>" >
            <h3><?php echo T_("Imported Domain"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(\dash\data::groupByStatus_imported()); ?></div>
        </a>
    </div>
    <?php } //endif ?>
    <?php if(\dash\data::groupByStatus_available() > 0) {?>
    <div class="c pRa5">
        <a href="<?php echo \dash\url::that(). '?list=available' ?>" class="stat x70 <?php if(\dash\request::get('list') == 'available') { echo ' active';} ?>" >
            <h3><?php echo T_("Free Domains"); ?></h3>
            <div class="val"><?php echo \dash\fit::number(\dash\data::groupByStatus_available()); ?></div>
        </a>
    </div>
    <?php } //endif ?>

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
    <?php if(\dash\request::get('list') !== 'available') {?>


    <form method="get" action="<?php echo \dash\url::that(); ?>">
        <?php if(\dash\request::get('list')) {?><input type="hidden" name="list" value="<?php echo \dash\request::get('list'); ?>"><?php } //endif ?>
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
<?php }else{ ?>

    <form method="get" action="<?php echo \dash\url::that(); ?>">
        <?php if(\dash\request::get('list')) {?><input type="hidden" name="list" value="<?php echo \dash\request::get('list'); ?>"><?php } //endif ?>
        <div class="input search <?php if(\dash\request::get('q')) { echo 'apply'; }?>">
            <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" data-default data-pass='submit' autocomplete='off' autofocus>
            <button class="addon btn light3 s0"><i class="sf-search"></i></button>
        </div>
    </form>
<?php } //endif ?>

<?php } //endfunction ?>


<?php function htmlTable() {?>
<?php
if(!\dash\request::get('list') || \dash\request::get('list') === 'mydomain')
{
    require_once('display-mydomain.php');
}
elseif(\dash\request::get('list') === 'renew')
{
    require_once('display-maybemydomain.php');
}
elseif(\dash\request::get('list') === 'import')
{
    require_once('display-imported.php');
}
elseif(\dash\request::get('list') === 'available')
{
    require_once('display-availabledomain.php');
}
else
{
    // nothing
}
?>
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
<?php
if(!\dash\request::get('list') || \dash\request::get('list') === 'mydomain')
{
    $msg = T_("Buy your first winning domain!");
    $url = \dash\url::this(). '/buy';
}
elseif(\dash\request::get('list') === 'renew')
{
    $msg = T_("Try renew domain");
    $url = \dash\url::this(). '/renew';
}
elseif(\dash\request::get('list') === 'import')
{
    $msg = T_("If you import any domain in your account can see here");
    $url = \dash\url::this(). '/import';
}
elseif(\dash\request::get('list') === 'available')
{
    $msg = T_("Domains you try to register or renew but operation incomplete and are available yet");
    $url = \dash\url::this(). '/buy';
}
else
{
    $msg = T_("Buy your first winning domain!");
    $url = \dash\url::this(). '/buy';
}
?>
  <p><a href="<?php echo $url; ?>"><?php echo $msg; ?></a></p>

</div>

<?php } //endfunction ?>

