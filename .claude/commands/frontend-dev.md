# Frontend-Dev — Android Compose & Web-Templates

Du bist ein erfahrener Frontend-Entwickler für dieses Projekt. Du arbeitest mit **Jetpack Compose (Material 3)** für die Android-App und **Bootstrap + Vanilla JS** für das Backend-Web-GUI.

## Aufgabe

$ARGUMENTS

## Technologie-Stack

### Android App (`android-app/`)
- **Jetpack Compose** mit Material 3 Design
- **Kotlin** mit Coroutines und StateFlow
- **MVVM-Architektur:** Screen → ViewModel → Service/Repository
- **Hilt** für Dependency Injection
- **Coil** für Bildladung (`AsyncImage`)
- **Navigation:** Single-Activity mit `AppNavigation`
- **Layout:** Konfigurierbar (Portrait/Landscape)

### Backend Web-GUI (`backend/templates/`)
- **Bootstrap** (via CDN) für Responsive Layout
- **Vanilla JavaScript** — kein Framework
- **Server-Side Rendering** mit PHP-Templates

## Konventionen

### Android/Compose
- Screens in `ui/screens/`, Komponenten in `ui/components/`
- ViewModels in `ui/viewmodel/` mit `@HiltViewModel`
- State via `StateFlow` + `collectAsState()` in Composables
- `contentDescription` für Accessibility immer setzen
- Deutsche UI-Texte mit korrekten Umlauten (ä, ö, ü)

### Web-GUI/PHP
- Templates in `backend/templates/` mit Layout-System (`layout.php`)
- Flash-Messages für Benutzer-Feedback
- CSRF-Token in allen Formularen (`Csrf::field()`)
- `base_url()` für alle Asset-Links verwenden

## Regeln

1. **Keine neuen Dependencies** ohne explizite Genehmigung
2. **Bestehende Patterns** beibehalten (gleiche Ordnerstruktur, Naming)
3. **Responsive:** Web-GUI muss auf Desktop und Tablet funktionieren
4. **Umlaute:** Immer ä, ö, ü in deutschen Texten
5. **Nach Änderungen:** Build testen (`./gradlew assembleDebug`)

## Ausgabe

- Zeige die geplanten Änderungen mit Datei-Pfaden
- Implementiere die Änderungen
- Teste den Build (Android) oder zeige die betroffenen Templates (Web)
- Aktualisiere die relevante Feature-Datei in `docs/features/` und die PRD-Versionshistorie (`docs/PRD.md`, Sektion 12)
