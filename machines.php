<?php

get_header();

/* Template Name: machine */


?>

<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Archief Design Html</title>

    <link rel="stylesheet" type="text/css" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" media="mediatype and|not|only (expressions)" href="print.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css">

  </head>

  <body>

    <style type="text/css">

      .categories-section li {

        list-style: none;

        padding-top: 15px;

      }



      select.category-prijs {

        width: 44%;

      }



      select.category-prijs-section {

        width: 44%;

        margin-left: 12px;

      }



      .tot {

        padding-left: 29%;

      }



      .merk-heading h3 {

        width: 100%;

        color: #007a3d;

        font-size: 18px;

        text-transform: uppercase;

        cursor: pointer;

        margin-top: 19px;

      }



      .filiaal-heading h3 {

        width: 100%;

        color: #007a3d;

        font-size: 18px;

        text-transform: uppercase;

        cursor: pointer;

        margin-top: 19px;

      }



      .Sinds-heading h3 {

        width: 100%;

        color: #007a3d;

        font-size: 18px;

        text-transform: uppercase;

        cursor: pointer;

        margin-top: 19px;

      }



      .form-group {

        display: block;

        margin-bottom: 15px;

      }



      .form-group input {

        padding: 0;

        height: initial;

        width: initial;

        margin-bottom: 0;

        display: none;

        cursor: pointer;

      }



      .form-group label {

        position: relative;

        cursor: pointer;

      }



      .form-group label:before {

        content: '';

        -webkit-appearance: none;

        background-color: transparent;

        border: 2px solid #c4c4c4;

        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);

        padding: 10px;

        display: inline-block;

        position: relative;

        vertical-align: middle;

        cursor: pointer;

        margin-right: 5px;

      }



      .form-group input:checked+label:after {

        content: '';

        display: block;

        position: absolute;

        top: 2px;

        left: 9px;

        width: 6px;

        height: 14px;

        border: solid #397a3d;

        border-width: 0 2px 2px 0;

        transform: rotate(45deg);

      }



      .right-arrow {

        content: "\1F892";

        padding-left: 9px;

        font-size: 25px;

      }



      .second-img {

        float: right;

      }



      /* Bootstrap 4 text input with search icon */

      .has-search .form-control {

        padding-left: 2.375rem;

      }



      .has-search .form-control-feedback {

        position: absolute;

        z-index: 2;

        display: block;

        width: 2.375rem;

        height: 2.375rem;

        line-height: 2.375rem;

        text-align: center;

        pointer-events: none;

        color: #aaa;

      }



      i.fa.fa-caret-right {

        padding-left: 12px;

        padding-right: 12px;

      }



      .category-heading h3 {

        width: 100%;

        color: #007a3d;

        font-size: 18px;

        text-transform: uppercase;

        cursor: pointer;

      }



      .ding {

        width: calc(80% - 1%);

        padding-bottom: 15px;

        flex-flow:

      }



      .ding h2 {

        font-size: 18px;

        font-weight: 400;

        line-height: 1.888em;

        color: #888;

      }



      select {

        width: 100%;

        padding: 7px 0px;

        border: 2px solid #c4c4c4;

      }



      .ss-main .ss-single-selected {

        width: 50%;

        height: 50px;

        padding: 10px;

      }



      .ss-main .ss-content {

        width: 50%;

      }



      .ss-main .ss-multi-selected {

        width: 80%;

        padding: 10px;

      }



      label {

        font-size: 14px;

        font-family: 'Montserrat';
        text-transform: capitalize;

      }



      select#contact_filiaal {

        margin-bottom: 20px;

      }



      h3.filter__group__title {

        color: #007a3d;

        font-size: 18px;

        text-transform: uppercase;

        font-family: 'Montserrat';

        font-weight: bold;

        margin-bottom: 5px;

      }



      .filter__group__content {

        display: flex;

        flex-direction: row;

        align-content: center;

        justify-content: flex-start;

        align-items: center;

        gap: 10px;

      }



      select {

        width: 100%;

        padding: 10px 12px;

        border: 2px solid #c4c4c4;

        font-size: 14px;

        font-family: 'Montserrat';

      }



      .form__group {

        width: 100%;

      }



      .filter__group {

        margin-bottom: 25px;

      }



      .form__group.radio_content {

        display: flex;

        flex-direction: column;

        flex-wrap: wrap;

        align-content: flex-start;

        align-items: flex-start;

        justify-content: center;

        gap: 12px;

        margin-top: 10px;

      }



      /*search style*/

      .blog_search.search_form {

        width: 85%;

      }



      .input-group-append {

        width: 15%;

      }



      .form-control-main {

        width: 100%;

        padding: 12px 12px;

        font-size: 16px;

        font-weight: 500;

        font-style: italic;

        font-family: 'Montserrat';

        color: #007a3e !important;

        background-color: #ededed;

        background-clip: padding-box;

        -webkit-appearance: none;

        -moz-appearance: none;

        appearance: none;

        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;

        border: none;

        outline: none;

      }



      button.btn.btn-secondary {

        height: 100%;

        width: 100%;

        background: #ffe100;

        color: #007a3e;

        border: none;

        font-size: 14px;

        font-family: 'Montserrat';

        font-weight: 600;

        border-radius: 0;

      }



      .irs--round .irs-bar {

        background-color: #007a3e;

      }



      .irs--round .irs-handle {

        background-color: #007a3e;

        border-color: #007a3e;

        box-shadow: 0px 0px 0px 5px rgb(0 122 62);

      }



      .irs--round .irs-handle.state_hover,

      .irs--round .irs-handle:hover {

        background-color: #007a3e;

      }



      .irs--round .irs-handle {

        width: 16px;

        height: 16px;

        top: 29px

      }



      .irs--round .irs-from,

      .irs--round .irs-to,

      .irs--round .irs-single {

        background-color: transparent;

        color: #fff;

      }



      .irs--round .irs-from:before,

      .irs--round .irs-to:before,

      .irs--round .irs-single:before,

      .irs--round .irs-min,

      .irs--round .irs-max {

        display: none;

      }



      .range-qty-new {

        padding-left: 20px;

      }



      .range-qty-euro::before {

        content: '€';

        position: absolute;

        left: 7.2px;

        top: 35px;

        color: #000;

        font-size: 16px;

      }



      .range-qty-euro {

        position: relative;

      }



      @media(max-width:767px) {

        .range-qty-euro::before {

          left: 35px;

          top: -2px;

          color: #000;

          font-size: 15px;

        }

      }



      /* Styles for wrapping the search box */

      /*box style*/

      main.main_box_content {

        padding: 20px 0px;

      }

