<?php
namespace RobertLemke\Rss;

/**
 * An item of an RSS channel
 */
class Item {

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $itemLink;

	/**
	 * @var string
	 */
	protected $commentsLink;

	/**
	 * @var \DateTime
	 */
	protected $publicationDate;

	/**
	 * @var string
	 */
	protected $creator;

	/**
	 * @var string
	 */
	protected $guid;

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var string
	 */
	protected $content;

	/**
	 * @var array<string>
	 */
	protected $categories = array();

	/**
	 * @param array $categories
	 */
	public function setCategories($categories) {
		$this->categories = $categories;
	}

	/**
	 * @return array
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * @param string $commentsLink
	 */
	public function setCommentsLink($commentsLink) {
		$this->commentsLink = $commentsLink;
	}

	/**
	 * @return string
	 */
	public function getCommentsLink() {
		return $this->commentsLink;
	}

	/**
	 * @param string $content
	 */
	public function setContent($content) {
		$this->content = $content;
	}

	/**
	 * @return string
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * @param string $creator
	 */
	public function setCreator($creator) {
		$this->creator = $creator;
	}

	/**
	 * @return string
	 */
	public function getCreator() {
		return $this->creator;
	}

	/**
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string $guid
	 */
	public function setGuid($guid) {
		$this->guid = $guid;
	}

	/**
	 * @return string
	 */
	public function getGuid() {
		return $this->guid;
	}

	/**
	 * @param string $itemLink
	 */
	public function setItemLink($itemLink) {
		$this->itemLink = $itemLink;
	}

	/**
	 * @return string
	 */
	public function getItemLink() {
		return $this->itemLink;
	}

	/**
	 * @param \DateTime $publicationDate
	 */
	public function setPublicationDate(\DateTime $publicationDate = NULL) {
		$this->publicationDate = $publicationDate;
	}

	/**
	 * @return \DateTime
	 */
	public function getPublicationDate() {
		return $this->publicationDate;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @return \SimpleXMLElement
	 */
	public function asXml() {
		$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?>
			<item
				xmlns:content="http://purl.org/rss/1.0/modules/content/"
				xmlns:wfw="http://wellformedweb.org/CommentAPI/"
				xmlns:dc="http://purl.org/dc/elements/1.1/"
				xmlns:atom="http://www.w3.org/2005/Atom"
			/>', LIBXML_NOERROR|LIBXML_ERR_NONE|LIBXML_ERR_FATAL);

		$node = $xml->addChild('guid', $this->guid);
		$node->addAttribute('isPermaLink', 'false');

		$xml->addChild('title', $this->title);
		$xml->addChild('link', $this->itemLink);

		if ($this->commentsLink !== NULL) {
			$xml->addChild('comments', $this->commentsLink);
		}
		if ($this->publicationDate !== NULL) {
			$xml->addChild('pubDate', $this->publicationDate->format('D, d M Y H:i:s') . ' GMT');
		}
		if ($this->creator !== NULL) {
			$xml->addChild('creator', $this->creator, 'http://purl.org/dc/elements/1.1/');
		}
		if ($this->description !== NULL) {
			$xml->addCdataChild('description', $this->description);
		}
		foreach ($this->categories as $category) {
			$xml->addCdataChild('category', $category);
		}

		return $xml;
	}

}