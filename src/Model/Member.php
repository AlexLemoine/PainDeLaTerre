<?php

namespace Pdlt\Model;
use DateTime;


class Member {
	
	/** @var int  */
	protected int $id;
	
	/** @var string  */
	protected string $name;
	
	/** @var string  */
	protected string $position;
	
	/** @var string  */
	protected string $description;
	
	/** @var string  */
	protected string $picture;
	
	/** @var DateTime  */
	protected DateTime $entryDate;
	
	
	/**
	 * @param int $id
	 * @param string $name
	 * @param string $position
	 * @param string $description
	 * @param string $picture
	 */
	public function __construct (	string $name = '',
						string $position = '',
						string $description = '',
						string $picture = '') {
		
		$this->name = $name;
		$this->position = $position;
		$this->description = $description;
		$this->picture = $picture;
		
		// infos calculées en auto
		$this->entryDate = new DateTime('now');
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
	 * @return Member
	 */
	public function setId(int $id): Member
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
	 * @return Member
	 */
	public function setName(string $name): Member
	{
		$this->name = $name;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getPosition(): string
	{
		return $this->position;
	}
	
	/**
	 * @param string $position
	 * @return Member
	 */
	public function setPosition(string $position): Member
	{
		$this->position = $position;
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
	 * @return Member
	 */
	public function setDescription(string $description): Member
	{
		$this->description = $description;
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
	 * @return Member
	 */
	public function setPicture(string $picture): Member
	{
		$this->picture = $picture;
		return $this;
	}
	
	/**
	 * @return DateTime
	 */
	public function getEntryDate(): DateTime
	{
		return $this->entryDate;
	}
	
	/**
	 * @param DateTime $entryDate
	 * @return Member
	 */
	public function setEntryDate(DateTime $entryDate): Member
	{
		$this->entryDate = $entryDate;
		return $this;
	}
	
	
}