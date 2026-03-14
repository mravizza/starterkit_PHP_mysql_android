#!/bin/bash
# Hook: Warnt bei Schema-Änderungen und erzwingt Bestätigung
# Event: PreToolUse (Edit)

INPUT=$(cat)
FILE=$(echo "$INPUT" | jq -r '.tool_input.file_path // empty')

if [ -z "$FILE" ]; then
  exit 0
fi

if [[ "$FILE" == *"schema.sql"* ]]; then
  echo '{"hookSpecificOutput":{"hookEventName":"PreToolUse","permissionDecision":"ask","permissionDecisionReason":"Schema-Änderung erkannt — Migrations-Statement in schema.sql. Bitte bestätigen."}}'
  exit 0
fi

exit 0
