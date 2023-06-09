<?php

namespace Pdlt\Model;

class Partenaires
{
	use Updatable, Creatable;
	
	const STATUS_DRAFT = 1;
	const STATUS_PUBLISHED = 2;
	const STATUS_ASLEEP = 3;
	
	const STATUS = [
	    self::STATUS_DRAFT => 'brouillon',
	    self::STATUS_PUBLISHED => 'publié',
	    self::STATUS_ASLEEP => 'en sommeil'
	];
	
	
	
	// ATTRIBUTS
	
	/** @var int|NULL  */
	protected int|NULL $id = NULL;
	
	/**
	 * @var string
	 */
	protected string $name;
	
	/**
	 * @var string
	 */
	protected string $localisation = '';
	
	/**
	 * @var string
	 */
	protected string $supply;
	
	/**
	 * @var string
	 */
	protected string $description = '';
	
	/**
	 * @var string
	 */
	private string $picture;
	
	/**
	 * @var string
	 */
	private string $site;
	
	/**
	 * @var int
	 */
	private int $status;
	
	
	const DEFAULT_PICTURE_SUPPLIER = 'field.jpg';
	
	
	public function __construct(string $name = '',
					    string $description = '')
	{
		
		// infos à renseigner par le user
		$this->name = $name;
		$this->description = $description;
		
		// infos calculées en auto
		$this->status = self::STATUS_DRAFT;
		$this->createdAt = new \DateTime('now');
		$this->updatedAt = new \DateTime('now');
		
	}
	


	/**
	 * @return int|NULL
	 */
	public function getId(): ?int
	{
		return $this->id;
	}
	
	/**
	 * @param int|NULL $id
	 * @return Partenaires
	 */
	public function setId(?int $id): Partenaires
	{
		$this->id = $id;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
	
	/**
	 * @param string $name
	 * @return Partenaires
	 */
	public function setName(string $name): Partenaires
	{
		$this->name = $name;
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getStatus(): int
	{
		return $this->status;
	}
	
	/**
	 * @param int $status
	 * @return Partenaires
	 */
	public function setStatus(int $status): Partenaires
	{
		$this->status = $status;
		return $this;
	}
	
	
	
	/**
	 * @return string
	 */
	public function getLocalisation(): string
	{
		return $this->localisation;
	}
	
	/**
	 * @param string $localisation
	 * @return Partenaires
	 */
	public function setLocalisation(string $localisation): Partenaires
	{
		$this->localisation = $localisation;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getSupply(): string
	{
		return $this->supply;
	}
	
	/**
	 * @param string $supply
	 * @return Partenaires
	 */
	public function setSupply(string $supply): Partenaires
	{
		$this->supply = $supply;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getDescription(): string
	{
		return $this->description;
	}
	
	/**
	 * @param string $description
	 * @return Partenaires
	 */
	public function setDescription(string $description): Partenaires
	{
		$this->description = $description;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getPicture(): string
	{
		if (!empty($this->picture)) {
			return $this->picture;
		} else {
			return self::DEFAULT_PICTURE_SUPPLIER;
		}
	}
	
	/**
	 * @param string $picture
	 * @return Partenaires
	 */
	public function setPicture(string $picture): Partenaires
	{
		$this->picture = $picture;
		return $this;
	}
	
	
	/**
	 * @return \DateTime
	 */
	public function getCreatedAt(): \DateTime
	{
		return $this->createdAt;
	}
	
	/**
	 * @param \DateTime $createdAt
	 * @return Partenaires
	 */
	public function setCreatedAt(\DateTime $createdAt): Partenaires
	{
		$this->createdAt = $createdAt;
		return $this;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getUpdatedAt(): \DateTime
	{
		return $this->updatedAt;
	}
	
	/**
	 * @param \DateTime $updatedAt
	 * @return Partenaires
	 */
	public function setUpdatedAt(\DateTime $updatedAt): Partenaires
	{
		$this->updatedAt = $updatedAt;
		return $this;
	}
	
	/**
	 * @return string|null
	 */
	public function getSite(): string|null
	{
		if (!empty($this->site)) {
			return $this->site;
		} else {
			return NULL;
		}
	}
	
	/**
	 * @param string $site
	 * @return Partenaires
	 */
	public function setSite(string $site): Partenaires
	{
		$this->site = $site;
		return $this;
	}
	
	
}