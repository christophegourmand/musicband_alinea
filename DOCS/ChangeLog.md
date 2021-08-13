
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