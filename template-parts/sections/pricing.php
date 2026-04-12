<?php $pricing_plans = dietitian_get_pricing_plans(); ?>

<section class="pricing" id="pricing">
    <div class="pricing__container">
        <h2 class="pricing__title">Cennik</h2>
        <p class="pricing__subtitle">Porównaj zakres współpracy i wybierz formę wsparcia dopasowaną do etapu, na którym jesteś.</p>

        <div class="pricing__cards">
            <?php foreach ($pricing_plans as $plan) : ?>
                <div class="pricing__card <?php echo esc_attr($plan['modifier']); ?>">
                    <?php if (!empty($plan['badge'])) : ?>
                        <div class="pricing__card-badge"><?php echo esc_html($plan['badge']); ?></div>
                    <?php endif; ?>

                    <div class="pricing__card-header">
                        <p class="pricing__card-kicker"><?php echo esc_html($plan['kicker']); ?></p>
                        <h3 class="pricing__card-title"><?php echo esc_html($plan['title']); ?></h3>
                        <p class="pricing__card-subtitle"><?php echo esc_html($plan['subtitle']); ?></p>
                    </div>

                    <div class="pricing__price <?php echo $plan['price_variant'] === 'split' ? 'pricing__price--split' : ''; ?>">
                        <?php foreach ($plan['price_options'] as $index => $option) : ?>
                            <div class="pricing__price-option">
                                <span class="pricing__price-label"><?php echo esc_html($option['label']); ?></span>
                                <div class="pricing__price-main">
                                    <span class="pricing__price-value"><?php echo esc_html($option['value']); ?></span>
                                    <span class="pricing__price-currency">zł</span>
                                </div>
                            </div>
                            <?php if ($plan['price_variant'] === 'split' && $index === 0) : ?>
                                <span class="pricing__price-divider" aria-hidden="true"></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <div class="pricing__content">
                        <p class="pricing__lead <?php echo esc_attr($plan['lead_modifier']); ?>"><?php echo esc_html($plan['lead']); ?></p>
                        <?php if (!empty($plan['text'])) : ?>
                            <p class="pricing__text"><?php echo esc_html($plan['text']); ?></p>
                        <?php endif; ?>
                        <ul class="pricing__subfeatures">
                            <?php foreach ($plan['features'] as $feature) : ?>
                                <li class="<?php echo esc_attr($feature['modifier']); ?>"><?php echo esc_html($feature['text']); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>