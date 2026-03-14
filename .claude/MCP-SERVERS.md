# MCP-Server Konfiguration

Model Context Protocol (MCP) Server erweitern Claude Code um zusätzliche Fähigkeiten.

## Empfohlene MCP-Server

### Bildgenerierung
- **media-pipeline** — AI-Bildgenerierung mit Google Gemini
- Installation: Claude Code Marketplace (`/install media-pipeline`)
- Aktivierung in `settings.json`: `"enabledPlugins": { "media-pipeline@media-pipeline-marketplace": true }`

### GitHub Integration
- **GitHub MCP** — PR-Reviews, Issue-Management, Code-Search
- Ermöglicht direkte GitHub-Interaktion aus Claude Code

### Datenbank
- **MySQL/Postgres MCP** — Schema-Exploration, Query-Ausführung
- Nützlich für DB-Schema-Analyse ohne manuelle Queries

### Web-Suche
- **Brave Search MCP** — Web-Recherche direkt in Claude Code

## Konfiguration

MCP-Server werden in `.claude/settings.json` unter `enabledPlugins` aktiviert:

```json
{
  "enabledPlugins": {
    "plugin-name@source": true
  }
}
```

## Setup-Schritte

1. MCP-Server im Claude Code Marketplace finden
2. Mit `/install <name>` installieren
3. In `settings.json` aktivieren (wird automatisch eingetragen)
4. Claude Code neu starten
