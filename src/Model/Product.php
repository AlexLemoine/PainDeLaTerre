<?php

namespace Pdlt\Model;

class Product
{
	use Updatable, Creatable;
	
	const STATUS_DRAFT = 1;
	const STATUS_PUBLISHED = 2;
	const STATUS_ASLEEP = 3;
	
	const DEFAULT_PICTURE = "pain ancien.jpg";
	
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
	protected string $ingredients = '';
	
	/**
	 * @var string
	 */
	protected string $description = '';
	
	/**
	 * @var ProductCategory
	 */
	protected ProductCategory $category;
	
	/**
	 * @var int
	 */
	private int $status;
	
	/**
	 * @var string
	 */
	private string $picture;
	
	/** @var ProductFrequency  */
	protected ProductFrequency $frequency;
	
	
	/**
	 * @param string $name
	 * @param string $description
	 * @param ProductCategory $category
	 * @param ProductFrequency $frequency
	 */
	public function __construct(string $name = '',
					    string $description = '',
					    ProductCategory $category = new ProductCategory(),
					    ProductFrequency $frequency = new ProductFrequency())
	{
		// infos à renseigner par user
		$this->name = $name;
		$this->description = $description;
		$this->category = $category;
		$this->frequency = $frequency;
		
		// infos calculées en auto
		$this->status = self::STATUS_DRAFT;
		$this->createdAt = new \DateTime('now');
		$this->updatedAt = new \DateTime('now');
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
	 * @return Product
	 */
	public function setCreatedAt(\DateTime $createdAt): Product
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
	 * @return Product
	 */
	public function setUpdatedAt(\DateTime $updatedAt): Product
	{
		$this->updatedAt = $updatedAt;
		return $this;
	}
	
	/**
	 * @return int|null
	 */
	public function getId(): ? int
	{
		return $this->id;
	}
	
	/**
	 * @param int $id
	 * @return Product
	 */
	public function setId(int $id): Product
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
	 * @return Product
	 */
	public function setName(string $name): Product
	{
		$this->name = $name;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getIngredients(): string
	{
		return $this->ingredients;
	}
	
	/**
	 * @param string $ingredients
	 * @return Product
	 */
	public function setIngredients(string $ingredients): Product
	{
		$this->ingredients = $ingredients;
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
	 * @return Product
	 */
	public function setDescription(string $description): Product
	{
		$this->description = $description;
		return $this;
	}
	
	/**
	 * @return ProductCategory
	 */
	public function getCategory(): ProductCategory
	{
		return $this->category;
	}
	
	/**
	 * @param ProductCategory $category
	 * @return Product
	 */
	public function setCategory(ProductCategory $category): Product
	{
		$this->category = $category;
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
	 * @return Product
	 */
	public function setStatus(int $status): Product
	{
		$this->status = $status;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getPicture(): string
	{
		// TODO tester existence du fichier de la picture
		if (!empty($this->picture)) {
			return $this->picture;
		} else {
			return self::DEFAULT_PICTURE;
		}
		
	}
	
	/**
	 * @param string $picture
	 * @return Product
	 */
	public function setPicture(string $picture): Product
	{
		$this->picture = $picture;
		return $this;
	}
	
	/**
	 * @return ProductFrequency
	 */
	public function getFrequency(): ProductFrequency
	{
		return $this->frequency;
	}
	
	/**
	 * @param ProductFrequency $frequency
	 * @return Product
	 */
	public function setFrequency(ProductFrequency $frequency): Product
	{
		$this->frequency = $frequency;
		return $this;
	}
	
	
	
	
}