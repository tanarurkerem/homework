<?php

declare(strict_types=1);

namespace Tanarurkerem\Homework\Tests;

use PHPUnit\Framework\TestCase;
use Tanarurkerem\Homework\Entity\Pontszam;

final class PontszamTest extends TestCase
{
    public function testPontszam(): void
    {
        $pontszam = new Pontszam();
        $this->assertEquals(0, $pontszam->getPontszam());
        $pontszam->addAlapPontszam(1);
        $this->assertEquals(2, $pontszam->getPontszam());
        $pontszam->addTobbletPontszam(1);
        $this->assertEquals(3, $pontszam->getPontszam());
        $pontszam->addTobbletPontszam(99);
        $this->assertEquals(102, $pontszam->getPontszam());
        $pontszam->addTobbletPontszam(1);
        $this->assertEquals(102, $pontszam->getPontszam());
    }
}
