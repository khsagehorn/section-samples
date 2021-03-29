#Section Samples


##wine-list
[https://www.wanderandivy.com/wines/](https://www.wanderandivy.com/wines/)

This is a nice little Wordpress site for a wine retailer.

`wine-list.php` is the archive page for the Wine post type features a dynamically-generated 'navigation' of links that anchor to each single wine section.

The inital block of php are methods and functions particular to our internal WordPress theme. They are basically just parsing the posts and associated field data.

The design called for a 'disruption' within the loop of single wine sections, which is what is happening fron lines 15-23.

`single-wine.php` is the template being called for each single wine section on the archive page.


##tin-animation
[https://stello.us/](https://stello.us/)

This Shopify site for a CBD mint retailer has a lot of fun details, and was a lot of fun to build.

Here I am highlighting the mint and tin animation that are part of the product purchace form near the center of the page. In `tin-animation.js` I am using the GSAP ScrollTrigger library to initiate the animations of the mint dropping into the tin, and the tin lib closing behind it. The tin scrubs through a .png spritesheet, and the mint drops behind a 'mask' on top of the tin to achieve the illusion of dropping inside.
