# Yellow Extension imgpop

Version 1.7.7

> Tested with Version 0.8.33 / Release 0.8.16 of Yellow

2020-11-21: Alignment to install changes

## Application

CSS only image popup with dimmed background and subtitle, no additional script required. Reads image comment from file or exif, if available.

![Sample of operation](imgpop.webp)

Clicking or taping the *small* image it pops up to it´s maximum size or — if too large for viewport — 90% width or 90% height aspect ratio kept. The title of the *small* picture is set by default (see `imgpop.txt`) to »Please click for description«. The Title of the *large* picture can be set directly, fetched from a file `imagename.txt` in the same folder as the picture or from exif data (only jpeg images support this). 

The Extension comes with a prepared CSS-file that is added to the *footer* of a page *where imgpop ist used*. The *standard presentation*, passed as style "ipop" is defined with a maximum width of 30% for the *small* image. This can be overridden by additional styles or you may modify `imgpop.css` to your needs.

## Install

1. Download and install [Datenstrom Yellow CMS](https://github.com/datenstrom/yellow/).
2. Download [ImgPop plugin](https://github.com/BsNoSi/yellow-extension-imgpop/archive/master.zip ).  If you are using Safari, right click and select 'Download file as'.
3. Copy the `yellow-plugin-imgpop-master.zip` into the `system/plugins` folder.

> Installation is »carefully« which means, that altered files (exept »imgpop.php«) are *not* replaced due to an update. To ensure that you get all current files, delete or rename all »imgpop…« files, before updating.

To uninstall, delete all `imgpop.*` files in extension folder.

## Usage

     [imgpop "TheImage" "TheTitle" "TheID" "TheClass"]

| Parameter | Function |
| :------: | :--- |
| TheImage | Filename and path (relative to `media/images` !) to the image, **required**. A missing filename generates an error message. |
| TheTitle | The Title for the *large* image. If missing, first attempt is reading a file `imagename.tx`. If not available, second attempt is reading exif data (jpeg only). No title leads to standard entry `imgpop_NoTitle` preset in `imgpop.txt`. The *small* image *always* hat `imgpop_zoom` preset as title.<br/>*Note*: All tags are stripped off from TheTitle except `<br>` and `<br/>`. |
|  TheID   | The ID of the target. If missing, replaced by the filename. If two images with the same filename (from different folders) are shown on the same page, this will always show the first image with the same name. To avoid this, you should prefer unique IDs. |
| TheClass | Additional class(es) to basic `impop` class for adding or overriding the preset. |

### Technical Details

- "Small" and "big" image are the same. This means, that calling the page, loads the full image displaying it small. Showing the full size needs no additional load. Therefore you should optimize your images to a suitable size. Big enough but as small as possible, to reduce required bandwidth. Think about using "webp", which has in many cases a smaller file size compared to jpeg or png.      
- The image zoom is limited to its original dimensions with imgpop.css to avoid distortion of upscaled images. You may alter this in the css-file. 


### Examples

     [imgpop portal/portal2.jpg] 

- Reads the image from `/media/images/portal/`
- Generates  `#portal2` as ID
- Tries to read `/media/images/portal/prtal2.txt`.
- If no text file found, tries to read the exif comment of `portal2.jpg`
- If no exif data (JPG only!) the default "no title" is used.

     [imgpop portal/portal2.jpg "A beautiful door." d1 fl]

- Reads  the image from `/media/images/portal/`
- Sets id `#d1`
- Uses *regardless to an existing txt-file or exif comment* the given title
- adds css class `fl` (preset of `imgpos.css` → float left)

     [imgpop portal/portal2.jpg - d1 left]

- Same as previous exept that content of txt file or exif comment is used, if available.

> [imgpop] without any parameter shows a bold parameter list in preview. If not bold you should check if imgpop is correctly installed.

## History

2020-10-17: API changes applied

2020-10-15: Modifications: 

- If a class ist passed, the default class `ipop` is removed to reduce cross interference of other classes.
- Positioning of the magnifier uses another strategy to make it more robust with various formating.
- Magnifier background is no more a sharp circle but a blurred background as a follow up of the new positioning strategy.

2020-10-13: 

- Alignments to changes of Yellow API, split of translation into language.files.

2020-01-07: 

- Filename instead of timestamp as ID, text file for *large* title, default *small* title, Readme overhaul

2019-12-08: 

- Improved behavior, closer removed, magnifier symbol added

2019-04-23: 

- Exif read for jpeg files, improved css

2018-09-07: 

- Initial Release


## Developer

[Norbert Simon](https://nosi.de)
