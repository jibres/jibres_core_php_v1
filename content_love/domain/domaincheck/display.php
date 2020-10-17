<div class="f justify-center">
    <div class="c6 s12 fs12">
        <form method="get" autocomplete="off" class="mB20" action="<?php echo \dash\url::that(); ?>">
            <div class="input ltr">
                <input type="text" name="q" placeholder='<?php echo T_("Domain"); ?>' value="<?php echo \dash\validate::search_string(); ?>">
                <button class="btn addon success"><?php echo T_("Get Info"); ?></button>
            </div>
        </form>

<?php if(\dash\data::DomainInfo()) {?>
<samp><?php print_r(\dash\data::DomainInfo()) ?></samp>
<?php }//endif ?>
    </div>

</div>