h4.footer__big-title {
    font-size: 1.2rem;
    max-width: 275px !important;
}

      main.main_box_content section {

        width: 100%;

        display: flex;

        flex-wrap: wrap;

        flex-direction: row;

        align-content: center;

        justify-content: flex-start;

        align-items: center;

        gap: 15px;

      }



      .blog {

        width: 48.5%;

        height: 465px;

        background: #ededed;

        display: flex;

        flex-direction: column;

        justify-content: space-between;

        align-items: flex-start;

        align-content: flex-start;

      }



      main section .blog .blog-img {

        width: 100%;

      }



      main section .blog .blog-img img {

        width: 100%;
        height: 308px;
        object-fit: cover;

      }



      .blog-content {

        padding: 20px;

        display: flex;

        flex-direction: row;

        align-content: center;

        justify-content: space-between;

        align-items: center;

        gap: 5px;

        padding-top: 0;

      }



      .grey {

        width: 100%;

      }



      p.blog-desc {

        width: 55%;

      }



      .blog-details {

        width: 45%;

      }



      h2.blog-title {

        font-size: 20px;

        color: #007a3d;

        text-transform: uppercase;

        font-family: 'Montserrat';

        font-weight: bold;

        padding: 20px;

      }



      .blog-desc {

        color: #919191;

        font-size: 14px;

        font-family: 'Montserrat';

        font-weight: 500;

        margin: 0;

      }



      button#fancyButton {

        border: none;

        font-size: 14px;

        font-family: 'Montserrat';

        color: #fff;

        background-color: #007a3d;

        font-weight: bold;



        margin: 0;

        width: 100%;

      }



      button#fancyButton a {

        text-decoration: none;

        color: #fff;
        padding: 7px 0px;

                display: flex;

        flex-direction: row;

        justify-content: center;

        align-items: center;

        align-content: center;

        flex-wrap: nowrap;

      }



      /*Badge style*/

      .top_occasions {

        position: absolute;

        right: 7px;

        top: 14px;

        display: table;

        transform: rotate(45deg) translateX(29px) translateY(-71px);

        padding: 39px 60px 15px 60px;

        background-color: #007a3e;

        color: #fff;

        text-align: center;

      }



      h2.top {

        color: #ffffff;

        text-transform: uppercase;

        font-weight: 700;

        font-size: 20px;

        margin: 0;

        font-family: 'Montserrat';

      }



      p.occasions {

        font-family: Montserrat, sans-serif;

        font-size: 16px;

        margin: 0;

        text-align: center;

      }



      .blog-img {

        position: relative;

        overflow: hidden;

      }



      input.qty {

        width: 123px;

        border: 2px solid #c4c4c4;

      }



      @media(max-width:767px) {

        .blog_search.search_form {

          width: 60%;

        }



        .input-group-append {

          width: 40%;

        }

      }



      @media(max-width:1023px) and (min-width:768px) {

        input.qty {

          width: 100%;

          border: 2px solid #c4c4c4;

        }

      }



      @media screen and (max-width: 992px) {

        .ding {

          width: 100%;

        }



        .blog {

          width: 100%;

          height: max-content;

        }



        .tot {

          padding-left: 40%;

        }



        select.category-prijs-section {

          width: 50%;

        }

      }



      div#loader {

        text-align: center;

        width: 100px;

        height: 100px;

        border-top: 16px solid #527a3d;

        border-bottom: 16px solid #527a3d;

        margin: 0 auto;

        position: absolute;

        left: 57%;

        top: 77%;

      }



      .loader {

        border: 16px solid #f3f3f3;

        border-radius: 50%;

        border-top: 16px solid blue;

        border-bottom: 16px solid blue;

        width: 120px;

        height: 120px;

        -webkit-animation: spin 2s linear infinite;

        animation: spin 2s linear infinite;

      }



      @-webkit-keyframes spin {

        0% {

          -webkit-transform: rotate(0deg);

        }



        100% {

          -webkit-transform: rotate(360deg);

        }

      }



      @keyframes spin {

        0% {

          transform: rotate(0deg);

        }



        100% {

          transform: rotate(360deg);

        }

      }



      button#buttonclick {

        margin-top: 20px;

        width: 100%;

        font-family: 'Montserrat';

        font-size: 15px;

        border: none;

        background: #ffe100;

        color: #007a3e;

        font-weight: 500;

        padding: 6px;

      }



      .select2-results__options[aria-multiselectable="true"] li {

        padding-left: 30px;

        position: relative

      }



      .select2-results__options[aria-multiselectable="true"] li:before {

        position: absolute;

        left: 8px;

        opacity: .6;

        top: 6px;

        font-family: "FontAwesome";

        content: "\f0c8";

      }



      .select2-results__options[aria-multiselectable="true"] li[aria-selected="true"]:before {

        content: "\f14a";

      }

