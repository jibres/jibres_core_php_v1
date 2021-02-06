<section class="avand-md">
  <div class="box">
   <div class="body">
      <h2 class="txtB"><?php echo T_("What are Sitemaps?"); ?></h2>
      <p><?php echo T_('Sitemaps are an easy way for webmasters to inform search engines about pages on their sites that are available for crawling. In its simplest form, a Sitemap is an XML file that lists URLs for a site along with additional metadata about each URL (when it was last updated, how often it usually changes, and how important it is, relative to other URLs in the site) so that search engines can more intelligently crawl the site.') ?></p>
      <p><?php echo T_('Web crawlers usually discover pages from links within the site and from other sites. Sitemaps supplement this data to allow crawlers that support Sitemaps to pick up all URLs in the Sitemap and learn about those URLs using the associated metadata. Using the Sitemap protocol does not guarantee that web pages are included in search engines, but provides hints for web crawlers to do a better job of crawling your site.'); ?></p>
      <div class="msg success"><?php echo T_('We automatically build your sitemap.') ?></div>

      <div class="msg info2 row ltr" data-copy='<?php echo \dash\utility\sitemap::url(); ?>'>
        <div class="c"><a class="link" target="_blank" href="<?php echo \dash\utility\sitemap::url(); ?>"><i class="sf-link-external compact mLa10"></i><?php echo \dash\utility\sitemap::url(); ?></a></div>
        <div class="c-auto"><?php echo T_("Copy Sitemap URL"); ?></div>
      </div>
   </div>
  </div>

  <?php if(\dash\permission::check('cmsConfig') && \dash\request::get('force')) {?>
  <div class="box">
   <div class="body">
      <h2 class="txtB"><?php echo T_("Rebuil sitemap"); ?></h2>
      <p class="mB0-f"><?php echo T_("We will automatically update the sitemap with any changes in the posts, products and tags. However, you can submit a request to rebuild the sitemap.\n This will delete all the files related to the sitemap and rebuild them") ?></p>
   </div>
      <footer class="txtRa">
        <div data-confirm data-data='{"rebuild" : "rebuild"}' class="btn"><?php echo T_("Rebuil sitemap"); ?></div>
      </footer>
  </div>
<?php } //endif ?>
</section>