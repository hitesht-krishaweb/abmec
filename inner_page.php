<?php

get_header();


/* Template Name: inner_page */


//wp_head();





$product_id = ($_GET['product_id']);
$naam = get_post_meta($product_id, 'naam', true);
$beschrijving = get_post_meta($product_id, 'beschrijving', true);
$art_code = get_post_meta($product_id, 'art_code', true);
$categorie = get_post_meta($product_id, 'categorie', true);
$prijsexcl = get_post_meta($product_id, 'prijsexcl', true);
$bouwjaar = get_post_meta($product_id, 'bouwjaar', true);
$bandenvoor = get_post_meta($product_id, 'bandenvoor', true);
$bandenachter = get_post_meta($product_id, 'bandenachter', true);
$conditiemotor = get_post_meta($product_id, 'conditiemotor', true);
$conditietransmissie = get_post_meta($product_id, 'conditietransmissie', true);
$conditieslijtdelen = get_post_meta($product_id, 'conditieslijtdelen', true);
$uiterlijk = get_post_meta($product_id, 'uiterlijk', true);
$conditiehef = get_post_meta($product_id, 'conditiehef', true);
$merk = get_post_meta($product_id, 'merk', true);
$draaiuren = get_post_meta($product_id, 'draaiuren', true);
$cabine = get_post_meta($product_id, 'cabine', true);
$rijsnelheidmax = get_post_meta($product_id, 'rijsnelheidmax', true);
$werkbreedte = get_post_meta($product_id, 'werkbreedte', true);
$inhoud = get_post_meta($product_id, 'inhoud', true);
$elementen = get_post_meta($product_id, 'elementen', true);
$werkhoogte = get_post_meta($product_id, 'werkhoogte', true);
$vooras = get_post_meta($product_id, 'vooras', true);
$aftakas = get_post_meta($product_id, 'aftakas', true);
$aanhangerrem = get_post_meta($product_id, 'aanhangerrem', true);
$rijsnelheidmin = get_post_meta($product_id, 'rijsnelheidmin', true);
$hydraulischeventielen = get_post_meta($product_id, 'hydraulischeventielen', true);
$hefinrichtingachter = get_post_meta($product_id, 'hefinrichtingachter', true);
$hefinrichtingvoor = get_post_meta($product_id, 'hefinrichtingvoor', true);
$pk = get_post_meta($product_id, 'pk', true);
$contact_filiaal = get_post_meta($product_id, 'contact_filiaal', true);
$contact_persoon = get_post_meta($product_id, 'contact_persoon', true);
$contact_mobiel = get_post_meta($product_id, 'contact_mobiel', true);
$contact_telefoon = get_post_meta($product_id, 'contact_telefoon', true);
$mtekst = get_post_meta($product_id, 'mtekst', true);
$ag_code = get_post_meta($product_id, 'ag_code', true);
if (trim($contact_filiaal)) {

  $contact_filiaal_new = '<tr><td style="padding-top: 62px;font-family: Montserrat,sans-serif;font-size: 15px;color: #007a3d;font-weight: 700;">' . $contact_filiaal . '</td></tr>';


}

if (trim($contact_persoon)) {

  $contact_persoon_new = '<tr><td style="font-family: Montserrat,sans-serif;font-size: 16px;color: #666666;font-weight: 700;"> contactperson:' . $contact_persoon . '</td></tr>';

}

if (trim($contact_mobiel)) {


  $contact_mobiel_new = '<tr><td style="font-family: Montserrat,sans-serif;font-size: 16px;color: #666666;font-weight: 500;">MOB:' . $contact_mobiel . '</td></tr>';


}


if (trim($contact_telefoon)) {


  $contact_telefoon_new = '<tr><td style="font-family: Montserrat,sans-serif;font-size: 16px;color: #666666;font-weight: 500;">TEL NR:' . $contact_telefoon . '</td></tr>';

}

$path = ABSPATH;

$image_path = $path . '/_occasions/images/' . $art_code;

$full_img_pdf = $image_path . '/' . $art_code . '_' . '001.jpg';


if (file_exists($full_img_pdf)) {



  $full_img_pdf = site_url() . '/_occasions/images/' . $art_code . '/' . $art_code . '_' . '001.jpg';

  $full_img_pdf_img = '<tr><td><img class="" style=" height: 410px; object-fit: cover;padding-top: 22px;"src="' . $full_img_pdf . '"alt=""></td></tr>';



} else {



  $full_img_pdf = site_url() . '/wp-content/uploads/image1.png';

  $full_img_pdf_img = '<tr><td><img class="" style=" height: 410px; object-fit: cover;padding-top: 22px;"src="' . $full_img_pdf . '"alt=""></td></tr>';

}





if (trim($prijsexcl)) {
  $prijsexcl = str_replace(',', '', $prijsexcl); 

  $number_format=   number_format($prijsexcl, 2, ',', '.');

if ($prijsexcl=="0.00") {

  
 $prijsexcl_inner = '<tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">PRIJS</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;"> Op aanvraag</td></tr>';
}else{
   $prijsexcl_inner = '<tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">PRIJS</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">€' . $number_format . '</td></tr>';
}

}

// if (trim($beschrijving)){
//   $beschrijving_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;">'.$beschrijving.'</tr>';
// }
if (trim($bouwjaar)){
  $bouwjaar_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">BOUWJAAR</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $bouwjaar . '</td></tr>';
}
if (trim($bandenvoor)) {
  $bandenvoor_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">BANDEN VOOR</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $bandenvoor . '</td></tr>';
}

