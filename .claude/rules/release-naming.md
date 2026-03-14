# Release Filename Convention

Alle Release-Artefakte **müssen** die Build-Nummer im Dateinamen enthalten.

## Format
{appname}-{buildType}-v{versionName}-b{versionCode}.{ext}

## Beispiele
- `myapp-release-v1.0.0-b1.apk`
- `myapp-release-v1.0.0-b1.aab`
- `myapp-debug-v1.0.0-b1.apk`

## Build-Nummer Quelle
- CI/CD: Umgebungsvariable `$BUILD_NUMBER`
- Lokal: `git rev-list --count HEAD`

## Gilt für
- Alle Artefakte im `/release` und `/debug` Verzeichnis
- Build-Skripte, Gradle Tasks, Shell Scripts

## Archivierung
- Neue Builds werden im `release/` Verzeichnis **hinzugefügt**, nie überschrieben
- Alte Versionen **nie löschen** — lückenlose History erforderlich
