<?php

die("Not Allowed manual");

require_once ABSPATH . '/wp-admin/includes/post.php';

/* Template Name: XML */


$post_type_to_delete = 'machine';
global $wpdb;
$sql = $wpdb->prepare("DELETE FROM {$wpdb->posts} WHERE post_type = %s", $post_type_to_delete);
$wpdb->query($sql);
$xml_url= get_field('xml_url', 'option');
$xmldata = simplexml_load_file($xml_url) or die("Failed to load");
$total_nodes = count($xmldata->devices->device);
$nodes_processed =0;

foreach($xmldata->devices->device as $empl_new) { 
   
    $art_code= $empl_new->art_code;   
    $naam=$empl_new->naam;    
    $ag_code=$empl_new->ag_code;
    $beschrijving= $empl_new->beschrijving;
    $categorie=  $empl_new->categorie; 
    $prijsexcl= $empl_new->prijsexcl;
    $btw_marge= $empl_new->btw_marge;
    $bouwjaar= $empl_new->bouwjaar;
    $tanden= $empl_new->tanden;
    $nieuw= $empl_new->nieuw; 
    $contact_persoon= $empl_new->contact_persoon; 
    $contact_mobiel= $empl_new->contact_mobiel;
    $conditieslijtdelen= $empl_new->conditieslijtdelen; 
    $uiterlijk= $empl_new->uiterlijk;
    $elementen= $empl_new->elementen;
    $lastChangeDate= $empl_new->lastChangeDate; 
    $merk= $empl_new->merk;
    $top=  $empl_new->top; 
    $draaiuren=  $empl_new->draaiuren; 
    $bandenvoor=  $empl_new->bandenvoor;
    $bandenachter=  $empl_new->bandenachter;
    $conditiemotor=  $empl_new->conditiemotor;
    $conditietransmissie=  $empl_new->conditietransmissie;
    $gereserveerd_tot=  $empl_new->gereserveerd_tot;
    $contact_filiaal=  $empl_new->contact_filiaal;
    $contact_telefoon=  $empl_new->contact_telefoon;
    $contact_telefoon=  $empl_new->contact_telefoon;
    $cabine=  $empl_new->cabine;
    $conditiehef=  $empl_new->conditiehef;
    $vooras=  $empl_new->vooras;
    $hefinrichtingachter=  $empl_new->hefinrichtingachter;
    $aftakas=  $empl_new->aftakas;
    $hydraulischeventielen=  $empl_new->hydraulischeventielen;
    $aanhangerrem=  $empl_new->aanhangerrem;
    $pk=  $empl_new->pk;
    $inhoud=  $empl_new->inhoud;
    $laadvermogen=  $empl_new->laadvermogen;
    $rijsnelheidmin=  $empl_new->rijsnelheidmin;
    $rijsnelheidmax=  $empl_new->rijsnelheidmax;
    $werkbreedte=  $empl_new->werkbreedte;
    $werkhoogte=  $empl_new->werkhoogte;
    $hefinrichtingvoor=  $empl_new->hefinrichtingvoor;
    $prijs_op_aanvraag=  $empl_new->prijs_op_aanvraag;
    $mtekst=  $empl_new->mtekst;
    $directory= ABSPATH.'IMG/'.$art_code; 
    $parent_category = get_term_by( 'name', $categorie, 'category' );
if ( $parent_category ) {

  $parent_category_id = $parent_category->term_id;

} 
$my_post = array(

  'post_title'    => (string)$naam,

  'post_content'  => '',

  'post_status'   => 'publish',

  'post_type'     => 'machine',

  'post_category' => array($parent_category_id),

  

);

 $post_id = wp_insert_post( $my_post );

if($art_code){

    update_post_meta( $post_id, 'art_code',(string)$art_code );

}


if($naam){

    update_post_meta( $post_id, 'naam',(string)$naam );

}

 if($ag_code){

    update_post_meta( $post_id, 'ag_code',(string)$ag_code );

}

if($beschrijving){

    update_post_meta( $post_id, 'beschrijving',(string) $beschrijving );

}

if($categorie){

    update_post_meta( $post_id, 'categorie',(string) $categorie );

}

if($prijsexcl){

    update_post_meta( $post_id, 'prijsexcl',(string) $prijsexcl );

}

if($btw_marge){

    update_post_meta( $post_id, 'btw_marge',(string)$btw_marge );

}

if($bouwjaar){

    update_post_meta( $post_id, 'bouwjaar',(string)$bouwjaar );

}

if($tanden){

    update_post_meta( $post_id, 'tanden',(string)$tanden );

}

if($nieuw){

    update_post_meta( $post_id, 'nieuw',(string)$nieuw );

}

if($contact_persoon){

    update_post_meta( $post_id, 'contact_persoon',(string)$contact_persoon );

}


if($contact_mobiel){

    update_post_meta( $post_id, 'contact_mobiel',(string)$contact_mobiel );

}

if($conditieslijtdelen){

    update_post_meta( $post_id, 'conditieslijtdelen',(string)$conditieslijtdelen );

}


if($uiterlijk){

    update_post_meta( $post_id, 'uiterlijk',(string)$uiterlijk );

}


if($elementen){

    update_post_meta( $post_id, 'elementen',(string)$elementen );

}

if($lastChangeDate){

    update_post_meta( $post_id, 'lastChangeDate',(string)$lastChangeDate );

}

if($merk){

    update_post_meta( $post_id, 'merk',(string)$merk );

}


if($top){

    update_post_meta( $post_id, 'top',(string)$top );

}

if($draaiuren){

    update_post_meta( $post_id, 'draaiuren',(string)$draaiuren );

}

if($bandenvoor){

    update_post_meta( $post_id, 'bandenvoor',(string)$bandenvoor );

}

if($bandenachter){

    update_post_meta( $post_id, 'bandenachter',(string)$bandenachter );

}

if($conditiemotor){

    update_post_meta( $post_id, 'conditiemotor',(string)$conditiemotor );

}
if($conditietransmissie){

    update_post_meta( $post_id, 'conditietransmissie',(string)$conditietransmissie );

}

if($gereserveerd_tot){

    update_post_meta( $post_id, 'gereserveerd_tot',(string)$gereserveerd_tot );

}

if(trim($contact_filiaal)){

    update_post_meta( $post_id, 'contact_filiaal',(string)$contact_filiaal );
    global $wpdb;

$meta_key = 'contact_filiaal';

$wpdb->query(
    $wpdb->prepare(
        "
        UPDATE $wpdb->postmeta
        SET meta_value = TRIM(REGEXP_REPLACE(meta_value, '\\\\s+', ' '))
        WHERE meta_key = %s
        ",
        $meta_key
    )
);
}

if($contact_telefoon){

    update_post_meta( $post_id, 'contact_telefoon',(string)$contact_telefoon );

}

if($cabine){

    update_post_meta( $post_id, 'cabine',(string)$cabine );

}

if($conditiehef){

    update_post_meta( $post_id, 'conditiehef',(string)$conditiehef );

}

if($vooras){

    update_post_meta( $post_id, 'vooras',(string)$vooras );

}

if($hefinrichtingachter){

    update_post_meta( $post_id, 'hefinrichtingachter',(string)$hefinrichtingachter);

}

if($aftakas){

    update_post_meta( $post_id, 'aftakas',(string)$aftakas );

}

if($hydraulischeventielen){

    update_post_meta( $post_id, 'hydraulischeventielen',(string)$hydraulischeventielen);

}

if($aanhangerrem){

    update_post_meta( $post_id, 'aanhangerrem',(string)$aanhangerrem );

}

if($pk){

    update_post_meta( $post_id, 'pk',(string)$pk );

}

if($inhoud){

    update_post_meta( $post_id, 'inhoud',(string)$inhoud);

}

if($laadvermogen){

    update_post_meta( $post_id, 'laadvermogen',(string)$laadvermogen );

}

if($rijsnelheidmin){

    update_post_meta( $post_id, 'rijsnelheidmin',(string)$rijsnelheidmin);

}

if($rijsnelheidmax){

    update_post_meta( $post_id, 'rijsnelheidmax',(string)$rijsnelheidmax);

}

if($werkbreedte){

    update_post_meta( $post_id, 'werkbreedte',(string)$werkbreedte);

}

if($werkhoogte){

    update_post_meta( $post_id, 'werkhoogte',(string)$werkhoogte);

}

if($hefinrichtingvoor){

    update_post_meta( $post_id, 'werkhoogte',(string)$hefinrichtingvoor

     );

}
if($prijs_op_aanvraag){

    update_post_meta( $post_id, 'prijs_op_aanvraag',(string)$prijs_op_aanvraag);

}

if($mtekst){

    update_post_meta( $post_id, 'mtekst',(string)$mtekst);

}

$nodes_processed++;

    // Check if all nodes are processed
    if ($nodes_processed === $total_nodes) {
        break; // Stop the loop when all nodes are processed
    }







} 
die;
  

?>