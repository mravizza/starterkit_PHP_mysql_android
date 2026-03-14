# Clean Code Regeln

Verbindliche Regeln für alle Implementierungen in diesem Projekt.

## 1. Funktionslänge

- **Max. 30 Zeilen** pro Funktion/Methode (exkl. Signatur und Klammern)
- Composable-Funktionen: Max. **50 Zeilen** UI-Code, Business-Logik auslagern
- Bei Überschreitung: in benannte Hilfsmethoden aufteilen
- Screen-Composables in eigene Dateien pro Abschnitt aufteilen (max. ~300 Zeilen pro Datei)

## 2. Single Responsibility (SRP)

- Jede Klasse hat **genau eine Verantwortung**
- ViewModels: Max. **5-6 Injected Dependencies**. Bei mehr → Use Cases extrahieren
- Services: Klar abgegrenzter Aufgabenbereich. Kein "God Object"
- Controller (PHP): Eine Action = eine Aufgabe. Shared Logic in Service-Klassen extrahieren

## 3. DRY (Don't Repeat Yourself)

- Code der **2x identisch** vorkommt → sofort extrahieren
- PHP: Shared Logic in Helper-Funktionen (`helpers.php`) oder Service-Klassen
- Kotlin: Shared Logic in Utility-Klassen oder Extension Functions
- Konstanten nur **einmal** definieren

## 4. Keine Magic Numbers/Strings

- Alle Zahlen und String-Literale mit fachlicher Bedeutung als **benannte Konstanten** definieren
- PHP: `const` oder Config-Werte in `config.php`
- Kotlin: `companion object` Konstanten oder Config-Objekt

```kotlin
// Falsch
delay(3000)
if (history.size > 10)

// Richtig
companion object {
    private const val TIMEOUT_MS = 3000L
    private const val MAX_HISTORY_SIZE = 10
}
```

## 5. Fehlerbehandlung

- **Keine leeren catch-Blöcke**. Mindestens loggen: `Log.w(TAG, "...", e)`
- **Kein `@` Error-Suppression** in PHP. Stattdessen try/catch mit Logging
- **Kein `!!`** in Kotlin. Stattdessen `?.let { }`, `?: return`, oder `requireNotNull()`
- Konsistentes Error-Response-Format in APIs: `{"error": "message", "code": "ERROR_CODE"}`

## 6. Coroutines (Kotlin)

- **Kein `GlobalScope`**. Immer verwalteten Scope verwenden:
  - In ViewModels: `viewModelScope`
  - In Services: Injected `CoroutineScope` mit `SupervisorJob()`
  - In Compose: `rememberCoroutineScope()`
- Scope muss bei Lifecycle-Ende gecancelled werden
- `StateFlow.update { }` statt Read-Then-Write für atomare Updates

## 7. Architektur-Schichten (Kotlin)

- **Domain-Layer** (`domain/`): Keine Android-Framework-Abhängigkeiten
  - Keine `@Entity`-Annotationen auf Domain-Models
  - Separate Room-Entities im Data-Layer mit Mapper-Funktionen
- **UI-Layer**: Keine Business-Logik in Composables
  - Zeitberechnungen, Formatierungen → ViewModel
- **ViewModels**: Nicht direkt auf API zugreifen → Repository/Service nutzen

## 8. Namensgebung

- **Sprache**: Code-Identifier auf **Englisch** (Variablen, Funktionen, Klassen)
- **Kommentare/UI**: Auf **Deutsch**
- Aussagekräftige Namen: `$matches` statt `$m`, `escapeHtml()` statt `e()`
- Dateien nach Inhalt benennen: DTOs → `*Dto.kt`, Models → `*Model.kt`

## 9. Kommentare

- Kein auskommentierter Code. Git ist die Versionskontrolle
- TODOs mit Kontext: `// TODO(TICKET-xxx): Beschreibung`
- Keine offensichtlichen Kommentare (`// increment counter`)

## 10. Logging (Kotlin)

- **`Log.d/w/e(TAG, ...)`** statt `println()`
- Jede Klasse: `companion object { private const val TAG = "ClassName" }`
- ProGuard/R8 entfernt `Log.d`/`Log.v` im Release automatisch

## 11. Security

- Keine User-Eingaben direkt in Prompts/Queries einbauen → sanitizen
- Input-Validierung an System-Grenzen (API-Endpoints, Deep Links)
- Keine sensiblen Daten in Kommentaren oder Config-Dateien

## 12. Performance

- Keine N+1-Queries: JOINs oder Batch-Queries verwenden
- Compose: Berechnungen im ViewModel, nicht bei jeder Recomposition
- `remember` mit `mutableStateOf` für reaktive UI-Werte

## 13. Dead Code

- Unbenutzte Funktionen, Parameter, Enum-Werte → löschen
- Stub-Implementierungen → implementieren oder mit TODO markieren
