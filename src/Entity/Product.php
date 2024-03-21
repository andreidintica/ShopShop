<?php

declare(strict_types = 1);

namespace MyApp\Entity;
use MyApp\Entity\Type;

class Product {
    private ?int $id = null;
    private string $name;
    private string $description;
    private float $prix;
    private Type $type;


    public function __construct(?int $id, string $name, string $description, float $prix, Type $type){
        $this-> id = $id;
        $this-> name = $name;
        $this-> description = $description;
        $this-> prix = $prix;
        $this->type = $type;
    }

    public function getId():?int{
        return $this->id;
    }
    public function getName():string{
        return $this->name;
    }
    public function getDescription():string{
        return $this->description;
    }
    public function getPrix():float{
        return $this->prix;
    }

    public function setId(?int $id):void{
        $this-> id = $id;
    }
    public function setName(string $name):void{
        $this-> name = $name;
    }
    public function setDescription(string $description):void{
        $this-> description = $description;
    }
    public function setPrix(string $prix):void{
        $this-> prix = $prix;
    }
    public function getType(): Type
    {
    return $this->type;
    }
    public function setType(Type $type): void
    {
    $this->type = $type;
    }
}