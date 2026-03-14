#!/bin/bash
# Hook: Windows-Toast-Notification wenn Claude auf Eingabe wartet
# Event: Notification

powershell.exe -NoProfile -Command "
Add-Type -AssemblyName System.Windows.Forms
\$notify = New-Object System.Windows.Forms.NotifyIcon
\$notify.Icon = [System.Drawing.SystemIcons]::Information
\$notify.Visible = \$true
\$notify.ShowBalloonTip(5000, 'Claude Code', 'Claude Code wartet auf deine Eingabe', [System.Windows.Forms.ToolTipIcon]::Info)
Start-Sleep -Seconds 6
\$notify.Dispose()
" &>/dev/null &

exit 0