if (trim($bandenachter)) {
  $bandenachter_inner=' <tr  style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">BANDEN ACHTER</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $bandenachter . '</td></tr>';
}
if (trim($conditiemotor)){
  $conditiemotor_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">CONDITIE MOTOR</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $conditiemotor . '</td></tr>';
}
if (trim($conditietransmissie)){
  $conditietransmissie_inner=' <tr  style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">CONDITIETRANSMISSIE</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $conditietransmissie . '</td></tr>';
}
if (trim($uiterlijk)){
  $uiterlijk_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">UITERLIJK</td>



                       <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $uiterlijk . '</td></tr>';
}
if (trim($conditiehef)){
  $conditiehef_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">CONDITIE HEF</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $conditiehef . '</td></tr>';
}
if (trim($merk)){
  $merk_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">MERK</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $merk . '</td></tr>';
}
if (trim($draaiuren)){
  $draaiuren_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">DRAAIUREN</td>



                       <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $draaiuren . '</td></tr>';
}
if (trim($cabine)){
  $cabine_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">CABINE</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $cabine . '</td></tr>';
}
if (trim($rijsnelheidmax)){
  $rijsnelheidmax_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">RIJSNELHEIDMAX</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $rijsnelheidmax . '</td></tr>';
}
if (trim($werkbreedte)){
  if ($werkbreedte!="0.00") {
  $werkbreedte_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">Werkbreedte</td>



                       <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $werkbreedte . '</td></tr>';
}
}

if (trim($inhoud)){
  $inhoud_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">INHOUD</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $inhoud . '</td></tr>';
}



if (trim($elementen)) {

if ($elementen!="0.00") {
 $elementen_inner = '<tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">ELEMENTEN</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $elementen . '</td></tr>';
}

}





if (trim($werkhoogte)){
  $werkhoogte_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">Werkhoogte</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $werkhoogte . '</td></tr>';
}
if (trim($vooras)){
  $vooras_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">VOORAS</td>



                       <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $vooras . '</td></tr>';
}
if (trim($aftakas)){
  $aftakas_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">AFTAKAS</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $aftakas . '</td></tr>';
}
if (trim($aanhangerrem)){
  $aanhangerrem_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family:Montserrat,sans-serif;font-size: 14px;font-weight: 700;">AANHANGERREM</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $aanhangerrem . '</td></tr>';
}

if (trim($rijsnelheidmin)){
  $rijsnelheidmin_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">RIJSNELHEIDMIN</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $rijsnelheidmin . '</td></tr>';
}
if (trim($hydraulischeventielen)){
  $hydraulischeventielen_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">HYDRALISCHEVNTILEN</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $hydraulischeventielen . '</td></tr>';
}
if (trim($hefinrichtingachter)){
  $hefinrichtingachter_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">HEFINRICHTINGACHTER</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $hefinrichtingachter . '</td></tr>';
}
if (trim($hefinrichtingvoor)){
  $hefinrichtingvoor_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">HEFINRICHTINGVOOR</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $hefinrichtingvoor . '</td></tr>';
}
if (trim($pk)){
  $pk_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">PK</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $pk . '</td></tr>';
}
if (trim($mtekst)){
  $mtekst_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">Mtekst</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $mtekst . '</td></tr>';
}

if (trim($ag_code)){
  $ag_code_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">AG CODE</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $ag_code . '</td></tr>';
}






$table_pdf='<table  style="width: 80%;margin: 0 auto;" class="first">

  <tbody style="display: flex;flex-wrap: wrap;column-gap: 100px;row-gap: 20px;">';



                   


                   $table_pdf_end= '</tbody></table>';





$html = '<html>



 <head>



  <title> Table with images </title>



<style type="text/css">



   th {



    float: left;



    line-height: 49px;



    padding-left: 92px;



    padding-right: 8px;



}



</style>

 </head>

 <body>
  <table style="width: 900px;margin: 0 auto;vertical-align: top;"> 
  <tr>
   <td>

 <p style="color: #239f64;padding-top: 22px; font-family: sans-serif;font-size: 23px;font-weight: 700;">' . $naam . '</p>

 <p style="font-family: sans-serif;color: #434343;font-size: 14px;margin-top: -8px;">' . $beschrijving . '</p>
   </td>
  </tr>


' . $full_img_pdf_img . '

<div>
   '.$categorie.'
</div>

        <tr>

         <td style="padding-top: 22px;font-family: sans-serif;color: grey;padding-bottom: 18px;">

    <span style="color: #239f64;font-weight: 700;">ARTIKELCODE</span>' . $art_code . '

         </td>

        </tr>
         <tr>

     <td style="padding-top: 22px;font-family: sans-serif;color: grey;padding-bottom: 18px;"></td>

     </tr>


'.$table_pdf.'
                    '.$prijsexcl_inner.'

                    '.$bouwjaar_inner.' 

                    '.$bandenvoor_inner.'

                    '.$bandenachter_inner.'       

                   '.$conditiemotor_inner.'

                    '.$conditietransmissie_inner.'                  

                    '.$uiterlijk_inner.'                      

                    '.$conditiehef_inner.'

                    '.$merk_inner.'

                    '.$draaiuren_inner.' 

                    '.$cabine_inner.'

                    '.$rijsnelheidmax_inner.'

                    '.$werkbreedte_inner.'

                    '.$inhoud_inner.'

                    '.$elementen_inner.'

                    '.$werkhoogte_inner.'

                    '.$vooras_inner.'

                    '.$aftakas_inner.'

                    '.$aanhangerrem_inner.'

                    '.$rijsnelheidmin_inner.'

                    '.$hydraulischeventielen_inner.'

                    '.$hefinrichtingachter_inner.'

                    '.$hefinrichtingvoor_inner.'

                    '.$pk_inner.'

                    '.$mtekst_inner.'
                    
                    '.$ag_code_inner.'

             
             

'.$table_pdf_end.'

     <table style="width: 600px;margin: 0 auto;" class="first">                    

      <tr> <td style="padding-top: 62px;font-family: sans-serif;font-size: 20px;color: #007a3d;font-weight: 600;"></td> <td style="padding-top: 62px;font-family: sans-serif;font-size: 20px;color: #007a3d;font-weight: 600;"></td> </tr>

          </table>
    <table style="width: 700px;margin: 0 auto;" class="first">
       <tr>' . $contact_filiaal_new . '</tr>         
       <tr>' . $contact_persoon_new . '</tr>
       <tr>' . $contact_mobiel_new . '</tr>
       <tr>' . $contact_telefoon_new . '</tr>                  

    </table>

</table>

</body>

</html>';

ob_start();

