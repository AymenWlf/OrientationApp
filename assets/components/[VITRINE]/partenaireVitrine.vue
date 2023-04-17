<script>
import SwiperCore, { Thumbs, Navigation, Pagination } from "swiper";
import { Swiper, SwiperSlide } from "swiper/vue";
import "swiper/swiper-bundle.css";
SwiperCore.use([Thumbs, Navigation, Pagination]);
export default {
  name: "PartenaireVitrine",
  components: {
    Swiper,
    SwiperSlide,
  },
};
</script>

<template>
  <!-- start client section -->
  <div class="pt-5 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="text-center mt-5">
            <h5 class="fs-20">
              En
              <span class="text-primary text-decoration-underline">partenariat</span> avec
            </h5>
            <div class="trusted-client-slider mt-sm-5 mt-4 mb-sm-5 mb-4">
              <swiper class="swiper responsive-swiper rounded gallery-light pb-4" :loop="true" :slidesPerView="1"
                :spaceBetween="10" :pagination="{
                  el: '.swiper-pagination',
                  clickable: true,
                }" :breakpoints="{
  640: {
    slidesPerView: 2,
    spaceBetween: 20,
  },
  768: {
    slidesPerView: 2,
    spaceBetween: 40,
  },
  1200: {
    slidesPerView: 2,
    spaceBetween: 50,
  },
}">Z
                <swiper-slide>
                  <div class="swiper-slide">
                  <div class="client-images">
                    <!-- <img
                        src="../../styles/images/notaires-ma.png"
                        alt="client-img"
                          class="mx-auto img-fluid d-block"
                        /> -->
                    </div>
                  </div>
                </swiper-slide>
                <!-- end slide item -->
                <swiper-slide>
                  <div class="swiper-slide">
                    <div class="client-images">
                      <!-- <img
                          src="../../styles/images/LPRI-logo.jpeg"
                          alt="client-img"
                          class="mx-auto img-fluid d-block"
                        /> -->
                    </div>
                  </div>
                </swiper-slide>
                <!-- end slide item -->
              </swiper>
            </div>
          </div>
        </div>
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </div>
  <!-- end client section -->
</template>
