<?php

if(a(\dash\data::domainDetail(), 'jibres_dns'))
{
  if(\dash\data::domainConnected() && \dash\data::domainConnectedToMyBusiness())
  {
    $href = a(\dash\data::domainConnectedToMyBusiness(), 'detail', 'url'). '/a/setting/domain/manage?domain='. \dash\data::domainDetail_name();
    $title = T_("Connected to :val", ['val' => a(\dash\data::domainConnectedToMyBusiness(), 'detail', 'title')]);
?>
      <section class="f" data-option='domain-business'>
        <div class="c8 s12">
          <div class="data">
            <h3><?php echo $title; ?></h3>
            <div class="body">
              <p><?php echo T_("You can manage your Domain DNS records");?></p>
            </div>
          </div>
        </div>
        <div class="c4 s12">
            <div class="action">
              <a class="btn primary" href="<?php echo $href; ?>"><?php echo T_("Manage Domain DNS record") ?></a>
            </div>
        </div>
      </section>

<?php }else{ ?>

  <section class="f" data-option='domain-business'>
        <div class="c8 s12">
          <div class="data">
            <h3><?php echo T_("Need website?");?></h3>
            <div class="body">
              <p><?php echo T_("You can build a modern website and enjoy it");?></p>
            </div>
          </div>
        </div>
        <div class="c4 s12">
            <div class="action">
              <a class="btn primary" href="<?php echo \dash\url::that(). '/business?domain='. \dash\request::get('domain') ?>"><?php echo T_("Build my website") ?></a>
            </div>
        </div>
      </section>
<?php } }// endif ?>