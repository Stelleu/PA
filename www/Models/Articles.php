<?php

namespace App\Models;

use Cassandra\Float_;

class Articles extends \App\Core\Sql
{
    protected Int $id = 0;
    protected String $name;
    protected String $categorie;
    protected Float $price ;
    protected Int $quantities;

    /**
     * @return Int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param Int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return String
     */
    public function getCategorie(): string
    {
        return $this->categorie;
    }

    /**
     * @param String $categorie
     */
    public function setCategorie(string $categorie): void
    {
        $this->categorie = $categorie;
    }

    /**
     * @return Float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param Float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return Int
     */
    public function getQuantities(): int
    {
        return $this->quantities;
    }

    /**
     * @param Int $quantities
     */
    public function setQuantities(int $quantities): void
    {
        $this->quantities = $quantities;
    }



}