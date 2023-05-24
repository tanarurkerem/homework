# Leírás

A tulajdonképpeni számolást a src/Services/Calculator.php-ban található Calculator osztály calculate metódusa végzi. Ennek kell átadni a mintában szereplő adathalmazt.
A tárgyi követelményeket egy külön szervízbe szerveztem ki, mely jelen esetben csak a példában megadott két értéket tartalmazza.

# TODO

* Emelt többletpontszám számításánál csak a pontszámításnál figyelembe vett két tárgyat számítja. Ez további egyeztetést igényel.
* Alapvetően az angol nyelvű azonosítók mellett tenném le a voksomat, de az üzleti domain (érettségi) nyelve miatt végül a magyar elnevezések mellett döntöttem. Az olyan elnevezések mint pl. az Entity már nem magyarítottam, ezért egy olyan keverék nyelv alakult ki, ami szerintem nem a legszerencsésebb. Azonban figyelembe véve a domaint elfogadhatónak gondolom, de mindenképpen csapat elé vinném a kérdés és közös döntésre bíznám. Amennyiben már van ilyen döntés, akkor azt követném.
