<script>
import WizardQuizz from "../[QUIZZ]/wizard-quizz.vue";

export default {
  name: "HeroVitrine",
  components: { WizardQuizz },
};
</script>

<template>
  <!-- start hero section -->
  <section class="section pb-5 hero-section mb-5" id="hero">
    <div class="bg-overlay bg-overlay-pattern"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10 col-sm-10">
          <div class="text-center pt-5 pt-md-3">
            <h1 class="display-6 fw-semibold mb-3 lh-base">
              Découvrez votre filière idéale avec
              <span class="text-success">E-Tawjihi</span>
            </h1>
            <p class="lead text-muted lh-base">
              Testez votre personnalité et découvrez la filière d'études qui correspond le
              mieux à vos attentes grâce à notre quizz en
              <b>intelligence artificielle !</b>
            </p>
          </div>

          <div class="mt-5 mt-sm-0 pt-sm-5 mb-sm-n5 demo-carousel">
            <WizardQuizz />
          </div>
        </div>
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
    <div class="position-absolute start-0 end-0 bottom-0 hero-shape-svg">
      <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 0 1440 120">
        <g mask='url("#SvgjsMask1003")' fill="none">
          <path d="M 0,118 C 288,98.6 1152,40.4 1440,21L1440 140L0 140z"></path>
        </g>
      </svg>
    </div>
    <!-- end shape -->
  </section>
  <!-- end hero section -->
</template>
