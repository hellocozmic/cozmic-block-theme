# Fonts

Two **variable** woff2 files, self-hosted and committed to this repo so every
deploy and clone carries them automatically.

| File | Family | Axis | License |
|---|---|---|---|
| `outfit-variable.woff2` | Outfit (headings) | weight 100–900 | `Outfit-OFL.txt` |
| `quicksand-variable.woff2` | Quicksand (body) | weight 300–700 | `Quicksand-OFL.txt` |

Both are referenced from `theme.json` →
`settings.typography.fontFamilies[].fontFace[].src`. If a filename changes,
update it there.

## Why self-hosted, and why woff2

Loading these from the Google Fonts CDN adds a third-party connection on every
page (a measurable LCP cost) and sends visitor IPs to Google, which some clients
will care about. Bundling avoids both.

woff2 is Brotli-compressed sfnt — roughly 60% smaller than the TTF Google Fonts
hands you (108KB → 44KB for Outfit), universally supported well below our WP 6.7
/ modern-browser floor, and it preserves the variable axes.

## Regenerating them

Download the family from [fonts.google.com](https://fonts.google.com) and use the
**`*-VariableFont_wght.ttf`** at the top level — *not* the `static/` folder, which
holds one fixed weight per file and would need nine separate `@font-face` rules.

Convert with the WASM build of Google's woff2 compressor (no native toolchain
needed):

```bash
npm install wawoff2
node -e "
const {compress}=require('wawoff2'),fs=require('fs');
(async()=>fs.writeFileSync('out.woff2',Buffer.from(await compress(fs.readFileSync('in.ttf')))))()
"
```

Avoid Font Squirrel's generator here — it can flatten a variable font to a single
static weight, which silently breaks the `100 900` range in `theme.json`.

**Verify axes survived** by decompressing and checking the table directory
contains `fvar` and `gvar`. If they are missing, the font is no longer variable.

## Licensing

Both families are SIL Open Font License 1.1. The OFL requires the license
accompany any redistribution — and this theme redistributes them to every client
site — so `Outfit-OFL.txt` and `Quicksand-OFL.txt` ship alongside. Do not remove
them.
