<?php

namespace Tanarurkerem\Homework\Service;

use Exception;
use Tanarurkerem\Homework\Entity\TargyiKovetelmenyrendszer;
use Tanarurkerem\Homework\Entity\ValasztottSzak;

class TargyiKovetelmenyrendszerService implements TargyiKovetelmenyrendszerServiceInterface
{
    public function getKovetelmenyrendszer(ValasztottSzak $szak)
    {
        if ($szak->szak == 'Programtervező informatikus') {
            return new TargyiKovetelmenyrendszer(
                'matematika',
                [
                    'biológia',
                    'fizika',
                    'informatika',
                    'kémia',
                ]
            );
        }
        if ($szak->szak == 'Anglisztika') {
            return new TargyiKovetelmenyrendszer(
                'angol',
                [
                    'francia',
                    'német',
                    'olasz',
                    'orosz',
                    'spanyol',
                ]
            );
        }
        throw new Exception("Tárgyi követelmény rendszer nem található");
    }
}
