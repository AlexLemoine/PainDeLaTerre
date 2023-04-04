<?php

namespace Blog\Model;

trait Creatable
{

    // ATTRIBUTS

    /**
     * @var \DateTime
     */
    private \DateTime $createdAt;

    // FONCTIONS

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Product|Creatable
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}