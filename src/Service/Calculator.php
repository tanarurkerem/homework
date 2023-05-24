<?php

namespace Tanarurkerem\Homework\Service;

use Exception;
use Tanarurkerem\Homework\Entity\ErettsegiAdatok;
use Tanarurkerem\Homework\Entity\ErettsegiEredmeny;
use Tanarurkerem\Homework\Entity\Pontszam;
use Tanarurkerem\Homework\Entity\TargyiKovetelmenyrendszer;

class Calculator
{
    public function __construct(private TargyiKovetelmenyrendszerServiceInterface $kovetelmenyService)
    {
    }

    public function calculateKotelezo(
        ErettsegiAdatok $adatok,
        TargyiKovetelmenyrendszer $kovetelmeny,
        Pontszam $pontszam,
    ) {
        /** @var ErettsegiEredmeny|null */
        $kotelezoEredmenye = array_reduce(
            $adatok->erettsegiEredmenyek,
            function (
                ErettsegiEredmeny|null $found,
                ErettsegiEredmeny $eredmeny
            ) use ($kovetelmeny): ErettsegiEredmeny|null {
                if ($eredmeny->nev == $kovetelmeny->kotelezoTargy) {
                    $found = $eredmeny;
                }
                return $found;
            }
        );
        if (is_null($kotelezoEredmenye)) {
            throw new Exception("Nincs kötelező");
        }
        if ($kotelezoEredmenye->eredmeny < 20) {
            throw new Exception("Kevés a kötelező eredménye");
        }
        $pontszam->addAlapPontszam($kotelezoEredmenye->eredmeny);
        if ($kotelezoEredmenye->tipus == 'emelt') {
            $pontszam->addTobbletPontszam(50);
        }
    }

    public function calculateValaszthato(
        ErettsegiAdatok $adatok,
        TargyiKovetelmenyrendszer $kovetelmeny,
        Pontszam $pontszam,
    ) {
        /** @var ErettsegiEredmeny|null */
        $valaszthatoEredmenye = array_reduce(
            $adatok->erettsegiEredmenyek,
            function (
                ErettsegiEredmeny|null $max,
                ErettsegiEredmeny $eredmeny
            ) use ($kovetelmeny): ErettsegiEredmeny|null {
                if (in_array($eredmeny->nev, $kovetelmeny->valaszthatoTargy)) {
                    if (is_null($max)) {
                        $max = $eredmeny;
                    }
                    if ($eredmeny->eredmeny > $max->eredmeny) {
                        $max = $eredmeny;
                    }
                }
                return $max;
            }
        );
        if (is_null($valaszthatoEredmenye)) {
            throw new Exception("Nincs választható");
        }
        if ($valaszthatoEredmenye->eredmeny < 20) {
            throw new Exception("Kevés a valasztható eredménye");
        }
        if ($valaszthatoEredmenye->tipus == 'emelt') {
            $pontszam->addTobbletPontszam(50);
        }
        $pontszam->addAlapPontszam($valaszthatoEredmenye->eredmeny);
    }

    public function calculateNyelv(
        ErettsegiAdatok $adatok,
        Pontszam $pontszam,
    ) {
        $nyelvek = $this->nyelvszuro($adatok->tobbletpontok);
        $tobbletpontszam = array_reduce(
            $nyelvek,
            function ($tobbletpontszam, $nyelvvizsga) {
                if ($nyelvvizsga->tipus == 'B2') {
                    $tobbletpontszam += 28;
                }
                if ($nyelvvizsga->tipus == 'C1') {
                    $tobbletpontszam += 40;
                }
                return $tobbletpontszam;
            },
            0
        );
        $pontszam->addTobbletPontszam($tobbletpontszam);
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function calculate($data): int
    {
        $pontszam = new Pontszam();
        $adatok = ErettsegiAdatok::createFromDataArray($data);
        $kovetelmenyRendszer = $this->kovetelmenyService->getKovetelmenyrendszer($adatok->valasztottSzak);
        $this->calculateKotelezo($adatok, $kovetelmenyRendszer, $pontszam);
        $this->calculateValaszthato($adatok, $kovetelmenyRendszer, $pontszam);
        $this->calculateNyelv($adatok, $pontszam);

        return $pontszam->getPontszam();
    }

    public function nyelvszuro(array $nyelvvizsgak)
    {
        $nyelvek = [];
        foreach ($nyelvvizsgak as $nyelvvizsga) {
            if ($nyelvvizsga->tipus == 'B2') {
                $vanNagyobb = false;
                foreach ($nyelvvizsgak as $nagyobb) {
                    if ($nagyobb->nyelv == $nyelvvizsga->nyelv && $nagyobb->tipus == 'C1') {
                        $vanNagyobb = true;
                    }
                }
                if ($vanNagyobb) {
                    continue;
                }
            }
            $nyelvek[] = $nyelvvizsga;
        }
        return $nyelvek;
    }
}
