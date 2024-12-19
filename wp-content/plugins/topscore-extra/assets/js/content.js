class ContentCarousel extends CarouselBase {
    getDefaultSettings() {
        const defaultSettings = super.getDefaultSettings();
        defaultSettings.slidesPerView = {
            desktop: 1,
        };
        Object.keys(elementorFrontend.config.responsive.activeBreakpoints).forEach((breakpointName) => {
            defaultSettings.slidesPerView[breakpointName] = 1;
        });
        if (defaultSettings.loop) {
            defaultSettings.loopedSlides = this.getSlidesCount();
        }
        return defaultSettings;
    }
    getEffect() {
        return "slide";
    }
}

jQuery(window).on("elementor/frontend/init", () => {
    const addContentHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(ContentCarousel, {
            $element,
        });
    };
    elementorFrontend.hooks.addAction("frontend/element_ready/content-carousel.default", addContentHandler);
});
