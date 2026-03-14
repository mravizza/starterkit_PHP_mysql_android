# Product Requirements Document (PRD)

<!-- TODO: Projektspezifisch ausfüllen -->

## 1. Einleitung

### 1.1 Zweck
Dieses Dokument beschreibt die funktionalen und nicht-funktionalen Anforderungen für **{{PROJECT_NAME}}**.

### 1.2 Zielgruppe
- Entwickler
- Produktverantwortliche
- QA-Team

### 1.3 Referenzen
- Feature-Spezifikationen: [docs/features/README.md](features/README.md)
- Roadmap: [docs/Roadmap.md](Roadmap.md)

---

## 2. Produktübersicht

### 2.1 Vision
<!-- Was ist das Produkt? Für wen? Welches Problem löst es? -->

### 2.2 Zielgruppe
| Zielgruppe | Beschreibung | Bedürfnisse |
|------------|-------------|-------------|
| | | |

---

## 3. Funktionale Anforderungen

Alle funktionalen Anforderungen sind als Feature-Spezifikationen in `docs/features/` dokumentiert.
Siehe [Feature-Index](features/README.md).

---

## 4. Systemübersicht

### 4.1 Architektur
```
┌─────────────────────┐       REST API        ┌──────────────────────┐
│   Android App       │ ◄──────────────────► │   PHP Backend        │
│   (Kotlin/Compose)  │   Bearer Token Auth   │   (Vanilla PHP)      │
│                     │                        │                      │
│ ┌─────────────────┐ │                        │ ┌──────────────────┐ │
│ │ UI Layer        │ │                        │ │ Admin Portal     │ │
│ │ (Compose)       │ │                        │ │ (Bootstrap/SSR)  │ │
│ ├─────────────────┤ │                        │ ├──────────────────┤ │
│ │ Domain Layer    │ │                        │ │ REST API v1      │ │
│ │ (Models/Repos)  │ │                        │ │ (JSON)           │ │
│ ├─────────────────┤ │                        │ ├──────────────────┤ │
│ │ Data Layer      │ │                        │ │ MySQL Database   │ │
│ │ (Room/Retrofit) │ │                        │ └──────────────────┘ │
│ └─────────────────┘ │                        └──────────────────────┘
└─────────────────────┘
```

### 4.2 Technologie-Stack

| Komponente | Technologie |
|-----------|-------------|
| Android App | Kotlin, Jetpack Compose, Hilt, Room, Retrofit |
| Backend | PHP 7.4+, MySQL, Vanilla (kein Framework) |
| API | REST, JSON, OpenAPI 3.0 |
| Hosting | <!-- z.B. Shared Hosting, Cloud --> |

### 4.3 Datenbank-Schema

Siehe `backend/config/schema.sql`.

---

## 5. Nicht-funktionale Anforderungen (NFR)

### 5.1 Performance
- API-Antwortzeit: < 500ms (P95)
- App-Startzeit: < 3s
- Foto-Sync: Inkrementell mit `since`-Parameter

### 5.2 Sicherheit
- HTTPS erzwungen
- SQL Injection: Prepared Statements überall
- XSS: Output-Encoding in allen Templates
- CSRF: Token-basierte Validierung
- API Auth: Bearer Token
- Admin Auth: Session-basiert, bcrypt

### 5.3 Datenschutz
<!-- Relevante Gesetze: DSGVO, nDSG (Schweiz), etc. -->

### 5.4 Verfügbarkeit
- Backend: 99.5% Uptime
- App: Offline-fähig (cached Daten)

### 5.5 Wartbarkeit
- Clean Code Regeln: `.claude/rules/clean-code.md`
- Feature-Dokumentation: `docs/features/`

---

## 6. API-Spezifikation

Siehe `backend/swagger.yaml` (OpenAPI 3.0.3).

---

## 7. Glossar

| Begriff | Beschreibung |
|---------|-------------|
| | |

---

## 8–11. (Reserviert)

---

## 12. Versionshistorie

| Version | Datum | Beschreibung |
|---------|-------|-------------|
| 0.1.0 | <!-- TT.MM.JJJJ --> | Initiale PRD-Version |
