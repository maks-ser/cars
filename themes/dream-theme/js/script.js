const tabsLink = document.querySelectorAll(".catalog-tabs-link");
const tabsContent = document.querySelectorAll(".tabs-content");

const tabsLink2 = document.querySelectorAll(".products__tab-link");
const tabsContent2 = document.querySelectorAll(".products-list");

tabsLink.forEach(function (item) {
    item.addEventListener("click", function (e) {
        e.preventDefault();
        let currentLink = item;
        let tabId = currentLink.getAttribute("href");

        let currentTab = document.querySelector(tabId);
        if (!currentLink.classList.contains("active")) {
            tabsLink.forEach(function (item) {
                item.classList.remove("active");
            });
            tabsContent.forEach(function (item) {
                item.classList.remove("active");
            });
            currentLink.classList.add("active");
            currentTab.classList.add("active");
        }
    });
});
/*range
$("#polzunok").slider({
    animate: "slow",
    range: true,
    values: [10, 400000],

    slide: function( event, ui ) {
        $( "#result-polzunok" ).html( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );

       window.location.href = window.location.href + '?' + 'price_min=' + ui.values[ 0 ] + '&price_max=' + ui.values[ 1 ];

    }
});

$("#result-polzunok").text("от " + $("#polzunok").slider("values", 0) + " до " + $("#polzunok").slider("values", 1));
*/


tabsLink2.forEach(function (item) {
    item.addEventListener("click", function (e) {
        e.preventDefault();

        let currentLink = item;
        let tabId = currentLink.getAttribute("href");

        let currentTab = document.querySelector(tabId);

        if (!currentLink.classList.contains("active")) {
            tabsLink2.forEach(function (item) {
                item.classList.remove("active");
            });

            tabsContent2.forEach(function (item) {
                item.classList.remove("active");
            });

            currentLink.classList.add("active");
            currentTab.classList.add("active");
        }
        ;
    });
});


// Fixing header on scroll

$(window).scroll(function () {
    $('.header.catalog .bottom-part').toggleClass('fixed', $(this).scrollTop() > 300);
    $('.main-catalog').toggleClass('indent', $(this).scrollTop() > 300);
});


// Homepage slider

const mySwiper = new Swiper('.home-swiper-container', {

    loop: true,
    spaceBetween: 20,
    centeredSlides: true,
    slidesPerView: "auto",

    // navigation arrows
    nextButton: '.main-slider__button-next',
    prevButton: '.main-slider__button-prev',
    breakpoints: {

        544: {
            slidesPerView: 2,
            spaceBetween: 10,
            centeredSlides: false,
        },

        768: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        992: {
            centeredSlides: false,
            slidesPerView: 3
        }
    }
});

// Section rewiews slider functional

new Swiper('.reviews-slider', {
    spaceBetween: 48,
    speed: 500,
    loop: true,
    centeredSlides: true,
    autoplay: true,
    navigation: {
        nextEl: ".reviews-slider__button-next",
        prevEl: ".reviews-slider__button-prev"
    },

    breakpoints: {
        680: {
            slidesPerView: 3
        },

        920: {
            slidesPerView: 4
        },

        1240: {
            slidesPerView: 5
        },
    }
});


// Section banner slider functional

new Swiper('.banner-slider', {
    spaceBetween: 8,
    speed: 500,
    slidesPerView: 3,
    loop: true,
    centeredSlides: true,
    autoplay: true,
    navigation: {
        nextEl: ".banner-slider__button-next",
        prevEl: ".banner-slider__button-prev"
    }
});

// Section glasses slider functional

new Swiper('.glasses-slider', {
    spaceBetween: 30,
    speed: 500,
    loop: true,
    autoplay: true,
    navigation: {
        nextEl: ".glasses-slider__button-next",
        prevEl: ".glasses-slider__button-prev"
    },

    breakpoints: {
        680: {
            slidesPerView: 3
        },

        920: {
            slidesPerView: 4
        },

        1240: {
            slidesPerView: 5
        },
    }
});

// Section similar products slider functional

new Swiper('.similar-products-slider', {
    spaceBetween: 30,
    speed: 500,
    loop: true,
    autoplay: true,
    navigation: {
        nextEl: ".similar-products-slider__button-next",
        prevEl: ".similar-products-slider__button-prev"
    },

    breakpoints: {
        680: {
            slidesPerView: 2
        },

        920: {
            slidesPerView: 2
        },

        1240: {
            slidesPerView: 4
        },
    }
});

