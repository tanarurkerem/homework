<?php

namespace Tanarurkerem\Homework\Entity;

class ErettsegiAdatok
{
    public function __construct(
        public readonly ValasztottSzak $valasztottSzak,
        public readonly array $erettsegiEredmenyek,
        public readonly array $tobbletpontok
    ) {
    }

    public static function createFromDataArray($data): ErettsegiAdatok
    {
        $valasztottSzak = new ValasztottSzak(
            $data["valasztott-szak"]["egyetem"],
            $data["valasztott-szak"]["kar"],
            $data["valasztott-szak"]["szak"],
        );
        $erettsegiEredmenyek = array_map(
            function ($eredmenyData) {
                return new ErettsegiEredmeny(
                    $eredmenyData['nev'],
                    $eredmenyData['tipus'],
                    (int)$eredmenyData['eredmeny'],
                );
            },
            $data['erettsegi-eredmenyek']
        );
        $tobbletpontok = array_map(function ($tobbletpontData) {
            return new Tobbletpont(
                $tobbletpontData['kategoria'],
                $tobbletpontData['tipus'],
                $tobbletpontData['nyelv'],
            );
        }, $data['tobbletpontok']);

        return new ErettsegiAdatok($valasztottSzak, $erettsegiEredmenyek, $tobbletpontok);
    }
}
