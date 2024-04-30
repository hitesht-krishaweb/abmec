<?php get_header(); ?>
<section class="section">
    <div class="breadcrumbs">
        <div class="container">
            <?php custom_breadcrumbs(); ?>
        </div>
    </div>

    <article class="page">
    <div class="container">
        <article>
        <h1><?php the_title(); ?></h1>
        <?php $address = get_field('location_address'); ?>
        <?php $contacts = get_field('contacts'); ?>

        <p><?php echo $address['address']; ?> <br/>
            <?php echo $address['zipcode_city']; ?><br/>
            <a href="tel:<?php echo str_replace( array( ' ', '(', ')', '-', '  ' ), '', $address['phonenumber'] ); ?>"><?php echo $address['phonenumber']; ?></a><br/>
            <a href="mailto:<?php echo $address['email'] ?>"><?php echo $address['email']; ?></a><br>
            <?php if($address['whatsapp_number']){ ?>
                WhatsApp werkplaats: <a href="https://api.whatsapp.com/send?phone=<?php echo str_replace( array( ' ', '(', ')', '-', '  ' ), '', $address['whatsapp_number'] ); ?>"><?php echo $address['whatsapp_number']; ?></a><br/>
            <?php } ?>
            <a href="mailto:<?php echo $address['e-mail_magazijn'] ?>"><?php echo $address['e-mail_magazijn'] ?></a><br/>
            <?php if($address['whatsapp_magazijn']){ ?>
                WhatsApp magazijn: <a href="https://api.whatsapp.com/send?phone=<?php echo str_replace( array( ' ', '(', ')', '-', '  ' ), '', $address['whatsapp_magazijn'] ); ?>"><?php echo $address['whatsapp_magazijn']; ?></a><br/>
            <?php } ?>
            
        </p>


        <?php if ($manager = $contacts['location_manager'] && !empty($contacts['location_manager']['name'])): ?>
        <h2>Bedrijfsleider</h2>


            <p><a href="mailto:<?php echo $manager['email'] ?>"><?php echo $manager['name'] ?></a><br/>
                <a href="tel:<?php echo $manager['phone']; ?>"><?php echo $manager['phone'] ?></a>
            </p>
        <?php endif; ?>


        <?php if ($chefWorkshop = $contacts['chef_workshop']): ?>
        <?php if (($chefWorkshop['name'] != "") && ($chefWorkshop['phone'] != "") ): ?>
        <h2>Chef werkplaats</h2>

            <p><a href="mailto:<?php echo $chefWorkshop['email'] ?>"><?php echo $chefWorkshop['name'] ?></a><br/>
                <a href="tel: <?php echo $chefWorkshop['phone']; ?>"><?php echo $chefWorkshop['phone'] ?></a>
            </p>
        <?php endif; ?>
        <?php endif; ?>

        <?php if ($salesAgents = $contacts['sales_agents']): ?>
        <h2>Verkoper(s) machines</h2>

            <?php foreach ($salesAgents as $salesAgent): ?>
                <p><a href="mailto:<?php echo $salesAgent['email'] ?>"><?php echo $salesAgent['name'] ?></a><br/>
                    <a href="tel:<?php echo $salesAgent['phone'] ?>"><?php echo $salesAgent['phone'] ?></a>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($verkopers_mechanisatie = $contacts['verkopers_mechanisatie']): ?>
        <h2>Verkoper(s) mechanisatie</h2>

            <?php foreach ($verkopers_mechanisatie as $mechanisatie): ?>
                <p><a href="mailto:<?php echo $mechanisatie['email'] ?>"><?php echo $mechanisatie['name'] ?></a><br/>
                    <a href="tel:<?php echo $mechanisatie['phone'] ?>"><?php echo $mechanisatie['phone'] ?></a>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($verkopers_melkwinning = $contacts['verkopers_melkwinning']): ?>
        <h2>Verkoper(s) melkwinning</h2>

            <?php foreach ($verkopers_melkwinning as $melkwinning): ?>
                <p><a href="mailto:<?php echo $melkwinning['email'] ?>"><?php echo $melkwinning['name'] ?></a><br/>
                    <a href="tel:<?php echo $melkwinning['phone'] ?>"><?php echo $melkwinning['phone'] ?></a>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>
        
		<?php if ($verkopers_machines = $contacts['verkopers_machines']): ?>
        <h2>Verkoper(s) Fendt</h2>

            <?php foreach ($verkopers_machines as $verkopers_machine): ?>
                <p><a href="mailto:<?php echo $verkopers_machine['email'] ?>"><?php echo $verkopers_machine['name'] ?></a><br/>
                    <a href="tel:<?php echo $verkopers_machine['phone'] ?>"><?php echo $verkopers_machine['phone'] ?></a>
                </p>
            <?php endforeach; ?>
        <?php endif; ?>
		
            <?php if ($openingHours = get_field('opening_hours')): ?>
        <h2>Openingstijden</h2>
            <?php foreach ($openingHours as $openingHour): ?>
                <p><?php echo $openingHour['openinghours_day'] ?> <?php echo $openingHour['openinghours_times'] ?></p>
            <?php endforeach; ?>
        <?php endif; ?>


        <?php if (get_field('Title_new') != "" && get_field('logo_dnl') != ""): ?>
            <p><br></p>
            <h2><?php echo get_field('Title_new'); ?></h2>
            <a target="_blank" href="<?php echo get_field('logo_leverancier_link'); ?>"><img alt="DNL" class="logo_dnl" src="<?php echo get_field('logo_dnl'); ?>"></a>
            <p><br></p>
        <?php endif; ?>

    </div>
    </article>
</section>
<?php get_footer(); ?>