// Single page slider
$(document).ready(function () {
    var productSlider = new Swiper('.product-slider', {
        nextButton: '.single-page-swiper-next-btn',
        prevButton: '.single-page-swiper-prev-btn',
        spaceBetween: 10

    });
    var productThumbs = new Swiper('.product-thumbs', {
        spaceBetween: 10,
        centeredSlides: true,
        slidesPerView: 5,
        touchRatio: 0.2,
        slideToClickedSlide: true,
        direction: 'vertical',
        breakpoints: {
            992: {
                direction: 'horizontal'
            }
        }
    });
    productSlider.params.control = productThumbs;
    productThumbs.params.control = productSlider;
});

const filters = document?.querySelectorAll(".sidebar .aside-wrapper .w-block");

filters.forEach(function (filter) {
    const title = filter.querySelector(".title_custom");
    title.addEventListener("click", function () {
        filter.classList.toggle('active');
    });
});

const filterDrop = document?.querySelectorAll(".sidebar .aside-wrapper");

filterDrop.forEach(function (filterDrop) {
    const title = filterDrop.querySelector(".filter-column__title");
    title.addEventListener("click", function () {
        filterDrop.classList.toggle('active');
    });
});


// Burger Functional

const burger = document?.querySelector('.header__burger');
const nav = document?.querySelector('.navbar');
const navItems = nav?.querySelectorAll('a');

burger?.addEventListener('click', () => {
    burger?.classList.toggle('header__burger_active');
    nav?.classList.toggle('navbar_active');
    $('header').toggleClass('header_active');
    $('body').toggleClass('body_lock');
    // if (window.innerWidth <= 1200 && window.innerWidth > 768) {
    //     document.querySelector('.navbar_active')
    //         .append(document.querySelector('.aut'));
    // }
});

navItems.forEach(el => {
    el.addEventListener('click', () => {
        burger?.classList.remove('header__burger_active');
        nav?.classList.remove('navbar_active')
        $('body').toggleClass('body_lock');
        $('header').toggleClass('header_active');
    });
});

if(window.innerWidth < 575) {
    document.querySelector('.right-block').append(burger);
}

document.querySelector('.shadow').addEventListener('click', () => {
    burger?.classList.remove('header__burger_active');
    nav?.classList.remove('navbar_active')
    $('body').toggleClass('body_lock');
    $('header').toggleClass('header_active');
});
// Dropdown menu functional

// const catalogArrow = document?.querySelector('header .nav__list .menu-item-has-children > a:before')
// const catalogDropdown = document?.querySelector('.header .nav__list .menu-item-has-children .sub-menu')
//
// catalogArrow?.addEventListener('click', () => {
//     catalogArrow?.classList.toggle("active")
//     catalogDropdown?.classList.toggle("open")
// });


const numbersArrow = document?.querySelector('.numbers__dropdown-menu-arrow')
const numbersDropdown = document?.querySelector('.dropdown-numbers')

numbersArrow?.addEventListener('click', () => {
    numbersArrow?.classList.toggle("active")
    numbersDropdown?.classList.toggle("open")
});

$('.buy-button a').click(function () {
    $('[type="hidden"]').val($(this).data('name'));
});

