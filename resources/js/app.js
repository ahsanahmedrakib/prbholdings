import Alpine from "alpinejs";
import Swiper from "swiper";
import "swiper/css";
import "swiper/css/effect-fade";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { Autoplay, EffectFade, Navigation, Pagination } from "swiper/modules";

window.Alpine = Alpine;

const prefersReducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
).matches;

function initHeader() {
    const header = document.querySelector("[data-site-header]");
    const progress = document.querySelector("[data-scroll-progress]");
    const floatingActions = document.querySelector("[data-floating-actions]");

    const onScroll = () => {
        if (header) {
            header.classList.toggle("is-scrolled", window.scrollY > 24);
        }

        if (floatingActions) {
            floatingActions.classList.toggle(
                "is-visible",
                window.scrollY > 420,
            );
        }

        if (progress) {
            const max =
                document.documentElement.scrollHeight - window.innerHeight;
            const value = max > 0 ? (window.scrollY / max) * 100 : 0;
            progress.style.width = `${value}%`;
        }
    };

    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
}

function initReveal() {
    const items = document.querySelectorAll("[data-reveal]");

    if (!items.length) {
        return;
    }

    if (prefersReducedMotion || !("IntersectionObserver" in window)) {
        items.forEach((item) => item.classList.add("is-visible"));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                const counters =
                    entry.target.querySelectorAll("[data-counter]");

                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    counters.forEach((counter) => animateCounter(counter));
                    return;
                }

                entry.target.classList.remove("is-visible");
                counters.forEach((counter) => resetCounter(counter));
            });
        },
        { threshold: 0.15, rootMargin: "0px 0px -60px 0px" },
    );

    items.forEach((item) => observer.observe(item));
}

function resetCounter(el) {
    if (el.dataset.counted !== "true") {
        return;
    }

    el.dataset.counted = "false";
    el.textContent = `0${el.dataset.suffix || ""}`;
}

function animateCounter(el) {
    if (el.dataset.counted === "true") {
        return;
    }

    el.dataset.counted = "true";

    const target = Number(el.dataset.counter || 0);
    const suffix = el.dataset.suffix || "";
    const duration = Number(el.dataset.duration || 1800);
    const start = performance.now();

    if (prefersReducedMotion) {
        el.textContent = `${target.toLocaleString()}${suffix}`;
        return;
    }

    const tick = (now) => {
        const elapsed = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - elapsed, 3);
        el.textContent = `${Math.round(target * eased).toLocaleString()}${suffix}`;

        if (elapsed < 1) {
            requestAnimationFrame(tick);
        }
    };

    requestAnimationFrame(tick);
}

function initHeroSliders() {
    document.querySelectorAll("[data-hero]").forEach((root) => {
        const swiperEl = root.querySelector(".swiper");
        const nextEl = root.querySelector("[data-hero-next]");
        const prevEl = root.querySelector("[data-hero-prev]");
        const currentEl = root.querySelector("[data-hero-current]");
        const totalEl = root.querySelector("[data-hero-total]");
        const progressEl = root.querySelector("[data-hero-progress]");
        const slides = swiperEl
            ? swiperEl.querySelectorAll(".swiper-slide")
            : [];

        if (!swiperEl || slides.length === 0) {
            return;
        }

        if (totalEl) {
            totalEl.textContent = String(slides.length).padStart(2, "0");
        }

        new Swiper(swiperEl, {
            modules: [Autoplay, EffectFade, Navigation],
            effect: "fade",
            fadeEffect: { crossFade: true },
            speed: prefersReducedMotion ? 0 : 900,
            loop: slides.length > 1,
            watchOverflow: true,
            autoplay: prefersReducedMotion
                ? false
                : {
                      delay: 6800,
                      disableOnInteraction: false,
                      pauseOnMouseEnter: true,
                  },
            navigation: {
                nextEl,
                prevEl,
            },
            on: {
                init(instance) {
                    updateHeroMeta(instance, currentEl, progressEl);
                },
                slideChange(instance) {
                    updateHeroMeta(instance, currentEl, progressEl);
                },
            },
        });

        if (progressEl) {
            progressEl.style.animation = "none";
        }
    });
}