.select2{

  margin-bottom: 50% !important;

}

    



      /*span.select2.select2-container.select2-container--default.select2-container--focus.select2-container--below.select2-container--open {

    min-height: 200px;

}

*/

      div#mainsubcategory_1 {

        margin: -18% 0% 0% 0%;

      }



      ul#select2-mainsubcategory-results {

        max-height: 140px !important;

      }



     .select2-dropdown {

        border: 0px solid #aaa;

      }


.input-group {
    position: relative;
    display: flex;
    flex-wrap: nowrap;
    align-items: stretch;
    width: 100%;
}

@media(max-width:767px){
  h2.blog-title{
    padding-bottom: 10px;
  }
}

    </style>

    <div class="container">

      <div class="categories-section">

        <ul>

          <li>Homepage <i class="fa fa-caret-right"></i>Occasion </li>

        </ul>

      </div>

      <div class="row">

        <div class="col-sm-3">

          <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

          <form action="" id="filter" method="get">

            <!--First Dropdown-->

            <div class="filter__group">



                <input type="hidden" name="main-category" id="main-category" value="">

                 <input type="hidden" name="mainsubcategory" id="mainsubcategory" value="">

                  <input type="hidden" name="mainsubcategory1" id="mainsubcategory1" value="">

              <h3 class="filter__group__title">Categorie</h3>

              <div class="filter__group__content">

                <div class="form__group">

                  <div class="country">

                 <?php

                 $categories = get_categories(

                    array(

                        'parent' => 0,

                        'hide_empty' => false,

                         'exclude' => array(1)

                     )



                );


  $main_category_url = $_GET["main-category"];
  $mainsubcategory_url = $_GET["mainsubcategory"];
  $mainsubcategory1_url = $_GET["mainsubcategory1"];
  
foreach ($categories as $category) {
if($main_category_url == $category->name ){

    ?>
    <script>

        setTimeout(function(){ showChildCategories('<?php echo $category->name; ?>','<?php echo $category->term_id; ?>');}, 4000);
     jQuery('#<?php echo $category->name ?>-child-categories').css('display','block');
    </script>
<?php
}
?>
     <input type="checkbox"  id="<?php echo $category->term_id; ?>" value="<?php echo $category->name; ?>" onclick="showChildCategories('<?php echo $category->name; ?>','<?php echo $category->term_id; ?>') ">

    <label for="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></label><br>

    <div id="<?php echo $category->name; ?>-child-categories" style="display: none;">

    <?php

    $childCategories = get_categories(array('parent' => $category->term_id,'hide_empty' => false));

    foreach ($childCategories as $childCategory) {

    if($main_category_url == $childCategory->name ){

    ?>
    <script>

        setTimeout(function(){ showSubChildCategories('<?php echo $childCategory->name; ?>','<?php echo $childCategory->term_id; ?>','<?php echo $category->term_id; ?>');}, 4000);
        jQuery('#<?php echo $category->name ?>-child-categories').css('display','block');
       jQuery('#<?php echo $childCategory->name ?>-sub-child-categories').css('display','block');
    </script>
<?php
}
?>

        &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  id="<?php echo $childCategory->term_id; ?>" value="<?php echo $childCategory->name; ?>" class="subchild" onclick="showSubChildCategories('<?php echo $childCategory->name; ?>','<?php echo $childCategory->term_id; ?>','<?php echo $category->term_id; ?>')">

        <label for="<?php echo $childCategory->term_id; ?>"><?php echo $childCategory->name; ?></label><br>







        <div id="<?php echo $childCategory->name; ?>-sub-child-categories" style="display: none;">

         <?php

        // Loop for subchild categories

        $subChildCategories = get_categories(array('parent' => $childCategory->term_id,'hide_empty' => false));

        foreach ($subChildCategories as $subChildCategory) {

        
   if($main_category_url == $subChildCategory->name ){

    ?>
    <script>

        setTimeout(function(){ showSubSubChildCategories('<?php echo $subChildCategory->name; ?>','<?php echo $subChildCategory->term_id; ?>','<?php echo $childCategory->term_id; ?>');}, 4000);
     jQuery('#<?php echo $category->name ?>-child-categories').css('display','block');
       jQuery('#<?php echo $childCategory->name ?>-sub-child-categories').css('display','block');
    </script>
<?php
}
?>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  id="<?php echo $subChildCategory->term_id; ?>" value="<?php echo $subChildCategory->name; ?>" onclick="showSubSubChildCategories('<?php echo $subChildCategory->name; ?>','<?php echo $subChildCategory->term_id; ?>','<?php echo $childCategory->term_id; ?>')"  class="subsubchild">

            <label for="<?php echo $subChildCategory->term_id; ?>"><?php echo $subChildCategory->name; ?></label><br>

            

         

        <?php

       

        }



    ?> </div>

        <?php 





    }

    ?>

    </div>

    <?php

}?>

                  </div>

                </div>

              </div>

            </div>

        

            <div class="filter__group" id="merk_new">

              <h3 class="filter__group__title">Merk</h3>

              <div class="filter__group__content">

                <div class="form__group"> 

                   <select name="merk" id="merk">

                    <option value="">Select</option>



                    <?php



                            global $wpdb;







                            $merk = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT meta_value  FROM wp_postmeta WHERE meta_key = %s ORDER BY meta_value ASC", 'merk'));




