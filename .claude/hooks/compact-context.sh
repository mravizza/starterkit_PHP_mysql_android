#!/bin/bash
# Hook: Re-injiziert kritischen Projektkontext nach Context-Compaction
# Event: SessionStart (matcher: compact)
# TODO: Projektspezifisch anpassen

cat <<'CONTEXT'
Projekt-Kontext nach Compaction:
- Android-App: android-app/ (Kotlin, Jetpack Compose, MVVM + Clean Architecture, Hilt DI)
- Backend: backend/ (Vanilla PHP + MySQL)
- Sprache: Deutsch. Umlaute korrekt schreiben.
- Anti-Halluzinations-Workflow: Immer PRD und Code lesen VOR Implementierung.
- Bei funktionalen Änderungen: docs/features/ und PRD Sektion 12 aktualisieren.
- Clean-Code-Regeln: .claude/rules/clean-code.md
- Release-Naming: .claude/rules/release-naming.md
- Skill-Pipeline: .claude/rules/skill-pipeline.md
CONTEXT

exit 0