function updateHeroMeta(swiper, currentEl, progressEl) {
    if (currentEl) {
        const index = swiper.realIndex ?? swiper.activeIndex;
        currentEl.textContent = String(index + 1).padStart(2, "0");
    }

    if (progressEl) {
        progressEl.classList.remove("is-running");
        void progressEl.offsetWidth;
        progressEl.classList.add("is-running");
    }
}

function initProjectsSlider() {
    document.querySelectorAll("[data-projects-swiper]").forEach((root) => {
        const swiperEl = root.querySelector(".swiper");
        const nextEl = root.querySelector("[data-projects-next]");
        const prevEl = root.querySelector("[data-projects-prev]");

        if (!swiperEl) {
            return;
        }

        new Swiper(swiperEl, {
            modules: [Autoplay, Navigation, Pagination],
            slidesPerView: 1.08,
            spaceBetween: 20,
            grabCursor: true,
            watchOverflow: true,
            navigation: { nextEl, prevEl },
            pagination: {
                el: root.querySelector("[data-projects-dots]"),
                clickable: true,
                bulletClass: "mini-dot",
                bulletActiveClass: "mini-dot-active",
            },
            breakpoints: {
                640: { slidesPerView: 1.6, spaceBetween: 24 },
                768: { slidesPerView: 2.1, spaceBetween: 24 },
                1024: { slidesPerView: 2.9, spaceBetween: 26 },
                1280: { slidesPerView: 3.25, spaceBetween: 28 },
            },
            loop: true, // ← enable continuous loop
            autoplay: prefersReducedMotion
                ? false
                : {
                      delay: 5200,
                      disableOnInteraction: false,
                      pauseOnMouseEnter: true,
                  },
        });
    });
}

function initTestimonialSlider() {
    document.querySelectorAll("[data-testimonials-swiper]").forEach((root) => {
        const swiperEl = root.querySelector(".swiper");

        if (!swiperEl) {
            return;
        }

        new Swiper(swiperEl, {
            modules: [Autoplay, Navigation, Pagination],
            slidesPerView: 1.05,
            spaceBetween: 20,
            grabCursor: true,
            watchOverflow: true,
            autoplay: prefersReducedMotion
                ? false
                : {
                      delay: 5200,
                      disableOnInteraction: false,
                      pauseOnMouseEnter: true,
                  },
            navigation: {
                nextEl: root.querySelector("[data-testimonials-next]"),
                prevEl: root.querySelector("[data-testimonials-prev]"),
            },
            pagination: {
                el: root.querySelector("[data-testimonials-dots]"),
                clickable: true,
                bulletClass: "mini-dot",
                bulletActiveClass: "mini-dot-active",
            },
            breakpoints: {
                768: { slidesPerView: 1.7, spaceBetween: 24 },
                1024: { slidesPerView: 2.4, spaceBetween: 26 },
            },
            loop: true,
        });
    });
}

function initLightbox() {
    const lightbox = document.querySelector("[data-lightbox-modal]");

    if (!lightbox) {
        return;
    }

    const image = lightbox.querySelector("[data-lightbox-image]");
    const close = lightbox.querySelector("[data-lightbox-close]");

    const closeLightbox = () => {
        lightbox.classList.remove("is-open");
        document.body.classList.remove("no-scroll");
        image.src = "";
    };

    document.querySelectorAll("[data-lightbox]").forEach((trigger) => {
        trigger.addEventListener("click", (event) => {
            const src = trigger.dataset.lightbox;

            if (!src) {
                return;
            }

            event.preventDefault();
            image.src = src;
            image.alt = trigger.dataset.lightboxAlt || "";
            lightbox.classList.add("is-open");
            document.body.classList.add("no-scroll");
        });
    });

    close?.addEventListener("click", closeLightbox);

    lightbox.addEventListener("click", (event) => {
        if (event.target === lightbox) {
            closeLightbox();
        }
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && lightbox.classList.contains("is-open")) {
            closeLightbox();
        }
    });
}

function initBackToTop() {
    document.querySelectorAll("[data-to-top]").forEach((button) => {
        button.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: prefersReducedMotion ? "auto" : "smooth",
            });
        });
    });
}

document.addEventListener("DOMContentLoaded", () => {
    initHeader();
    initReveal();
    initHeroSliders();
    initProjectsSlider();
    initTestimonialSlider();
    initLightbox();
    initBackToTop();
});

Alpine.start();
