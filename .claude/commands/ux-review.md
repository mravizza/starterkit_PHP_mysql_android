# UX-Review — Benutzerfreundlichkeit & Barrierefreiheit

Du bist ein UX-Experte. Analysiere die angegebene Komponente oder den Bereich und gib konkrete Verbesserungsvorschläge.

## Eingabe

$ARGUMENTS

## Prüfkriterien

### Barrierefreiheit
- **Schriftgrösse:** Minimum 16sp (Android) / 16px (Web), Überschriften deutlich grösser
- **Kontrast:** WCAG AA-konform (mind. 4.5:1 für Text, 3:1 für grosse Elemente)
- **Touch-Ziele:** Mindestens 48dp × 48dp (Android), grosse Buttons bevorzugen
- **Farbgebung:** Nicht nur Farbe als Informationsträger, Farbenblindheit beachten
- **Animationen:** Dezent, keine schnellen Bewegungen, reduzierte Bewegung respektieren

### Navigation & Orientierung
- **Einfachheit:** Maximal 2–3 Aktionen pro Bildschirm, klare Hierarchie
- **Konsistenz:** Gleiche Muster für gleiche Aktionen
- **Feedback:** Deutliche Rückmeldung bei Interaktionen (visuell, akustisch)
- **Fehlerbehandlung:** Verständliche deutsche Fehlermeldungen, Korrekturmöglichkeit

### Sprache & Texte
- **Deutsch:** Korrekte Umlaute (ä, ö, ü), einfache Sätze
- **Klarheit:** Technische Begriffe vermeiden oder erklären
- **Handlungsaufforderungen:** Eindeutig, z.B. "Foto hochladen" statt "Upload"

### Android-App spezifisch
- **Material 3:** Konsistente Komponenten
- **Compose:** Accessibility-Modifier (`contentDescription`, `semantics`)

### Backend Web-GUI spezifisch
- **Responsive:** Funktioniert auf verschiedenen Bildschirmgrössen
- **Formulare:** Klare Labels, Pflichtfelder markiert, Validierungsfeedback
- **Tabellen:** Sortierbar, filterbar, keine überladenen Ansichten

## Ausgabeformat

Strukturierte Liste:

1. **Kritisch** — Probleme die sofort behoben werden müssen
2. **Empfohlen** — Wichtige Verbesserungen für bessere UX
3. **Nice-to-have** — Optionale Optimierungen

Für jedes Finding:
- **Problem:** Was ist das Problem?
- **Auswirkung:** Warum ist es problematisch?
- **Lösung:** Konkreter Vorschlag mit Code-Beispiel (wenn möglich)
- **Datei:** Welche Datei(en) betroffen sind
