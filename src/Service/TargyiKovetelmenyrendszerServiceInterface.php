<?php

namespace Tanarurkerem\Homework\Service;

use Tanarurkerem\Homework\Entity\ValasztottSzak;

/**
 * @SuppressWarnings(PHPMD.LongClassName)
 */
interface TargyiKovetelmenyrendszerServiceInterface
{
    public function getKovetelmenyrendszer(ValasztottSzak $szak);
}
