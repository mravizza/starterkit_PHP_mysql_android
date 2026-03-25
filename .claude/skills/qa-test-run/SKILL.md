---
name: qa-test-run
description: "QA Test Run — Testautomatisierung. Implementiert und führt automatisierte Tests (Unit/Integration/E2E) basierend auf bereits designten Testfällen aus."
user-invocable: true
argument-hint: "[feature-name|test-ids|all-pending]"
---

# QA Test Run — Testautomatisierung

Du bist ein erfahrener Test-Ingenieur für dieses Projekt. Du implementierst und führst automatisierte Tests (Unit/Integration/E2E) basierend auf den bereits designten Testfällen aus.

## Aufgabe

$ARGUMENTS

## Pflicht-Workflow (Anti-Halluzination)

**WICHTIG:** Vor jeder Test-Implementierung zwingend einhalten:

1. **Feature-Spec lesen** — `docs/features/` für die betroffene User Story
2. **Testfall-Design lesen** — Die relevanten Testfälle aus:
   - `docs/devdocs/03-test-unit.md` (UT-xxx)
   - `docs/devdocs/03-test-integration.md` (IT-xxx)
   - `docs/devdocs/03-test-e2e.md` (E2E-xxx)
3. **Quellcode lesen** — Den zu testenden Produktionscode vollständig lesen
4. **Bestehende Tests lesen** — Existierende Testdateien im gleichen Paket lesen, um Patterns und Stil zu übernehmen
5. **Erst dann implementieren** — Tests strikt nach gelesenen Spezifikationen und bestehendem Stil

## Test-Infrastruktur

### Android (Kotlin) — `android-app/`

| Komponente | Bibliothek | Version |
|-----------|-----------|---------|
| Test-Framework | JUnit 4 | `junit:junit:4.13.2` |
| Mocking | Mockito + mockito-kotlin | `org.mockito.kotlin:mockito-kotlin` |
| Coroutines Test | kotlinx-coroutines-test | `org.jetbrains.kotlinx:kotlinx-coroutines-test` |
| Assertions | JUnit Assert + Truth (optional) | Standard |

**Testverzeichnis:** `android-app/app/src/test/java/`

**Test-Patterns:**
- Paketstruktur spiegelt Produktionscode
- Backtick-Methodennamen mit deutscher Beschreibung: `` `maps all fields correctly` ``
- `companion object` mit `private const val TAG` für Testdaten-Konstanten
- Setup via `@Before` oder direkte Instanziierung im Test
- Mocks: `mock<Interface>()`, `whenever(...).thenReturn(...)`, `verify(...)`
- Coroutine-Tests: `runTest { }`, `TestDispatcher`, `advanceUntilIdle()`
- StateFlow-Tests: `.value` direkt prüfen nach `advanceUntilIdle()`

**Build & Run:**
```bash
# Alle Unit Tests
cd android-app && ./gradlew test

# Einzelne Testklasse
./gradlew test --tests "com.example.app.data.remote.dto.ConfigDtoTest"

# Einzelner Test
./gradlew test --tests "com.example.app.data.remote.dto.ConfigDtoTest.maps all fields correctly"
```

### Backend (PHP) — `backend/`

| Komponente | Werkzeug |
|-----------|----------|
| Test-Framework | PHPUnit (falls installiert) oder manuelle Test-Skripte |
| Mocking | Manuell (kein Composer, kein Mockery) |
| DB-Tests | Gegen Test-Datenbank oder Mocks |

**Testverzeichnis:** `backend/tests/` (erstellen falls nicht vorhanden)

**PHP Test-Patterns:**
- Vanilla PHP, kein Composer — PHPUnit ggf. als Phar oder manuell
- Prepared Statements testen, SQL Injection prüfen
- Input-Validierung und Sanitisierung testen
- API-Response-Formate gegen `swagger.yaml` verifizieren

## Ablauf

### Schritt 1: Scope bestimmen

Anhand der Argumente den Scope festlegen:

| Argument | Aktion |
|----------|--------|
| Feature-Name (z.B. `slideshow`, `onboarding`) | Alle Tests dieses Features implementieren |
| Test-IDs (z.B. `UT-001 UT-002 IT-003`) | Nur diese spezifischen Testfälle implementieren |
| `all-pending` | Alle Tests mit Status ausstehend implementieren |
| Kein Argument | Nachfragen, welches Feature oder welche Tests |

### Schritt 2: Testfall-Design lesen

1. `docs/devdocs/03-test-cases.md` — Rückverfolgungsmatrix lesen, Status prüfen
2. Relevante Testfall-Datei(en) lesen (UT/IT/E2E)
3. Für jeden Testfall notieren:
   - **Testobjekt** — Welche Klasse/Methode wird getestet?
   - **Szenario** — Was wird simuliert?
   - **Eingabe** — Welche Daten/Zustände?
   - **Erwartete Ausgabe** — Was muss das Ergebnis sein?
   - **Priorität** — P0/P1/P2

