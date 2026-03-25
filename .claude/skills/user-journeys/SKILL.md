---
name: user-journeys
description: "User experience flows - journey mapping, UX validation, error recovery. Definiert und testet echte User Journeys durch die Applikation."
user-invocable: true
---

# User Journeys Skill

For defining and testing real user experiences - not just specs, but actual flows humans take through your application.

---

## Philosophy

**Specs test features. Journeys test experiences.**

A feature can pass all specs but still deliver a terrible experience. User journeys capture:
- How users actually navigate (not how we think they should)
- Emotional states at each step (frustrated, confused, delighted)
- Recovery from mistakes (users will make them)
- Real-world conditions (slow networks, interruptions, distractions)

---

## Journey Documentation Structure

```
docs/
├── journeys/
│   ├── _template.md              # Journey template
│   ├── critical/                 # Must-work journeys (revenue, core value)
│   │   ├── signup-to-first-value.md
│   │   ├── checkout-purchase.md
│   │   └── login-to-dashboard.md
│   ├── common/                   # Frequent user paths
│   │   ├── browse-and-search.md
│   │   ├── update-profile.md
│   │   └── invite-team-member.md
│   └── edge-cases/               # Error recovery, unusual paths
│       ├── payment-failure-retry.md
│       ├── session-timeout-recovery.md
│       └── offline-reconnection.md
```

---

## Journey Template

```markdown
# Journey: [Name]

## Overview
| Attribute | Value |
|-----------|-------|
| **Priority** | Critical / High / Medium |
| **User Type** | New / Returning / Admin |
| **Frequency** | Daily / Weekly / One-time |
| **Success Metric** | Conversion rate, time to complete, drop-off rate |

## User Goal
What is the user trying to accomplish? Write from their perspective.

> "I want to [goal] so that I can [benefit]."

## Preconditions
- User state (logged in, has subscription, first visit)
- Data state (has items in cart, has team members)
- Environment (mobile, desktop, slow connection)

## Journey Steps

### Step 1: [Entry Point]
**User Action:** What the user does
**System Response:** What they should see/experience
**Success Criteria:**
- [ ] Page loads in < 2 seconds
- [ ] Primary CTA is immediately visible
- [ ] User understands what to do next

**Potential Friction:**
- Slow load time -> Show skeleton/loader
- Unclear CTA -> A/B test copy variations

---

### Step 2: [Next Action]
**User Action:** ...
**System Response:** ...
**Success Criteria:**
- [ ] ...

**Potential Friction:**
- ...

---

## Error Scenarios

### E1: [Error Name]
**Trigger:** What causes this error
**User Sees:** Error message/state
**Recovery Path:** How user gets back on track
**Test:** How to verify recovery works

## Metrics to Track
- Time to complete journey
- Drop-off rate at each step
- Error rate and recovery rate
- User satisfaction (if surveyed)

## E2E Test Reference
Link to test: `e2e/tests/journeys/[name].spec.ts`
```

---

## User Experience Validation

### UX Checklist per Journey Step

```markdown
## UX Validation Checklist

### Clarity
- [ ] User knows where they are (breadcrumbs, progress)
- [ ] User knows what to do next (clear CTA)
- [ ] User knows what just happened (feedback)

### Speed
- [ ] Page loads < 2 seconds
- [ ] Actions complete < 3 seconds
- [ ] Progress shown for longer operations

### Forgiveness
- [ ] Mistakes are easy to undo
- [ ] Errors explain what went wrong
- [ ] Recovery path is clear

### Accessibility
- [ ] Keyboard navigation works
- [ ] Screen reader announces changes
- [ ] Focus management correct
- [ ] Color contrast sufficient

### Mobile
- [ ] Touch targets >= 44px
- [ ] No horizontal scroll
- [ ] Forms don't zoom unexpectedly
- [ ] Works on slow 3G
```

---

## Common Journey Patterns

### Progressive Disclosure Journey
User sees simple view first, complexity revealed as needed.

### Guided Setup Journey
Hand-hold new users through initial configuration.

### Recovery Journey
User returns after failure or abandonment.

---

## Anti-Patterns

- **Happy path only** - Test error recovery, not just success
- **Spec-driven testing** - Test user goals, not features
- **Ignoring time** - Measure how long journeys take
- **Desktop-only** - Test mobile journeys separately
- **Skipping emotions** - Consider user frustration points
- **No metrics** - Track journey completion and drop-off
- **Static journeys** - Update as user behavior evolves

---

## Quick Reference

### Journey Priorities
| Priority | Criteria | Test Frequency |
|----------|----------|----------------|
| Critical | Revenue, core value | Every deploy |
| High | Daily user actions | Daily |
| Medium | Weekly features | Weekly |
| Low | Edge cases | On change |

### Journey Documentation Checklist
- [ ] User goal clearly stated
- [ ] All steps documented
- [ ] Success criteria per step
- [ ] Error scenarios covered
- [ ] Recovery paths defined
- [ ] Metrics identified
- [ ] E2E test linked
