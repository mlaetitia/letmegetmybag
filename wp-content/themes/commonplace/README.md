# Commonplace

A quiet, earthy editorial block theme for the multipotentialite. Built for [letmegetmybag.com](https://letmegetmybag.com).

## Concept

Named after the [commonplace book](https://en.wikipedia.org/wiki/Commonplace_book) - a personal notebook for collecting passages, observations, and projects across many domains. The site has five flat categories (Notes, Reading, Making, Growing, Going); each gets its own accent colour against a shared cream foundation.

## Design system

| Token             | Hex       | Used for                                               |
|-------------------|-----------|--------------------------------------------------------|
| `--base`          | `#FAF7F2` | Cream background, site-wide                            |
| `--contrast`      | `#1F1B2E` | Body text                                              |
| `--accent` (plum) | `#5B3A5A` | Default accent (Notes, Reading, homepage)              |
| `--accent-sage`   | `#8FA888` | Growing                                                |
| `--accent-terracotta` | `#C67B5C` | Making                                              |
| `--accent-ochre`  | `#C9A24A` | Going                                                  |

Per-category accent switching is handled via the `category-<slug>` body class set in `functions.php`.

**Typography:** Fraunces (serif headings) + Inter (sans body), declared as font-family stacks in `theme.json`. Replace with `theme.json` font assets when you want self-hosted Google Fonts.

## File structure

```
commonplace/
├── style.css            ← Theme header (required by WordPress)
├── theme.json           ← Block theme config: tokens, layout, styles
├── functions.php        ← Minimal: enqueues, body class, text domain
├── index.php            ← Silence-is-golden fallback
├── templates/
│   └── index.html       ← Default blog list
├── parts/
│   ├── header.html      ← Site title + nav
│   └── footer.html      ← Separator + colophon link + RSS
├── patterns/            ← Block patterns (project templates etc.)
├── styles/              ← Style variations (alt palettes)
├── assets/
│   ├── src/             ← JS / SCSS source (built by @wordpress/scripts)
│   └── build/           ← Compiled output (committed; safe to install without build step)
├── package.json         ← @wordpress/scripts build chain
├── readme.txt           ← wp.org-format readme (required for dotorg submission)
├── README.md            ← This file
├── .distignore          ← Files to exclude from the wp.org zip
└── screenshot.png       ← Theme preview (1200x900, required by wp.org)
```

## Development

From the repo root:

```bash
npm install               # installs deps for all workspaces, including this theme
npm run start             # watches and rebuilds assets across all workspaces
npm run build             # production build
```

Or theme-only, from this folder:

```bash
npm run start
npm run build
npm run lint:js
npm run lint:css
```

## What still needs building

This is a 0.1.0 scaffold. Outstanding work tracked at the repo level:

- [ ] Block patterns: project templates (sewing, crochet, knitting, code, growing, reading)
- [ ] `/now` page template (in-progress projects, grouped by category)
- [ ] `/bookshelf` page template
- [ ] `/colophon` page template
- [ ] Style variations: sage, terracotta, ochre alternates of the base palette
- [ ] Single post template with reading time + category chip + pull-quote treatment
- [ ] Project post template with metadata header + progress log layout
- [ ] Self-hosted Fraunces + Inter via `theme.json` font assets
- [ ] `screenshot.png` (1200x900)

## License

GPL-3.0-or-later. See [LICENSE](../../../LICENSE) at the repo root.
