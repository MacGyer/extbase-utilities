# Extbase Utilities

## Changelog

### 14.3.0 - 2026-05-08

* compatibility with TYPO3 14.3
* remove `GenericPageTitleProvider` — use TYPO3 14's native `RecordTitleProvider` instead
* rename `BackendEnumInterface` to `BackedEnumInterface` (typo fix) ⚠ breaking
* inject `ComponentFactory` into `BaseBackendController`
* refactor phone number view helpers around `AbstractPhoneViewHelper` base class
* add `FormatNationalViewHelper`, `FormatInternationalViewHelper`, `FormatRfc3966ViewHelper`
* `IsValidViewHelper` now extends `AbstractConditionViewHelper` — supports `<f:then>`/`<f:else>` and inline condition usage
* `defaultRegion` argument accepts TYPO3 `Country` objects in addition to ISO 3166-1 alpha-2 strings
* rename `countryCode` argument to `defaultRegion` in all phone view helpers ⚠ breaking
* `FormatViewHelper`: `format` argument changed from int to string (`NATIONAL`, `INTERNATIONAL`, `E164`, `RFC3966`), default changed from `RFC3966` to `NATIONAL` ⚠ breaking

### 13.4.0 - 2025-03-20
* compatibility with TYPO3 13
* replace constant based enum implementation with native Enum handling
* add `BaseBackendController::addNotification()` to display notifications
* add view helpers for phone numbers
* add `TcaUtility::getEmptySlugPrefix()` to remove prefix from slug fields
* add `IntegerEnumTrait::fromLabel()` to get enum by label
* add `IntegerEnumTrait::getLabel()` for use in Fluid view helpers