require_once('TCPDF-main/tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 054');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
  require_once(dirname(__FILE__) . '/lang/eng.php');
  $pdf->setLanguageArray($l);

}
$pdf->setFontSubsetting(false);
$pdf->SetFont('helvetica', '', 10, '', false);
$pdf->AddPage('P','A3');
$pdf->writeHTML($html, true, 0, true, 0);
$pdf->lastPage();
ob_end_clean();
$pdfName = "missing_00" . rand() . ".pdf";
$pdf->Output(__DIR__ . '/machine_pdfs/' . $pdfName, 'F');
$pdfUrl = get_template_directory_uri() . '/machine_pdfs/' . $pdfName;


?>


  <link rel="preconnect" href="https://fonts.googleapis.com">

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/css/swiper.min.css">

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<body>

  <style type="text/css">

    body {



      font-family: 'Montserrat', sans-serif;



    }

.fendt-heading h1 {
    color: #007a3d;
    text-transform: uppercase;
    font-weight: 600;
    font-size: 35px;
    margin-top: 30px;
    margin-bottom: 20px;
    text-align: left;
}

.fendt-heading p {
     font-weight: 500;
     padding-top: 10px;
    }

 .artikecode-text {
 color: #007a3d;
 text-transform: uppercase;

    }

    .artikecode-text span {
color: #007a3d;
 text-transform: uppercase;
font-weight: 700;

    }

    table {
       width: 100%;
    }
table,
 th,
 td {
border-collapse: collapse;

}

    th,

    td {

      padding: 10px;
  padding-left: 30px;

 }

    button.back-button {
      color: #007a3d;
      padding: 9px 15px;
      border: none;
    font-weight: 700;
      font-size: 19px;
      margin-top: 22px;
      font-family: 'Montserrat', sans-serif;
    }


    p.artikecode-text {
    padding-left: 30px;
    margin-top: 25px;
}

.fendt-heading {
    padding-left: 30px;
}

.parent{
    width: 100%;
    padding-left: 30px;
}

.parent {
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    align-items: center;
}

.for-product-dis,
.for-product-form {
    width: 50%;
}

.first-heading
{
  color: #007a3d;
    text-transform: uppercase;
   font-size: 1.5rem;
    line-height: 2rem;
    font-weight: 700;
    font-family: Montserrat,sans-serif;
}

.second-heading
{
  color: #007a3d;
    text-transform: uppercase;
   font-size: .875rem;
   font-weight: 700;
     font-family: Montserrat,sans-serif;
}
ul.Contactpersoon {
    list-style: none;
    padding: 0px;
   line-height: 1.5rem;
    color: #666;
   font-size: .875rem;
    font-family: Montserrat,sans-serif;
    margin-bottom: 1rem;
    font-style: normal;
    
    
}
button.back-button {
transform: rotate(0deg) translateX(97px) translateY(48px);
   padding: 1px 24px 7px 12px;

    }


    form.wpcf7-form input{
    width: 100%;
    padding: 0.5rem;
    border: none;
    border: 1px solid #c4c4c4;
    background: 0 0;
    font-family: Montserrat,sans-serif;
}

form.wpcf7-form label,
form.wpcf7-form p{
    width: 100%;
    margin: 0;

}

.for-field-style {
    display: flex;
    width: 100%;
    gap: 30px;
}

form.wpcf7-form textarea{
width: 100%;
    height: 4.5rem;
    padding: 0.5rem;
    border: 1px solid #c4c4c4;
    background: 0 0;
    font-family: Montserrat,sans-serif;
    overflow-y: auto;
    resize: none;
  }

form.wpcf7-form textarea:focus,
form.wpcf7-form input:focus {
    outline: 0;
    border-color: #007a3d;
}

input.wpcf7-form-control.wpcf7-submit.has-spinner {
    margin-top: 20px;
    width: max-content;
    padding: 13px;
    font-size: 1.125rem;
    color: #fff;
    background: #007a3d;
    text-transform: uppercase;
    font-weight: 700;
    flex-shrink: 0;
    -webkit-transition: background .2s ease-in-out;
    transition: background .2s ease-in-out;
    border: 0;
    cursor: pointer;
}


button.print-pdf {
    color: #007a3d;
    border: none;
    font-weight: 700;
    font-size: 19px;
    margin-top: 30px;
    font-family: 'Montserrat', sans-serif;
    margin-bottom: 30px;
    margin-left: 25px;
    background: transparent;
}

    button.print-pdf a {
      padding: 7px 24px 7px 24px;
      background: #f0f0f0;
      color: #007a3d;
      text-decoration: none;
    }

    @media(max-width:767px){
      table.first tbody tr {
    width: 97% !important;
}
    }



