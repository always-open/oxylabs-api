# Changelog

All notable changes to `oxylabs-api` will be documented in this file.

## v0.8.8 - 2026-09-03

### Fixed

- `parse_status_code` is now `?int` on `AmazonProductResultContent`,
  `WalmartProductResultContent`, `GoogleShoppingProductResultContent`,
  `GoogleShoppingPricingResultContent` and `AmazonSellerResultContent`. Oxylabs omits the key
  entirely on responses its parser never produced (blocked / CAPTCHA / error pages, unsupported
  page types), which made those payloads unrepresentable: spatie's union fallback handed the raw
  array to the parent constructor and every such job died with
  `TypeError: ...Result::__construct(): Argument #1 ($content) must be of type ...Content|string,
  array given`. (FLUX-511)
- `parser_type` is now `?string` on `AmazonProductResult`, `GoogleShoppingProductResult` and
  `GoogleShoppingPricingResult`, matching `AmazonResult`/`WalmartResult`. The same unparsed
  responses omit it, which otherwise moved the failure to the result envelope.
- `getParseStatusCode()` no longer throws on parse status codes this SDK does not model
  (`12001` is a real gap in the enum sequence); it returns `ParseStatus::UNKNOWN`.

### Added

- `ParseStatus::NOT_REPORTED` (`0`, deliberately outside the vendor `120xx` space) and
  `hasParseStatus(): bool`, so "vendor reported nothing", "vendor reported 12007 UNKNOWN" and
  "vendor reported a code we do not model" stay three distinguishable facts.

### Changed

- A `content` value that is a *string* containing JSON object/array syntax (e.g. `"{}"`) now
  hydrates into a content object instead of remaining a string, because every array-shaped payload
  can now satisfy the content DTO. Oxylabs does not emit this shape for `type: parsed`; pinned by
  test so the behaviour is a decision rather than a surprise.

No BC break: `getParseStatusCode(): ParseStatusEnum` keeps its exact signature, the enum case is
additive, and property types only widen.
