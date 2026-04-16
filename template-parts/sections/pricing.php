<?php $pricing_plans = dietitian_get_pricing_plans(); ?>

<section class="pricing" id="pricing">
    <div class="pricing__container">
        <h2 class="pricing__title">Wybierz formę współpracy</h2>
        <p class="pricing__subtitle">Porównaj pakiety i wybierz wariant, który najlepiej odpowiada Twoim potrzebom oraz etapowi, na którym teraz jesteś.</p>

        <div class="pricing__cards">
            <?php foreach ($pricing_plans as $plan) : ?>
                <?php
                $card_class  = 'pricing__card' . ($plan['featured']    ? ' pricing__card--featured' : '');
                $price_class = 'pricing__price' . ($plan['split_prices'] ? ' pricing__price--split'  : '');
                $lead_class  = 'pricing__lead'  . ($plan['lead_accent']  ? ' pricing__lead--accent'  : '');
                $last_price_index = count($plan['prices']) - 1;
                ?>
                <div class="<?php echo $card_class; ?>">
                    <?php if (!empty($plan['badge'])) : ?>
                        <div class="pricing__card-badge"><?php echo $plan['badge']; ?></div>
                    <?php endif; ?>

                    <div class="pricing__card-header">
                        <p class="pricing__card-kicker"><?php echo $plan['kicker']; ?></p>
                        <h3 class="pricing__card-title"><?php echo $plan['title']; ?></h3>
                        <p class="pricing__card-subtitle"><?php echo $plan['subtitle']; ?></p>
                    </div>

                    <div class="<?php echo $price_class; ?>">
                        <?php foreach ($plan['prices'] as $index => $price) : ?>
                            <div class="pricing__price-option">
                                <span class="pricing__price-label"><?php echo $price['label']; ?></span>
                                <div class="pricing__price-main">
                                    <span class="pricing__price-value"><?php echo $price['value']; ?></span>
                                    <span class="pricing__price-currency">zł</span>
                                </div>
                            </div>
                            <?php if ($plan['split_prices'] && $index < $last_price_index) : ?>
                                <span class="pricing__price-divider" aria-hidden="true"></span>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                    <div class="pricing__content">
                        <p class="<?php echo $lead_class; ?>"><?php echo $plan['lead']; ?></p>
                        <?php if (!empty($plan['text'])) : ?>
                            <p class="pricing__text"><?php echo $plan['text']; ?></p>
                        <?php endif; ?>
                        <ul class="pricing__subfeatures">
                            <?php foreach ($plan['features'] as $feature) : ?>
                                <?php
                                if ($feature['alert'])         $li_class = 'pricing__feature-alert';
                                elseif ($feature['highlight']) $li_class = 'pricing__feature-highlight';
                                else                           $li_class = '';
                                ?>
                                <li<?php echo $li_class ? " class=\"{$li_class}\"" : ''; ?>><?php echo $feature['text']; ?></li>
                                <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pricing__footer">
            <a href="#contact" class="btn btn--primary pricing__footer-cta">Umów konsultację</a>
            <p class="pricing__footer-note">Masz wątpliwości? Napisz lub zadzwoń, pomogę wybrać najlepszą opcję.</p>
        </div>
    </div>
</section>