/*  form css  */
.flexy-pr {
    width: 100%;
    margin-bottom: 20px;
}
.parent-top-feilds {
    display: flex;
    gap: 20px;
}
.button-sbmt input {
    background: #006130;
    color: #fff;
    width: 30% !IMPORTANT;
    font-size: 21px;
    font-weight: 600;
    margin-top: 20px;
}
/*form css*/

  </style>



  <button class="back-button" id="back_button" > &#8592; Back</button>



  <div id="wrap" class="container my-5">



    <div class="row">



      <div class="col-md-12">



        <div class="for-parent-style">



          <div class="light-slider">



            <style>

              .center {

                text-align: center;

              }



              h2.subtitle {

                font-size: inherit;

                font-style: italic;

                font-weight: normal;

              }



              span.keyboard-key {

                background: #EFF0F2;

                margin: 0 4px;

                padding: 4px 8px;

                border-radius: 4px;

                border-top: 1px solid #F5F5F5;

                box-shadow: inset 0 0 25px #E8E8E8, 0 1px 0 #C3C3C3, 0 2px 0 #C9C9C9, 0 2px 3px #333;

                line-height: 23px;

                font-family: "Arial", sans-serif;

                font-size: 12px;

                font-weight: bold;

                text-shadow: 0px 1px 0px #F5F5F5;

                white-space: nowrap;

                -webkit-user-select: none;

                -moz-user-select: none;

                -ms-user-select: none;

              }



              .swiper-container,

              .swiper-container * {

                -webkit-user-select: none;

                -moz-user-select: none;

                -ms-user-select: none;

              }



              .swiper-container .swiper-no-swiping .swiper-button-prev,

              .swiper-container .swiper-no-swiping .swiper-button-next {

                opacity: 0;

              }



              .swiper-button-next.swiper-button-disabled,

              .swiper-button-prev.swiper-button-disabled {

                opacity: .1;

              }



              .product-gallery .product-photos-side,

              .product-gallery .product-photo-main {

                position: relative;

              }



              .product-gallery .product-photo-main {

                margin-bottom: 15px;

              }



              .product-gallery .product-photos-side .swiper-container {

                height: 90px;

              }



              .product-gallery .product-photo-main .swiper-container {

                height: 550px;

              }



              .product-gallery .product-photos-side .swiper-slide {

                width: 142px;

                opacity: .4;

                transition: 225ms opacity ease-in-out;

              }



              .product-gallery .product-photos-side .swiper-slide.swiper-slide-active {

                opacity: 1;

              }



              .product-gallery .swiper-container {

                position: static;

                width: 100%;

              }



              .product-gallery .swiper-slide {

                cursor: pointer;

                text-align: center;

              }



              .product-gallery img {

                max-height: 100%;

                max-width: 100%;

              }



              .swiper-pagination.swiper-pagination-clickable.swiper-pagination-bullets {

                display: none;

              }



              .product-photos-side img,

              .product-photo-main img {

                object-fit: cover !important;

                width: 100%;

                height: 100%;

              }



              /* full screen product gallery */



              .product-gallery-full-screen {

                position: fixed;

                background: #000;

                top: 0;

                left: 0;

                height: 100%;

                width: 100%;

                width: 100vw;

                opacity: 0;

                pointer-events: none;

                overflow-y: auto;

                z-index: 999999;

                transition: 350ms opacity ease-in-out;

              }



              .product-gallery-full-screen.opened {

                opacity: 1;

                overflow-y: scroll;

                pointer-events: auto;

              }



              .product-gallery-full-screen .swiper-container {

                position: absolute;

                margin: auto;

                left: 0;

                right: 0;

                top: 0;

                bottom: 0;

              }



              .product-gallery-full-screen .swiper-slide {

                overflow: hidden;

              }





              p.categorie-text {
    color: #212529;
    font-weight: 500;
    font-size: 15px;
    padding-top: 10px;
    
}

              .product-gallery-full-screen .swiper-slide img,

              .product-photos-side .swiper-slide img {

                max-height: 100%;

                max-width: 100%;

              }



              .product-gallery-full-screen .swiper-slide img {

                cursor: zoom-in;

                transition: 350ms -webkit-transform ease-in-out, 350ms transform ease-in-out;

              }



              .product-gallery-full-screen .swiper-button-prev,

              .product-gallery-full-screen .swiper-button-next {

                background: rgba(0, 0, 0, .4);

                color: #aaa;

                transition:

                  250ms opacity ease-in-out,

                  150ms color ease-in-out;

              }



              body:not(:hover) .product-gallery-full-screen .swiper-button-prev,

              body:not(:hover) .product-gallery-full-screen .swiper-button-next {

                opacity: 0;

                transition-delay: 1000ms;

              }



              body:hover .product-gallery-full-screen .swiper-button-prev,

              body:hover .product-gallery-full-screen .swiper-button-next {

                transition-delay: 0ms;

              }



              .product-gallery-full-screen .swiper-button-prev:hover,

              .product-gallery-full-screen .swiper-button-next:hover {

                color: #fff;

              }



              .gallery-nav {

                position: absolute;

                background: rgba(0, 0, 0, 1);

                color: #aaa;

                padding: 10px 15px;

                top: 0;

                left: 0;

                width: 100%;

                z-index: 1;

                transition:

                  250ms opacity ease-in-out;

              }



              body:not(:hover) .gallery-nav {

                opacity: 0;

                transition-delay: 1000ms;

              }



              body:hover .gallery-nav {

                opacity: .65;

                transition-delay: 0ms;

              }



              .gallery-nav ul,

              .gallery-nav li {

                list-style: none;

              }



              .gallery-nav ul {

                float: right;

              }



              .gallery-nav li {

                float: left;

                color: #aaa;

                cursor: pointer;

                margin-left: 15px;

                transition: 150ms color ease-in-out;

              }



              .gallery-nav li:hover {

                color: #fff;

              }



              .gallery-nav svg {

                display: block;

                fill: currentColor;

                height: 24px;

                width: 24px;

              }



              .gallery-nav .zoom.zoom-out svg.zoom-icon-zoom-in {

                display: none;

              }



              .gallery-nav .zoom svg.zoom-icon-zoom-out {

                display: none;

              }



              .gallery-nav .zoom.zoom-out svg.zoom-icon-zoom-out {

                display: block;

              }



              .gallery-nav .fullscreen.leavefs svg.fs-icon {

                display: none;

              }



              .gallery-nav .fullscreen svg.fs-icon-exit {

                display: none;

              }



              .gallery-nav .fullscreen.leavefs svg.fs-icon-exit {

                display: block;

              }



              .gallery-nav .swiper-pagination {

                position: static;

                float: left;

                width: auto;

                line-height: 24px;

              }

              

.product-photo-main .swiper-button-next,

.product-photo-main .swiper-button-prev {

    bottom: 5%;

    top:inherit;



}

              

div#Arrow-style {

    background: none;

    height: max-content;

    width: max-content;

    background-color: #fff;

    color: #007a3d;

    padding: 0px 10px;

    padding-bottom: 4px;

    border-radius: 50px;

    font-size: 30px;

}

@media(max-width:767px){
  .first-heading {
    color: #007a3d;
    text-transform: uppercase;
    font-size: 0.6rem;
    line-height: 2rem;
    font-weight: 700;
    font-family: Montserrat,sans-serif;
}

.parent {
    flex-direction: column;
    padding-left: 0px;
}

.for-product-dis, .for-product-form {
    width: 100%;
}

}


.product-photo-main .swiper-button-next {

    transform: rotate(90deg);

}



