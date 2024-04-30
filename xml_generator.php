
<?php

 /* Template Name: Xml Generator */

 require_once ABSPATH . '/wp-admin/includes/post.php';

$xml = new SimpleXMLElement('<data></data>');
$devices = $xml->addChild('devices');


global $wp_query;
           $args = array(
            "posts_per_page" => -1,

            "post_type" => "machine",

            "post_status" => "publish",

            "orderby" => "title",

            "order" => "ASC"
           );
           
$the_query = new WP_Query($args);
if ($the_query->have_posts()) {
while ($the_query->have_posts()) {
$the_query->the_post();
$post_id = get_the_ID();


$naam = get_post_meta($post_id, 'naam', true);
$categorie = get_post_meta($post_id, 'categorie', true);
$beschrijving = get_post_meta($post_id, 'beschrijving', true);
$art_code = get_post_meta($post_id, 'art_code', true);
$prijsexcl = get_post_meta($post_id, 'prijsexcl', true);
$bouwjaar = get_post_meta($post_id, 'bouwjaar', true);
$bandenvoor = get_post_meta($post_id, 'bandenvoor', true);
$bandenachter = get_post_meta($post_id, 'bandenachter', true);
$conditiemotor = get_post_meta($post_id, 'conditiemotor', true);
$conditietransmissie = get_post_meta($post_id, 'conditietransmissie', true);
$conditieslijtdelen = get_post_meta($post_id, 'conditieslijtdelen', true);
$uiterlijk = get_post_meta($post_id, 'uiterlijk', true);
$conditiehef = get_post_meta($post_id, 'conditiehef', true);
$merk = get_post_meta($post_id, 'merk', true);
$draaiuren = get_post_meta($post_id, 'draaiuren', true);
$cabine = get_post_meta($post_id, 'cabine', true);
$rijsnelheidmax = get_post_meta($post_id, 'rijsnelheidmax', true);
$werkbreedte = get_post_meta($post_id, 'werkbreedte', true);
$inhoud = get_post_meta($post_id, 'inhoud', true);
$elementen = get_post_meta($post_id, 'elementen', true);
$werkhoogte = get_post_meta($post_id, 'werkhoogte', true);
$vooras = get_post_meta($post_id, 'vooras', true);
$aftakas = get_post_meta($post_id, 'aftakas', true);
$aanhangerrem = get_post_meta($post_id, 'aanhangerrem', true);
$rijsnelheidmin = get_post_meta($post_id, 'rijsnelheidmin', true);
$hydraulischeventielen = get_post_meta($post_id, 'hydraulischeventielen', true);
$hefinrichtingachter = get_post_meta($post_id, 'hefinrichtingachter', true);
$hefinrichtingvoor = get_post_meta($post_id, 'hefinrichtingvoor', true);
$pk = get_post_meta($post_id, 'pk', true);
$contact_filiaal = get_post_meta($post_id, 'contact_filiaal', true);
$contact_persoon = get_post_meta($post_id, 'contact_persoon', true);
$contact_mobiel = get_post_meta($post_id, 'contact_mobiel', true);
$contact_telefoon = get_post_meta($post_id, 'contact_telefoon', true);
$ag_code = get_post_meta($post_id, 'ag_code', true);
$btw_marge = get_post_meta($post_id, 'btw_marge', true);
$nieuw = get_post_meta($post_id, 'nieuw', true);
$lastChangeDate = get_post_meta($post_id, 'lastChangeDate', true);
$top = get_post_meta($post_id, 'top', true);
$mtekst = get_post_meta($post_id, 'mtekst', true);
$prijs_op_aanvraag = get_post_meta($post_id, 'prijs_op_aanvraag', true);
$laadvermogen = get_post_meta($post_id, 'laadvermogen', true);
$werkdiepte = get_post_meta($post_id, 'werkdiepte', true);
$tanden = get_post_meta($post_id, 'tanden', true);
$gpssysteem = get_post_meta($post_id, 'gpssysteem', true);
$gereserveerd = get_post_meta($post_id, 'gereserveerd', true);

$base_url = site_url()."/inner-page/";
$article_url = $base_url . '?product_id=' . $post_id;




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

  
  $files = array_reverse($files);

  
  $art_code_file=$art_code . '_' . '001.jpg';
  
  $index = array_search($art_code_file, $files);

 
  if ($index !== false) {
    $temp = $files[0];
    $files[0] = $files[$index];
    $files[$index] = $temp;
  }

  $filearray = "";
  foreach ($files as $file) {
      $filearray .= home_url('/_occasions/images/' . $art_code . '/' . $file) . ' | ';
  }
  
  $filearray = rtrim($filearray, '| ');
}



 


$device = $devices->addChild('device');
$device->addChild('art_code', "$art_code");
$device->addChild('naam', "$naam");
$device->addChild('ag_code', "$ag_code");
$device->addChild('beschrijving',"$beschrijving");
$device->addChild('categorie', "$categorie");
$device->addChild('btw_marge', "$btw_marge");
$device->addChild('nieuw', "$nieuw");
$device->addChild('contact_persoon', "$contact_persoon");
$device->addChild('contact_mobiel', "$contact_mobiel");
$device->addChild('draaiuren', "$draaiuren");
$device->addChild('bandenachter', "$bandenachter");
$device->addChild('cabine', "$cabine");
$device->addChild('conditiemotor', "$conditiemotor");
$device->addChild('conditietransmissie',"$conditietransmissie");
$device->addChild('uiterlijk',"$uiterlijk");
$device->addChild('conditiehef', "$conditiehef");
$device->addChild('hefinrichtingachter', "$hefinrichtingachter");
$device->addChild('aftakas', "$aftakas");
$device->addChild('hydraulischeventielen', "$hydraulischeventielen");
$device->addChild('lastChangeDate', "$lastChangeDate");
$device->addChild('merk', "$merk");
$device->addChild('top', "$top");
$device->addChild('prijs', "$prijsexcl");
$device->addChild('bouwjaar', "$bouwjaar"); 
$device->addChild('bandenvoor', "$bandenvoor");
$device->addChild('conditieslijtdelen', "$conditieslijtdelen");
$device->addChild('rijsnelheidmax', "$rijsnelheidmax");
$device->addChild('werkbreedte', "$werkbreedte");
$device->addChild('inhoud', "$inhoud");
$device->addChild('elementen', "$elementen");
$device->addChild('werkhoogte', "$werkhoogte");
$device->addChild('vooras', "$vooras");
$device->addChild('aanhangerrem', "$aanhangerrem");
$device->addChild('rijsnelheidmin', "$rijsnelheidmin");
$device->addChild('hefinrichtingvoor', "$hefinrichtingvoor");
$device->addChild('pk', "$pk");
$device->addChild('contact_filiaal', "$contact_filiaal");
$device->addChild('contact_telefoon', "$contact_telefoon");
$device->addChild('mtekst', "$mtekst");
$device->addChild('prijs_op_aanvraag', "$prijs_op_aanvraag");
$device->addChild('laadvermogen', "$laadvermogen");
$device->addChild('werkdiepte', "$werkdiepte");
$device->addChild('tanden', "$tanden");
$device->addChild('gpssysteem', "$gpssysteem");
$device->addChild('gereserveerd', "$gereserveerd");
 

$device->addChild('IMG', "$filearray");
$device->addChild('article_url', "$article_url");


 }


}

      




$xml->asXML('data.xml');
?>