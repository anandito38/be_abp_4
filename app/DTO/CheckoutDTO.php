<?php

namespace App\DTO;
class CheckoutDTO{
    public function __construct(
        public ?int $idBooking = null,
        public ?int $idMenu = null,
        public ?int $quantity = null,
    ){}

    public function getIdMenu(): ?int
    {
        return $this->idMenu;
    }

    public function getIdBooking(): ?int
    {
        return $this->idBooking;
    }

    public function setIdMenu(?int $idMenu): void
    {
        $this->idMenu = $idMenu;
    }

    public function setIdBooking(?int $idBooking): void
    {
        $this->idBooking = $idBooking;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

}

?>