foreach ($merk as $merk_val) {



$merk_select = $merk_val->meta_value;



                            ?> 



                   <option value="<?php echo $merk_select; ?>"><?php echo $merk_select; ?></option>

                    <?php

                   



}

                   ?>

                  </select>

                </div>

              </div>

            </div>

            <div class="filter__group" id="priceinput">

              <h3 class="filter__group__title">Prijs</h3>

              <div class="filter__group__content">

                <div class="form__group">

                  <label for="prijsmin" class="range-qty-euro">Van</label>

                  <input type="number" maxlength="4" id="prijsmin_id" name='prijsmin' value="" class="range-qty-new qty from" />

                </div>

                <div class="form__group data-collapsed">

                  <label for="prijsmax" class="range-qty-euro">Tot</label>

                  <input type="number" name='prijsmax' id="prijsmax_id" maxlength="4" value="" class="range-qty-new qty to" />

                </div>

              </div>

              <section>

                <input type="range" class="js-range-slider" value="" data-skin="round" data-type="double" data-min="0" data-max="900000" data-grid="false" />

              </section>

            </div>

            <div class="filter__group" id="darian">

              <h3 class="filter__group__title">Draaiuren</h3>

              <div class="filter__group__content">

                <div class="form__group">

                  <label for="draaiurenMin">Van</label>

                  <input type="number" maxlength="4" id="draaiurenMin_id" name='draaiurenMin' value="" class="range-qty-new qty from1" />

                </div>

                <div class="form__group data-collapsed">

                  <label for="draaiurenMax">Tot</label>

                  <input type="number" name='draaiurenMax' id="draaiurenMax_id" maxlength="4" value="" class="range-qty-new qty to1" />

                </div>

              </div>

              <section>

                <input type="range" class="js-range-slider1" value="" data-skin="round" data-type="double" data-min="0" data-max="20000" data-grid="false" />

              </section>

            </div>

            <div class="filter__group" id="Bouwjaar_new">

              <h3 class="filter__group__title">Bouwjaar</h3>

              <div class="filter__group__content">

                <div class="form__group">

                  

                  <select name="bouwjaarMin" id="bouwjaarMin" value="12">

                    <option value="">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">Van</font>

                      </font>

                    </option>

                    <option value="1980">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1980</font>

                      </font>

                    </option>

                    <option value="1983">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1983</font>

                      </font>

                    </option>

                    <option value="1985">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1985</font>

                      </font>

                    </option>

                    <option value="1986">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1986</font>

                      </font>

                    </option>

                    <option value="1987">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1987</font>

                      </font>

                    </option>

                    <option value="1989">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1989</font>

                      </font>

                    </option>

                    <option value="1990">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1990</font>

                      </font>

                    </option>

                    <option value="1991">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1991</font>

                      </font>

                    </option>

                    <option value="1992">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1992</font>

                      </font>

                    </option>

                    <option value="1993">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1993</font>

                      </font>

                    </option>

                    <option value="1994">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1994</font>

                      </font>

                    </option>

                    <option value="1995">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1995</font>

                      </font>

                    </option>

                    <option value="1996">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1996</font>

                      </font>

                    </option>

                    <option value="1997">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1997</font>

                      </font>

                    </option>

                    <option value="1998">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1998</font>

                      </font>

                    </option>

                    <option value="1999">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1999</font>

                      </font>

                    </option>

                    <option value="2000">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2000</font>

                      </font>

                    </option>

                    <option value="2001">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2001</font>

                      </font>

                    </option>

                    <option value="2002">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2002</font>

                      </font>

                    </option>

                    <option value="2003">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2003</font>

                      </font>

                    </option>

                    <option value="2004">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2004</font>

                      </font>

                    </option>

                    <option value="2005">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2005</font>

                      </font>

                    </option>

                    <option value="2006">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2006</font>

                      </font>

                    </option>

                    <option value="2007">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2007</font>

                      </font>

                    </option>

                    <option value="2008">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2008</font>

                      </font>

                    </option>

                    <option value="2009">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2009</font>

                      </font>

                    </option>

                    <option value="2010">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2010</font>

                      </font>

                    </option>

                    <option value="2011">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2011</font>

                      </font>

                    </option>

                    <option value="2012">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2012</font>

                      </font>

                    </option>

                    <option value="2013">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2013</font>

                      </font>

                    </option>

                    <option value="2014">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2014</font>

                      </font>

                    </option>

                    <option value="2015">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2015</font>

                      </font>

                    </option>

                    <option value="2016">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2016</font>

                      </font>

                    </option>

                    <option value="2017">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2017</font>

                      </font>

                    </option>

                    <option value="2018">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2018</font>

                      </font>

                    </option>

                    <option value="2019">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2019</font>

                      </font>

                    </option>

                    <option value="2020">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2020</font>

                      </font>

                    </option>

                    <option value="2021">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2021</font>

                      </font>

                    </option>

                    <option value="2022">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2022</font>

                      </font>

                    </option>

                    <option value="2023">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2023</font>

                      </font>

                    </option>

                  </select>

                </div>

                <div class="form__group">

                  

                  <select name="bouwjaarMax" id="bouwjaarMax">

                    <option value="">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">Tot</font>

                      </font>

                    </option>

                    <option value="2023">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2023</font>

                      </font>

                    </option>

                    <option value="2022">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2022</font>

                      </font>

                    </option>

                    <option value="2021">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2021</font>

                      </font>

                    </option>

                    <option value="2020">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2020</font>

                      </font>

                    </option>

                    <option value="2019">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2019</font>

                      </font>

                    </option>

                    <option value="2018">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2018</font>

                      </font>

                    </option>

                    <option value="2017">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2017</font>

                      </font>

                    </option>

                    <option value="2016">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2016</font>

                      </font>

                    </option>

                    <option value="2015">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2015</font>

                      </font>

                    </option>

                    <option value="2014">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2014</font>

                      </font>

                    </option>

                    <option value="2013">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2013</font>

                      </font>

                    </option>

                    <option value="2012">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2012</font>

                      </font>

                    </option>

                    <option value="2011">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2011</font>

                      </font>

                    </option>

                    <option value="2010">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2010</font>

                      </font>

                    </option>

                    <option value="2009">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2009</font>

                      </font>

                    </option>

                    <option value="2008">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2008</font>

                      </font>

                    </option>

                    <option value="2007">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2007</font>

                      </font>

                    </option>

                    <option value="2006">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2006</font>

                      </font>

                    </option>

                    <option value="2005">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2005</font>

                      </font>

                    </option>

                    <option value="2004">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2004</font>

                      </font>

                    </option>

                    <option value="2003">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2003</font>

                      </font>

                    </option>

                    <option value="2002">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2002</font>

                      </font>

                    </option>

                    <option value="2001">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2001</font>

                      </font>

                    </option>

                    <option value="2000">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">2000</font>

                      </font>

                    </option>

                    <option value="1999">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1999</font>

                      </font>

                    </option>

                    <option value="1998">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1998</font>

                      </font>

                    </option>

                    <option value="1997">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1997</font>

                      </font>

                    </option>

                    <option value="1996">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1996</font>

                      </font>

                    </option>

                    <option value="1995">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1995</font>

                      </font>

                    </option>

                    <option value="1994">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1994</font>

                      </font>

                    </option>

                    <option value="1993">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1993</font>

                      </font>

                    </option>

                    <option value="1992">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1992</font>

                      </font>

                    </option>

                    <option value="1991">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1991</font>

                      </font>

                    </option>

                    <option value="1990">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1990</font>

                      </font>

                    </option>

                    <option value="1989">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1989</font>

                      </font>

                    </option>

                    <option value="1987">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1987</font>

                      </font>

                    </option>

                    <option value="1986">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1986</font>

                      </font>

                    </option>

                    <option value="1985">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1985</font>

                      </font>

                    </option>

                    <option value="1983">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1983</font>

                      </font>

                    </option>

                    <option value="1980">

                      <font style="vertical-align: inherit;">

                        <font style="vertical-align: inherit;">1980</font>

                      </font>

                    </option>

                  </select>

                </div>

              </div>

            </div>

            <div class="form__group" id="Contact_filiaal_new">

              <h3 class="filter__group__title">Filiaal</h3>

              <div class="filter__group__content"> <?php



