
# Changelog

---

## 2020.10.10 11h10 :   modifications made locally --> To also make on online

- `datas/allSongs_variables.php`
-> updated : new lyrics for "j'écrirais"

- `views/pages/page_photos/photos_array.php`
-> deleted.

- `views/pages/page_photos_big/photos_array.php`
-> deleted.

- `views/pages/page_photos_big/page-content.php`
-> integration of a button 'back'.

- `assets/css/modules/_gallery.scss`
-> modified the css for the button 'back'.

---

## 2020.10.29

- Added new photos sent from Thierry
- bigger margin under each photo album.
- bigger font-size for photo-album-title.

TODO : in page page_photos_big ,  the photo could fit the viewport height, not the width (now=width).

---

## 2021.01.13

### 1er commit

- in `page_actu`
  - section "les jardins du rock" :
    - changed and adopted this class structure : (in page_actu/page-content.php)
      - section
        - section-title
        - section-content
          - section-content-text
            - section-content-text-message
            - section-content-textsubmessage
          - section-content-img
    - same change has been made (in "asset/css/modules/_section.scss")

- in `assets/css/utilities/_colors.scss` :
-> created a sass "map" (like a Json, but using parenthese) called $borderColors_map .

- in `assets/css/utilities/_debig-border.scss` :
-> created a sass loop "@each" to create many classes "border-colorName".

### 2e commit

- in  `assets/img/photos/from-facebook/`
  - created folder "2021.01.12"
  - added photos inside (+named them + created thumbnails 400px max for the longuest side)

- in  `datas/photos_array.php`
  - extended the photo array for the new album + added description for each photo.

- in  `assets/css/modules/_gallery.scss`
  - created a variation (V2) for the class ".gallery-title" to look like other pages section-titles.
  - finally modified the class ".gallery-title" to make it thinner.

### 3e commit

- in   `views/pages/page_bio/page-content.php`
  - surrounded each lastname in a  span having class "musiciens-name-lastname"

- in   `assets/css/layouts/_page_bio.scss`
  - added a style 'small-caps' for musiciens lastname.

---

## 2021.05.19

- in `views/pages/page_tour/page-content.php`
  - removed "la ferme des Epinettes"
  - added new concert at "L'Éveil des Puys".
  - added a map icon linked to Google map.
  
- in assets/css/layouts/_page_tour.scss
  - added a class '.tour-event-mapIcon'

---

## 2021.06.17

### UPDATE FOR OWNER :  CONCERTS TO ADD , A MEMBER TO REMOVE

- in `views/pages/page_bio/page-content.php`
  - removed section about the musician 'Simone CANDIAN'
- in `datas/photos_array.php`
  - de-activated (switched to comment '//' ) photos where 'Simone CANDIAN' appears.

- in `views/pages/page_tour/page-content.php`
  - added 3 more concerts, and google map link for 2 of them.

### FIX JAVASCRIT BUG IN CONSOLE

- in `assets/js/mainPage.js`
  - added a condition if(divSocialMedia_node != null) {...}

### HIDE MY EMAIL ADDRESS

- in `/`
  - created folder 'controller'
- in `/controller/`
  -created 'controller/mailToChristopheGourmand.php'
- in `controller/mailToChristopheGourmand.php`
  - added a 'header(location ....)' to email address c....g.....@gmail.com

### ADD MY CODE PEN LANDPAGE

- in `views/pages/page_contact/page-content.php`
  - added my codepen link

---

## 2021.07.13

### UPDATE FOR OWNER : CONCERT TO REMOVE , ADD PHOTOS

- in `views/pages/page_tour/page-content.php`
  - removed concert "10 juillet - chant des graines"
  - {}
- in `datas/photos_array.php`
  - added new photos from folder '2021.07.08_repetition'
- UPDATED THE `.cpanel.yml` FILE !

---

## 2021.08.12

### UPDATE FOR OWNER : CONCERTS TO ADD

