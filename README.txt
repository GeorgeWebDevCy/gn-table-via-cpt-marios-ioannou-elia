=== GN Table Via CPT For Marios Ioannou Ellia ===
Contributors: georgenicolaou
Donate link: https://www.georgenicolaou.me/
Tags: cpt, acf, table, custom post type, works
Requires at least: 5.0
Tested up to: 6.9
Stable tag: 1.0.30
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Requires PHP: 7.4

A custom plugin to display a responsive table of "Works" from a Custom Post Type using Advanced Custom Fields PRO data.

== Description ==

This plugin provides a simple way to list musical works or similar entries managed via a Custom Post Type (CPT) named `works`. It allows you to display a detailed, responsive table on any page using a shortcode.

**Key Features:**
*   **Responsive Table:** Automatically adjusts for mobile devices, stacking columns and using data labels.
*   **ACF Integration:** Pulls data directly from Advanced Custom Fields PRO fields.
*   **Smart Fallbacks:** Uses the standard WordPress post title if the specific ACF title field is empty.
*   **Automatic Updates:** Integrated with GitHub for seamless updates.
*   **Activation Checks:** Ensures ACF PRO is active to prevent errors.

**Required CPT Structure:**
The plugin expects a CPT with the slug `works` and the following ACF fields:
*   `title` (Text)
*   `year` (Text)
*   `duration` (Text)
*   `genre` (Select/Text)
*   `scored-for` (Text)
*   `instrumentation_details` (WYSIWYG)
*   `date` (Date/Text - used for Premiere)

== Installation ==

1.  Ensure **Advanced Custom Fields PRO** is installed and active.
2.  Ensure you have a Custom Post Type registered with the slug `works`.
3.  Upload the plugin files to the `/wp-content/plugins/gn-table-via-cpt-marios-ioannou-elia` directory, or install the plugin through the WordPress plugins screen.
4.  Activate the plugin through the 'Plugins' screen in WordPress.
5.  Use the `[gn_table_works]` shortcode on any page.

== Shortcodes ==

= [gn_table_works] =

Displays a responsive table of all published "Works".

**Example:**
`[gn_table_works]`

**Attributes:**
*   Currently, there are no attributes. The shortcode queries all published posts in the `works` post type.

== Frequently Asked Questions ==

= Does this plugin register the CPT? =
No, this plugin assumes the `works` CPT and its associated ACF fields are already registered (e.g., via another plugin or theme).

= What happens if I deactivate ACF PRO? =
This plugin will automatically deactivate itself to prevent errors, as it relies heavily on ACF functions.

== Changelog ==

= 1.0.30 =
*   Set `td.gn-col-title` to 18px.
*   Bump plugin version number.

= 1.0.29 =
*   Changed the default table query and selector to 20 items per page.
*   Bump plugin version number.

= 1.0.28 =
*   Corrected the table pagination arrow markup to match the site's theme behavior.
*   Bump plugin version number.

= 1.0.27 =
*   Increased the table border radius to 10px.
*   Bump plugin version number.

= 1.0.26 =
*   Matched the table pagination markup to the site's default pagination structure.
*   Bump plugin version number.

= 1.0.25 =
*   Set the default title link color to black.
*   Bump plugin version number.

= 1.0.24 =
*   Added Safari-specific title link sizing safeguards.
*   Bump plugin version number.

= 1.0.23 =
*   Disabled underline on title links during hover.
*   Bump plugin version number.

= 1.0.22 =
*   Bump plugin version number.

= 1.0.21 =
*   Limited title links to the width of their anchor text.
*   Bump plugin version number.

= 1.0.20 =
*   Widened the title column so more of each title stays visible on desktop.
*   Bump plugin version number.

= 1.0.19 =
*   Improved the table's mobile responsiveness and stacked controls cleanly on small screens.
*   Bump plugin version number.

= 1.0.18 =
*   Centered the duration column.
*   Bump plugin version number.

= 1.0.17 =
*   Enforced single-line title cells with constrained width and ellipsis.
*   Bump plugin version number.

= 1.0.16 =
*   Kept the title column on a single line with ellipsis.
*   Bump plugin version number.

= 1.0.15 =
*   Set the title column width to 10%.
*   Bump plugin version number.

= 1.0.14 =
*   Tightened the year column width and applied the year column class to the header cell.
*   Bump plugin version number.

= 1.0.13 =
*   Reduced the year column width.
*   Bump plugin version number.

= 1.0.12 =
*   Tightened the title column width and enforced table column sizing.
*   Bump plugin version number.

= 1.0.11 =
*   Reduced the title column width and centered the numbering column.
*   Bump plugin version number.

= 1.0.10 =
*   Restored the numbering column with an empty header cell.
*   Set the works table wrapper width to 80%.
*   Bump plugin version number.

= 1.0.9 =
*   Simplified the works table to Title, Year, Scored For, and Duration.
*   Reduced the frontend table width.
*   Bump plugin version number.

= 1.0.8 =
*   Honor the per-page selector when fetching works and pagination.
*   Bump plugin version number.

= 1.0.7 =
*   Ensure pagination resets to the first page when resorting the table.
*   Bump plugin version number.

= 1.0.4 =
*   Bumped "Tested up to" version to 6.9.

= 1.0.3 =
*   Updated documentation for production release.

= 1.0.2 =
*   Added `[gn_table_works]` shortcode.
*   Implemented responsive table layout.
*   Implemented check for Advanced Custom Fields PRO.

= 1.0.1 =
*   Integrated Plugin Update Checker.
*   Added ACF Pro activation dependency check.

= 1.0.0 =
*   Initial release.