global $wpdb;



$contact_filiaal = 'contact_filiaal';







$data = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = %s", $contact_filiaal), ARRAY_N);


?> 
<select name="contact_filiaal" id="contact_filiaal">

                  <option value="">--- Maak een keuze ---</option> <?php



foreach ($data as $array) {
 ?> <option value="<?php echo $array[0] ?>"> <?php echo $array[0] ?> </option> <?php



}



?>

                </select>

              </div>

            </div>

            <div class="filter__group" id="date_filter">

              <h3 class="filter__group__title">Nieuw</h3>

              <div class="filter__group__content">

                <div class="form__group radio_content">

                 <!--  <label class="radio">

                    <input type="radio" class="radio__input" name="post-filters[date]" value="today" style="margin-right:10px;">Vandaag <span class="radio__indicator"></span>

                  </label>

                  <label class="radio">

                    <input type="radio" class="radio__input" name="post-filters[date]" value="yesterday" style="margin-right:10px;">Gisteren <span class="radio__indicator"></span>

                  </label> -->

                  <label class="radio">

                    <input type="radio" class="radio__input" name="post-filters[date]" value="one-week" style="margin-right:10px;">Afgelopen week<span class="radio__indicator"></span>

                  </label>

                  <label class="radio">

                    <input type="radio" class="radio__input"  name="post-filters[date]" value="all" style="margin-right:10px;">Altijd <span class="radio__indicator"></span>

                  </label>

                </div>

              </div>

            </div>

            <input type="hidden" name="search" value="" id="occ_search">

            <input type="hidden" name="action" value="myfilter1">

          </form>

        </div>

        <div class="col-md-9">

          <div class="main">

            <div class="input-group">

              <div class="input-group-append">

                <button class="btn btn-secondary" id="occ_reset" onclick="resetbutton()" type="button">Reset</button>

              </div>

              <div class="blog_search search_form">

                <input type="search" name="search" class="form-control-main oc-search-input" id="search1" placeholder="Zoek in alle 0 Occasions">

              </div>

              <div class="input-group-append">

                <button class="btn btn-secondary" id="occ_search_new" type="button" onclick="searchbutton()">Zoeken</button>

              </div>

            </div>

            <div id="loader" class="loader" style="display:none;"></div>

            <main class="main_box_content">

              <section class="blog-grid" id="products"> <?php







           $args = array(
            "posts_per_page" => 4,

            "post_type" => "machine",

            "post_status" => "publish",

            "meta_key" => "top",

            "meta_value" => "yes",

            "orderby" => "title",

            "order" => "ASC"


       );

