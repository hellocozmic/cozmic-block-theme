# Fonts

`theme.json` expects two **variable** woff2 files here. They are not committed
yet — drop them in before the theme renders correctly:

| File | Source |
|---|---|
| `quicksand-variable.woff2` | Google Fonts → Quicksand (variable, weight 300–700) |
| `outfit-variable.woff2` | Google Fonts → Outfit (variable, weight 100–900) |

**Self-hosted on purpose.** Loading these from the Google Fonts CDN adds a
third-party request on every page (a measurable LCP cost) and sends visitor IPs
to Google, which is a GDPR problem some clients will care about. Bundling them
avoids both.

Getting variable woff2 files: download the family from
[fonts.google.com](https://fonts.google.com), or pull the variable build from
the [google/fonts](https://github.com/google/fonts) repo and convert the TTF
with `woff2_compress` or [Fontsquirrel](https://www.fontsquirrel.com/tools/webfont-generator).

If a filename changes, update the `src` paths in `theme.json` →
`settings.typography.fontFamilies[].fontFace[].src`.
