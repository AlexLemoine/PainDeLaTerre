<?php

namespace Pdlt\Model;

class Team
{
	/** @var int  */
	protected int $id;
	
	/** @var string  */
	protected string $descResume;
	
	/** @var string  */
	protected string $descOrigin;
	
	/** @var string  */
	protected string $picture;
	
	
	/**
	 * @param string $descResume
	 * @param string $descOrigin
	 * @param string $picture
	 */
	public function __construct(string $descResume = '',
					    string $descOrigin = '',
					    string $picture = '') {

		$this->descResume = $descResume;
		$this->descOrigin = $descOrigin;
		$this->picture = $picture;
	}
	
	
	// Getters and setters des propriétés
	
	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}
	
	/**
	 * @param int $id
	 * @return Team
	 */
	public function setId(int $id): Team
	{
		$this->id = $id;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getDescResume(): string
	{
		return $this->descResume;
	}
	
	/**
	 * @param string $descResume
	 * @return Team
	 */
	public function setDescResume(string $descResume): Team
	{
		$this->descResume = $descResume;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getDescOrigin(): string
	{
		return $this->descOrigin;
	}
	
	/**
	 * @param string $descOrigin
	 * @return Team
	 */
	public function setDescOrigin(string $descOrigin): Team
	{
		$this->descOrigin = $descOrigin;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getPicture(): string
	{
		return $this->picture;
	}
	
	/**
	 * @param string $picture
	 * @return Team
	 */
	public function setPicture(string $picture): Team
	{
		$this->picture = $picture;
		return $this;
	}

	
	


}