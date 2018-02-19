# Factorio Item Browser - Export Data

This small library provides a data format used for temporarily persisting the exported data from the Factorio game to
the disk to later import it into the actual database.

This persistence step is required because the export is executed on a local machine (able to run Factorio), which is 
not able to directly access the database. The files created by this library can be easily uploaded to the server and
loaded by the importing script.

## Usage

To save or load any data, the ExportDataService is used. It will handle the directory structure itself, the only 
requirement is a writable directory already available.

There are different kinds of data which can be persisted:

* **Mod data:** Holds the meta data of a mod. All mods are saved to a single file.
* **Combination data:** Holds the data of exactly one exported combination of mods with its items, recipes etc.
* **Icon data:** The binary icons (as PNG files).