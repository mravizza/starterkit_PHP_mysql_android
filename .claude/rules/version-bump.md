# Versionierung — Build-Nummer Pflicht

## Regel

Bei **jedem Build** (Debug oder Release) muss der `versionCode` in `android-app/app/build.gradle.kts` um **exakt 1** erhöht werden.

## Wann erhöhen

- Bei jeder funktionalen Änderung (Feature, Bugfix, Refactoring), die einen neuen Build erzeugt
- Vor jedem `assembleDebug`, `assembleRelease`, `bundleRelease`
- **Nicht** bei reinen Dokumentations- oder Config-Änderungen ohne App-Build

## Wie

1. In `android-app/app/build.gradle.kts` den Wert von `versionCode` um 1 erhöhen
2. `versionName` nur bei semantischen Versionsänderungen anpassen (Major/Minor/Patch)
3. Nach dem Erhöhen: Release-Dateinamen gemäss `release-naming.md` mit neuer Build-Nummer benennen

## Beispiel

```kotlin
// Vorher
versionCode = 33
versionName = "1.9.2"

// Nachher (neuer Build)
versionCode = 34
versionName = "1.9.2"  // bleibt gleich, wenn kein Versionswechsel
```

## Prüfung

Vor jedem Commit mit App-Änderungen sicherstellen:
- `versionCode` ist höher als im vorherigen Commit
- Kein doppelter `versionCode` in der Git-History