.product-photo-main .swiper-button-prev {

    transform: rotate(270deg);

}



            </style>



            <div class="main">

              <div class="main">

                <div class="container">

                  <div class="product-gallery">

                    <div class="product-photo-main">

                      <div class="swiper-container">

                      
 <div class="fendt-heading">



          <h1>

             <?php echo "$naam"; ?>

            </h1>



        </div>



                        <div class="swiper-wrapper">



                        <?php


$url_path = ABSPATH.'/_occasions/images/'.$art_code.'/';
$handle = opendir($url_path);
if (!empty($handle)) {
  $files = array();
  while($file = readdir($handle)){
    if($file !== '.' && $file !== '..'){
      $files[] = $file;
    }
  }
  closedir($handle);

  // Reverse the order of the files.
  $files = array_reverse($files);

  // Find the index of the `2.gif` file.
  $art_code_file=$art_code . '_' . '001.jpg';
  
  $index = array_search($art_code_file, $files);

  // Move the `2.gif` file to the first element of the array.
  if ($index !== false) {
    $temp = $files[0];
    $files[0] = $files[$index];
    $files[$index] = $temp;
  }
  natsort($files);

  // Display the files.
  foreach ($files as $file) {
    $full_img=site_url().'/_occasions/images/'.$art_code.'/'.$file;
   ?>
 <div class="swiper-slide">
<div class="swiper-zoom-container">
<img   src="<?php echo $full_img; ?>">
</div>
</div>

   <?php
  }
}else{

 $full_img=site_url().'/wp-content/uploads/image1.png';

   echo '<img src="'.$full_img.'">';

}




?>

 </div>
<div id="Arrow-style" class="swiper-button-next swiper-button-white">

                            ▲

                        </div>

                        <div id="Arrow-style" class="swiper-button-prev swiper-button-white">

                          ▲

                        </div>

                        <div class="swiper-pagination"></div>

                      </div>

                    </div>

                    <div class="product-photos-side">

                      <div class="swiper-container">

                        <div class="swiper-wrapper">





  <?php
$url_path = ABSPATH.'/_occasions/images/'.$art_code.'/';
$handle = opendir($url_path);
if (!empty($handle)) {
  $files = array();
  while($file = readdir($handle)){
    if($file !== '.' && $file !== '..'){
      $files[] = $file;
    }
  }
  closedir($handle);

  // Reverse the order of the files.
  $files = array_reverse($files);

  // Find the index of the `2.gif` file.
  $art_code_file=$art_code . '_' . '001.jpg';
  
  $index = array_search($art_code_file, $files);

  // Move the `2.gif` file to the first element of the array.
  if ($index !== false) {
    $temp = $files[0];
    $files[0] = $files[$index];
    $files[$index] = $temp;
  }
  natsort($files);
  // Display the files.
  foreach ($files as $file) {
    $full_img=site_url().'/_occasions/images/'.$art_code.'/'.$file;
   ?>
 <div class="swiper-slide">
<div class="swiper-zoom-container">
<img src="<?php echo $full_img; ?>">
</div>
</div>


   <?php
  }
}


?>


                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

              <div id="fullImage" class="product-gallery-full-screen">

                <div class="swiper-container gallery-top">

                  <div class="swiper-wrapper">





                  <?php




$url_path = ABSPATH.'/_occasions/images/'.$art_code.'/';
$handle = opendir($url_path);
if (!empty($handle)) {
  $files = array();
  while($file = readdir($handle)){
    if($file !== '.' && $file !== '..'){
      $files[] = $file;
    }
  }
  closedir($handle);

  // Reverse the order of the files.
  $files = array_reverse($files);

  // Find the index of the `2.gif` file.
  $art_code_file=$art_code . '_' . '001.jpg';
  
  $index = array_search($art_code_file, $files);

  // Move the `2.gif` file to the first element of the array.
  if ($index !== false) {
    $temp = $files[0];
    $files[0] = $files[$index];
    $files[$index] = $temp;
  }
  natsort($files);
  // Display the files.
  foreach ($files as $file) {
    $full_img=site_url().'/_occasions/images/'.$art_code.'/'.$file;
   ?>
<div class="swiper-slide">
<div class="swiper-zoom-container">
<img src="<?php echo $full_img; ?>" draggable="false" ondragstart="return false;">
</div>
</div>

   <?php
  }
}else{

 $full_img=site_url().'/wp-content/uploads/image1.png';

   echo '<img src="'.$full_img.'">';

}



?>









                  </div>

                  <div class="swiper-button-next swiper-button-white">

                    <svg fill="#FFFFFF" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                      <path d="M0 0h24v24H0z" fill="none" />

                      <path d="M12 4l-1.41 1.41L16.17 11H4v2h12.17l-5.58 5.59L12 20l8-8z" />

                    </svg>

                  </div>

                  <div class="swiper-button-prev swiper-button-white">

                    <svg fill="#FFFFFF" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                      <path d="M0 0h24v24H0z" fill="none" />

                      <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />

                    </svg>

                  </div>

                  <div class="gallery-nav">

                    <div class="swiper-pagination"></div>

                    <ul class="gallery-menu">

                      <li class="zoom">

                        <svg class="zoom-icon-zoom-in" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                          <path

                            d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />

                          <path d="M0 0h24v24H0V0z" fill="none" />

                          <path d="M12 10h-2v2H9v-2H7V9h2V7h1v2h2v1z" />

                        </svg>

                        <svg class="zoom-icon-zoom-out" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                          <path d="M0 0h24v24H0V0z" fill="none" />

                          <path

                            d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14zM7 9h5v1H7z" />

                        </svg>

                      </li>

                      <li class="fullscreen">

                        <svg class="fs-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                          <path d="M0 0h24v24H0z" fill="none" />

                          <path d="M7 14H5v5h5v-2H7v-3zm-2-4h2V7h3V5H5v5zm12 7h-3v2h5v-5h-2v3zM14 5v2h3v3h2V5h-5z" />

                        </svg>

                        <svg class="fs-icon-exit" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                          <path d="M0 0h24v24H0z" fill="none" />

                          <path d="M5 16h3v3h2v-5H5v2zm3-8H5v2h5V5H8v3zm6 11h2v-3h3v-2h-5v5zm2-11V5h-2v5h5V8h-3z" />

                        </svg>

                      </li>

                      <li class="close">

                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                          <path

                            d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />

                          <path d="M0 0h24v24H0z" fill="none" />

                        </svg>

                      </li>

                    </ul>

                  </div>

                </div>

              </div>

            </div>



            <div>
  
  <p class="categorie-text">

    <?php echo "$categorie"; ?>

  </p>
