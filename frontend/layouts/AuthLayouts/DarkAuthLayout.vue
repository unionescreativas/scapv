<template>
    <div>
        <Loader />
        <section class="sign-in-page">
            <b-container class="bg-white mt-5 p-0">
                <div class="row no-gutters">
                    <div class="col-sm-6 align-self-center">
                        <div class="sign-in-from">
                            <nuxt />
                        </div>
                    </div>
                    <div class="col-sm-6 text-center">
                        <div class="sign-in-detail text-white" :style="'background: url(' + bgImageURL + ') no-repeat 0 0; background-size: cover;'">
                            <a class="sign-in-logo mb-5" href="javascript:void(0)"><img :src="logo" class="img-fluid" alt="logo"/></a>
                            <Slick :option="slickOptions">
                                <div class="item">
                                    <img :src="require('~/assets/images/login/login-1.png')" class="img-fluid mb-4" alt="logo" />
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                                <div class="item">
                                    <img :src="require('~/assets/images/login/login-1.png')" class="img-fluid mb-4" alt="logo" />
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                                <div class="item">
                                    <img :src="require('~/assets/images/login/login-1.png')" class="img-fluid mb-4" alt="logo" />
                                    <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                                </div>
                            </Slick>
                        </div>
                    </div>
                </div>
            </b-container>
        </section>
    </div>
</template>

<script>
import logo from "~/assets/images/logo-white.png";
import { vito } from "~/plugins/config/pluginInit";
import bgImage from "~/assets/images/login/login-2.jpg";

export default {
    name: "DarkAuthLayout",
    mounted() {
        vito.index();
        let body = document.querySelector("body");
        if ($("body").hasClass("dark")) {
            $("body").addClass("dark");
            $("body").removeClass("light");
        } else {
            $("body").addClass("dark");
            $("body").removeClass("light");
        }
    },
    data() {
        return {
            slickOptions: {
                slidesToShow: 1,
                arrows: false,
                dots: false
            },
            logo: logo,
            bgImageURL: bgImage
        };
    }
};
</script>
