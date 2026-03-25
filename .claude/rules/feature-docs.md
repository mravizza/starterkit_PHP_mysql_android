# Feature-Dokumentation

Alle Feature-Spezifikationen (User Stories, Akzeptanzkriterien, technische Auswirkungen) liegen in **`docs/features/`**.

## Vor jeder Implementierung

1. **Feature-Index lesen:** `docs/features/README.md` — findet das richtige Feature-Dokument
2. **Feature-Dokument lesen:** Enthält alle User Stories und Akzeptanzkriterien
3. **PRD für Kontext:** `docs/PRD.md` enthält Architektur, NFR, Glossar, Versionshistorie

## Bei Änderungen aktualisieren

- **Feature-Datei:** User Stories und Akzeptanzkriterien im relevanten `docs/features/*.md`
- **PRD Versionshistorie:** Sektion 12 in `docs/PRD.md`
- **Feature-Index:** `docs/features/README.md` nur bei neuen Feature-Dateien

## Zuordnung Skill → Features

| Skill | Primäre Feature-Dateien |
|-------|------------------------|
| `/ux-discovery` | Erstellt ux-discovery-*.md in docs/features/ (Personas, Wireframes, Journey Maps) |
| `/requirements` | Schreibt neue Features in docs/features/, basierend auf UX Discovery |
| `/qa-test-cases` | Erstellt Testfälle in docs/devdocs/ basierend auf ACs und Wireframes |
| `/qa-test-run` | Implementiert und führt automatisierte Tests (UT/IT/E2E) aus |
| `/architect` | Alle nach Bedarf, nutzt Wireframes als Input |
| `/backend-dev` | backend-admin.md, api-endpoints.md, security.md |
| `/frontend-dev` | app-*.md, backend-admin.md (Templates), orientiert sich an Wireframes |
| `/ux-review` | app-*.md — validiert Implementierung gegen Wireframes |
| `/qa-check` | Alle nach Bedarf — führt Testfälle aus docs/devdocs/ aus |
| `/pentest` | security.md, api-endpoints.md |
| `/deploy` | Kein Feature-Dokument — Build, Versionierung, Deployment |

## Entwicklungs-Workflow

### Vollständige Pipeline (18 Schritte)

```
Design & Planung
─────────────────────────────────────────────────────
 1. /ux-discovery       → Problemverständnis, Personas, Wireframes (bei UI-Features)
 2. /requirements       → User Stories + Akzeptanzkriterien
 3. /qa-test-cases      → Testfälle designen (UT/IT/E2E, Shift Left)
 4. /architect          → Technische Lösung entwerfen
    ⏸ User-Review-Gate — Architektur freigeben

Implementierung + Testautomatisierung (parallel)
─────────────────────────────────────────────────────
 5. /backend-dev        → Backend implementieren
 6. /frontend-dev       → Frontend implementieren
 7. /qa-test-run        → Automatisierte Tests parallel implementieren und ausführen
                          (Unit Tests zusammen mit Produktionscode, nicht nachträglich)

Qualitätssicherung (CI — GitHub Runner)
─────────────────────────────────────────────────────
 8. /ux-review          → UX-Validierung gegen Wireframes
 9. /qa-check           → Unit Tests + Lint + detekt (laufen automatisch in CI)
    ⏸ QA-Gate — CI grün?

Staging & Abnahme
─────────────────────────────────────────────────────
10. /deploy staging     → Backend auf Staging (automatisch bei Push)
                          Schema-Migration auf Staging-DB zuerst
11. /qa-check staging   → System Tests gegen Staging-API (API-Verträge, Smoke Tests)
12. /deploy build       → Debug-APK bauen + auf Tablet installieren (App gegen Staging)
13. UAT                 → Produktmanager testet auf Tablet + Staging
    ⏸ UAT-Gate — Abnahme erteilt?

Produktion & Release
─────────────────────────────────────────────────────
14. /deploy production  → Backend auf Produktion deployen
15. /deploy release     → Release-Build, Version bump, Commit, Push
16. /pentest            → Security-Review (bei Security-relevanten Änderungen)

Post-Release
─────────────────────────────────────────────────────
17. /qa-test-run        → Regressionstests ausführen (alle P0-Tests)
18. Roadmap-Bereinigung → Feature in docs/Roadmap.md von "Aktuelle Roadmap" nach
                          "Erledigte Roadmap-Items" verschieben
```

### Test-Umgebungen (Testpyramide)

```
Testtyp          Umgebung                Wann                     Gegen was
─────────────────────────────────────────────────────────────────────────────
Unit Tests       CI (GitHub Runner)      Bei jedem Push/PR        Isoliert (Mocks)
PHP Lint         CI (GitHub Runner)      Bei jedem Push/PR        Syntax-Check
detekt           CI (GitHub Runner)      Bei jedem Push/PR        Statische Analyse
System Tests     Staging                 Nach Staging-Deploy      Live-API, Test-DB
E2E Tests        Staging + Tablet        UAT-Phase                App → Staging-API
UAT              Staging + Tablet        Manuell (Schritt 12)     Realer Nutzertest
Pentest          Staging                 Bei Security-Änderungen  Nie auf Produktion
```

> **Auf Produktion werden keine Tests ausgeführt.** Produktion wird nur deployed, nachdem alle Tests auf Staging bestanden haben.

### Regeln

> **Unit Tests** werden **parallel zum Produktionscode** in Schritt 5/6/7 geschrieben, nicht nachträglich. Schritt 3 (`/qa-test-cases`) liefert das Test-Design (Was), Schritt 7 (`/qa-test-run`) den Test-Code (Wie).

> **Deploy-Reihenfolge** in Schritt 9/13: Immer zuerst Backend (Schema-Migration + neue Endpoints), dann App. Nie umgekehrt.

> **Staging-First** (Schritt 9–12): Jede Backend-Änderung geht zuerst auf Staging. Produktion wird erst nach UAT-Abnahme deployed.

> **Pentest-Trigger** (Schritt 16): Nicht bei jedem Feature nötig. Auslösen bei Änderungen an Auth, Token, Session, API-Endpoints, File-Upload, Input-Validierung oder Deep-Links. Pentest immer gegen Staging, nie gegen Produktion.

> **Roadmap-Bereinigung** (Schritt 18): Nach jedem Release das erledigte Feature in `docs/Roadmap.md` von der aktiven Sektion in "Erledigte Roadmap-Items" verschieben.

### Regression-Scope (Dependency-Map)
Siehe `docs/devdocs/03-test-cases.md` Sektion "Dependency-Map" für die Zuordnung
welche Features bei Änderungen an Querschnitts-Komponenten regressionsgetestet werden müssen.

### Testfall-Dokumente
- `docs/devdocs/03-test-cases.md` — Übersicht, Strategie, Rückverfolgungsmatrix, Dependency-Map
- `docs/devdocs/03-test-unit.md` — Unit Tests (UT-xxx)
- `docs/devdocs/03-test-integration.md` — Integration Tests (IT-xxx)
- `docs/devdocs/03-test-e2e.md` — E2E Tests (E2E-xxx)
