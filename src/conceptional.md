# Konzept-Aufgabe

Gegeben ist ein komplexer eCommerce-Shop, basierend auf einem PHP-Monolithen. Im Laufe der Zeit wurde er aufgrund
zahlreicher Feature-Wünsche um verschiedenste Komponenten erweitert. Die Ausspielung von Angeboten im Shop ist in
letzter Zeit immer langsamer geworden.

Was könnten mögliche Ansätze sein, um die Geschwindigkeit des Shops wieder zu erhöhen?

# Antwort

## Backend

### Code

- als erstes Performance-Tests implementieren
- dann refactoren: Wo kann der Code vereinfacht werden? 
  - "Code Smell" detektieren und refactoren 
  - Z.B. mit kleineren Funktionen, mit weniger If- und anderen 
    Schleifen, mit moderneren, nicht so teuren (= performanteren) Funktionen
    - ganz kleines Beispiel: 
      - statt `array_merge($arr1, ["a" => 123, "b" => 456]);`
      - lieber `$arr1 + ["a" => 123, "b" => 456];`
    - oder lassen sich vielleicht Klassen zusammenfassen oder gegen Interfaces implementieren
    - das erhöht zudem die Wartbarkeit, Testbarkeit und Lesbarkeit des Codes
- zwischendurch natürlich die Performance-Tests immer wieder laufen lassen und vergleichen
- Dependencies regelmäßig updaten
- Abwägen, ob Komponenten in einen Microservice ausgelagert werden können
- APIs ebenfalls prüfen und im Sinne von "(API) User first" refactoren: Wird wirklich alles benötigt, was rausgeht? 
  Wird 
  wirklich alles benötigt, was angefordert wird?

### Datenbank

- Abfragen prüfen & optimieren, wo möglich: 
  - Wo werden Daten geholt, die gar nicht gebraucht werden? Bsp. `SELECT * FROM ...`
  - Wo finden unnötig komplizierte Joins statt?
  - Was wird immer und überall gebraucht und kann daher in die Session wandern?
- Können Tabellen "refactored", d.h. z.B. normalisiert werden?
- Welche Daten & Tabellen werden vielleicht gar nicht mehr gebraucht? 

## Frontend

### Images

- Produkt- und Marketing-Bilder prüfen: Wo ist eine hohe Auflösung wirklich nötig?
- verschiedene Größen, z.B. Thumbnails, bereitstellen oder durch schnellen Microservice ad hoc generieren lassen (wir
  haben tatsächlich intern einen solchen Service in Go gebaut: Die Bilder werden per API über den Service 
  eingebunden, d.h. die URL läuft über den Service, sowie Größenangaben als Parameter, und es werden binnen 
  Nanosekunden die richtigen 
  Maße zurückgegeben)

### Code

- CSS und JavaScript automatisiert minimieren (sollte beim Deployment durch die Pipeline geschehen)
- Accessibility-Richtlinien einhalten (haben ja viel mehr Nutzen als nur für den Enduser)
- auch hier natürlich refactoren, wo möglich und sinnvoll

### Local Storage

- nutzen, wo möglich und sinnvoll

## Abwägen

- Wenn der Aufwand für all die oben genannten Punkte beträchtlich ist, sollten die Kosten für einen Neubau evaluiert 
  werden