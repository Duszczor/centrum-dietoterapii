import {
  BlockControls,
  InspectorControls,
  RichText,
  useBlockProps,
} from "@wordpress/block-editor";
import {
  Button,
  Notice,
  PanelBody,
  SelectControl,
  TextareaControl,
  TextControl,
  ToolbarButton,
  ToolbarGroup,
} from "@wordpress/components";
import { useEffect, useMemo, useState } from "@wordpress/element";
import { __, sprintf } from "@wordpress/i18n";
import {
  THEME_TEXT_DOMAIN,
  getFieldGuidance,
  getPlainTextLength,
} from "../../shared/utils";
import "./editor.scss";

// ============================================================================
// Configuration: Card modifiers, icon options, and defaults
// ============================================================================

const CARD_MODIFIER_OPTIONS = [
  { label: __("Left", THEME_TEXT_DOMAIN), value: "left" },
  { label: __("Featured", THEME_TEXT_DOMAIN), value: "featured" },
  { label: __("Right", THEME_TEXT_DOMAIN), value: "right" },
];

const CARD_ICON_OPTIONS = [
  {
    label: __("Gut health", THEME_TEXT_DOMAIN),
    value: "gut-health",
    symbol: "🦠",
  },
  {
    label: __("Metabolic", THEME_TEXT_DOMAIN),
    value: "metabolic",
    symbol: "❤️",
  },
  {
    label: __("Fertility support", THEME_TEXT_DOMAIN),
    value: "fertility-support",
    symbol: "👶",
  },
];

const DEFAULT_CARDS = [
  {
    modifier: "left",
    icon: "gut-health",
    title: "Zdrowe Jelita & Trawienie 🦠",
    subtitle: "Choroby autoimmunologiczne i chroniczne zapalenia",
    description:
      "Specjalizuję się w leczeniu dietetycznym chorób, które wpływają na Twoją codzienną jakość życia.",
    items: [
      "Hashimoto, RZS, łuszczyca i inne",
      "Zapalenia jelita (IBD, IBS, SIBO)",
      "Wzdęcia, zaparcia, dysbioza",
      "Problemy trawienne i bóle",
    ],
  },
  {
    modifier: "featured",
    icon: "metabolic",
    title: "Metabolizm i Serce ❤️",
    subtitle: "Choroby metaboliczne i profilaktyka",
    description:
      "Pomagam zregulować ciśnienie, cholesterol i poziom cukru poprzez zmianę nawyków żywieniowych.",
    items: [
      "Nadciśnienie i dyslipidemię",
      "Cukrzycę i insulinooporność",
      "Otyłość i nadawagę",
      "Profilaktykę chorób serca",
    ],
  },
  {
    modifier: "right",
    icon: "fertility-support",
    title: "Płodność i Hormony 👶",
    subtitle: "Wsparcie przed ciążą i zmiany nawyków",
    description:
      "Przygotowuję Cię do najważniejszych chwil i pomagam w zmianie trybu życia na lepszy.",
    items: [
      "Przygotowaniu do ciąży",
      "Problemach z płodnością",
      "Zaburzeniach hormonalnych",
      "Budowie masy i utracie wagi",
    ],
  },
];

// ============================================================================
// Content guidelines: Character count thresholds for card fields
// ============================================================================

const CONTENT_GUIDELINES = {
  title: { softMax: 44, hardMax: 62 },
  subtitle: { softMax: 78, hardMax: 110 },
  description: { softMax: 120, hardMax: 170 },
  intro: { softMax: 220, hardMax: 300 },
};

// ============================================================================
// Helper functions: Card normalization, validation, and utilities
// ============================================================================

/**
 * Normalize cards by merging saved data with defaults and ensuring items.
 * Each card inherits defaults for missing properties.
 */
