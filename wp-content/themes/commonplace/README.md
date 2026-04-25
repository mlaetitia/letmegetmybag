# Commonplace

A quiet, earthy editorial block theme for the multipotentialite. Built for [letmegetmybag.com](https://letmegetmybag.com).

> **Lineage:** forked from [Twenty Twenty-Five](https://wordpress.org/themes/twentytwentyfive/) (GPLv2 or later) and progressively customised. Full attribution lives in [`readme.txt`](./readme.txt).

## Concept

Named after the [commonplace book](https://en.wikipedia.org/wiki/Commonplace_book) - a personal notebook for collecting passages, observations, and projects across many domains. The site has five flat categories (Notes, Reading, Making, Growing, Going); each gets its own accent colour against a shared cream foundation.

## Design system

To be filled in once we work through the design handoff document. The current `theme.json` still carries Twenty Twenty-Five's defaults.

## File structure

```
commonplace/
├── style.css            ← Theme header + frontend CSS (used in dev)
├── style.min.css        ← Minified frontend CSS (used in production)
├── theme.json           ← Block theme config: tokens, layout, styles
├── functions.php        ← Enqueues, post formats, pattern categories, body class
├── index.php            ← Silence-is-golden fallback
├── templates/           ← 8 block templates (index, single, page, archive, etc.)
├── parts/               ← 7 template parts (header variants, footers, sidebar)
├── patterns/            ← 98 block patterns (inherited from TT5, to be customised)
├── styles/              ← 12 style variations (alt palettes, to be replaced)
├── assets/
│   ├── css/             ← editor-style.css
│   ├── fonts/           ← Manrope + Fira Code woff2 (from TT5)
│   └── images/          ← TT5's CC0 image library
├── package.json         ← postcss build chain (style.css -> style.min.css)
├── readme.txt           ← wp.org-format readme (required for dotorg submission)
├── README.md            ← This file
├── .distignore          ← Files to exclude from the wp.org zip
└── screenshot.png       ← Theme preview (TT5's; replace before launch)
```

## Development

From the repo root:

```bash
npm install               # installs deps for every workspace
npm run start             # watches and rebuilds assets across all workspaces
npm run build             # production build (regenerates style.min.css)
```

Or theme-only, from this folder:

```bash
npm run start             # postcss watch
npm run build             # postcss build
```

PHP linting runs from the repo root:

```bash
composer run lint         # PHPCS with WordPress Coding Standards
composer run format       # PHPCBF auto-fix
```

## What still needs doing

This is a 0.1.0 fork of Twenty Twenty-Five. Customisation backlog from the design brief:

- [ ] Replace TT5 patterns with Commonplace patterns: project templates (sewing, crochet, knitting, code, growing, reading)
- [ ] `/now` page template (in-progress projects, grouped by category)
- [ ] `/bookshelf` page template
- [ ] `/colophon` page template
- [ ] Style variations: replace TT5's 12 with sage, terracotta, ochre alternates of the base palette
- [ ] Single post template with reading time + category chip + pull-quote treatment
- [ ] Project post template with metadata header + progress log layout
- [ ] Self-host Fraunces + Inter (woff2) and switch theme.json fontFamilies away from Manrope
- [ ] Replace `screenshot.png` (currently TT5's; needs a real Commonplace shot at 1200x900)
- [ ] Audit which TT5 patterns/templates/styles to keep, customise, or delete

## License

GPL-2.0-or-later. See [LICENSE](../../../LICENSE) at the repo root. Forked from Twenty Twenty-Five (also GPLv2 or later).