</div>


<div>
  
        <p class="artikecode-text"><span>ARTIKELCODE</span>

          <?php echo "$art_code"; ?>

        </p>
</div>
 <div class="fendt-heading">





            <p>

              <?php echo "$beschrijving"; ?>

            </p>



        </div>
<?php
$naam = get_post_meta($product_id, 'naam', true);
$beschrijving = get_post_meta($product_id, 'beschrijving', true);
$art_code = get_post_meta($product_id, 'art_code', true);
$prijsexcl = get_post_meta($product_id, 'prijsexcl', true);
$bouwjaar = get_post_meta($product_id, 'bouwjaar', true);
$bandenvoor = get_post_meta($product_id, 'bandenvoor', true);
$bandenachter = get_post_meta($product_id, 'bandenachter', true);
$conditiemotor = get_post_meta($product_id, 'conditiemotor', true);
$conditietransmissie = get_post_meta($product_id, 'conditietransmissie', true);
$conditieslijtdelen = get_post_meta($product_id, 'conditieslijtdelen', true);
$uiterlijk = get_post_meta($product_id, 'uiterlijk', true);
$conditiehef = get_post_meta($product_id, 'conditiehef', true);
$merk = get_post_meta($product_id, 'merk', true);
$draaiuren = get_post_meta($product_id, 'draaiuren', true);
$cabine = get_post_meta($product_id, 'cabine', true);
$rijsnelheidmax = get_post_meta($product_id, 'rijsnelheidmax', true);
$werkbreedte = get_post_meta($product_id, 'werkbreedte', true);
$inhoud = get_post_meta($product_id, 'inhoud', true);
$elementen = get_post_meta($product_id, 'elementen', true);
$werkhoogte = get_post_meta($product_id, 'werkhoogte', true);
$vooras = get_post_meta($product_id, 'vooras', true);
$aftakas = get_post_meta($product_id, 'aftakas', true);
$aanhangerrem = get_post_meta($product_id, 'aanhangerrem', true);
$rijsnelheidmin = get_post_meta($product_id, 'rijsnelheidmin', true);
$hydraulischeventielen = get_post_meta($product_id, 'hydraulischeventielen', true);
$hefinrichtingachter = get_post_meta($product_id, 'hefinrichtingachter', true);
$hefinrichtingvoor = get_post_meta($product_id, 'hefinrichtingvoor', true);
$pk = get_post_meta($product_id, 'pk', true);
$ag_code = get_post_meta($product_id, 'ag_code', true);


$contact_filiaal = get_post_meta($product_id, 'contact_filiaal', true);
$contact_persoon = get_post_meta($product_id, 'contact_persoon', true);
$contact_mobiel = get_post_meta($product_id, 'contact_mobiel', true);
$contact_telefoon = get_post_meta($product_id, 'contact_telefoon', true);


if (trim($prijsexcl)) {
  $prijsexcl = str_replace(',', '', $prijsexcl); 

  $number_format=   number_format($prijsexcl, 2, ',', '.');

if ($prijsexcl=="0.00") {
 
                  
 $prijsexcl_inner = '<tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">PRIJS</td> 



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;"> Op aanvraag</td></tr>';
}else{
   $prijsexcl_inner = '<tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">PRIJS</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">€' . $number_format . '</td></tr>' ;
}

}

// if (trim($beschrijving)){
//   $beschrijving_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;">'.$beschrijving.'</tr>';
// }
if (trim($bouwjaar)){
  $bouwjaar_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">BOUWJAAR</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $bouwjaar . '</td></tr>';
}
if (trim($bandenvoor)) {
  $bandenvoor_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">BANDEN VOOR</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $bandenvoor . '</td></tr>';
}

if (trim($bandenachter)) {
  $bandenachter_inner=' <tr  style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">BANDEN ACHTER</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $bandenachter . '</td></tr>';
}
if (trim($conditiemotor)){
  $conditiemotor_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">CONDITIE MOTOR</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $conditiemotor . '</td></tr>';
}
if (trim($conditietransmissie)){
  $conditietransmissie_inner=' <tr  style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">CONDITIETRANSMISSIE</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $conditietransmissie . '</td></tr>';
}
if (trim($uiterlijk)){
  $uiterlijk_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">UITERLIJK</td>



                       <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $uiterlijk . '</td></tr>';
}
if (trim($conditiehef)){
  $conditiehef_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">CONDITIE HEF</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $conditiehef . '</td></tr>';
}
if (trim($merk)){
  $merk_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">MERK</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $merk . '</td></tr>';
}
if (trim($draaiuren)){
  $draaiuren_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">DRAAIUREN</td>



                       <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;">' . $draaiuren . '</td></tr>';
}
if (trim($cabine)){
  $cabine_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">CABINE</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $cabine . '</td></tr>';
}
if (trim($rijsnelheidmax)){
  $rijsnelheidmax_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">RIJSNELHEIDMAX</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $rijsnelheidmax . '</td></tr>';
}
if (trim($werkbreedte)){
  if ($werkbreedte!="0.00") {
  $werkbreedte_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">Werkbreedte</td>



                       <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $werkbreedte . '</td></tr>';
}
}

if (trim($inhoud)){
  $inhoud_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">INHOUD</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $inhoud . '</td></tr>';
}



if (trim($elementen)) {

if ($elementen!="0.00") {
 $elementen_inner = '<tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">ELEMENTEN</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $elementen . '</td></tr>';
}

}





