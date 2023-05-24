<?php

namespace Tanarurkerem\Homework\Entity;

class TargyiKovetelmenyrendszer
{
    public function __construct(
        public readonly string $kotelezoTargy,
        public readonly array $valaszthatoTargy
    ) {
    }
}
