<div class="avand-md">
  <div class="box">
   <div class="body">
      <div class="txtB"><?php echo T_("What are Sitemaps?"); ?></div>
      <p>
        <?php echo T_('Sitemaps are an easy way for webmasters to inform search engines about pages on their sites that are available for crawling. In its simplest form, a Sitemap is an XML file that lists URLs for a site along with additional metadata about each URL (when it was last updated, how often it usually changes, and how important it is, relative to other URLs in the site) so that search engines can more intelligently crawl the site.') ?>
        <?php echo T_('Web crawlers usually discover pages from links within the site and from other sites. Sitemaps supplement this data to allow crawlers that support Sitemaps to pick up all URLs in the Sitemap and learn about those URLs using the associated metadata. Using the Sitemap protocol does not guarantee that web pages are included in search engines, but provides hints for web crawlers to do a better job of crawling your site.'); ?>
      </p>
      <?php echo T_('We automatically builds your sitemap') ?>
      <p>
      </p>
   </div>
      <footer class="txtRa">
        <a class="btn link" target="_blank" href="<?php echo \dash\utility\sitemap::url(); ?>"><?php echo T_("View Sitemap"); ?></a>
      </footer>
  </div>
</div>