if (trim($werkhoogte)){
  $werkhoogte_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">Werkhoogte</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $werkhoogte . '</td></tr>';
}
if (trim($vooras)){
  $vooras_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">VOORAS</td>



                       <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $vooras . '</td></tr>';
}
if (trim($aftakas)){
  $aftakas_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">AFTAKAS</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $aftakas . '</td></tr>';
}
if (trim($aanhangerrem)){
  $aanhangerrem_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family:Montserrat,sans-serif;font-size: 14px;font-weight: 700;">AANHANGERREM</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $aanhangerrem . '</td></tr>';
}

if (trim($rijsnelheidmin)){
  $rijsnelheidmin_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">RIJSNELHEIDMIN</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $rijsnelheidmin . '</td></tr>';
}
if (trim($hydraulischeventielen)){
  $hydraulischeventielen_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">HYDRALISCHEVNTILEN</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $hydraulischeventielen . '</td></tr>';
}
if (trim($hefinrichtingachter)){
  $hefinrichtingachter_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">HEFINRICHTINGACHTER</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $hefinrichtingachter . '</td></tr>';
}
if (trim($hefinrichtingvoor)){
  $hefinrichtingvoor_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">HEFINRICHTINGVOOR</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;text-align: right;">' . $hefinrichtingvoor . '</td></tr>';
}
if (trim($pk)){
  $pk_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">PK</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $pk . '</td></tr>';
}
if (trim($mtekst)){
  $mtekst_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">Mtekst</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $mtekst . '</td></tr>';
}
if (trim($ag_code)){
  $ag_code_inner=' <tr style="line-height: 27px;width: 40%;display: flex !important;flex-direction: row;justify-content: space-between;"><td style="display: table;color:#007a3d;font-family: Montserrat,sans-serif;font-size: 14px;font-weight: 700;">AG CODE</td>



                        <td style="display: table;font-family: Montserrat,sans-serif;font-size: 14px;color: #666;
    -webkit-font-smoothing: antialiased;padding-left: 82px;text-align: right;">' . $ag_code . '</td></tr>';
}




?>

<table  style="width: 100%;margin: 0 auto;" class="first">

  <tbody style="display: flex;flex-wrap: wrap;column-gap: 100px;row-gap: 20px;">



                    <?php echo "$prijsexcl_inner"; ?>

                 

                    <?php echo "$bouwjaar_inner"; ?> 

                    <?php echo "$bandenvoor_inner"; ?>

                    <?php echo "$bandenachter_inner"; ?>       

                    <?php echo "$conditiemotor_inner"; ?>

                    <?php echo "$conditietransmissie_inner";?>                  

                    <?php echo "$uiterlijk_inner"; ?>                      

                    <?php echo "$conditiehef_inner"; ?>

                    <?php echo "$merk_inner"; ?>

                    <?php echo "$draaiuren_inner"; ?> 

                    <?php echo "$cabine_inner"; ?>

                    <?php echo "$rijsnelheidmax_inner"; ?>

                    <?php echo "$werkbreedte_inner"; ?>

                    <?php echo "$inhoud_inner"; ?>

                    <?php echo "$elementen_inner"; ?>

                    <?php echo "$werkhoogte_inner"; ?>

                    <?php echo "$vooras_inner"; ?>

                    <?php echo "$aftakas_inner"; ?>

                    <?php echo "$aanhangerrem_inner"; ?>

                    <?php echo "$rijsnelheidmin_inner"; ?>

                    <?php echo "$hydraulischeventielen_inner"; ?>

                    <?php echo "$hefinrichtingachter_inner"; ?>

                    <?php echo "$hefinrichtingvoor_inner"; ?>

                    <?php echo "$pk_inner"; ?>

                     <?php echo "$mtekst_inner"; ?>

                     <?php echo "$ag_code_inner"; ?>


                    </tbody>                               



                </table>
<!-- button start -->

<div>

        <button class="print-pdf"><a href="<?php echo $pdfUrl; ?>" target="_blank">PRINT PDF</button></a>

</div>

        <!-- button close -->
  









     


            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.0/js/swiper.min.js"></script>



            <script>

              $(document).ready(function () {

                // --- VARIABLES ---

                var swiperSide = new Swiper('.product-photos-side .swiper-container', {

                  direction: 'horizontal',

                  centeredSlides: true,

                  spaceBetween: 10,

                  slidesPerView: 'auto',

                  touchRatio: 0.2,

                  slideToClickedSlide: true,

                  nextButton: '.swiper-button-next',

                  prevButton: '.swiper-button-prev',

                })

                var swiperProduct = new Swiper('.product-photo-main .swiper-container', {

                  direction: 'horizontal',

                  pagination: '.swiper-pagination',

                  paginationClickable: true,

                  // keyboardControl: true,

                })

                var galleryTop = new Swiper('.product-gallery-full-screen .gallery-top', {

                  nextButton: '.swiper-button-next',

                  prevButton: '.swiper-button-prev',

                  pagination: '.swiper-pagination',

                  paginationType: 'fraction',

                  spaceBetween: 5,

                  keyboardControl: true,

                  noSwiping: true,

                  zoom: true,

                })

                swiperSide.params.control = swiperProduct || galleryTop;

                swiperProduct.params.control = swiperSide || galleryTop;

                galleryTop.params.control = swiperProduct || swiperSide;



                var galleryOpen = false,

                  fullscreen = false,

                  fsTrigger = $('.gallery-nav .fullscreen')[0],

                  fsGallery = $('.product-gallery-full-screen')[0],

                  fsFunction = fsGallery.requestFullscreen;

                // browser support check

                if (!fsFunction) {

                  ['webkitRequestFullScreen',

                    'mozRequestFullscreen',

                    'msRequestFullScreen'

                  ].forEach(function (req) {

                    fsFunction = fsFunction || fsGallery[req];

                  });

                }



                // --- FUNCTIONS ---

                function openImageGallery(slide) {

                  galleryOpen = true;

                  var galleryX = $('.product-photo-main').offset().left,

                    galleryY = $('.product-photo-main').offset().top,

                    galleryHeight = $('.product-photo-main').height(),

                    galleryWidth = $('.product-photo-main').width(),

                    activeIndex = slide.index(),

                    indexes = $('.product-photo-main').find('.swiper-slide').length;

                  $('body').css('overflow', 'hidden');

                  $('.main, .product-gallery-full-screen').css('overflow-y', 'scroll');

                  $('.product-gallery-full-screen').addClass('opened');

                  galleryTop.activeIndex = activeIndex;

                  galleryTop.onResize();

                }



                function goFs() {

                  fullscreen = true;

                  $('.product-gallery-full-screen').css('overflow-y', 'auto');

                  $('.fullscreen').addClass('leavefs');

                  fsFunction.call(fsGallery);

                }



                function leaveFs() {

                  fullscreen = false;

                  $('.product-gallery-full-screen').css('overflow-y', 'scroll');

                  $('.fullscreen').removeClass('leavefs');

                  if (document.exitFullscreen) {

                    document.exitFullscreen();

                  } else if (document.mozCancelFullScreen) {

                    document.mozCancelFullScreen();

                  } else if (document.webkitExitFullscreen) {

                    document.webkitExitFullscreen();

                  }

                }



                function closeImageGallery() {

                  // if(zoomed) {

                  //   zoom($('.product-gallery-full-screen .swiper-slide-active img'));

                  // }

                  $('body').css('overflow', 'auto');

                  $('.main, .product-gallery-full-screen').css('overflow-y', 'auto');

                  galleryOpen = false;

                  leaveFs();

                  $('.product-gallery-full-screen').removeClass('opened');

                }



                // --- EVENTS ---

                // open the large image gallery

                $('.product-photo-main .swiper-slide').on('click touch', function () {

                  var slide = $(this);

                  openImageGallery(slide);

                });

                // close the large image gallery

                $('.gallery-nav .close').on('click touch', function () {

                  closeImageGallery();

                });

                // zoom in / out

                $('.zoom').on('click touch', function () {

                  // zoom

                });

                // fullscreen toggle

                $(fsTrigger).on('click touch', function () {

                  if (fullscreen) {

                    leaveFs();

                  } else {

                    goFs();

                  }

                });


                $(window).on('resize', function () {

                  galleryTop.onResize();

                  swiperSide.onResize();

                  swiperProduct.onResize();

                });

              });

            </script>

          </div>
         
