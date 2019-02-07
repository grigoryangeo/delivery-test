<?php

namespace App\Entity;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Order
{
    /** @var  string */
    protected $name;

    /** @var  string */
    protected $surname;

    /** @var  string */
    protected $patronymic;

    /** @var  string */
    protected $phone;

    /** @var  string */
    protected $fromAddress;

    /** @var  string */
    protected $fromLatitude;

    /** @var  string */
    protected $fromLongitude;

    /** @var  string */
    protected $fromContactName;

    /** @var  string */
    protected $fromContactPhone;

    /** @var  string */
    protected $toAddress;

    /** @var  string */
    protected $toLatitude;

    /** @var  string */
    protected $toLongitude;

    /** @var  DateTime */
    protected $timeBegin;

    /** @var  DateTime */
    protected $timeEnd;

    /** @var  int */
    protected $schema;

    /** @var  int */
    protected $legalEntity;

    /** @var  string */
    protected $payMethod;

    /** @var  string */
    protected $externalId;

    /** @var  bool */
    protected $tailLift;

    /** @var  int */
    protected $loaders;

    /** @var  array */
    protected $products;

    /**
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new Assert\NotBlank());
        $metadata->addPropertyConstraint('name', new Assert\Length(['max' => 255]));

        $metadata->addPropertyConstraint('surname', new Assert\Length(['max' => 255]));
        $metadata->addPropertyConstraint('patronymic', new Assert\Length(['max' => 255]));

        $metadata->addPropertyConstraint(
            'phone',
            new Assert\Regex(
                [
                    'pattern' => '/^7[0-9]{10}$/',
                ]
            )
        );

        $metadata->addPropertyConstraint('phone', new Assert\NotBlank());
        $metadata->addPropertyConstraint('phone', new Assert\Length(['max' => 255]));

        $metadata->addPropertyConstraint('fromAddress', new Assert\NotBlank());
        $metadata->addPropertyConstraint('fromAddress', new Assert\Length(['max' => 255]));

        $metadata->addPropertyConstraint('fromLatitude', new Assert\NotBlank());
        $metadata->addPropertyConstraint('fromLatitude', new Assert\Length(['max' => 255]));

        $metadata->addPropertyConstraint('fromLongitude', new Assert\NotBlank());
        $metadata->addPropertyConstraint('fromLongitude', new Assert\Length(['max' => 255]));

        $metadata->addPropertyConstraint('fromContactName', new Assert\NotBlank());
        $metadata->addPropertyConstraint('fromContactName', new Assert\Length(['max' => 255]));

        $metadata->addPropertyConstraint('fromContactPhone', new Assert\NotBlank());
        $metadata->addPropertyConstraint('fromContactPhone', new Assert\Length(['max' => 255]));

        $metadata->addPropertyConstraint('toAddress', new Assert\NotBlank());
        $metadata->addPropertyConstraint('toAddress', new Assert\Length(['max' => 255]));

        $metadata->addPropertyConstraint('toLatitude', new Assert\NotBlank());
        $metadata->addPropertyConstraint('toLatitude', new Assert\Length(['max' => 255]));

        $metadata->addPropertyConstraint('toLongitude', new Assert\NotBlank());
        $metadata->addPropertyConstraint('toLongitude', new Assert\Length(['max' => 255]));

        //$metadata->addPropertyConstraint('schema', new Assert\NotBlank());
        $metadata->addPropertyConstraint('schema', new Assert\Range(['min' => 1,]));

        //$metadata->addPropertyConstraint('legalEntity', new Assert\NotBlank());
        $metadata->addPropertyConstraint('legalEntity', new Assert\Range(['min' => 1,]));

        $metadata->addPropertyConstraint('externalId', new Assert\Length(['max' => 255]));

        $metadata->addPropertyConstraint('loaders', new Assert\Length(['max' => 255]));
        $metadata->addPropertyConstraint('loaders', new Assert\Range(['min' => 0, 'max' => 100]));

        $metadata->addPropertyConstraint(
            'products',
            new Assert\Count(
                [
                    'min' => 1,
                ]
            )
        );

        $metadata->addPropertyConstraint('timeBegin', new Assert\NotBlank());
        $metadata->addPropertyConstraint('timeBegin', new Assert\DateTime());

        $metadata->addPropertyConstraint('timeEnd', new Assert\NotBlank());
        $metadata->addPropertyConstraint('timeEnd', new Assert\DateTime());

        $metadata->addPropertyConstraint('payMethod', new Assert\NotBlank());
        /*
                $metadata->addPropertyConstraint('payMethod', new Assert\Choice([
                    'callback' => ['getPayMethods'],
                ]));
        */
    }

    /**
     * avalible PayMethods
     *
     * @return array
     */
    public static function getPayMethods(): array
    {
        return ["cash", "card", "bank"];
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
     * @return null|string
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     *
     * @return self
     */
    public function setSurname(string $surname): self
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    /**
     * @param string $patronymic
     *
     * @return self
     */
    public function setPatronymic(string $patronymic): self
    {
        $this->patronymic = $patronymic;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return self
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFromAddress():?string
    {
        return $this->fromAddress;
    }

    /**
     * @param string $fromAddress
     *
     * @return self
     */
    public function setFromAddress(string $fromAddress): self
    {
        $this->fromAddress = $fromAddress;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFromLatitude(): ?string
    {
        return $this->fromLatitude;
    }

    /**
     * @param string $fromLatitude
     *
     * @return self
     */
    public function setFromLatitude(string $fromLatitude): self
    {
        $this->fromLatitude = $fromLatitude;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFromLongitude(): ?string
    {
        return $this->fromLongitude;
    }

    /**
     * @param string $fromLongitude
     *
     * @return self
     */
    public function setFromLongitude(string $fromLongitude): self
    {
        $this->fromLongitude = $fromLongitude;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFromContactName(): ?string
    {
        return $this->fromContactName;
    }

    /**
     * @param string $fromContactName
     *
     * @return self
     */
    public function setFromContactName(string $fromContactName): self
    {
        $this->fromContactName = $fromContactName;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFromContactPhone(): ?string
    {
        return $this->fromContactPhone;
    }

    /**
     * @param string $fromContactPhone
     *
     * @return self
     */
    public function setFromContactPhone(string $fromContactPhone): self
    {
        $this->fromContactPhone = $fromContactPhone;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getToAddress(): ?string
    {
        return $this->toAddress;
    }

    /**
     * @param string $toAddress
     *
     * @return self
     */
    public function setToAddress(string $toAddress): self
    {
        $this->toAddress = $toAddress;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getToLatitude(): ?string
    {
        return $this->toLatitude;
    }

    /**
     * @param string $toLatitude
     *
     * @return self
     */
    public function setToLatitude(string $toLatitude): self
    {
        $this->toLatitude = $toLatitude;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getToLongitude(): ?string
    {
        return $this->toLongitude;
    }

    /**
     * @param string $toLongitude
     *
     * @return self
     */
    public function setToLongitude(string $toLongitude): self
    {
        $this->toLongitude = $toLongitude;
        return $this;
    }

    /**
     * @return null|DateTime
     */
    public function getTimeBegin(): ?DateTime
    {
        return $this->timeBegin;
    }

    /**
     * @param DateTime $timeBegin
     *
     * @return self
     */
    public function setTimeBegin(DateTime $timeBegin): self
    {
        $this->timeBegin = $timeBegin;
        return $this;
    }

    /**
     * @return null|DateTime
     */
    public function getTimeEnd(): ?DateTime
    {
        return $this->timeEnd;
    }

    /**
     * @param DateTime $timeEnd
     *
     * @return self
     */
    public function setTimeEnd(DateTime $timeEnd): self
    {
        $this->timeEnd = $timeEnd;
        return $this;
    }

    /**
     * @return null|array
     */
    public function getProducts(): ?array
    {
        return $this->products;
    }

    /**
     * @param array $products
     *
     * @return self
     */
    public function setProducts(array $products): self
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getSchema(): ?int
    {
        return $this->schema;
    }

    /**
     * @param null|int $schema
     *
     * @return self
     */
    public function setSchema(?int $schema): self
    {
        $this->schema = $schema;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getLegalEntity(): ?int
    {
        return $this->legalEntity;
    }

    /**
     * @param null|int $legalEntity
     *
     * @return self
     */
    public function setLegalEntity(?int $legalEntity): self
    {
        $this->legalEntity = $legalEntity;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPayMethod(): ?string
    {
        return $this->payMethod;
    }

    /**
     * @param string $payMethod
     *
     * @return self
     */
    public function setPayMethod(string $payMethod): self
    {
        $this->payMethod = $payMethod;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    /**
     * @param null|string $externalId
     *
     * @return self
     */
    public function setExternalId(?string $externalId): self
    {
        $this->externalId = $externalId;
        return $this;
    }

    /**
     * @return null|bool
     */
    public function getTailLift(): ?bool
    {
        return $this->tailLift;
    }

    /**
     * @param bool $tailLift
     *
     * @return self
     */
    public function setTailLift(bool $tailLift): self
    {
        $this->tailLift = $tailLift;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getLoaders(): ?int
    {
        return $this->loaders;
    }

    /**
     * @param null|int $loaders
     *
     * @return self
     */
    public function setLoaders(?int $loaders): self
    {
        $this->loaders = $loaders;
        return $this;
    }
}