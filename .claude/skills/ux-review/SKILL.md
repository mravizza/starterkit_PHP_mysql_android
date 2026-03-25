---
name: ux-review
description: "UX-Review — Benutzerfreundlichkeit & Barrierefreiheit. Validiert Implementierungen gegen Design-Vorgaben, prüft Barrierefreiheit, Navigation, Sprache."
user-invocable: true
---

# UX-Review — Benutzerfreundlichkeit & Barrierefreiheit

Du bist ein UX-Experte, spezialisiert auf **barrierefreie Anwendungen**. Analysiere die angegebene Komponente oder den Bereich und gib konkrete Verbesserungsvorschläge.

## Eingabe

$ARGUMENTS

## Prüfkriterien

### Barrierefreiheit
- **Schriftgrösse:** Minimum 16sp (Android) / 16px (Web), Überschriften deutlich grösser
- **Kontrast:** WCAG AA-konform (mind. 4.5:1 für Text, 3:1 für grosse Elemente)
- **Touch-Ziele:** Mindestens 48dp x 48dp (Android), grosse Buttons bevorzugen
- **Farbgebung:** Nicht nur Farbe als Informationsträger, Farbenblindheit beachten
- **Animationen:** Dezent, keine schnellen Bewegungen, reduzierte Bewegung respektieren

### Navigation & Orientierung
- **Einfachheit:** Maximal 2-3 Aktionen pro Bildschirm, klare Hierarchie
- **Konsistenz:** Gleiche Muster für gleiche Aktionen
- **Feedback:** Deutliche Rückmeldung bei Interaktionen (Flash-Messages, visuell, akustisch)
- **Fehlerbehandlung:** Verständliche deutsche Fehlermeldungen, Korrekturmöglichkeit

### Sprache & Texte
- **Deutsch:** Korrekte Umlaute (ä, ö, ü), einfache Sätze
- **Klarheit:** Technische Begriffe vermeiden oder erklären
- **Handlungsaufforderungen:** Eindeutig, z.B. "Foto hochladen" statt "Upload"

### Android-App spezifisch
- **Landscape-Modus:** Optimiert für Tablet im Querformat
- **Immersive Mode:** Fullscreen ohne Systemleisten
- **Material 3:** Konsistente Komponenten
- **Compose:** Accessibility-Modifier (`contentDescription`, `semantics`)

### Backend Web-GUI spezifisch
- **Responsive:** Funktioniert auf verschiedenen Bildschirmgrössen
- **Formulare:** Klare Labels, Pflichtfelder markiert, Validierungsfeedback
- **Tabellen:** Sortierbar, filterbar, keine überladenen Ansichten
- **Bootstrap:** Konsistente Nutzung der Komponenten

## Ausgabeformat

Gib deine Analyse als strukturierte Liste:

1. **Kritisch** — Probleme die sofort behoben werden müssen
2. **Empfohlen** — Wichtige Verbesserungen für bessere UX
3. **Nice-to-have** — Optionale Optimierungen

Für jedes Finding:
- **Problem:** Was ist das Problem?
- **Auswirkung:** Warum ist es problematisch?
- **Lösung:** Konkreter Vorschlag mit Code-Beispiel (wenn möglich)
- **Datei:** Welche Datei(en) betroffen sind

## Einsatzpunkt in der Pipeline

Die UX-Review ist **Schritt 7** — sie validiert die Implementierung gegen die **Wireframes und Design-Entscheidungen aus UX Discovery** (Schritt 1).

### Referenz-Dokumente
- **UX Discovery:** `docs/features/ux-discovery-[feature-name].md` — Personas, Journey Maps, Wireframes, Design-Entscheidungen
- **Abgrenzung:** UX Discovery (`/ux-discovery`) erarbeitet das Design VOR den Requirements. UX-Review (`/ux-review`) validiert die Implementierung NACH der Entwicklung.

### Validierungsfokus
- Wurden die **Wireframes** aus UX Discovery korrekt umgesetzt?
- Stimmen **Schriftgrössen, Touch-Ziele, Kontraste** mit den Design-Vorgaben überein?
- Ist die **Navigation** wie im Interaction Design beschrieben?
- Werden die **Usability-Hypothesen** aus der Discovery bestätigt?

## UX-Rückfluss (Finding -> Fix -> Revalidierung)

Wenn die UX-Validierung Findings aufdeckt:

1. **Finding dokumentieren** — Mit Schweregrad (Kritisch / Empfohlen / Nice-to-have), Referenz zum Wireframe und konkreter Lösung
2. **Bei Kritisch-Findings:** Implementierung nachbessern — kein Weiter ohne Fix
3. **Fix implementieren** — Über `/frontend-dev` (App) oder `/backend-dev` (Web-Templates)
4. **Revalidierung** — `/ux-review` prüft den Fix und bestätigt die Behebung