function normalizeCards(cards) {
  return DEFAULT_CARDS.map((defaultCard, index) => {
    const card = cards?.[index] || {};
    return {
      ...defaultCard,
      ...card,
      items:
        Array.isArray(card.items) && card.items.length > 0
          ? card.items
          : defaultCard.items,
    };
  });
}

/**
 * Get icon option config by slug, with fallback to first option.
 */
function getIconOption(iconSlug) {
  return (
    CARD_ICON_OPTIONS.find((option) => option.value === iconSlug) ||
    CARD_ICON_OPTIONS[0]
  );
}

/**
 * Clamp card index to valid range [0, cardsLength-1].
 */
function sanitizeCardIndex(index, cardsLength) {
  if (cardsLength <= 0) return 0;
  if (index < 0) return 0;
  if (index >= cardsLength) return cardsLength - 1;
  return index;
}

/**
 * Build guidance objects for active card fields.
 */
function buildCardFieldGuidance(card) {
  const fields = [
    { key: "title", label: __("Title", THEME_TEXT_DOMAIN) },
    { key: "subtitle", label: __("Subtitle", THEME_TEXT_DOMAIN) },
    { key: "description", label: __("Description", THEME_TEXT_DOMAIN) },
  ];

  return fields.map((field) => {
    const value = card[field.key];
    const length = getPlainTextLength(value);
    const limits = CONTENT_GUIDELINES[field.key];
    const level = getFieldGuidance(length, limits);

    return { ...field, value, length, limits, level };
  });
}

// ============================================================================
// Main Edit Component
// ============================================================================

