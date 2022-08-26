# Kombinierte Coding- und Konzept-Aufgabe

Moin. Du erhälst in dieser README zwei Aufgaben, mit der Bitte beide zu bearbeiten. Zunächst haben wir eine kleine
Konzeptaufgabe. Danach wollen wir sehen, wie Du in PHP eine Aufgabenstellung angehst.

Vor allem bei der Programmieraufgabe ist es *nicht* wichtig, ob am Ende das 1a-Resultat vorliegt. Wir wollen sehen, wie
Du solche Aufgaben angehst.

Bitte schicke nach vier Stunden nach Erhalt der Aufgaben die beiden Lösungen in einer ZIP-Datei an nils.lauk@skon.de (
alternativ schickst Du einen Link zu einem Repository mit der Lösung - in letzter Zeit bekam ich mehrmals ZIP-Dateien im
binären Format, die ich nicht habe öffnen können ...).

## Konzept-Aufgabe

Gegeben ist ein komplexer eCommerce-Shop, basierend auf einem PHP-Monolithen. Im Laufe der Zeit wurde er aufgrund
zahlreicher Feature-Wünsche um verschiedenste Komponenten erweitert. Die Ausspielung von Angeboten im Shop ist in
letzter Zeit immer langsamer geworden.

Was könnten mögliche Ansätze sein, um die Geschwindigkeit des Shops wieder zu erhöhen?

Nimm Dir _maximal eine Stunde Zeit_ für die Beantwortung dieser Aufgabe. Schreibe frei runter, triff gerne Annahmen und
lasse darauf Deine Antworten basieren.

## PHP-Aufgabe

In dem beiliegendem `objekte.json` sind Objekte mit Preisen definiert. Diese Objekte sollen eingelesen werden und dann
so sortiert sein, sodass folgende Kriterien der Priorität nach erfüllt sind:

**Prio 1**: Objekte mit Angebotspreis (`promotionPrice > 0`) werden zuerst angezeigt, danach kommen die Objekte ohne
Angebotspreis.
**Prio 2**: Die Objekte sollen abwechselnd nach `type` sortiert werden, bspw.: `A`, `B`, `C`. Es sollen _möglichst_
Objekte vom gleichen Type _nicht_ aufeinander folgen (gilt auch für Objekte mit Angebotspreis).
**Prio 3**: Die Objekte werden aufsteigend nach Preis sortiert.

Zudem muss folgende Rahmenbedingung erfüllt sein:

- Wenn Objekte einen Angebotspreis haben, gilt der Angebotspreis anstelle des Preises (Ausgabe/Sortierung).

Bonus (müssen also nicht zwingend bearbeitet werden):

- Alle Funktionen sind unit-getestet (100% coverage).
- Die Daten werden vor dem Test geshuffled.
- Es steht Dir frei, ob Du die Aufgabe in "PHP pur" umsetzen möchtest oder in Symfony.

### Datenstruktur, Beispiel

```json
{
    "id": "1",
    "type": "A",
    "price": 21099,
    // monatlicher Preis in Cent
    "promotionPrice": 20894
    // Angebotspreis in Cent (überschreibt monatlichen Preis)
}
```

### Beispiel-Resultat

```json
[
    {
        "id": "4",
        "type": "A",
        "price": 21194,
        "promotionPrice": 20894
    },
    {
        "id": "2",
        "type": "B",
        "price": 23894,
        "promotionPrice": 22894
    },
    {
        "id": "5",
        "type": "B",
        "price": 24894,
        "promotionPrice": 23894
    },
    {
        "id": "1",
        "type": "A",
        "price": 21099,
        "promotionPrice": 0
    },
    {
        "id": "3",
        "type": "B",
        "price": 22099,
        "promotionPrice": 0
    }
]
```