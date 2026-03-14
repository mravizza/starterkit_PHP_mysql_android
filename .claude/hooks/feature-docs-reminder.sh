#!/bin/bash
# Hook: Erinnert an Feature-Docs-Aktualisierung nach Code-Änderungen
# Event: PostToolUse (Edit|Write)

INPUT=$(cat)
FILE=$(echo "$INPUT" | jq -r '.tool_input.file_path // empty')

if [ -z "$FILE" ]; then
  exit 0
fi

# Nur bei funktionalen Code-Änderungen erinnern (nicht bei Docs, Config, Templates)
if [[ "$FILE" == *"Controllers"* ]] || \
   [[ "$FILE" == *"Models"* ]] || \
   [[ "$FILE" == *"service"* ]] || \
   [[ "$FILE" == *"Service"* ]] || \
   [[ "$FILE" == *"screens"* ]] || \
   [[ "$FILE" == *"viewmodel"* ]] || \
   [[ "$FILE" == *"ViewModel"* ]] || \
   [[ "$FILE" == *"repository"* ]] || \
   [[ "$FILE" == *"Repository"* ]]; then

  # Nicht erinnern wenn die Änderung selbst in docs/ ist
  if [[ "$FILE" == *"docs/"* ]]; then
    exit 0
  fi

  echo '{"additionalContext":"⚠ Erinnerung: Bei funktionalen Änderungen müssen docs/features/ und PRD Sektion 12 (Versionshistorie) aktualisiert werden."}'
  exit 0
fi

exit 0
