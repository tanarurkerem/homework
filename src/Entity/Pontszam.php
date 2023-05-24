<?php

namespace Tanarurkerem\Homework\Entity;

class Pontszam
{
    public function __construct(
        private int $alapPontszam = 0,
        private int $tobbletPontszam = 0,
    ) {
    }

    public function addAlapPontszam(int $alapPontszam)
    {
        $this->alapPontszam += $alapPontszam;
    }

    public function addTobbletPontszam(int $tobbletPontszam)
    {
        $this->tobbletPontszam += $tobbletPontszam;
        if ($this->tobbletPontszam > 100) {
            $this->tobbletPontszam = 100;
        }
    }

    public function getPontszam()
    {
        return $this->alapPontszam * 2 + $this->tobbletPontszam;
    }
}
