<?php

declare(strict_types=1);

namespace Tanarurkerem\Homework\Tests;

use PHPUnit\Framework\TestCase;
use Tanarurkerem\Homework\Entity\ErettsegiAdatok;

final class EntityTest extends TestCase
{
     /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function testErettsegiAdatok(): void
    {
        $adatok = ErettsegiAdatok::createFromDataArray($this->getExampleData1());
        $this->assertEquals('ELTE', $adatok->valasztottSzak->egyetem);
        $this->assertEquals('IK', $adatok->valasztottSzak->kar);
        $this->assertEquals('Programtervező informatikus', $adatok->valasztottSzak->szak);
        $this->assertEquals('informatika', $adatok->erettsegiEredmenyek[4]->nev);
        $this->assertEquals('közép', $adatok->erettsegiEredmenyek[4]->tipus);
        $this->assertEquals(95, $adatok->erettsegiEredmenyek[4]->eredmeny);
        $this->assertEquals('Nyelvvizsga', $adatok->tobbletpontok[1]->kategoria);
        $this->assertEquals('C1', $adatok->tobbletpontok[1]->tipus);
        $this->assertEquals('német', $adatok->tobbletpontok[1]->nyelv);
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     * @SuppressWarnings(PHPMD.ErrorControlOperator)
     */
    public function testErettsegiAdatokWrongData(): void
    {
        $this->expectException('TypeError');
        @ErettsegiAdatok::createFromDataArray([]);
    }

    private function getExampleData1()
    {
        return [
            'valasztott-szak' => [
                'egyetem' => 'ELTE',
                'kar' => 'IK',
                'szak' => 'Programtervező informatikus',
            ],
            'erettsegi-eredmenyek' => [
                [
                    'nev' => 'magyar nyelv és irodalom',
                    'tipus' => 'közép',
                    'eredmeny' => '70%',
                ],
                [
                    'nev' => 'történelem',
                    'tipus' => 'közép',
                    'eredmeny' => '80%',
                ],
                [
                    'nev' => 'matematika',
                    'tipus' => 'emelt',
                    'eredmeny' => '90%',
                ],
                [
                    'nev' => 'angol nyelv',
                    'tipus' => 'közép',
                    'eredmeny' => '94%',
                ],
                [
                    'nev' => 'informatika',
                    'tipus' => 'közép',
                    'eredmeny' => '95%',
                ],
            ],
            'tobbletpontok' => [
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'B2',
                    'nyelv' => 'angol',
                ],
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'C1',
                    'nyelv' => 'német',
                ],
            ],
        ];
    }
}
