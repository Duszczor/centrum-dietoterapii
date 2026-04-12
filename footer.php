<?php
$privacy_url = function_exists('get_privacy_policy_url') ? get_privacy_policy_url() : '';
$home_url = home_url('/');
?>

<footer class="site-footer" aria-labelledby="site-footer-title">
    <div class="site-footer__container container">
        <div class="site-footer__top">
            <div class="site-footer__brand">
                <a href="<?php echo esc_url($home_url); ?>" class="site-footer__logo" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo/logo.png'); ?>"
                        alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                        class="site-footer__logo-image">
                </a>
                <h2 class="site-footer__title" id="site-footer-title"><?php bloginfo('name'); ?></h2>
                <p class="site-footer__description">Dietetyka kliniczna oparta na spokojnym prowadzeniu, jasnych zaleceniach i współpracy dopasowanej do Twojej sytuacji.</p>
            </div>

            <div class="site-footer__column">
                <p class="site-footer__eyebrow">Kontakt</p>
                <div class="site-footer__contact-list">
                    <a href="tel:+48668156568" class="site-footer__link">668-156-568</a>
                    <a href="mailto:kontakt@centrum-dietoterapii.pl" class="site-footer__link">kontakt@centrum-dietoterapii.pl</a>
                    <p class="site-footer__meta">Łowicz</p>
                    <p class="site-footer__meta">Konsultacje stacjonarne i online</p>
                </div>
            </div>

            <nav class="site-footer__column" aria-label="Skróty w stopce">
                <p class="site-footer__eyebrow">Na skróty</p>
                <ul class="site-footer__nav-list">
                    <li><a href="<?php echo esc_url($home_url); ?>" class="site-footer__link">Start</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#offer')); ?>" class="site-footer__link">Oferta</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#knowledge-base')); ?>" class="site-footer__link">Jak przebiega wizyta</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#pricing')); ?>" class="site-footer__link">Cennik</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#contact')); ?>" class="site-footer__link">Kontakt</a></li>
                </ul>
            </nav>

            <div class="site-footer__column site-footer__column--cta">
                <p class="site-footer__eyebrow">Pierwszy krok</p>
                <p class="site-footer__cta-text">Masz pytanie przed rozpoczęciem współpracy? Skontaktuj się i wybierz najlepszą formę konsultacji.</p>
                <div class="site-footer__cta-group">
                    <a href="tel:+48668156568" class="site-footer__cta">Zadzwoń</a>
                    <a href="mailto:kontakt@centrum-dietoterapii.pl" class="site-footer__secondary-link">Napisz e-mail</a>
                </div>
            </div>
        </div>

        <div class="site-footer__bottom">
            <p class="site-footer__copyright">&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?></p>
            <div class="site-footer__bottom-links">
                <?php if (!empty($privacy_url)) : ?>
                    <a href="<?php echo esc_url($privacy_url); ?>" class="site-footer__bottom-link">Polityka prywatności</a>
                <?php endif; ?>
                <a href="<?php echo esc_url(home_url('/#contact')); ?>" class="site-footer__bottom-link">Umów konsultację</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>