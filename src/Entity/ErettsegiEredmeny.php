<?php

namespace Tanarurkerem\Homework\Entity;

class ErettsegiEredmeny
{
    public function __construct(
        public readonly string $nev,
        public readonly string $tipus,
        public readonly int $eredmeny
    ) {
    }
}
