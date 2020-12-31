<?php
namespace dash\utility;

/** generating Sitemap files **/
class sitemap_xml
{
	/**
	 * Sitemap
	 *
	 * This class used for generating Google Sitemap files
	 *
	 * @package    Sitemap
	 * @author     Reze Mohiti <rm.biqarar@gmail.com>
	 * @copyright  2020
	 * @license    http://opensource.org/licenses/MIT MIT License
	 */


	/**
	 *
	 * @var XMLWriter
	 */
	private $writer;

	/**
	 * @var sitemap addr
	 */
	private $addr;

	const SCHEMA             = 'http://www.sitemaps.org/schemas/sitemap/0.9';


	/**
	 *
	 * @param string $addr
	 */
	public function __construct($_addr)
	{
		$this->setAddr($_addr);
	}


	/**
	 * Sets the address.
	 *
	 * @param      <type>  $addr   The address
	 */
	public function setAddr($_addr)
	{
		$this->addr = $_addr;
		return $this;
	}


	/**
	 * Gets the address.
	 *
	 * @return     <type>  The address.
	 */
	private function getAddr()
	{
		return $this->addr;
	}


	/**
	 * Returns XMLWriter object instance
	 *
	 * @return XMLWriter
	 */
	private function getWriter()
	{
		return $this->writer;
	}


	/**
	 * Assigns XMLWriter object instance
	 *
	 * @param XMLWriter $writer
	 */
	private function setWriter(\XMLWriter $_writer)
	{
		$this->writer = $_writer;
	}


	/**
	 * Prepares sitemap XML document
	 *
	 */
	public function startSitemap()
	{
		$this->setWriter(new \XMLWriter());
		$this->getWriter()->openURI($this->getAddr());
		$this->getWriter()->startDocument('1.0', 'UTF-8');
		$this->getWriter()->setIndent(true);
		$this->getWriter()->startElement('urlset');
		$this->getWriter()->writeAttribute('xmlns', self::SCHEMA);
	}


	/**
	 * Prepares sitemap XML document
	 *
	 */
	public function siteampIndex()
	{
		$this->setWriter(new \XMLWriter());
		$this->getWriter()->openURI($this->getAddr());
		$this->getWriter()->startDocument('1.0', 'UTF-8');
		$this->getWriter()->setIndent(true);
		$this->getWriter()->startElement('sitemapindex');
		$this->getWriter()->writeAttribute('xmlns', self::SCHEMA);
	}

	/**
	 * Adds an item.
	 *
	 * @param      <type>  $_loc           The location
	 * @param      <type>  $_lastmodified  The lastmodified
	 * @param      <type>  $_priority      The priority
	 * @param      <type>  $_changefreq    The changefreq
	 *
	 * @return     self    ( description_of_the_return_value )
	 */
	public function addIndexItem($_loc)
	{
		$this->getWriter()->startElement('sitemap');
		$this->getWriter()->writeElement('loc', $_loc);
		$this->getWriter()->endElement();
		return $this;
	}




	/**
	 * Adds an item.
	 *
	 * @param      <type>  $_loc           The location
	 * @param      <type>  $_lastmodified  The lastmodified
	 * @param      <type>  $_priority      The priority
	 * @param      <type>  $_changefreq    The changefreq
	 *
	 * @return     self    ( description_of_the_return_value )
	 */
	public function addItem($_loc, $_lastmodified = NULL, $_priority = null, $_changefreq = NULL)
	{
		$this->getWriter()->startElement('url');
		$this->getWriter()->writeElement('loc', $_loc);

		if($_priority)
		{
			$this->getWriter()->writeElement('priority', $_priority);
		}

		if($_changefreq)
		{
			$this->getWriter()->writeElement('changefreq', $_changefreq);
		}

		if($_lastmodified)
		{
			$this->getWriter()->writeElement('lastmod', $_lastmodified);
		}

		$this->getWriter()->endElement();

		return $this;
	}




	/**
	 * Finalizes tags of sitemap XML document.
	 *
	 */
	public function endSitemap()
	{
		$this->getWriter()->endElement();
		$this->getWriter()->endDocument();
		$this->getWriter()->flush();
	}

}
?>