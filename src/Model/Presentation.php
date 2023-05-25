<?php

namespace Pdlt\Model;

class Presentation
{
	
	// ATTRIBUTS
	
	/** @var int|NULL  */
	protected int|NULL $id = NULL;
	
	/**
	 * @var string
	 */
	protected string $theme;
	
	/**
	 * @var string
	 */
	protected string $text = '';
	
	
	
	// CONSTRUCTEUR
	
	public function __construct(string $theme = '', string $text = '')
	{
		$this->theme = $theme;
		$this->text = $text;
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
	 * @return Presentation
	 */
	public function setId(?int $id): Presentation
	{
		$this->id = $id;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getTheme(): string
	{
		return $this->theme;
	}
	
	/**
	 * @param string $theme
	 * @return Presentation
	 */
	public function setTheme(string $theme): Presentation
	{
		$this->theme = $theme;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getText(): string
	{
		return $this->text;
	}
	
	/**
	 * @param string $text
	 * @return Presentation
	 */
	public function setText(string $text): Presentation
	{
		$this->text = $text;
		return $this;
	}
	
	
	
	
}