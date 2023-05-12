<?php

namespace Pdlt\Model;

class CompanySlider
{
	
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
	protected string $url;
	
	/**
	 * @var string
	 */
	protected string $legend = '';
	
	/**
	 * @var int
	 */
	private int $status;
	
	
	public function __construct(string $url = '',
					    string $legend = '')
	{
		// infos à renseigner par le user
		$this->url = $url;
		$this->legend = $legend;
		
		// infos calculées en auto
		$this->status = self::STATUS_DRAFT;

	}
	
	// FLUENT GETTERS AND SETTERS
	
	/**
	 * @return int|NULL
	 */
	public function getId(): ?int
	{
		return $this->id;
	}
	
	/**
	 * @param int|NULL $id
	 * @return CompanySlider
	 */
	public function setId(?int $id): CompanySlider
	{
		$this->id = $id;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getUrl(): string
	{
		return $this->url;
	}
	
	/**
	 * @param string $url
	 * @return CompanySlider
	 */
	public function setUrl(string $url): CompanySlider
	{
		$this->url = $url;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getLegend(): string
	{
		return $this->legend;
	}
	
	/**
	 * @param string $legend
	 * @return CompanySlider
	 */
	public function setLegend(string $legend): CompanySlider
	{
		$this->legend = $legend;
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
	 * @return CompanySlider
	 */
	public function setStatus(int $status): CompanySlider
	{
		$this->status = $status;
		return $this;
	}
	
	
	
	
	
}