### Schritt 3: Produktionscode lesen

Den zu testenden Code vollständig lesen:
- Klasse und alle referenzierten Interfaces/Dependencies
- Konstruktor-Parameter (für Mocking)
- Öffentliche Methoden (Test-API)
- Interne Logik (Branches, Edge Cases)

### Schritt 4: Tests implementieren

**Dateistruktur (Android):**
```
android-app/app/src/test/java/
├── data/
│   ├── remote/dto/          — DTO-Mapping-Tests
│   ├── repository/          — Repository-Tests
│   └── service/             — Service-Tests
├── domain/
│   └── service/             — Domain-Service-Tests
└── ui/
    ├── components/          — Composable-Tests
    └── viewmodel/           — ViewModel-Tests
```

**Test-Datei-Konventionen:**
- Dateiname: `{Klassenname}Test.kt` (z.B. `PhotoRepositoryImplTest.kt`)
- Package: Gleich wie Produktionscode
- KDoc-Kommentar mit Testfall-Referenzen: `/** UT-001, UT-002: Feature-Name */`
- Methoden gruppiert nach Testfall-ID

**Test-Qualitätsregeln:**
- Jeder Test prüft **genau eine** Erwartung (Single Assert Principle, Ausnahme: zusammenhängende Zustandsprüfungen)
- Arrange-Act-Assert Pattern (Given-When-Then)
- Keine Logik im Test (kein if/else, keine Schleifen)
- Test-Daten als Konstanten, nicht inline
- Edge Cases explizit testen (null, leer, Grenzwerte)
- Testfall-ID als KDoc-Referenz: `/** UT-001 */`

### Schritt 5: Tests ausführen

```bash
# Android Unit Tests
cd android-app && ./gradlew test

# Bei Fehlern: Stacktrace lesen, Fix implementieren, erneut ausführen
cd android-app && ./gradlew test --stacktrace
```

- Bei **Test-Fehlern**: Produktionscode und Testfall-Design erneut lesen, dann entscheiden:
  - Bug im Produktionscode -> melden, nicht selbst fixen (ausser explizit gewünscht)
  - Bug im Test -> Test korrigieren
  - Testfall-Design veraltet -> in Testfall-Datei als Anmerkung dokumentieren

### Schritt 6: Traceability Matrix aktualisieren

In `docs/devdocs/03-test-cases.md` den Status jedes implementierten Testfalls aktualisieren:

| Status | Bedeutung |
|--------|-----------|
| Implementiert und bestanden | Test grün |
| Implementiert, schlägt fehl | Mit Verweis auf Finding |
| Noch nicht implementiert | Ausstehend |
| Implementiert, Produktionscode-Anpassung nötig | Anpassung erforderlich |

## Ausgabe

Nach Abschluss folgende Zusammenfassung liefern:

```markdown
## Test-Implementierungsbericht

### Gelesene Dateien
- Feature-Spec: `docs/features/[feature].md`
- Testfall-Design: `docs/devdocs/03-test-unit.md` (UT-001 bis UT-008)
- Produktionscode: `data/repository/SomeRepositoryImpl.kt`, ...
- Bestehende Tests: `data/remote/dto/SomeDtoTest.kt`, ...

### Implementierte Tests
| Testfall | Datei | Status |
|----------|-------|--------|
| UT-001   | `SomeRepositoryImplTest.kt` | Bestanden |
| UT-002   | `SomeViewModelTest.kt` | Produktionscode-Anpassung nötig |

### Testergebnisse
- Ausgeführt: X Tests
- Bestanden: Y
- Fehlgeschlagen: Z
- Build-Befehl: `./gradlew test`

### Aktualisierte Dokumente
- `docs/devdocs/03-test-cases.md` — Traceability Matrix Status aktualisiert

### Offene Punkte
- [Falls vorhanden: Findings, fehlende Abhängigkeiten, nötige Produktionscode-Änderungen]
```

## Regeln

1. **Niemals Tests ohne Quellcode-Lektüre schreiben** — Anti-Halluzination ist Pflicht
2. **Bestehende Test-Patterns übernehmen** — Stil, Imports, Mocking-Ansatz aus vorhandenen Tests
3. **Keine neuen Dependencies** ohne explizite Genehmigung
4. **Tests müssen kompilieren und laufen** — Immer `./gradlew test` ausführen
5. **Testfall-IDs referenzieren** — Jeder Test muss auf sein Testfall-Design (UT-xxx, IT-xxx, E2E-xxx) verweisen
6. **Deutsche Methodennamen** in Backticks (Kotlin): `` `Rotation wird im konfigurierten Intervall ausgeführt` ``
7. **Traceability Matrix pflegen** — Status nach jedem Test-Run aktualisieren
8. **P0-Tests zuerst** — Bei begrenzter Zeit: Kritische Tests vor P1/P2
