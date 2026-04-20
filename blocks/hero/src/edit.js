import {
  InspectorControls,
  MediaUpload,
  MediaUploadCheck,
  RichText,
  URLInput,
  useBlockProps,
} from "@wordpress/block-editor";
import {
  Button,
  Notice,
  PanelBody,
  SelectControl,
  TextControl,
  ToggleControl,
} from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import {
  THEME_TEXT_DOMAIN,
  getFieldGuidance,
  getPlainTextLength,
  sanitizeSelectValue,
} from "../../shared/utils";
import "./editor.scss";

// ============================================================================
// Configuration: Layout, overlay, and position options
// ============================================================================

const ALLOWED_MEDIA_TYPES = ["image"];

const LAYOUT_VARIANT_OPTIONS = [
  { label: __("Content left", THEME_TEXT_DOMAIN), value: "content-left" },
  { label: __("Centered", THEME_TEXT_DOMAIN), value: "centered" },
  { label: __("Compact", THEME_TEXT_DOMAIN), value: "compact" },
];

const OVERLAY_INTENSITY_OPTIONS = [
  { label: __("Soft", THEME_TEXT_DOMAIN), value: "soft" },
  { label: __("Default", THEME_TEXT_DOMAIN), value: "default" },
  { label: __("Strong", THEME_TEXT_DOMAIN), value: "strong" },
];

const CONTENT_POSITION_OPTIONS = [
  { label: __("Top", THEME_TEXT_DOMAIN), value: "top" },
  { label: __("Center", THEME_TEXT_DOMAIN), value: "center" },
  { label: __("Bottom", THEME_TEXT_DOMAIN), value: "bottom" },
];

// ============================================================================
// Content guidelines: Character count thresholds for each field
// ============================================================================

const CONTENT_GUIDELINES = {
  label: { softMax: 32, hardMax: 48 },
  title: { softMax: 72, hardMax: 96 },
  name: { softMax: 28, hardMax: 40 },
  descriptionPrimary: { softMax: 180, hardMax: 240 },
  descriptionSecondary: { softMax: 130, hardMax: 180 },
  ctaText: { softMax: 28, hardMax: 40 },
  ctaNote: { softMax: 90, hardMax: 130 },
};

// ============================================================================
// Helper functions: URL validation, text normalization
// ============================================================================

/**
 * Check if a URL string is valid for CTA (anchor, relative, or external URL).
 */
