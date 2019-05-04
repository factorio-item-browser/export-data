# Changelog

## 2.1.0 - 2019-05-04

### Added

- Property `thumbnailHash` to the `Mod` entity.
- Property `renderedSize` to the `Icon` entity.
- `DEFAULT_SIZE` of `Icon` from 32 to 64, as it will become the new default value in the game. 

## 2.0.0 - 2018-12-26

### Changed

- **Backward compatibility break:** Refactored the whole library and the data format of the files: Entities are now saved separately and no longer in a 
  huge file for each combination. 

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
