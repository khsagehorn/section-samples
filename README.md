# Section Samples

##wp-vue-blog-collection

A Vue component for a blog collection page featuring a searchbar the allowed dynamic filtering of the post list by fuzzy-matching search terms to post content. Includes a dropdown of search suggestions based on post tags provided in the CMS, which is a neat feature. Worked pretty well, and is still in use at [https://www.nemacolin.com/experiences/all](https://www.nemacolin.com/experiences/all).

## strainge-beast-homepage

A website introducing a new line for a beverage brand. I built a custom Wordpress theme that featured lots of lively animations that triggered on different interactions. This directory includes the PHP homepage file, styles, JavaScript handling animation states, and some of the CMS entry schema.


## wine-list

This was a nice little Wordpress site for a wine retailer. (It has since migrated to Shopify, but the bones of the original site are still present.)

`wine-list.php` is the archive page for the Wine post type features a dynamically-generated 'navigation' of links that anchor to each single wine section.

The inital block of php are methods and functions particular to our internal WordPress theme. They are basically just parsing the posts and associated field data.

The design called for a 'disruption' within the loop of single wine sections, which is what is happening from lines 15-23.

`single-wine.php` is the template being called for each single wine section on the archive page.


## tin-animation
[https://stello.us/](https://stello.us/)

This Shopify site for a CBD mint retailer has a lot of fun details, and was a lot of fun to build.

Here I am highlighting the mint and tin animation that are part of the product purchace form near the center of the page. In `tin-animation.js` I am using the GSAP ScrollTrigger library to initiate the animations of the mint dropping into the tin, and the tin lid closing behind it. The tin scrubs through a .png spritesheet, and the mint drops behind a 'mask' on top of the tin to achieve the illusion of dropping inside.
