# letmegetmybag

Source repository for [letmegetmybag.com](https://letmegetmybag.com), a personal site by Lae running on WordPress.

This repo holds **only** the custom themes, plugins, and mu-plugins authored for this site. WordPress core, third-party plugins/themes, uploads, and database files are all gitignored. The local development environment is [WordPress Studio](https://developer.wordpress.com/studio/).

## Repo layout

```
.
├── package.json                  ← npm workspaces (themes, plugins, mu-plugins)
├── composer.json                 ← PHPCS + WordPress Coding Standards
├── phpcs.xml.dist                ← PHPCS config (scoped to our custom code)
├── .github/workflows/ci.yml      ← CI: PHPCS + theme/plugin builds on PR
└── wp-content/
    ├── themes/
    │   └── commonplace/          ← block theme (self-contained, dotorg-ready)
    ├── plugins/                  ← (custom plugins go here)
    └── mu-plugins/               ← (custom mu-plugins go here)
```

## Branches

| Branch    | Purpose                                                                 |
|-----------|-------------------------------------------------------------------------|
| `develop` | Active development. PRs target this branch. Deploys to staging.         |
| `main`    | Production. Promotions from `develop` only.                             |

## Quick start

```bash
git clone git@github.com:mlaetitia/letmegetmybag.git
cd letmegetmybag

# Install JS deps for every workspace (theme, plugins, mu-plugins)
npm install

# Install PHP dev deps (PHPCS + WPCS)
composer install
```

## Common tasks

All commands run from the repo root:

| Command                 | What it does                                                            |
|-------------------------|-------------------------------------------------------------------------|
| `npm run build`         | Build every workspace that has a `build` script                         |
| `npm run start`         | Run dev watchers in every workspace that has a `start` script           |
| `npm run lint`          | Lint JS, CSS, and PHP across all workspaces                             |
| `npm run lint:js`       | JS linting only                                                         |
| `npm run lint:php`      | PHPCS using `phpcs.xml.dist`                                            |
| `npm run format`        | Auto-format where supported                                             |
| `composer run lint`     | PHPCS direct                                                            |
| `composer run format`   | PHPCBF auto-fix                                                         |

Per-workspace commands (e.g. theme-only) work from the workspace folder:

```bash
cd wp-content/themes/commonplace
npm run start
```

## Adding a new plugin or mu-plugin

1. Create the folder: `wp-content/plugins/your-slug/`
2. Add a `package.json` (and optionally `composer.json`) inside it
3. Add an allowlist entry to `.gitignore`:
   ```
   !/wp-content/plugins/your-slug
   ```
4. Run `npm install` from the repo root to register the new workspace

## Deploying

- **Staging:** push to `develop` (deployment pipeline TBD)
- **Production:** open PR from `develop` to `main`, merge after review

## License

GPL-2.0-or-later - see [LICENSE](LICENSE). Matches WordPress core and the theme's parent (Twenty Twenty-Five).
