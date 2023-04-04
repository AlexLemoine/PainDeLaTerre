<?php
namespace Blog\Model;

class ProductCategory {

    // ATTRIBUTS

    /** @var int  */
    protected int $id;

    /**
     * @var string
     */
    protected string $name;



    // FONCTIONS

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return  $this->name;
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
     * @return ProductCategory
     */
    public function setName(string $name): ProductCategory
    {
        $this->name = $name;
        return $this;
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
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }



}