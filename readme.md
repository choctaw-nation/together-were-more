# Together We're More

## Color Map Reference

```javascript
const colorMap = {
	Artists: 'gold',
	Culture: 'plum',
	Inspirational: 'violet',
	Competitors: 'garnet',
};
```

# Changelog

## 2.4.0

-   Added: New Rest Route for federating content to the nation site

## 2.3.2

-   Fixed: Profiles now correctly look up MediaPress fields before reverting to ACF fields

## 2.3.1

-   Fixed: Homepage alternate images are now being used in the correct spots.

## 2.3.0

-   Added: Common post patterns have been registered with the `patterns` directory
-   Fixed: Blockquote now handles text sizes and line-heights better
-   Fixed: Social Icons in pre-footer are now clickable on entire hover area
-   Fixed: Email "Share This Story" link now has href properly set

## 2.2.0

-   Added: MediaPress!
    -   Added new `mp_get_field` and `mp_the_field` functions to mimic ACF functions
    -   MediaPress gracefully falls back to ACF in template-parts if no value exists (yet)
-   Added: Yoast_Handler class
    -   Controls meta-description fallbacks where it hasn't been switched to the excerpt
    -   Migrated custom field filter the new class
-   Chore: Refactored handleFadeAnimations file to class structure for easier expansion (and less code duplication) to other elements
-   Chore: Fixed blockquote styles

## 2.1.1

-   Fixed: Profile Preview Cards on archive pages are now equal height on desktop screens (buttons line up)
-   Fixed: Search page no longer throws error
-   Fixed: Search page "showing results" message has been updated when no query is set
-   Fixed: Archive pages now support pagination

## 2.1.0

-   Added: Posts can now powered by the Block Editor
-   Added: ACF Field registration is handled with acf-json
-   Added: Images powered by the Block Editor now have lightbox support
-   Updated: `lite-vimeo` package has been upgraded to v1.3.0 for compatibility with the Block Editor's Lite Vimeo plugin

## 2.0.4

-   Fixed: Hero photo is now positioned correctly on desktop sizes in the homepage 'current-feature' section

## 2.0.3

-   Fixed: The profile swiper bug fixe for Webkit introduced a new (but similar) issue on Chrome, so that is now properly handled.
-   Chore: Update Packages

## 2.0.2

-   Fixed: Social Icons now appear the correct height
-   Chore: Updated packages

## 2.0.1

-   Fixed: Profile Swiper doesn't render correctly on Webkit vs Chromium
-   Chore: Updated packages

### Dev Note

Something about how the `lite-vimeo` component calls the thumbnail in causes some odd rendering, but it only occurs on Safari (Webkit engine). The hack is to initialize the Swiper with the video container (`.media-container`) with height set to 100% (`.h-100`). However, this then causes a layout bug on Chromium, so I also removed the `.h-100` class when the swiper bounces to hide the layout issue.

## v2.0.0

-   Added `.inset-0` utility class
-   Updated diamond hr style so the diamonds are smaller and the gap between the svg and the `hr` elements is smaller

### Profile Swiper Updates

-   Updated profile swiper api to only use 1 photo for the first slide
    -   Slide 1 field "transparent image" has been marked "DEPRECATED" to be removed in a future version
-   Slides 4 and 5 have their custom styles removed as they are now only 1 photo with the required design elements set.

## v1.1.10

-   On mobile devices, set the height of the profile slider === 100vw (keeps slides at square ratio, but equal to the device viewport width when < 500px)
-   Adjusted "swipe" text color, size and location over the first slide

## v1.1.9

-   Added new webpack config to remove empty `.js` files
-   Added a new SCSS function to get the correct color based on the above (newly added) color map (mirrors the php function)
-   Updated packages
-   Updated profile swiper styles
-   Updated homepage colors of `.category-spotlight` to be accessible
-   Updated Logo hover color to be accessible (matches the rest of the nav links)
-   Fixed: Category Spotlight colors were wrong
-   Fixed: Links on profiles are now the correct color (were using default gold)
-   Fixed: Site header now uses `--wp-admin--admin-bar--height` instead of `.top-0` for sticky positioning
-   Removed dead files

## v1.1.8

-   Fixed Safari bugs

## v1.1.7

-   Fixed a bug where "watch video" button launched a modal with the incorrect video.

## v1.1.6

-   Fix the homepage photo treatment
-   Fix social share colors to meet WCAG contrast guidelines
-   Update `single.php` profile swiper

## v1.1.5

-   Updated lite-vimeo package to latest version to fix bugs

## v1.1.4

-   Updated lite-vimeo package to latest version to enable GTM Tracking
-   Fixed incorrect aria value
-   Fixed accessibility issue on cards (not enough contrast).
-   Removed lazy loading from hero images
-   Fixed an issue where video loader wasn't accessing ACF properties correctly

## v1.1.3

-   Fixed an issue where card body wasn't going the full width on lg+ sizes
-   Fixed an issue where the swiper media's caption was breaking its container on `single.php` templates

## v1.1.2

-   Fixed an issue where custom video broke single site
-   Further style fixes

## v1.1.1

-   Fixed style bugs on homepage & profile-single

## v1.1.0

-   Added Social Share (requires [CNO Plugin Facebook Share](https://github.com/choctaw-nation/cno-plugin-facebook-share) plugin)
-   Add Gallery Content Block
-   Power Photo Captions with WP "Caption" field
-   Enable `flex-grow` for "Media + Text" blocks that don't get any media set
-   Improve parallax UX for 3XL+ screen sizes
-   Minor style tweaks

## v1.0.0

-   Finished build
