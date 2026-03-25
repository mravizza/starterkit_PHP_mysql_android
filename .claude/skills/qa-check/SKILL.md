---
name: qa-check
description: "QA-Check — Qualitätssicherung & Testing. Prüft Code-Änderungen systematisch auf Korrektheit, Sicherheit und Regressionen."
user-invocable: true
---

# QA-Check — Qualitätssicherung & Testing

Du bist ein erfahrener QA-Ingenieur für dieses Projekt. Du prüfst Code-Änderungen systematisch auf Korrektheit, Sicherheit und Regressionen.

## Aufgabe

$ARGUMENTS

## Prüfbereiche

### 1. Code-Review
- **Logik:** Korrekte Bedingungen, Edge Cases, Off-by-One-Fehler
- **Typen:** Korrekte Casts, null-Checks, leere Arrays/Strings
- **PHP-Fallen:** `isset()` vs `!empty()` (Checkbox-Bug!), `==` vs `===`, String/Int-Vergleiche
- **Kotlin-Fallen:** Nullable-Typen, Coroutine-Scoping, StateFlow-Updates
- **SQL:** Injection-Risiken, fehlende Indices, N+1-Queries

### 2. Sicherheit
- **SQL Injection:** Sind alle Queries Prepared Statements?
- **XSS:** Werden alle Ausgaben escaped?
- **CSRF:** Hat jedes Formular ein Token? Wird es validiert?
- **Auth:** Sind alle Endpunkte geschützt?
- **File Upload:** MIME-Check, Grössen-Limit, Duplikat-Erkennung?
- **API:** Sind Bearer-Tokens korrekt validiert?

### 3. Funktionale Tests
- **Happy Path:** Funktioniert der Standardfall?
- **Edge Cases:**
  - Leere Eingaben / leere Formulare
  - Ungültige IDs (0, negative, nicht-existent)
  - Doppelte Einträge / Duplikate
  - Maximale Werte (grosse Dateien, lange Strings)
  - Sonderzeichen (Umlaute ä/ö/ü, Emojis, HTML-Tags)
  - Gleichzeitige Zugriffe (Race Conditions)
- **Fehlerfälle:** Was passiert bei Netzwerkfehler, DB-Fehler, ungültigen Daten?

### 4. Integration
- **API <-> App:** Stimmen die JSON-Keys überein (camelCase)?
- **DB <-> Model:** Stimmen Spalten und Typen überein?
- **Controller <-> Template:** Werden alle Variablen korrekt übergeben?
- **Config-Flow:** Backend -> API -> DTO -> Room -> StateFlow -> UI

### 5. UI/UX-Regression
- **Deutsche Texte:** Korrekte Umlaute (ä, ö, ü, nie ae/oe/ue)?
- **Flash-Messages:** Werden Erfolgs- und Fehlermeldungen korrekt angezeigt?
- **Redirects:** Wird nach Aktionen korrekt weitergeleitet?
- **Filter/Suche:** Funktionieren alle Filter-Kombinationen (inkl. "Alle")?
- **Schriftgrössen:** Minimum 16sp (Android) / 16px (Web) eingehalten?
- **Touch-Ziele:** Mindestens 48dp x 48dp (Android)?
- **Kontrast:** WCAG AA (mind. 4.5:1 Text, 3:1 grosse Elemente)?
- **UX-Vorgaben:** Stimmt die Implementierung mit den Wireframes und Design-Entscheidungen aus UX Discovery überein? (Referenz: `docs/features/ux-discovery-[feature-name].md`)

### 6. Build & Deployment
- **Android Build:** `./gradlew assembleDebug` erfolgreich?
- **PHP Syntax:** Keine Parse-Errors?
- **FTP Deployment:** Sind alle geänderten Dateien deployed?
- **Config:** Sind `config.local.php` und `.env`-Variablen korrekt?

## Bekannte Bug-Patterns

| Pattern | Problem | Lösung |
|---------|---------|--------|
| `isset($data['field'])` für Checkboxes | Gibt `true` zurück auch wenn Wert `false` ist | `!empty($data['field'])` verwenden |
| `isset($_GET['param'])` für Filter | Leerer String `""` gilt als "gesetzt" | `!empty($_GET['param'])` verwenden |

## Testmethodik

### Für PHP-Änderungen
1. Code-Review der geänderten Dateien
2. Trace des Datenflusses: Form -> POST -> Controller -> Model -> DB -> Redirect
3. Edge Cases für Eingabevalidierung prüfen
4. SQL-Queries auf Injection und Performance prüfen
5. CSRF- und Auth-Checks verifizieren

### Für Android-Änderungen
1. Code-Review der geänderten Dateien
2. Build testen: `./gradlew assembleDebug`
3. State-Flow prüfen: ViewModel -> StateFlow -> UI
4. Coroutine-Scoping überprüfen
5. Hilt-Injection verifizieren

### Für API-Änderungen
1. Request/Response-Format gegen `swagger.yaml` prüfen
2. Auth-Header-Validierung testen
3. Fehler-Responses (400, 401, 404, 500) prüfen
4. Kompatibilität mit Android-DTOs sicherstellen

## Prüfphasen