<div class="parent">

<div class="for-product-dis">

<div class="w3-container w3-teal">
  <h1 class="first-heading">IS DEZE OCCASION NOG BESCHIKBAAR?</h1>

             <?php


  if($contact_filiaal) {

                ?>

  <h2 class="second-heading"><?php echo "$contact_filiaal"; ?></h2>
</div>
<?php } ?>

<ul class="Contactpersoon">
    <?php
 if ($contact_persoon) {
?>
  <li>Contactpersoon: <?php echo "$contact_persoon"; ?></li>

<?php } ?>


<?php

 if ($contact_mobiel) {

                ?>
  <li>Mob: <?php echo "$contact_mobiel"; ?></li>

    <?php } ?>


</ul>

<h1 class="first-heading">ABEMEC OCCASIONCENTRUM VEGHEL</h1>

<ul class="Contactpersoon">
<!--   <li>Geert Heesakkers</li>
  <li>M +31(0)654 757 021</li> -->
  <li><a href="tel:+31413382185">+31(0)413-382 185</a></li>
  <li><a href="mailto:occasions@abemec.nl">occasions@abemec.nl</a></li>
</ul>

</div>
<?php
if (isset($_POST['submit'])) {
 

$fullname = $_POST['fullname'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$fullmessage = $_POST['fullmessage'];


$fullsubject=$art_code.' '.$naam;

$to = 'occasions@abemec.nl';

$subject = $fullsubject;
$body = '
<table>

<tr>
<td>Naam:</td>
<td>'.$fullname.'</td>
</tr>

<tr>
<td>Telefoon:</td>
<td>'.$telephone.'</td>
</tr>


<tr>
<td>E-mailadres:</td>
<td>'.$email.'</td>
</tr>

<tr>
<td>Message:</td>
<td>'.$fullmessage.'</td>
</tr>

</table>



';
$headers = array('Content-Type: text/html; charset=UTF-8');

wp_mail( $to, $fullsubject, $body, $headers );

}

//die('hamza123');
?>
<div class="for-product-form">
  <div class="inner-pro-form">
    <h1 class="first-heading">NEEM CONTACT OP</h1>
   

   <form action="<?php site_url() ?>/inner-page/?product_id=<?php echo $product_id; ?>" method="post">
     

<div class="parent-top-feilds">
  <div class="flexy-pr"><input type="text" name="fullname" id="fullname" placeholder="Naam *" required></div>
   <div class="flexy-pr"><input type="tel" name="telephone" id="telephone" placeholder="Telefoon *" required></div>
</div>

<div class="input-cr7t-feilds">
  <div class="flexy-pr"><input type="email" name="email" id="email" placeholder="E-mailadres *" required></div>
</div>

<div class="textarea-divs"><textarea id="fullmessage" name="fullmessage" rows="4" cols="50"></textarea></div>
 <div class="button-sbmt"><input type="submit" name="submit" value="Verzend"></div>

   </form>
   

  </div>
  
</div>

</div>


        </div>
      </div>

    </div>

  </div>


<script type="text/javascript">
//  document.getElementById('back_button').addEventListener('click', function() {
//   // Go back to the previous page in history
//  window.history.go(-1);
// });
document.getElementById('back_button').addEventListener('click', function() {
  // Prevent the browser from refreshing the page.
  event.preventDefault();

  // Navigate back to the previous page.
  history.back();
});
</script>

<script>
    // Get the reference to the image element
    var fullImage = document.getElementById('fullImage');

    // Add event listener for the "keydown" event on the document
    document.addEventListener('keydown', function(event) {
        // Check if the pressed key is the "Esc" key (key code 27)
        if (event.keyCode === 27) {
            // Hide the image
            // fullImage.style.display = 'none';
            $('body').css('overflow', 'auto');

            $('.main, .product-gallery-full-screen').css('overflow-y', 'auto');

            $('.product-gallery-full-screen').removeClass('opened');
        }
    });
</script>
</body>

</html>


<?php 

//wp_footer();
get_footer();

?>
