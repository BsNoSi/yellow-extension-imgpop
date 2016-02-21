#imgscale plugin 0.0.1

Image scale for Yellow with dimmed background and subtitle, CCS only, no Javascript required.

## The Idea Behind

I wanted to have a simple use of images in my blog (http://blog.nosi.de → German only). So I created a CSS style that places images, included with standard markdown, always on the right side of the text, reduced to maximum of 40% textwidth. In much cases this is too small for details.

To avoid loading external and huge javascript, I created a few more CSS styles and this plugin, to expand the basic behaviour.

The image is scaled to it´s maximum size of itself or — if too large for viewport — 90% width or 80% height aspect ratio kept. It is *not* scaled to max-width!  

## How do I Install This?

1. Download and install [Yellow](https://github.com/datenstrom/yellow/).
1. Donwload imgscale.php and copy it into the `system/plugins` folder.
1. Add the required css styles to your style sheet (see below)

## How To Add A Scaled Image?

Create a `[imgscale TheImage TheTitle TheID]` shortcut.

The following arguments are available:

`TheImage` = Filename and path (relative to `media/images` !) to the image, **required**     
`TheTitle` = The Title for the image as `title` tag and subtitle. If missing, currently replaced by „Keine weitere Bildbeschreibung“     
`TheID` = The ID of the target. If missing, replaced by a timestamp (**not unique** if more than one image!)

It´s licensed under [MIT license](http://opensource.org/licenses/MIT).


### Required CSS Styles

You may alter this formats to your needs.


~~~.css

.content img {
    border: 0 none;
    height: auto;
    max-width: 40%;
    outline: 0 none;
    float: right;
    padding-left: 1em
}
.imgnote,
.closer {
    display: none
}
.content span: target img {
    max-width: 90%;
    max-height: 90%;
    padding: 0;
    border: 1500px solid #0a0a0a;
    border: 1500px solid rgba(10, 10, 10, .9);
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    background-color: #fff;
    position: fixed;
    top: 50%;
    left: 50%;
    max-width: 90%;
    max-height: 80%;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    cursor: default
}
span: target .imgnote {
    position: fixed;
    bottom: 1%;
    left: 50%;
    max-width: 90%;
    max-height: 8%;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    padding: 1rem;
    z-index: 99;
    background-color: #fff;
    font-size: 1rem;
    display: block
}
span: target>.closer {
    position: fixed;
    z-index: 100;
    right: 2%;
    top: 2%;
    font-size: 6rem;
    display: block
}

~~~