### Phase A: Statische Analyse (kann parallel zur Implementierung laufen)
- Code-Review (Sektion 1)
- Sicherheits-Check (Sektion 2)
- Build-Verifikation (Sektion 6)

### Phase B: Testausführung (nach Implementierung)
- Funktionale Tests (Sektion 3)
- Integrations-Prüfung (Sektion 4)
- UI/UX-Regression (Sektion 5)
- Testfall-Ausführung mit Traceability (Sektion 7)

## 7. Testfall-Ausführung (Regression + Progression)

**WICHTIG:** Bei jedem QA-Check müssen die dokumentierten Testfälle systematisch ausgeführt werden.

### Testfall-Dokumente
- **Übersicht & Rückverfolgungsmatrix:** `docs/devdocs/03-test-cases.md`
- **Unit Tests:** `docs/devdocs/03-test-unit.md`
- **Integration Tests:** `docs/devdocs/03-test-integration.md`
- **E2E Tests:** `docs/devdocs/03-test-e2e.md`

### Ausführungsablauf

1. **Betroffene Features identifizieren** — Welche Feature-Bereiche wurden geändert?
2. **Regressions-Tests auswählen** — Alle bestehenden Testfälle der betroffenen Feature-Bereiche
3. **Progressions-Tests auswählen** — Alle neuen Testfälle für neu implementierte Features
4. **Testfälle ausführen:**
   - **Unit Tests:** Code-Review-basiert (Logik, Validierung, Berechnungen prüfen)
   - **Integration Tests:** Datenfluss tracen (API <-> App, DB <-> Model, Config-Flow)
   - **E2E Tests:** Komplette User Journeys nachvollziehen
5. **Status aktualisieren** — In `docs/devdocs/03-test-cases.md` die Rückverfolgungsmatrix aktualisieren

### Priorisierung
- **P0 Tests:** Immer ausführen (Kernfunktionen, Sicherheit)
- **P1 Tests:** Vor jedem Release ausführen
- **P2 Tests:** Bei Kapazität / bei betroffenen Bereichen

## Ausgabeformat

Speichere die Findings als Markdown-Datei in `docs/qa-check/vX.Y.Z-bN.md`.

**Versions-Info ermitteln:**
- `versionName` und `versionCode` aus `android-app/app/build.gradle.kts` lesen
- Backend-API-Version aus `backend/swagger.yaml` (`info.version`) lesen
- Beides im Report-Header dokumentieren

### Zusammenfassung
- **App-Version:** vX.Y.Z (Build N) — aus `build.gradle.kts`
- **API-Version:** X.Y.Z — aus `swagger.yaml`
- **Geprüfte Dateien:** Liste
- **Gesamtbewertung:** OK / Warnungen / Probleme

### Testfall-Ergebnisse (Traceability Report)

**PFLICHT:** Der QA-Report muss eine Traceability-Tabelle enthalten, die zeigt welche Testfälle für welche User Story ausgeführt wurden.

```markdown
## Testfall-Ergebnisse

### Ausgeführte Tests

| Testfall | User Story | Typ | Ergebnis | Bemerkung |
|----------|-----------|------|----------|-----------|
| UT-001   | US-APP-01 | Regression | Bestanden | — |
| IT-003   | US-APP-03 | Regression | Bestanden | — |
| E2E-007  | US-APP-10 | Progression | Fehlgeschlagen | Finding #F-003 |

### Zusammenfassung
| Kategorie | Gesamt | Bestanden | Fehlgeschlagen | Übersprungen |
|-----------|--------|-----------|----------------|--------------|
| Regression | X | Y | Z | W |
| Progression | X | Y | Z | W |
| **Total** | **X** | **Y** | **Z** | **W** |

### Abdeckung pro Feature
| Feature | User Stories | Tests ausgeführt | Bestanden | Fehlgeschlagen |
|---------|------------|-----------------|-----------|----------------|
| Feature A | US-APP-01,02 | 8 | 7 | 1 |
| Feature B | US-APP-03,04 | 5 | 5 | 0 |
```

### Findings
Für jedes Finding:
- **Schweregrad:** Kritisch / Warnung / Info
- **Testfall-Referenz:** Welcher Testfall hat den Fehler aufgedeckt
- **User Story:** Betroffene User Story
- **Datei:** Pfad und Zeile
- **Problem:** Beschreibung
- **Auswirkung:** Was kann schiefgehen?
- **Fix:** Konkreter Lösungsvorschlag mit Code

### Empfehlungen
- Fehlende Tests die geschrieben werden sollten
- Potenzielle Regressionen in anderen Bereichen
- Dokumentation die aktualisiert werden muss

## Bug-Rückfluss (Finding -> Fix -> Retest)

Wenn der QA-Check Findings aufdeckt, gilt folgender Rückfluss-Prozess:

1. **Finding dokumentieren** — Im QA-Report mit Schweregrad und Testfall-Referenz
2. **Bug-Story erstellen** — Für Kritisch und Warnung: User Story in der betroffenen Feature-Datei ergänzen
3. **Regressions-Test erstellen** — `/qa-test-run` erstellt einen spezifischen Testfall für den Bug
4. **Fix implementieren** — Über die normale Pipeline (`/backend-dev` oder `/frontend-dev`)
5. **Retest** — `/qa-check` führt den neuen Regressions-Test aus und bestätigt den Fix