export default function Edit({ attributes, setAttributes }) {
  const [activeCardIndex, setActiveCardIndex] = useState(0);
  const cards = normalizeCards(attributes.cards || []);
  const currentCardIndex = sanitizeCardIndex(activeCardIndex, cards.length);
  const activeCard = cards[currentCardIndex];
  const blockProps = useBlockProps({
    className: "offer-cards offer-cards--editor",
  });

  // Ensure active card index stays valid when cards change
  useEffect(() => {
    setActiveCardIndex((index) => sanitizeCardIndex(index, cards.length));
  }, [cards.length]);

  // =========================================================================
  // Card update methods: Single card, items, individual items, reset
  // =========================================================================

  const updateCard = (index, patch) => {
    const nextCards = cards.map((card, cardIndex) =>
      cardIndex === index ? { ...card, ...patch } : card,
    );
    setAttributes({ cards: nextCards });
  };

  const updateCardItems = (index, value) => {
    const items = value
      .split("\n")
      .map((item) => item.trim())
      .filter(Boolean);
    updateCard(index, { items });
  };

  const updateCardItem = (cardIndex, itemIndex, value) => {
    const nextItems = cards[cardIndex].items.map((item, currentItemIndex) =>
      currentItemIndex === itemIndex ? value : item,
    );
    updateCard(cardIndex, { items: nextItems });
  };

  const removeCardItem = (cardIndex, itemIndex) => {
    const nextItems = cards[cardIndex].items.filter(
      (_, currentItemIndex) => currentItemIndex !== itemIndex,
    );
    updateCard(cardIndex, { items: nextItems });
  };

  const addCardItem = (cardIndex) => {
    updateCard(cardIndex, {
      items: [...cards[cardIndex].items, ""],
    });
  };

  const resetCard = (index) => {
    const nextCards = cards.map((card, cardIndex) =>
      cardIndex === index ? { ...DEFAULT_CARDS[index] } : card,
    );
    setAttributes({ cards: nextCards });
  };

  // =========================================================================
  // Computed properties for display and validation
  // =========================================================================

  const invalidCards = cards.filter(
    (card) => card.title.trim() === "" || card.items.length === 0,
  );

  const activeCardGuidance = useMemo(() => {
    return activeCard ? buildCardFieldGuidance(activeCard) : [];
  }, [activeCard]);

  const introLength = getPlainTextLength(attributes.intro || "");
  const introGuidance = getFieldGuidance(introLength, CONTENT_GUIDELINES.intro);

  // =========================================================================
  // Render
  // =========================================================================

  return (
    <>
      <BlockControls>
        <ToolbarGroup label={__("Quick card switch", THEME_TEXT_DOMAIN)}>
          {cards.map((_, index) => (
            <ToolbarButton
              key={index}
              label={sprintf(__("Edit card %d", THEME_TEXT_DOMAIN), index + 1)}
              isPressed={currentCardIndex === index}
              onClick={() => setActiveCardIndex(index)}
              showTooltip
            >
              {index + 1}
            </ToolbarButton>
          ))}
        </ToolbarGroup>
      </BlockControls>

      <InspectorControls>
        <PanelBody
          title={__("Section structure", THEME_TEXT_DOMAIN)}
          initialOpen
        >
          <p className="offer-cards__inspector-note">
            {__(
              "This block keeps the existing three-card layout. Edit copy, icon and emphasis for each card without changing the front-end structure.",
              THEME_TEXT_DOMAIN,
            )}
          </p>
          <p
            className={`offer-cards__inspector-guidance offer-cards__inspector-guidance--${
              introGuidance || "ok"
            }`}
          >
            {sprintf(
              __("Intro length: %d characters", THEME_TEXT_DOMAIN),
              introLength,
            )}
          </p>
        </PanelBody>

        <PanelBody
          title={sprintf(
            __("Card %d settings", THEME_TEXT_DOMAIN),
            currentCardIndex + 1,
          )}
          initialOpen
        >
          <div className="offer-cards__inspector-switcher">
            {cards.map((_, index) => (
              <Button
                key={index}
                variant={currentCardIndex === index ? "primary" : "secondary"}
                onClick={() => setActiveCardIndex(index)}
              >
                {sprintf(__("Card %d", THEME_TEXT_DOMAIN), index + 1)}
              </Button>
            ))}
          </div>

          {activeCardGuidance.map((field) => (
            <p
              key={field.key}
              className={`offer-cards__inspector-guidance offer-cards__inspector-guidance--${
                field.level || "ok"
              }`}
            >
              <strong>{field.label}:</strong>{" "}
              {sprintf(
                __("%d chars (recommended up to %d)", THEME_TEXT_DOMAIN),
                field.length,
                field.limits.softMax,
              )}
            </p>
          ))}

          <SelectControl
            label={__("Card emphasis", THEME_TEXT_DOMAIN)}
            value={activeCard.modifier}
            options={CARD_MODIFIER_OPTIONS}
            onChange={(value) =>
              updateCard(currentCardIndex, { modifier: value })
            }
          />
          <SelectControl
            label={__("Icon", THEME_TEXT_DOMAIN)}
            value={activeCard.icon}
            options={CARD_ICON_OPTIONS.map(({ label, value }) => ({
              label,
              value,
            }))}
            onChange={(value) => updateCard(currentCardIndex, { icon: value })}
          />

          <div className="offer-cards__inspector-items">
            <p className="offer-cards__inspector-items-title">
              {__("List items", THEME_TEXT_DOMAIN)}
            </p>
            {activeCard.items.map((item, itemIndex) => (
              <div key={itemIndex} className="offer-cards__inspector-item-row">
                <TextControl
                  value={item}
                  onChange={(value) =>
                    updateCardItem(currentCardIndex, itemIndex, value)
                  }
                  placeholder={__("List item", THEME_TEXT_DOMAIN)}
                />
                <Button
                  variant="tertiary"
                  isDestructive
                  onClick={() => removeCardItem(currentCardIndex, itemIndex)}
                >
                  {__("Remove", THEME_TEXT_DOMAIN)}
                </Button>
              </div>
            ))}

            <div className="offer-cards__inspector-actions">
              <Button
                variant="secondary"
                onClick={() => addCardItem(currentCardIndex)}
              >
                {__("Add item", THEME_TEXT_DOMAIN)}
              </Button>
              <Button
                variant="tertiary"
                onClick={() => resetCard(currentCardIndex)}
              >
                {__("Reset this card", THEME_TEXT_DOMAIN)}
              </Button>
            </div>
          </div>
        </PanelBody>

        <PanelBody
          title={__("Quick paste items", THEME_TEXT_DOMAIN)}
          initialOpen={false}
        >
          <TextareaControl
            label={__("Paste list (one item per line)", THEME_TEXT_DOMAIN)}
            value={activeCard.items.join("\n")}
            onChange={(value) => updateCardItems(currentCardIndex, value)}
          />
        </PanelBody>
      </InspectorControls>

      <section
        {...blockProps}
        aria-label={__("Offer cards preview", THEME_TEXT_DOMAIN)}
      >
        <div className="offer-cards__container">
          <div className="offer-cards__header">
            <RichText
              tagName="h2"
              className="offer-cards__title"
              value={attributes.title}
              onChange={(value) => setAttributes({ title: value })}
              placeholder={__("Section title", THEME_TEXT_DOMAIN)}
              allowedFormats={[]}
            />
            <RichText
              tagName="p"
              className="offer-cards__intro"
              value={attributes.intro}
              onChange={(value) => setAttributes({ intro: value })}
              placeholder={__("Section introduction", THEME_TEXT_DOMAIN)}
            />
          </div>

          {invalidCards.length > 0 ? (
            <Notice status="warning" isDismissible={false}>
              {__(
                "Each card should have a title and at least one list item to render cleanly on the front end.",
                THEME_TEXT_DOMAIN,
              )}
            </Notice>
          ) : null}

          <div className="offer-cards__grid">
            {cards.map((card, index) => {
              const iconOption = getIconOption(card.icon);
              const isActive = index === currentCardIndex;

              return (
                <article
                  key={index}
                  className={`offer-card offer-card--${card.modifier} ${
                    isActive ? "is-active" : ""
                  }`}
                >
                  <button
                    type="button"
                    className="offer-card__editor-focus"
                    onClick={() => setActiveCardIndex(index)}
                  >
                    {sprintf(
                      __("Editing card %d", THEME_TEXT_DOMAIN),
                      index + 1,
                    )}
                  </button>

                  <span className="offer-card__icon-wrap" aria-hidden="true">
                    <span className="offer-card__icon-preview">
                      {iconOption.symbol}
                    </span>
                  </span>

                  <div className="offer-card__content">
                    <RichText
                      tagName="h3"
                      className="offer-card__heading"
                      value={card.title}
                      onChange={(value) => updateCard(index, { title: value })}
                      placeholder={__("Card title", THEME_TEXT_DOMAIN)}
                      allowedFormats={[]}
                    />
                    <RichText
                      tagName="p"
                      className="offer-card__subtitle"
                      value={card.subtitle}
                      onChange={(value) =>
                        updateCard(index, { subtitle: value })
                      }
                      placeholder={__("Card subtitle", THEME_TEXT_DOMAIN)}
                      allowedFormats={[]}
                    />
                    <RichText
                      tagName="p"
                      className="offer-card__description"
                      value={card.description}
                      onChange={(value) =>
                        updateCard(index, { description: value })
                      }
                      placeholder={__("Card description", THEME_TEXT_DOMAIN)}
                    />
                  </div>

                  <ul className="offer-card__list">
                    {card.items.map((item, itemIndex) => (
                      <li key={`${index}-${itemIndex}`}>
                        <RichText
                          tagName="span"
                          value={item}
                          onChange={(value) =>
                            updateCardItem(index, itemIndex, value)
                          }
                          placeholder={__("List item", THEME_TEXT_DOMAIN)}
                          allowedFormats={[]}
                          onFocus={() => setActiveCardIndex(index)}
                        />
                      </li>
                    ))}
                  </ul>
                </article>
              );
            })}
          </div>
        </div>
      </section>
    </>
  );
}
