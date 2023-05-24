<?php

namespace Tanarurkerem\Homework\Entity;

class ValasztottSzak
{
    public function __construct(
        public readonly string $egyetem,
        public readonly string $kar,
        public readonly string $szak,
    ) {
    }
}
