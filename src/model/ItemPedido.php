<?php

namespace model;

class ItemPedido
{
    private ?int $id;

    public function __construct() {}

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}
