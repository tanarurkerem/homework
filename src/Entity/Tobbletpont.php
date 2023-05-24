<?php

namespace Tanarurkerem\Homework\Entity;

class Tobbletpont
{
    public function __construct(
        public readonly string $kategoria,
        public readonly string $tipus,
        public readonly string $nyelv,
    ) {
    }
}
