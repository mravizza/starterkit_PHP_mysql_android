#!/bin/bash
# Hook: Blockiert destruktive Shell-Befehle
# Event: PreToolUse (Bash)

INPUT=$(cat)
CMD=$(echo "$INPUT" | jq -r '.tool_input.command // empty')

if [ -z "$CMD" ]; then
  exit 0
fi

# Destruktive Git-Befehle
if echo "$CMD" | grep -qiE 'git\s+push\s+--force|git\s+push\s+-f\b'; then
  echo "Blockiert: git push --force ist nicht erlaubt." >&2
  exit 2
fi

if echo "$CMD" | grep -qiE 'git\s+reset\s+--hard'; then
  echo "Blockiert: git reset --hard ist nicht erlaubt." >&2
  exit 2
fi

# Destruktive Dateisystem-Befehle
if echo "$CMD" | grep -qiE 'rm\s+-rf\s+/|rm\s+-rf\s+\.\s|rm\s+-rf\s+\*'; then
  echo "Blockiert: Gefährlicher rm -rf Befehl." >&2
  exit 2
fi

# Destruktive SQL-Befehle
if echo "$CMD" | grep -qiE 'DROP\s+TABLE|DROP\s+DATABASE|DELETE\s+FROM\s+\w+\s*;|TRUNCATE\s+TABLE'; then
  echo "Blockiert: Destruktiver SQL-Befehl." >&2
  exit 2
fi

exit 0