function isValidCtaUrl(ctaUrl) {
  if (!ctaUrl) {
    return false;
  }
  return /^(#.+|\/.*|https?:\/\/.+|mailto:.+|tel:.+)$/i.test(ctaUrl);
}

/**
 * Check if a URL is external HTTP/HTTPS (for "open in new tab" eligibility).
 */
function isExternalHttpUrl(ctaUrl) {
  return /^https?:\/\//i.test(ctaUrl);
}

/**
 * Normalize and validate a layout variant value.
 */
function normalizeLayoutVariant(layoutVariant) {
  return sanitizeSelectValue(
    layoutVariant,
    LAYOUT_VARIANT_OPTIONS,
    "content-left",
  );
}

/**
 * Build CTA validation messages for the inspector.
 */
function buildCtaValidationMessages(hasCtaText, hasCtaUrl, isUrlValid) {
  const messages = [];

  if (hasCtaText && !hasCtaUrl) {
    messages.push(
      __("Add a CTA URL or clear the button label.", THEME_TEXT_DOMAIN),
    );
  }

  if (hasCtaUrl && !hasCtaText) {
    messages.push(
      __(
        "Add a button label to render the CTA on the front end.",
        THEME_TEXT_DOMAIN,
      ),
    );
  }

  if (hasCtaUrl && !isUrlValid) {
    messages.push(
      __(
        "Use an anchor (#offer), a relative path (/kontakt), or a full https://, mailto:, or tel: URL.",
        THEME_TEXT_DOMAIN,
      ),
    );
  }

  return messages;
}

/**
 * Build content guidance objects from field values and thresholds.
 */
function buildContentGuidance(attributes) {
  const fields = [
    { key: "label", label: __("Label", THEME_TEXT_DOMAIN), attr: "label" },
    { key: "title", label: __("Headline", THEME_TEXT_DOMAIN), attr: "title" },
    { key: "name", label: __("Name", THEME_TEXT_DOMAIN), attr: "name" },
    {
      key: "descriptionPrimary",
      label: __("Primary description", THEME_TEXT_DOMAIN),
      attr: "descriptionPrimary",
    },
    {
      key: "descriptionSecondary",
      label: __("Secondary description", THEME_TEXT_DOMAIN),
      attr: "descriptionSecondary",
    },
    {
      key: "ctaText",
      label: __("CTA label", THEME_TEXT_DOMAIN),
      attr: "ctaText",
    },
    {
      key: "ctaNote",
      label: __("CTA note", THEME_TEXT_DOMAIN),
      attr: "ctaNote",
    },
  ];

  return fields.map((field) => {
    const value = attributes[field.attr];
    const length = getPlainTextLength(value);
    const thresholds = CONTENT_GUIDELINES[field.key];
    const guidance = getFieldGuidance(length, thresholds);

    return { ...field, value, length, guidance, thresholds };
  });
}

// ============================================================================
// Main Edit Component
// ============================================================================

export default function Edit({ attributes, setAttributes }) {
  // Normalize all select field values against allowed options
  const normalizedLayoutVariant = normalizeLayoutVariant(
    attributes.layoutVariant,
  );
  const normalizedOverlayIntensity = sanitizeSelectValue(
    attributes.overlayIntensity,
    OVERLAY_INTENSITY_OPTIONS,
    "default",
  );
  const normalizedContentPosition = sanitizeSelectValue(
    attributes.contentPosition,
    CONTENT_POSITION_OPTIONS,
    "center",
  );

  // Normalize CTA values
  const trimmedCtaText = (attributes.ctaText || "").trim();
  const trimmedCtaUrl = (attributes.ctaUrl || "").trim();
  const hasCtaText = trimmedCtaText.length > 0;
  const hasCtaUrl = trimmedCtaUrl.length > 0;
  const ctaUrlIsValid = !hasCtaUrl || isValidCtaUrl(trimmedCtaUrl);
  const canOpenInNewTab = isExternalHttpUrl(trimmedCtaUrl);

  // Build validation messages and content guidance
  const ctaValidationMessages = buildCtaValidationMessages(
    hasCtaText,
    hasCtaUrl,
    ctaUrlIsValid,
  );
  const contentGuidance = buildContentGuidance(attributes);
  const contentWarnings = contentGuidance.filter((f) => f.guidance !== null);

  // Block props with computed classes
  const blockProps = useBlockProps({
    className: `hero hero--${normalizedLayoutVariant} hero--overlay-${normalizedOverlayIntensity} hero--content-${normalizedContentPosition}`,
  });

  return (
    <>
      <InspectorControls>
        <PanelBody title={__("Layout", THEME_TEXT_DOMAIN)} initialOpen>
          <SelectControl
            label={__("Hero layout variant", THEME_TEXT_DOMAIN)}
            value={normalizedLayoutVariant}
            options={LAYOUT_VARIANT_OPTIONS}
            onChange={(value) => setAttributes({ layoutVariant: value })}
          />
          <SelectControl
            label={__("Overlay intensity", THEME_TEXT_DOMAIN)}
            value={normalizedOverlayIntensity}
            options={OVERLAY_INTENSITY_OPTIONS}
            onChange={(value) => setAttributes({ overlayIntensity: value })}
          />
          <SelectControl
            label={__("Content vertical position", THEME_TEXT_DOMAIN)}
            value={normalizedContentPosition}
            options={CONTENT_POSITION_OPTIONS}
            onChange={(value) => setAttributes({ contentPosition: value })}
          />
        </PanelBody>

        <PanelBody
          title={__("Content guidance", THEME_TEXT_DOMAIN)}
          initialOpen={false}
        >
          {contentGuidance.map((field) => (
            <p
              key={field.key}
              className={`hero__inspector-guidance hero__inspector-guidance--${
                field.guidance || "ok"
              }`}
            >
              <strong>{field.label}:</strong> {field.length}/
              {field.thresholds.softMax}
              {field.guidance === "soft"
                ? __(" recommended characters exceeded.", THEME_TEXT_DOMAIN)
                : null}
              {field.guidance === "hard"
                ? __(
                    " strongly consider shortening this field.",
                    THEME_TEXT_DOMAIN,
                  )
                : null}
            </p>
          ))}
        </PanelBody>

        <PanelBody title={__("CTA", THEME_TEXT_DOMAIN)} initialOpen>
          <TextControl
            label={__("Button label", THEME_TEXT_DOMAIN)}
            value={attributes.ctaText}
            onChange={(value) => setAttributes({ ctaText: value })}
          />
          <URLInput
            label={__("Button URL", THEME_TEXT_DOMAIN)}
            value={attributes.ctaUrl}
            onChange={(value) => setAttributes({ ctaUrl: value })}
          />

          {ctaValidationMessages.map((message, idx) => (
            <Notice key={idx} status="warning" isDismissible={false}>
              {message}
            </Notice>
          ))}

          <ToggleControl
            label={__("Open link in new tab", THEME_TEXT_DOMAIN)}
            checked={attributes.openInNewTab && canOpenInNewTab}
            help={
              canOpenInNewTab
                ? __(
                    "Applies only to external http/https links.",
                    THEME_TEXT_DOMAIN,
                  )
                : __(
                    "Available only for external http/https links.",
                    THEME_TEXT_DOMAIN,
                  )
            }
            disabled={!canOpenInNewTab}
            onChange={(value) => setAttributes({ openInNewTab: value })}
          />
        </PanelBody>

        <PanelBody
          title={__("Background image", THEME_TEXT_DOMAIN)}
          initialOpen={false}
        >
          <MediaUploadCheck>
            <MediaUpload
              onSelect={(media) => {
                setAttributes({
                  imageId: media?.id,
                  imageUrl: media?.url || "",
                  imageAlt: media?.alt || attributes.imageAlt,
                });
              }}
              allowedTypes={ALLOWED_MEDIA_TYPES}
              value={attributes.imageId}
              render={({ open }) => (
                <Button variant="secondary" onClick={open}>
                  {attributes.imageId
                    ? __("Replace image", THEME_TEXT_DOMAIN)
                    : __("Choose image", THEME_TEXT_DOMAIN)}
                </Button>
              )}
            />
          </MediaUploadCheck>

          {attributes.imageId ? (
            <Button
              variant="link"
              isDestructive
              onClick={() =>
                setAttributes({
                  imageId: undefined,
                  imageUrl: "",
                  imageAlt: "",
                })
              }
            >
              {__("Remove image", THEME_TEXT_DOMAIN)}
            </Button>
          ) : null}

          <TextControl
            label={__("Image alt text (optional)", THEME_TEXT_DOMAIN)}
            help={__("Leave empty if image is decorative.", THEME_TEXT_DOMAIN)}
            value={attributes.imageAlt}
            onChange={(value) => setAttributes({ imageAlt: value })}
          />
        </PanelBody>
      </InspectorControls>

      <section
        {...blockProps}
        aria-label={__("Hero preview", THEME_TEXT_DOMAIN)}
      >
        <div className="hero__media" aria-hidden="true">
          {attributes.imageUrl ? (
            <img className="hero__image" src={attributes.imageUrl} alt="" />
          ) : (
            <div
              className="hero__image"
              style={{
                background:
                  "linear-gradient(135deg, rgba(14, 39, 48, 1), rgba(31, 73, 89, 1))",
              }}
            />
          )}
        </div>

        <div className="hero__overlay" aria-hidden="true" />

        <div className="hero__content">
          {contentWarnings.length > 0 ? (
            <div className="hero__editor-guidance-list">
              {contentWarnings.map((field) => (
                <p
                  key={field.key}
                  className={`hero__editor-guidance hero__editor-guidance--${field.guidance}`}
                >
                  <strong>{field.label}:</strong>{" "}
                  {field.guidance === "hard"
                    ? __(
                        "This field is likely too long for a clean Hero layout.",
                        THEME_TEXT_DOMAIN,
                      )
                    : __(
                        "This field is getting long for a Hero section.",
                        THEME_TEXT_DOMAIN,
                      )}
                </p>
              ))}
            </div>
          ) : null}

          <div className="hero__heading">
            <RichText
              tagName="p"
              className="hero__label"
              value={attributes.label}
              onChange={(value) => setAttributes({ label: value })}
              placeholder={__("Short location label", THEME_TEXT_DOMAIN)}
              allowedFormats={[]}
            />

            <RichText
              tagName="h1"
              className="hero__title"
              value={attributes.title}
              onChange={(value) => setAttributes({ title: value })}
              placeholder={__("Main headline", THEME_TEXT_DOMAIN)}
              allowedFormats={[]}
            />

            <RichText
              tagName="p"
              className="hero__name"
              value={attributes.name}
              onChange={(value) => setAttributes({ name: value })}
              placeholder={__("Name", THEME_TEXT_DOMAIN)}
              allowedFormats={[]}
            />
          </div>

          <div className="hero__desc">
            <RichText
              tagName="p"
              value={attributes.descriptionPrimary}
              onChange={(value) => setAttributes({ descriptionPrimary: value })}
              placeholder={__("Primary description", THEME_TEXT_DOMAIN)}
            />
            <RichText
              tagName="p"
              className="hero__desc-secondary"
              value={attributes.descriptionSecondary}
              onChange={(value) =>
                setAttributes({ descriptionSecondary: value })
              }
              placeholder={__("Secondary description", THEME_TEXT_DOMAIN)}
            />
          </div>

          <RichText
            tagName="p"
            className="hero__cta-note"
            value={attributes.ctaNote}
            onChange={(value) => setAttributes({ ctaNote: value })}
            placeholder={__("CTA support note", THEME_TEXT_DOMAIN)}
            allowedFormats={[]}
          />

          <div className="hero__cta btn btn--primary">
            <RichText
              tagName="span"
              value={attributes.ctaText}
              onChange={(value) => setAttributes({ ctaText: value })}
              placeholder={__("Button label", THEME_TEXT_DOMAIN)}
              allowedFormats={[]}
            />
          </div>

          <div className="hero__editor-meta">
            {hasCtaUrl && ctaUrlIsValid ? (
              <p className="hero__editor-url">{trimmedCtaUrl}</p>
            ) : null}

            {ctaValidationMessages.length > 0 ? (
              <p className="hero__editor-warning">
                {__(
                  "CTA needs attention before it can render on the front end.",
                  THEME_TEXT_DOMAIN,
                )}
              </p>
            ) : null}
          </div>
        </div>
      </section>
    </>
  );
}
