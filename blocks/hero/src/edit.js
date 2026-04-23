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
  PanelBody,
  TextControl,
  ToggleControl,
} from "@wordpress/components";
import { __ } from "@wordpress/i18n";
import { THEME_TEXT_DOMAIN } from "../../shared/i18n";
import "./editor.scss";

const ALLOWED_MEDIA_TYPES = ["image"];

// ============================================================================
// Main Edit Component
// ============================================================================

export default function Edit({ attributes, setAttributes }) {
  const trimmedCtaUrl = (attributes.ctaUrl || "").trim();
  const canOpenInNewTab = /^https?:\/\//i.test(trimmedCtaUrl);

  // Block props with computed classes
  const blockProps = useBlockProps({
    className: "hero",
  });

  return (
    <>
      <InspectorControls>
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
        </div>
      </section>
    </>
  );
}
