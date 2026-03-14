#!/bin/bash
# Hook: Schützt sensible Dateien vor versehentlichem Lesen/Editieren
# Event: PreToolUse (Edit|Write|Read)

INPUT=$(cat)
FILE=$(echo "$INPUT" | jq -r '.tool_input.file_path // empty')

if [ -z "$FILE" ]; then
  exit 0
fi

PROTECTED_PATTERNS=(
  ".ftp-credentials"
  "config.local.php"
  "local.properties"
  ".env"
  "credentials"
  "secrets"
)

for pattern in "${PROTECTED_PATTERNS[@]}"; do
  if [[ "$FILE" == *"$pattern"* ]]; then
    echo "Blockiert: Geschützte Datei '$pattern' darf nicht gelesen oder bearbeitet werden." >&2
    exit 2
  fi
done

exit 0
