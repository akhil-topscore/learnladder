class FacilityHandler extends elementorModules.frontend.handlers.SwiperBase {
    getDefaultSettings() {
        return {
            selectors: {
                slider: ".elementor-facility-wrapper",
                slide: ".swiper-slide",
                slideInnerContents: ".swiper-slide-contents",
                activeSlide: ".swiper-slide-active",
                activeDuplicate: ".swiper-slide-duplicate-active",
            },
            slidesPerView: {
                widescreen: 3,
                desktop: 3,
                laptop: 3,
                tablet_extra: 3,
                tablet: 2,
                mobile_extra: 2,
                mobile: 1,
            },
            classes: {
                animated: "animated",
                kenBurnsActive: "elementor-ken-burns--active",
                slideBackground: "swiper-slide-bg",
            },
            attributes: {
                dataSliderOptions: "slider_options",
                dataAnimation: "animation",
            },
        };
    }
    getDefaultElements() {
        const selectors = this.getSettings("selectors"),
            elements = {
                $swiperContainer: this.$element.find(selectors.slider),
            };
        elements.$slides = elements.$swiperContainer.find(selectors.slide);
        return elements;
    }
    getDeviceSlidesPerView(device) {
        const slidesPerViewKey = "slides_per_view" + ("desktop" === device ? "" : "_" + device);
        return Math.min(this.getSlidesCount(), +this.getElementSettings(slidesPerViewKey) || this.getSettings("slidesPerView")[device]);
    }
    getSlidesPerView(device) {
        return this.getDeviceSlidesPerView(device);
    }
    getDeviceSlidesToScroll(device) {
        const slidesToScrollKey = "slides_to_scroll" + ("desktop" === device ? "" : "_" + device);
        return Math.min(this.getSlidesCount(), +this.getElementSettings(slidesToScrollKey) || 1);
    }
    getSlidesToScroll(device) {
        return this.getDeviceSlidesToScroll(device);
    }
    getSwiperOptions() {
        const elementSettings = this.getElementSettings(),
            swiperOptions = {
                autoplay: this.getAutoplayConfig(),
                grabCursor: true,
                initialSlide: this.getInitialSlide(),
                slidesPerView: this.getSlidesPerView("desktop"),
                slidesPerGroup: this.getSlidesToScroll("desktop"),
                loop: "yes" === elementSettings.infinite,
                speed: elementSettings.transition_speed,
                effect: elementSettings.transition,
                observeParents: true,
                observer: true,
                handleElementorBreakpoints: true,
                on: {
                    slideChange: () => {
                        this.handleKenBurns();
                    },
                },
            };
        const showArrows = "arrows" === elementSettings.navigation || "both" === elementSettings.navigation,
            pagination = "dots" === elementSettings.navigation || "both" === elementSettings.navigation;
        const breakpointsSettings = {},
            breakpoints = elementorFrontend.config.responsive.activeBreakpoints;
        Object.keys(breakpoints).forEach((breakpointName) => {
            breakpointsSettings[breakpoints[breakpointName].value] = {
                slidesPerView: this.getSlidesPerView(breakpointName),
                slidesPerGroup: this.getSlidesToScroll(breakpointName),
            };
        });
        swiperOptions.breakpoints = breakpointsSettings;
        if (showArrows) {
            swiperOptions.navigation = {
                prevEl: ".elementor-swiper-button-prev",
                nextEl: ".elementor-swiper-button-next",
            };
        }
        if (pagination) {
            swiperOptions.pagination = {
                el: ".swiper-pagination",
                type: "bullets",
                clickable: true,
            };
        }
        if (true === swiperOptions.loop) {
            swiperOptions.loopedSlides = this.getSlidesCount();
        }
        if ("fade" === swiperOptions.effect) {
            swiperOptions.fadeEffect = {
                crossFade: true,
            };
        }
        return swiperOptions;
    }
    getDeviceBreakpointValue(device) {
        if (!this.breakpointsDictionary) {
            const breakpoints = elementorFrontend.config.responsive.activeBreakpoints;
            this.breakpointsDictionary = {};
            Object.keys(breakpoints).forEach((breakpointName) => {
                this.breakpointsDictionary[breakpointName] = breakpoints[breakpointName].value;
            });
        }
        return this.breakpointsDictionary[device];
    }
    getAutoplayConfig() {
        const elementSettings = this.getElementSettings();
        if ("yes" !== elementSettings.autoplay) {
            return false;
        }
        return {
            stopOnLastSlide: true,
            // Has no effect in infinite mode by default.
            delay: elementSettings.autoplay_speed,
            disableOnInteraction: "yes" === elementSettings.pause_on_interaction,
        };
    }
    initSingleSlideAnimations() {
        const settings = this.getSettings(),
            animation = this.elements.$swiperContainer.data(settings.attributes.dataAnimation);
        this.elements.$swiperContainer.find("." + settings.classes.slideBackground).addClass(settings.classes.kenBurnsActive);

        // If there is an animation, get the container of the slide's inner contents and add the animation classes to it
        if (animation) {
            this.elements.$swiperContainer.find(settings.selectors.slideInnerContents).addClass(settings.classes.animated + " " + animation);
        }
    }
    async initSlider() {
        const $slider = this.elements.$swiperContainer;
        if (!$slider.length) {
            return;
        }
        if (1 >= this.getSlidesCount()) {
            return;
        }
        const Swiper = elementorFrontend.utils.swiper;
        this.swiper = await new Swiper($slider, this.getSwiperOptions());

        // Expose the swiper instance in the frontend
        $slider.data("swiper", this.swiper);

        // The Ken Burns effect will only apply on the specific slides that toggled the effect ON,
        // since it depends on an additional class besides 'elementor-ken-burns--active'
        this.handleKenBurns();
        const elementSettings = this.getElementSettings();
        if (elementSettings.pause_on_hover) {
            this.togglePauseOnHover(true);
        }
        const settings = this.getSettings();
        const animation = $slider.data(settings.attributes.dataAnimation);
        if (!animation) {
            return;
        }
        this.swiper.on("slideChangeTransitionStart", function () {
            const $sliderContent = $slider.find(settings.selectors.slideInnerContents);
            $sliderContent.removeClass(settings.classes.animated + " " + animation).hide();
        });
        this.swiper.on("slideChangeTransitionEnd", function () {
            const $currentSlide = $slider.find(settings.selectors.slideInnerContents);
            $currentSlide.show().addClass(settings.classes.animated + " " + animation);
        });
    }
    onInit() {
        elementorModules.frontend.handlers.Base.prototype.onInit.apply(this, arguments);
        if (2 > this.getSlidesCount()) {
            this.initSingleSlideAnimations();
            return;
        }
        this.initSlider();
    }
    getChangeableProperties() {
        return {
            pause_on_hover: "pauseOnHover",
            pause_on_interaction: "disableOnInteraction",
            autoplay_speed: "delay",
            transition_speed: "speed",
        };
    }
    updateSwiperOption(propertyName) {
        if (0 === propertyName.indexOf("width")) {
            this.swiper.update();
            return;
        }
        const elementSettings = this.getElementSettings(),
            newSettingValue = elementSettings[propertyName],
            changeableProperties = this.getChangeableProperties();
        let propertyToUpdate = changeableProperties[propertyName],
            valueToUpdate = newSettingValue;

        // Handle special cases where the value to update is not the value that the Swiper library accepts
        switch (propertyName) {
            case "autoplay_speed":
                propertyToUpdate = "autoplay";
                valueToUpdate = {
                    delay: newSettingValue,
                    disableOnInteraction: "yes" === elementSettings.pause_on_interaction,
                };
                break;
            case "pause_on_hover":
                this.togglePauseOnHover("yes" === newSettingValue);
                break;
            case "pause_on_interaction":
                valueToUpdate = "yes" === newSettingValue;
                break;
        }

        // 'pause_on_hover' is implemented by the handler with event listeners, not the Swiper library
        if ("pause_on_hover" !== propertyName) {
            this.swiper.params[propertyToUpdate] = valueToUpdate;
        }
        this.swiper.update();
    }
    onElementChange(propertyName) {
        if (1 >= this.getSlidesCount()) {
            return;
        }
        const changeableProperties = this.getChangeableProperties();
        if (Object.prototype.hasOwnProperty.call(changeableProperties, propertyName)) {
            this.updateSwiperOption(propertyName);
            this.swiper.autoplay.start();
        }
    }
    onEditSettingsChange(propertyName) {
        if (1 >= this.getSlidesCount()) {
            return;
        }
        if ("activeItemIndex" === propertyName) {
            this.swiper.slideToLoop(this.getEditSettings("activeItemIndex") - 1);
            this.swiper.autoplay.stop();
        }
    }
}

jQuery(window).on("elementor/frontend/init", () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(FacilityHandler, {
            $element,
        });
    };
    elementorFrontend.hooks.addAction("frontend/element_ready/facility-carousel.default", addHandler);
});
