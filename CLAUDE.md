# CLAUDE.md

**Architektur, NFR & Übersicht:** [docs/PRD.md](docs/PRD.md)
**Feature-Spezifikationen (User Stories):** [docs/features/README.md](docs/features/README.md)

## Project Overview

<!-- TODO: Projektbeschreibung anpassen -->
**{{PROJECT_NAME}}** — bestehend aus zwei Sub-Projekten:

- **`backend/`** — PHP + MySQL Admin-Portal und REST API
- **`android-app/`** — Android Kotlin Tablet/Phone App

Primärsprache des Systems: **Deutsch** (optional: Schweizerdeutsch-Unterstützung). Alle UI-Texte in Deutsch.

## Build & Run Commands

### Android App (`android-app/`)

```bash
# Build debug APK
./gradlew assembleDebug

# Install on connected device
adb install -r app/build/outputs/apk/debug/app-debug.apk

# Run unit tests
./gradlew test

# Run a single test class
./gradlew test --tests "com.example.SomeTestClass"
```

- Compile SDK 35, Min SDK 24, Target SDK 35, Java/Kotlin target 1.8
- Debug build uses `.debug` applicationId suffix

### Backend (`backend/`)

```bash
# Local development: PHP built-in server
php -S localhost:8080 -t public/

# No build step — vanilla PHP, runs on any PHP 7.4+ server
```

- No package manager (no Composer). All code is vanilla PHP.
- MySQL database. Schema in `config/schema.sql`.
- Local config overrides in `config/config.local.php` (git-ignored).
- API documentation: `swagger.yaml` (OpenAPI 3.0.3)

## Architecture

### Android App — MVVM + Clean Architecture

Three layers under `app/src/main/java/`:

- **`domain/`** — Models, repository interfaces, service interfaces. No Android dependencies.
- **`data/`** — Implementations: Room DB, Retrofit API, DTOs, repository/service impls.
- **`ui/`** — Jetpack Compose screens, ViewModels, components, navigation, theme.

**Dependency injection:** Hilt. Modules in `di/`.

### Backend — PHP + MySQL

Vanilla PHP, custom Router. Entry point: `public/index.php` → `Router.php`.

Key paths:
- Controllers: `backend/src/Controllers/Admin/`, `backend/src/Controllers/Api/`
- Models: `backend/src/Models/`
- Core: `backend/src/` — Auth.php, Csrf.php, Database.php, Router.php, helpers.php
- Templates: `backend/templates/` (Server-rendered HTML)
- Schema: `backend/config/schema.sql`

## Key Conventions

- Reactive state via `StateFlow`/`Flow` throughout the Android app
- Coroutines for all async work
- Backend uses camelCase JSON keys in API responses, snake_case in database
- Backend admin UI uses flash messages for user feedback, server-side rendering
- Security headers set in `bootstrap.php`

## Conventions
See `.claude/rules/` for all project conventions.

## Sprachregeln (Deutsch)

- **Umlaute immer korrekt schreiben:** ä statt ae, ö statt oe, ü statt ue
- **Kein ß** — immer **ss** verwenden (Schweizer Rechtschreibung)
- Ausnahme: Datenbank-Spaltennamen und Code-Identifier bleiben englisch

## Workflow Rules

- **Bei jeder funktionalen Änderung** muss die relevante Feature-Datei in `docs/features/` und die PRD-Versionshistorie (`docs/PRD.md`, Sektion 12) aktualisiert werden.
- Bei neuen Features: neue Datei in `docs/features/` erstellen und im Feature-Index (`docs/features/README.md`) verlinken.

## Implementierungs-Pflichtworkflow (Anti-Halluzination)

**Vor jeder Implementierung zwingend einhalten:**

1. **Relevante PRD-Abschnitte lesen** — Immer den betreffenden Abschnitt in `docs/PRD.md` lesen, bevor Code geschrieben wird. Niemals aus dem Gedächtnis implementieren.
2. **Betroffene Dateien lesen** — Den bestehenden Code in allen relevanten Dateien lesen, bevor Änderungen vorgenommen werden. Keine Annahmen über Dateiinhalte machen.
3. **Erst dann implementieren** — Implementierung strikt nach den gelesenen Spezifikationen und dem bestehenden Code-Stil.
4. **Abschluss bestätigen** — Nach der Implementierung kurz auflisten: welche Dateien wurden gelesen, welche PRD-Anforderungen wurden erfüllt.

**Gilt auch für:**
- Neue Features → PRD-User-Story lesen
- Bug Fixes → Betroffene Datei(en) vollständig lesen
- Refactoring → Alle abhängigen Dateien lesen
- Datenbankänderungen → `backend/config/schema.sql` lesen

**Bei Unklarheiten:** Nachfragen, nicht raten.
