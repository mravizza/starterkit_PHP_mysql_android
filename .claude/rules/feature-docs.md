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
| `/backend-dev` | backend-admin.md, api-endpoints.md, security.md |
| `/frontend-dev` | app-*.md, backend-admin.md (Templates) |
| `/architect` | Alle nach Bedarf |
| `/ux-review` | app-*.md (UI-relevante Features) |
| `/qa-check` | Alle nach Bedarf |
| `/pentest` | security.md, api-endpoints.md |
| `/requirements` | Schreibt neue Features in docs/features/ |