// $meta_keys = array(
//   'art_code',
//   'art_code',
//   'art_code',
//   'art_code',
// );

// // Create a new WP_Query object.
// $args = array(
//   'post_type' => 'machine',
//   "post_status" => "publish",
//     "orderby" => "title",
//   'meta_query' => array(
//     'relation' => 'OR',
//     array(
//       'key' => $meta_keys[0],
//       'value' => 'MCH-300009',
//       'compare' => '=',
//     ),
//     array(
//       'key' => $meta_keys[1],
//       'value' => 'MCH-207415',
//       'compare' => '=',
//     ),
//     array(
//       'key' => $meta_keys[2],
//       'value' => 'MCH-215018',
//       'compare' => '=',
//     ),
//     array(
//       'key' => $meta_keys[3],
//       'value' => 'MCH-213461',
//       'compare' => '=',
//     ),
//   ),
//   'posts_per_page' => 4,
// );









           $the_query = new WP_Query($args);

if ($the_query->have_posts()) {

 while ($the_query->have_posts()) {

$the_query->the_post();


$post_id = get_the_ID();

 $art_code = get_post_meta($post_id, 'art_code', true);

 $top = get_post_meta( $post_id, 'top', true );

           if ($top) {

                 $top = get_post_meta( $post_id, 'top', true );

        };
 $prijsexcl = get_post_meta($post_id, "prijsexcl", true);

            if ($prijsexcl) {
                if ($prijsexcl != "0.00") {

                  $prijsexcl = str_replace(',', '', $prijsexcl); 

                  $number_format=   number_format($prijsexcl, 2, ',', '.');

                    $prijsexclnew = "<br>Prijs:€" . $number_format;
                } else {
                    $prijsexclnew = "<br>Prijs: Op aanvraag";
                }
            }

            $bouwjaar = get_post_meta($post_id, "bouwjaar", true);

            $bouwjaarnew = "";

            if ($bouwjaar != 0) {
                $bouwjaarnew = "<br>Bouwjaar:" . $bouwjaar;
            }

            $draaiuren = get_post_meta($post_id, "draaiuren", true);

            $draaiurennew = "";
            if ($draaiuren != 0) {
                $draaiurennew = "<br>Draaiuren:" . $draaiuren;
            }

            $beschrijving = get_post_meta($post_id, "beschrijving", true);

            if (empty($beschrijving)) {
                $beschrijvingnew = "<br>Beschrijving:" . $beschrijving;
            }
 $directoryurl = site_url() . '/_occasions/images/' . $art_code . '/' . $art_code . '_' . '001.jpg';

?> <div class="blog">

   <div class="blog-img"> 
    <?php 

$topnew="Occasions";

?> 
<div class="top_occasions">
 <h2 class="top">Top</h2>

  <p class="occasions"> <?php echo $topnew; ?> </p>
 </div> 
 <?php


$url_path = ABSPATH.'/_occasions/images/' . $art_code . '/' ;
$handle = opendir($url_path);
if (!empty($handle)) {
?>
<a href="<?php the_permalink(); ?>">
  <img src="<?php echo $directoryurl; ?>"></a> 
<?php
}else{
?>
 <a href="<?php the_permalink(); ?>">
  <img src="<?php site_url() ?>/wp-content/uploads/image1.png"></a>

<?php
 
}


?>
   
   <h2 class="blog-title"> <?php the_title(); ?> </h2>

                  </div>

                  <div class="grey">

                    <div class="blog-content">

                      <?php
$html ='<p class="blog-desc">' ."Artikelcode: $art_code" ."" ."$prijsexclnew" ."" ." $bouwjaarnew" ."" ."$draaiurennew" ."" ."$beschrijvingnew" ."</p>";
 echo $html;
    ?>
<div class="blog-details">
<button id="fancyButton">
    <a href="<?php the_permalink(); ?>">MEER INFO<span class="right-arrow"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="svg-triangle" width="20" height="20">
        <path style="fill:#fff;" d="M 15,10 5,15 5,5 z"></path>
    </svg></span></a>
</button>

                      </div>

                    </div>

                  </div>

                </div> <?php


wp_reset_postdata();
 }


}else{
  echo "Geen machines gevonden!";
}




          ?> </section>

            </main>

          </div>

        </div>

      </div>

    </div>

    </div>

    </div>

    </div>

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <script>

      $(document).ready(function() {

        $("select.category-all").change(function() {

          var selectedCountry = $(".category-all option:selected").val();

          // alert(selectedCountry);

        });

      });

    </script>

    <script type="text/javascript">

      /* 



* Single



*/

      new SlimSelect({

        select: '#country'

      });

      new SlimSelect({

        select: '#favoritefood'

      });

      /*



      * Multiple



      */

      new SlimSelect({

        select: '#multiple'

      });

      new SlimSelect({

        select: '#moptgroups'

      });

    </script>

    <script type="text/javascript">

      const navEl = document.getElementById("nav-mobile-menu");

      const nav = document.getElementsByTagName("nav");

      navEl.addEventListener("click", () => {

        nav[0].classList.toggle("mobile-menu");

      });

    </script>

    <script type="text/javascript">


      jQuery(document).ready(function() {





        jQuery('#filter').submit(filter_form);




        jQuery("#filter #merk_new select, #Contact_filiaal_new select, #Bouwjaar_new select, #priceinput input, #darian input, #date_filter input").on("change", filter_form);



var urlParams = new URLSearchParams(window.location.search);
let merk = urlParams.get('merk');
let bouwjaarMin = urlParams.get('bouwjaarMin');
let bouwjaarMax = urlParams.get('bouwjaarMax');
let contact_filiaal = urlParams.get('contact_filiaal');
let prijsmin = urlParams.get('prijsmin');
let prijsmax = urlParams.get('prijsmax');
let draaiurenMin = urlParams.get('draaiurenMin');
let draaiurenMax = urlParams.get('draaiurenMax');
let post_filters = urlParams.get('post-filters[date]');
let search = urlParams.get('search');





document.getElementById("merk").querySelector("option[value='" + merk + "']").selected = true;
document.getElementById("bouwjaarMin").querySelector("option[value='" + bouwjaarMin + "']").selected = true;
document.getElementById("bouwjaarMax").querySelector("option[value='" + bouwjaarMax + "']").selected = true;
document.getElementById("contact_filiaal").querySelector("option[value='" + contact_filiaal + "']").selected = true; 
document.getElementById("prijsmin_id").value = prijsmin;  
document.getElementById("prijsmax_id").value = prijsmax;
document.getElementById("draaiurenMin_id").value = draaiurenMin;  
document.getElementById("draaiurenMax_id").value = draaiurenMax;   
document.getElementById("search1").value = search;        
let checkboxes = document.querySelectorAll("input[type='radio'][value='" + post_filters + "']");
checkboxes.forEach(function(checkbox) {
  checkbox.checked = true;
});


        if (jQuery("#filter  #merk_new select, #Contact_filiaal_new select, #Bouwjaar_new select, #priceinput input, #darian input, #date_filter input").filter(function(a) {

            return a.value != '';

          }).length > 0) {

          filter_form();

        }




        function filter_form() {



          jQuery('.select2').css('margin-bottom', '50% !important');

          var filter = jQuery('#filter');

          jQuery('#loader').css('display', 'block');

          var s = jQuery('.oc-search-input').val();

          jQuery('#occ_search').val(s);





          var main_category = jQuery('#main-category').val();

          var main_subcategory = jQuery('#mainsubcategory').val();

          var main_subcategory1 = jQuery('#mainsubcategory1').val();







        setTimeout(function() { 

          jQuery.ajax({

            //                                url:filter.attr('action'),

            url: "<?php site_url() ?>/wp-admin/admin-ajax.php",

            dataType: 'JSON',

            data: filter.serialize() + "&filter_form=" + filter_form, // form data

            type: filter.attr('method'), // POST

            cache: false,

            beforeSend: function(xhr) {

              filter.find('button').text('Processing...'); // changing the button label

            },

            success: function(data) {

       jQuery('#merk').html(data[0].merk_option);

              jQuery('#loader').css('display', 'none');

              //console.log(data[0].html);

              jQuery("#search1").attr("placeholder", "Zoek in alle " + data[0].total + " Occasions");

              console.log(data[0].total);

              filter.find('button').text('Apply filter'); // changing the button label back

              var url = window.location.pathname;

              url += '?' + filter.serialize();

              window.history.pushState(null, '', url);

              jQuery('#products').html(data[0].html); // insert data

              if (data.post_count != "") {

                //  jQuery('input#search').attr('placeholder', 'Zoek in alle '+data.post_count+' occasions');

              }

    

            }

          });



 }, 2000);



          return false;

        }

      });

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script type="text/javascript">

      var $range = $(".js-range-slider"),

        $from = $(".from"),

        $to = $(".to"),

        range,

        min = $range.data('min'),

        max = $range.data('max'),

        from,

        to;

      var updateValues = function() {

      $from.prop("value", from);

        $to.prop("value", to);

      };

      $range.ionRangeSlider({

        onChange: function(data) {

          from = data.from;

          to = data.to;

         updateValues();

        }

      });

      range = $range.data("ionRangeSlider");

      var updateRange = function() {

        range.update({

          from: from,

          to: to

        });

      };

      $from.on("input[name='prijsmin']", function() {

        from = +$(this).prop("value");

        if (from < min) {

          from = min;

        }

        if (from > to) {

          from = to;

        }

        updateValues();

        updateRange();

      });

      $to.on("input[name='prijsmax']", function() {

        to = +$(this).prop("value");

        if (to > max) {

          to = max;

        }

        if (to < from) {

          to = from;

        }

        updateValues();

        updateRange();

      });

    </script>

    <script type="text/javascript">

      var $range1 = $(".js-range-slider1"),

        $from1 = $(".from1"),

        $to1 = $(".to1"),

        range1,

        min1 = $range.data('min'),

        max1 = $range.data('max'),

        from1,

        to1;

      var updateValues1 = function() {

        $from1.prop("value", from1);

        $to1.prop("value", to1);

      };

      $range1.ionRangeSlider({

        onChange: function(data) {

          from1 = data.from;

          to1 = data.to;

          updateValues1();

        }

      });

      range1 = $range1.data("ionRangeSlider");

      var updateRange1 = function() {

        range1.update({

          from: from1,

          to: to1

        });

      };

      $from1.on("input[name='draaiurenMin']", function() {

        from1 = +$(this).prop("value");

        if (from1 < min1) {

          from1 = min1;

        }

        if (from1 > to1) {

          from1 = to1;

        }

        updateValues1();

        updateRange1();

      });

      $to1.on("input[name='draaiurenMax']", function() {

        to1 = +$(this).prop("value");

        if (to1 > max1) {

          to1 = max1;

        }

        if (to1 < from1) {

          to1 = from1;

        }

        updateValues1();

        updateRange1();

      });

    </script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet" />

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

    <script src="<?php echo get_template_directory_uri(); ?>/select2.js"></script>

    

    

    

    

    <script>






   function filter_form_checkboxes() {

        

          var filter = jQuery('#filter');

          jQuery('#loader').css('display', 'block');

          var s = jQuery('.oc-search-input').val();

          jQuery('#occ_search').val(s);





          var main_category = jQuery('#main-category').val();



          var filter_form = '';

          jQuery.ajax({

            url: "<?php site_url() ?>/wp-admin/admin-ajax.php",

            dataType: 'JSON',

            data: filter.serialize() + "&filter_form=" + filter_form, // form data

            type: filter.attr('method'), // POST

            cache: false,

            beforeSend: function(xhr) {

              filter.find('button').text('Processing...'); // changing the button label

            },

            success: function(data) {

                jQuery('#merk').html(data[0].merk_option);

              jQuery('#loader').css('display', 'none');

              jQuery("#search1").attr("placeholder", "Zoek in alle " + data[0].total + " Occasions");

              console.log(data[0].total);

              filter.find('button').text('Apply filter'); // changing the button label back

              var url = window.location.pathname;

              url += '?' + filter.serialize();

              window.history.pushState(null, '', url);

              jQuery('#products').html(data[0].html); // insert data

              if (data.post_count != "") {

                //  jQuery('input#search').attr('placeholder', 'Zoek in alle '+data.post_count+' occasions');

              }

          

            }

          });

          return false;

        }


