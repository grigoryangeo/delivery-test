<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Product
{
    /** @var  string */
    protected $code;

    /** @var  string */
    protected $name;

    /** @var  int */
    protected $count;

    /** @var  float */
    protected $cost;

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('code', new Assert\Length(['max' => 255]));
        $metadata->addPropertyConstraint('code', new Assert\NotBlank());

        $metadata->addPropertyConstraint('name', new Assert\Length(['max' => 255]));
        $metadata->addPropertyConstraint('name', new Assert\NotBlank());

        $metadata->addPropertyConstraint('count', new Assert\NotBlank());
        $metadata->addPropertyConstraint(
            'count',
            new Assert\Range(
                [
                    'min' => 1,
                    'max' => 1000,
                ]
            )
        );
        $metadata->addPropertyConstraint('cost', new Assert\NotBlank());
        $metadata->addPropertyConstraint(
            'cost',
            new Assert\Range(
                [
                    'min' => 1,
                ]
            )
        );
    }

    /**
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return self
     */
    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getCount(): ?int
    {
        return $this->count;
    }

    /**
     * @param int $count
     *
     * @return self
     */
    public function setCount(int $count): self
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return null|float
     */
    public function getCost(): ?float
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     *
     * @return self
     */
    public function setCost(float $cost): self
    {
        $this->cost = $cost;
        return $this;
    }
}