- in `views/pages/page_tour/page-content.php`
  - removed concert "23 juillet, Paradiso"
  - removed concert "07 Août, Paradiso"
  - add concert "21 Août, librairie De Plume Et D'Épée"
  - add concert "11 Septembre, concert privé, Beynost"

## 2021.08.13

### UPDATE .cpanel.yml frac-line

- in `.cpanel.yml`
  - de-activated line copying `img` folder
  - added some `/` on some lines.

### FIX menu 'Photo' and size of mobile menu

- in `assets/css/modules/_navbar.scss`
  - change background for menu photo : `.bg-photos` now use image 00043 (steeldrum)
  - the menu with tiles (mobile view) has height of 92vh intead of 84vh.

### FIX overflow issue

here I will just describe to the essential :

- in `main_style.scss` : INVERT some lines (to fix and issu between queries and variables).
- in `_body.scss` : ADD width 100vw on body.
- on class `.navfooter-menus` : MODIFY the grid and order (now columns order, and optimized according to media-querie).
- on class `.page-title` : MODIFY font-size (now 2.8 rem if under sm breakpoint).
- in `_variables.scss` : MODIFY $pageMargin (1rem if under sm breakpoint, 2rem if above).
- in `footer.php` : MODIFY order of links.
- in `head.php` : ADD rule who block the zoom for a user.

## 2021.08.26

### UPDATE concerts

- deleted concert date of 21 august.

## 2021.10.22

### ADD musician member

- in `views/pages/page_bio/page-content.php` : ADD section for the musician Anthony Plaisir.
- in `assets/img/photos/musicians/` : ADD `photo_presentation_anthony.jpg` with comica effect (made on 'comica' android app.

## 2021.12.01 (branch `feature_design_photoGallery_flex`)

### feat(photoGallery)

#### detailed version

- created folder `models/media` and within : created files for 3 classes `Gallery.php` , `Album.php` , `Photo.php` with properties, getters-setters and methods.
- used these files in `datas/photos_array.php` to created instances of Gallery, of Albums, of Photos. All nested.
- in page 'Photos' , splitted the code of `views/pages/page_photos/page-content.php` into a partial file : `_gallery_loop.php`.
- in `views/pages/page_photos/_gallery_loop.php` : 
  - created a new loop who get albums and photos from new classes instances.
  - tried 3 css classes : `gallery-body-flex`, `gallery-body-flex2` , `gallery-body-grid` who are defined in the file `assets/css/modules/_gallery.scss`
- in `assets/css/modules/_gallery.scss` : 
  - the css-class `gallery-body` became 3 variations : `gallery-body-flex`, `gallery-body-flex2` , `gallery-body-grid`.
  - finally, the css-class `gallery-body-flex2` is the best and I keep this version.
  (However, Please keep the nice job I made on `gallery-body-grid` who apply different number of cells horizontally and vertically, (using grid span system) by reading the php-class Photo->orientation who contain "landscape" or "portrait" or "square");
- well, detailed is too long, let me explain more concisely:

#### short Version

- about photos-storage and display :
  - create 3 php-classes: Gallery, Album and Photo, to replace the previous array system.
  - create instances of them in `photos_array.php`.
  - modify the page 'Photos' and 'Photos big' (respectively in their file `page-content.php` to display the albums and photos instances.
    - move the loop code of page 'Photos' (file `page-content.php`) in a partial `_gallery_loop.php`
  - BETA, WIP : create a file `photos_by_scandir` to automatically create an array from directory.
- about photo effects
  - import new file `animationsOnPhotos.js` in `page_photos.php`
  - create file `animationsOnPhotos.js` : inside, use my new function `effectOnAppear()` on each photo container (`<a>`) , but doesnt work yet, to be continued...
- about the navbar
  - modify menus to 'small caps'.
- about animation for social media icons
  - move css animations from `_socialmedia.scss` to `_animations.scss`
- about 'namespaces' and 'use'
  - create php namespace for `debug_functions.php`, and for classes `Gallery.php` , `Album.php`, `Photo.php`.
