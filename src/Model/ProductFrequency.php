<?php
namespace Pdlt\Model;

class ProductFrequency {

    // ATTRIBUTS

    /** @var int  */
    protected int $id;

    /**
     * @var string
     */
    protected string $designation;



    // FONCTIONS

    /**
     * @param string $designation
     */
    public function __construct(string $designation = '')
    {
        $this->designation= $designation;
    }

    public function __toString()
    {
        return  $this->designation;
    }
	
	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}
	
	/**
	 * @param int $id
	 * @return ProductFrequency
	 */
	public function setId(int $id): ProductFrequency
	{
		$this->id = $id;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getDesignation(): string
	{
		return $this->designation;
	}
	
	/**
	 * @param string $designation
	 * @return ProductFrequency
	 */
	public function setDesignation(string $designation): ProductFrequency
	{
		$this->designation = $designation;
		return $this;
	}






}