function update_merk() {

        

          var filter = jQuery('#filter');

          jQuery('#loader').css('display', 'block');

          var s = jQuery('.oc-search-input').val();

          jQuery('#occ_search').val(s);





          var main_category = jQuery('#main-category').val();



          var filter_form = '';

          jQuery.ajax({

            url: "<?php site_url() ?>/wp-admin/admin-ajax.php",

            dataType: 'JSON',

            data: {'main-category':main_category,'action':'update_merk'}, // form data

            type:'POST', // POST

            cache: false,

           

            success: function(data) {

               

                jQuery('#merk').html(data[0].merk_option);

              jQuery('#loader').css('display', 'none');

             // jQuery("#search").attr("placeholder", "Search all " + data[0].total + " occasions");

            

              filter.find('button').text('Apply filter'); // changing the button label back

              var url = window.location.pathname;

              url += '?' + filter.serialize();

              window.history.pushState(null, '', url);

              jQuery('#products').html(data[0].html); // insert data

              if (data.post_count != "") {

                //  jQuery('input#search').attr('placeholder', 'Zoek in alle '+data.post_count+' occasions');

              }

          

            }

          });

          return false;

        }


function showChildCategories(parentCategory,termparentid) {





    $('input[type="checkbox"]').not("#"+termparentid).prop('checked', false);









    var childCategoriesDiv = document.getElementById(parentCategory + '-child-categories');





    if (childCategoriesDiv.style.display === "none") {

        childCategoriesDiv.style.display = "block";

    } else {

        childCategoriesDiv.style.display = "none";

    }





          if( jQuery('#'+termparentid).is(':checked') ){

           

    jQuery('#main-category').val(parentCategory);

}

else{
            jQuery('#main-category').val('');
           
   window.location.href = "<?php site_url() ?>/occasionss/";

}


           setTimeout(function(){ filter_form_checkboxes();}, 500);

           setTimeout(function(){ update_merk();}, 500);

}
function resetbutton(){
  window.location.href = "<?php site_url() ?>/occasionss/";


}


