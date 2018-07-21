# Changelog

## 1.2.0 - 2018-07-21

### Added

- Added crafting category to `Recipe` entity.
- Added the `Machine` entity.
- Added flag to `Translation` entity for duplicating machine localisation.

### Changed

- Renamed `getIconHash()` to `getHash()` in `Icon` entity.

## 1.1.0 - 2018-04-05

### Changed

- Renamed type of recipes to mode to avoid confusion with item types.
- Only use one sub-directory for icons instead of two.
- Separated meta data and actual data of combinations into two entities. 

## 1.0.0 - 2018-02-19

- Initial import of the export data entities.