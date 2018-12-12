# Yellow Plugin imgpop 1.0.0

CSS only image popup for [Yellow](https://developers.datenstrom.se/de/help/ "see homepage of Yellow") with dimmed background and subtitle, no additional script required.

## The Idea Behind

Typically "zoom functions" are realised with JavaScript and/or switching between a thumbnail image and a full size image. While I am optimising images *always* to achieve low traffic for users, an additional thumbnail in most cases is no advantage. Some css allows using a single image in *standard presentation* and full screen: 

![Sample of operation](imgpop.png)

**The css below is required and has to be added to the standard css file**. It may be altered to personal needs or preferences.  

The *standard presentation* is defined with the css as *aligned right, max-width 40% of textwidth*. This can be overridden by a class passed to the plugin.

The image pops up to it´s maximum size or — if too large for viewport — 90% width or 80% height aspect ratio kept.

## How do I Install This?

1. Download and install [Datenstrom Yellow CMS](https://github.com/datenstrom/yellow/).
2. Donwload imgpop.php and copy it into the `system/plugins` folder.
3. Add required css styles to your style sheet (see below)

> There is no installer. To uninstall, simply delete the plugin and remove the additional css from your style sheet.

## How To Add A Popup Image?

> Small and big image are the same. This means, that calling the page, loads the full image, showing the full size needs no additional load. Therefore you should optimise your images to a suitable size. Big enough but as small as possible, to reduce required bandwidth. The image is limited to its true size with the styles below. You can alter this. Be aware, that small images zoomed to bigger than true size very seldom look nice.

Create a `[imgpop TheImage TheTitle TheID TheClass]` shortcut.

The following arguments are available:

`TheImage` = Filename and path (relative to `media/images` !) to the image, **required**     
`TheTitle` = The Title for the image as `title` tag and subtitle.     
`TheID` = The ID of the target. If missing, replaced by a timestamp (**not unique** if more than one image!).      

> You should *always* give an unique ID for the image.

`TheClass` =  Optional css class to override the standard formatting (s. below).

Missing filename and missing title are are notified with a text in output page, that can be altered in head of plugin:

- **const NoTitle** = "Place your standard text here, if image title is missing";
- **const NoImg** = "Place your note here for missing image";

### Required CSS Styles

You may alter this formats to your needs.

```.css
.content img {
	border: 0 none;
	height: auto;
	max-width: 40%;
	outline: 0 none;
	float: right;
	padding-left: 0.5rem
}
.imgnote, .closer {
	display: none
}
.content span:target img {
	max-width: 90% !important;
	max-height: 90% !important;
	padding: 0;
	border: 1500px solid #0a0a0a;
	border: 1500px solid rgba(10,10,10,.9);
	-webkit-background-clip: padding-box;
	background-clip: padding-box;
	background-color: #fff;
	position: fixed;
	top: 50%;
	left: 50%;
	max-width: 90%;
	max-height: 80%;
	transform: translate(-50%,-50%);
	-webkit-transform: translate(-50%,-50%);
	-moz-transform: translate(-50%,-50%);
	-o-transform: translate(-50%,-50%);
	-ms-transform: translate(-50%,-50%);
	cursor: default
}
span:target .imgnote {
	position: fixed;
	bottom: 1%;
	left: 50%;
	max-width: 90%;
	max-height: 8%;
	transform: translate(-50%,-50%);
	-webkit-transform: translate(-50%,-50%);
	-moz-transform: translate(-50%,-50%);
	-o-transform: translate(-50%,-50%);
	-ms-transform: translate(-50%,-50%);
	padding: 1rem;
	z-index: 99;
	background-color: #fff;
	font-size: 1rem;
	display: block
}
span:target>.closer {
	position: fixed;
	z-index: 100;
	right: 2%;
	top: 2%;
	font-size: 6rem;
	display: block;
	color: #ffffff;
}

```

ImgPop is licensed under the terms of the public license.
