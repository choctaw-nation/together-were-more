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

## v2.0.0

-   Added `.inset-0` utility class

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
