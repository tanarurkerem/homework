

# TODO

* Alapvetően az angol nyelvű azonosítók mellett tenném le a voksomat, de az üzleti domain (érettségi) nyelve miatt végül a magyar elnevezések mellett döntöttem. Az olyan elnevezések mint pl. az Entity már nem magyarítottam, ezért egy olyan keverék nyelv alakult ki, ami szerintem nem a legszerencsésebb. Azonban figyelembe véve a domaint elfogadhatónak gondolom, de mindenképpen csapat elé vinném a kérdés és közös döntésre bíznám. Amennyiben már van ilyen döntés, akkor azt követném.

phpunit tests
phpcs --standard=PSR12 src tests
phpmd src,tests text cleancode,codesize,controversial,design,naming,unusedcode