$(document).ready(function () {

    $('.catalog-tabs-link').click(function () {
        var link_data = $(this).data('link');
        $('.link').attr('href', link_data);
    });
    var buttonUp = $(".up-button");
    var scrollChange = 500;
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();

        if (scroll >= scrollChange) {
            buttonUp.addClass('fixed');
        } else {
            buttonUp.removeClass("fixed");
        }
    });

    $('[data-toggle="modal"]').click(function () {
        $('[type="hidden"][name="text-954"]').val($(this).data('title'));
        $('[type="hidden"][name="vin-code"]').val($(this).data('vin'));
        $('[type="hidden"][name="equipment"]').val($(this).data('equipment'));
    });

    // var wpcf7Elm = document.querySelector( '.wpcf7' );
    $('.wpcf7').on('wpcf7mailsent', function () {
        setTimeout(function () {
            $('.main-modal-form').hide();
            $('.modal-backdrop').hide();
            $('body').removeClass('modal-open');
            $('.drive-modal-form').hide();
            $('.modal').removeClass('show');
        }, 2000);
    });

    const singleForm = document.querySelector('.single-form .wpcf7-form');
    const homeUrl = document.querySelector('.header__logo a').href;

    if(singleForm) {
        singleForm.addEventListener( 'wpcf7mailsent', function( event ) {
            setTimeout(() => location.assign(homeUrl), 1000);
        }, false );
    }


    //RemoveClasses
    function removeClasses(el, class_name) {
        for (var i = 0; i < el.length; i++) {
            el[i].classList.remove(class_name);
        }
    }

    // single tabs
    const singleTabs = document.querySelectorAll('.section-product .description-block .column-title');
    const singleTabsContent = document.querySelectorAll('.section-product .description-block .table ')
    singleTabs.forEach((item, i) => {
        item.addEventListener('click', e => {
            removeClasses(singleTabs, "active");
            item.classList.add("active");
            removeClasses(singleTabsContent, "active");
            singleTabsContent[i].classList.add('active');
        });
    })

    const chooseCarSelect = document.querySelector('.wpcf7-select[name="choose-car"]');
    const chooseTimeSelect = document.querySelector('.wpcf7-select[name="choose-time"]');
    const hiddenDriveModalInput = document.querySelector('.wpcf7-hidden[name="text-555"]');
    const hiddenVinCodeModalInput = document.querySelector('.wpcf7-hidden[name="vin-code"]');
    const hiddenEquipmentModalInput = document.querySelector('.wpcf7-hidden[name="equipment"]');

    const hiddenPostsTitles = document.querySelectorAll('.hidden-posts-title');
    const hiddenPostsVinCodes = document.querySelectorAll('.hidden-posts-vincode');
    const hiddenPostsEquipment = document.querySelectorAll('.hidden-posts-equipment');

    if (hiddenDriveModalInput) {
        hiddenDriveModalInput.value = "Запис на тест-драйв";
    }

    hiddenPostsTitles.forEach(title => {
        const option = document.createElement('option');
        option.text = title.textContent.trim();
        if (chooseCarSelect)
            chooseCarSelect.add(option);
    });

    chooseCarSelect?.addEventListener('change', () => {
        hiddenVinCodeModalInput.value = hiddenPostsVinCodes[chooseCarSelect.selectedIndex - 1].textContent.trim();
        hiddenEquipmentModalInput.value = hiddenPostsEquipment[chooseCarSelect.selectedIndex - 1].textContent.trim();
    })



    if(chooseTimeSelect) {
        for (let hour = 10; hour <= 17; hour++) {
            if (hour < 17) {
                for (let minute of ['00', '30']) {
                    const option = document.createElement('option');
                    option.text = `${hour}:${minute}`;

                    chooseTimeSelect.add(option);
                }
            } else {
                const option = document.createElement('option');
                option.text = `${hour}:00`;
                chooseTimeSelect.add(option);
            }
        }
    }


    const openConsultModalBtn = document.querySelectorAll('[data-target="#consultation-modal"]');
    const openBuyModalBtn = document.querySelectorAll('.buy-modal-btn[data-target="#buy-modal"]');

    const mainFormTitle = document.querySelector('.main-modal-form .form__title');
    const orderFormTitle = document.querySelector('.order-modal-form .form__title');

    const hiddenInputFormTitle = document.querySelector('.wpcf7-hidden[name="text-956"]');
    const hiddenInput = document.querySelector('.wpcf7-hidden[name="text-758"]');
    const hiddenInputStatus = document.querySelector('.wpcf7-hidden[name="text-950"]');

    const hiddenOrderInput = document.querySelector('.order-modal-form .wpcf7-hidden');
    const regModalHiddenInput = document.querySelector('#registration-modal .wpcf7-hidden[name="text-100"]');

    if (regModalHiddenInput) {
        regModalHiddenInput.value = "Заявка на дилерство";
    }

    openBuyModalBtn.forEach((btn, i) => {
        btn.setAttribute("data-target", "#buy-modal");
        btn.addEventListener('click', e => {
            mainFormTitle.innerHTML = "Придбати авто";
            hiddenInputFormTitle.value = mainFormTitle.textContent;
            hiddenInputStatus.value = document.querySelectorAll('.availability-text')[i].textContent.trim();
        });
    })

    if(hiddenOrderInput) {
        hiddenOrderInput.value = orderFormTitle.textContent.trim();
    }

    if(hiddenOrderInput) {
        openConsultModalBtn.forEach((btn, i) => {
            btn.addEventListener('click', e => {
                if (!btn.classList.contains('buy-modal-btn')) {
                    mainFormTitle.textContent = "Замовити консультацію";
                    hiddenInput.value = mainFormTitle.textContent.trim();
                }
                hiddenOrderInput.value = orderFormTitle.textContent.trim();
            });
        })
    }
});

