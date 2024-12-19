class TestimonialCarousel extends CarouselBase {
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
    const addTestimonialHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(TestimonialCarousel, {
            $element,
        });
    };
    elementorFrontend.hooks.addAction("frontend/element_ready/testimonial-carousel-tpx.default", addTestimonialHandler);
});
