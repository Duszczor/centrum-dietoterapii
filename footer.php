<?php
$privacy_url = function_exists('get_privacy_policy_url') ? get_privacy_policy_url() : '';
$home_url = home_url('/');
$contact = dietitian_get_contact_data();
$footer_navigation_items = dietitian_get_footer_navigation_items();
?>

<footer class="site-footer" aria-labelledby="site-footer-title">
    <div class="site-footer__container container">
        <div class="site-footer__top">
            <div class="site-footer__brand">
                <a href="<?php echo $home_url; ?>" class="site-footer__logo" aria-label="<?php echo get_bloginfo('name'); ?>">
                    <img
                        src="<?php echo get_template_directory_uri() . '/assets/images/logo/logo.png'; ?>"
                        alt="<?php echo get_bloginfo('name'); ?>"
                        class="site-footer__logo-image">
                </a>
                <h2 class="site-footer__title" id="site-footer-title"><?php bloginfo('name'); ?></h2>
                <p class="site-footer__description">Dietetyka kliniczna oparta na spokojnym prowadzeniu, jasnych zaleceniach i współpracy dopasowanej do Twojej sytuacji.</p>
            </div>

            <div class="site-footer__column">
                <p class="site-footer__eyebrow">Kontakt</p>
                <div class="site-footer__contact-list">
                    <a href="<?php echo $contact['phone_href']; ?>" class="site-footer__link"><?php echo $contact['phone_display']; ?></a>
                    <a href="<?php echo $contact['email_href']; ?>" class="site-footer__link"><?php echo $contact['email_display']; ?></a>
                    <p class="site-footer__meta"><?php echo $contact['city']; ?></p>
                    <p class="site-footer__meta">Konsultacje stacjonarne i online</p>
                </div>
            </div>

            <nav class="site-footer__column" aria-label="Skróty w stopce">
                <p class="site-footer__eyebrow">Na skróty</p>
                <ul class="site-footer__nav-list">
                    <?php foreach ($footer_navigation_items as $item) : ?>
                        <li>
                            <a href="<?php echo $item['href']; ?>" class="site-footer__link"><?php echo $item['label']; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <div class="site-footer__column site-footer__column--cta">
                <p class="site-footer__eyebrow">Pierwszy krok</p>
                <p class="site-footer__cta-text">Masz pytanie przed rozpoczęciem współpracy? Skontaktuj się i wybierz najlepszą formę konsultacji.</p>
                <div class="site-footer__cta-group">
                    <a href="<?php echo $contact['phone_href']; ?>" class="btn btn--primary site-footer__cta">Zadzwoń</a>
                    <a href="<?php echo $contact['email_href']; ?>" class="btn btn--footer-outline site-footer__secondary-link">Napisz e-mail</a>
                </div>
            </div>
        </div>

        <div class="site-footer__bottom">
            <p class="site-footer__copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
            <div class="site-footer__bottom-links">
                <?php if (!empty($privacy_url)) : ?>
                    <a href="<?php echo $privacy_url; ?>" class="site-footer__bottom-link">Polityka prywatności</a>
                <?php endif; ?>
                <a href="<?php echo home_url('/#contact'); ?>" class="site-footer__bottom-link">Umów konsultację</a>
            </div>
        </div>
    </div>
</footer>

<?php if (is_front_page()) : ?>
    <a
        id="zl-url"
        class="zl-url"
        href="https://www.znanylekarz.pl/natalia-polit/dietetyk/lowicz"
        rel="nofollow"
        data-zlw-doctor="natalia-polit"
        data-zlw-type="button_calendar_floating_medium"
        data-zlw-opinion="false"
        data-zlw-hide-branding="true"
        data-zlw-saas-only="false">Natalia Polit - ZnanyLekarz.pl</a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>

</html>