function searchbutton() {

 

setTimeout(function(){ filter_form_checkboxes();}, 500);

}

$(document).keypress(function(event) {
  if (event.which === 13) {
   setTimeout(function(){ filter_form_checkboxes();}, 500);
  }
});



function showSubChildCategories(parentCategory,termparentid,highercateid) {



     $('.subchild').not("#"+termparentid).prop('checked', false);



  

    var subchildCategoriesDivs = document.querySelectorAll('#' + parentCategory + '-sub-child-categories');





    subchildCategoriesDivs.forEach(function(subchildCategoriesDiv) {

        if (subchildCategoriesDiv.style.display === "none") {

            subchildCategoriesDiv.style.display = "block";

        } else {

            subchildCategoriesDiv.style.display = "none";

        }

    });

if( jQuery('#'+termparentid).is(':checked') ){

jQuery('#main-category').val(parentCategory);

}

else{
jQuery('#main-category').val(jQuery('#'+highercateid).val());

}
 setTimeout(function(){ filter_form_checkboxes();}, 500);

setTimeout(function(){ update_merk();}, 500);



}

function showSubSubChildCategories(parentCategory,termparentid,highercateid) {
 $('.subsubchild').not("#"+termparentid).prop('checked', false);
if( jQuery('#'+termparentid).is(':checked') ){
jQuery('#main-category').val(parentCategory);

}

else{
jQuery('#main-category').val(jQuery('#'+highercateid).val());

}

setTimeout(function(){ filter_form_checkboxes();}, 500);

setTimeout(function(){ update_merk();}, 500);


}



</script>

  </body>

</html>

<?php 

//wp_footer();
get_footer();

?>