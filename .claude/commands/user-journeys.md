---
name: user-journeys
description: User experience flows - journey mapping, UX validation, error recovery
---

# User Journeys Skill

Für die Definition und das Testen realer Benutzererfahrungen — nicht nur Specs, sondern tatsächliche Flows.

---

## Aufgabe

$ARGUMENTS

## Philosophie

**Specs testen Features. Journeys testen Erlebnisse.**

Ein Feature kann alle Specs bestehen und trotzdem eine schlechte Erfahrung bieten. User Journeys erfassen:
- Wie Benutzer tatsächlich navigieren
- Emotionale Zustände bei jedem Schritt
- Wiederherstellung nach Fehlern
- Reale Bedingungen (langsames Netzwerk, Unterbrechungen)

---

## Journey-Dokumentation

```
docs/journeys/
├── critical/           # Must-work Journeys (Kernfunktionen)
├── common/             # Häufige Benutzerpfade
└── edge-cases/         # Fehlerszenarien, ungewöhnliche Pfade
```

## Journey Template

```markdown
# Journey: [Name]

## Übersicht
| Attribut | Wert |
|----------|------|
| **Priorität** | Kritisch / Hoch / Mittel |
| **Benutzertyp** | Neu / Wiederkehrend / Admin |
| **Häufigkeit** | Täglich / Wöchentlich / Einmalig |
| **Erfolgskennzahl** | Conversion-Rate, Zeit bis Abschluss |

## Benutzerziel
> "Ich möchte [Ziel], damit ich [Nutzen] habe."

## Voraussetzungen
- Benutzerstatus
- Datenstatus
- Umgebung

## Schritte

### Schritt 1: [Einstiegspunkt]
**Benutzeraktion:** Was der Benutzer tut
**Systemantwort:** Was er sehen/erleben soll
**Erfolgskriterien:**
- [ ] Seite lädt in < 2 Sekunden
- [ ] Primäre Aktion sofort sichtbar

**Mögliche Reibung:**
- Problem → Lösung

## Fehlerszenarien

### F1: [Fehlername]
**Auslöser:** Was den Fehler verursacht
**Benutzer sieht:** Fehlermeldung
**Wiederherstellungspfad:** Wie der Benutzer zurückfindet

## Metriken
- Zeit bis Abschluss
- Abbruchrate pro Schritt
- Fehlerrate und Wiederherstellungsrate
```

## UX-Checkliste pro Schritt

- [ ] Benutzer weiss wo er ist (Breadcrumbs, Fortschritt)
- [ ] Benutzer weiss was als nächstes zu tun ist (klare Aktion)
- [ ] Benutzer weiss was gerade passiert ist (Feedback)
- [ ] Fehler sind leicht zu beheben
- [ ] Seite lädt < 2 Sekunden
- [ ] Touch-Ziele >= 48dp
- [ ] Farbkontrast ausreichend

## Anti-Patterns

- **Nur Happy Path** — Immer auch Fehlerszenarien testen
- **Spec-getrieben** — Benutzerziele testen, nicht Features
- **Zeit ignorieren** — Messen wie lange Journeys dauern
- **Keine Metriken** — Journey-Abschluss und Abbrüche tracken
