<template>
    <client-only>
        <vue-slick :options="option">
            <slot />
        </vue-slick>
    </client-only>
</template>

<script>
export default {
    name: "Slick",
    components: {
        "vue-slick": () => import("vue-slick")
    },
    props: {
        option: {
            type: Object,
            default: () => {
                return {
                    centerMode: false,
                    centerPadding: "60px",
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    focusOnSelect: true,
                    responsive: [
                        {
                            breakpoint: 992,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: "30",
                                slidesToShow: 1
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                arrows: false,
                                centerMode: true,
                                centerPadding: "15",
                                slidesToShow: 1
                            }
                        }
                    ],
                    nextArrow: '<a href="javascript:void(0)" class="ri-arrow-left-s-line left"></a>',
                    prevArrow: '<a href="javascript:void(0)" class="ri-arrow-right-s-line right"></a>'
                };
            }
        }
    },
    data() {
        return {};
    }
};
</script>
