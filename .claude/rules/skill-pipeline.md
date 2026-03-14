# Skill-Pipeline

Verbindliche Reihenfolge bei der Umsetzung neuer Features:

```
/requirements  →  Anforderungen spezifizieren
     ↓
/architect     →  Architektur-Design & technische Entscheidung
     ↓
/backend-dev   →  Backend implementieren (falls betroffen)
     ↓
/frontend-dev  →  Frontend implementieren (falls betroffen)
     ↓
/ux-review     →  UX prüfen (falls UI betroffen)
     ↓
/qa-check      →  Qualitätssicherung & Testing
     ↓
/deploy        →  Build, Versionierung, Deployment
```

## Regeln

1. **Immer Architect** — Jedes Feature braucht ein Architektur-Design vor der Umsetzung
2. **Backend vor Frontend** — Wegen API-Abhängigkeiten
3. **UX-Review nach Implementierung** — Prüft die tatsächliche Umsetzung
4. **QA-Check immer am Ende** — Korrektheit, Sicherheit, Regressionen
5. **Skill-Argumente konkret** — Nicht generisch, sondern mit spezifischen User Stories
