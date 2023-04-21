<script>
import WizardQuizz from "../components/[QUIZZ]/wizard-quizz.vue";
import AboutVitrine from "../components/[VITRINE]/aboutVitrine.vue";
import ContactVitrine from "../components/[VITRINE]/contactVitrine.vue";
import CtaVitrine from "../components/[VITRINE]/ctaVitrine.vue";
import FaqVitrine from "../components/[VITRINE]/faqVitrine.vue";
import FonctionalitesVitrine from "../components/[VITRINE]/fonctionalitesVitrine.vue";
import FooterVitrine from "../components/[VITRINE]/footerVitrine.vue";
import HeaderVitrine from "../components/[VITRINE]/headerVitrine.vue";
import HeroVitrine from "../components/[VITRINE]/heroVitrine.vue";
import MobiliteVitrine from "../components/[VITRINE]/mobiliteVitrine.vue";
import NotarySearchVitrine from "../components/[VITRINE]/NotarySearchVitrine.vue";
import PartenaireVitrine from "../components/[VITRINE]/partenaireVitrine.vue";
import SearchHeroVitrine from "../components/[VITRINE]/searchHeroVitrine.vue";

export default {
  name: "Index",
  components: {
    HeaderVitrine,
    HeroVitrine,
    PartenaireVitrine,
    FooterVitrine,
    ContactVitrine,
    AboutVitrine,
    MobiliteVitrine,
    CtaVitrine,
    FonctionalitesVitrine,
    FaqVitrine,
    NotarySearchVitrine,
    SearchHeroVitrine,
    WizardQuizz,
  },
  data() {
    return {};
  },
};
</script>

<template>
  <div class="layout-wrapper landing">
    <!-- <HeaderVitrine /> -->
    <HeroVitrine />
    <!-- start cta -->
    <section class="py-5 bg-primary position-relative">
      <div class="bg-overlay bg-overlay-pattern opacity-50"></div>
      <div class="container">
        <div class="row align-items-center gy-4">
          <div class="col-sm">
            <div>
              <h4 class="text-white mb-0 fw-semibold">On a besoin de votre feedback !</h4>
            </div>
          </div>
          <!-- end col -->
          <div class="col-sm-auto">
            <div>
              <a target="_blank" href="https://www.instagram.com/e_tawjihi_ma/" class="btn bg-gradient btn-danger">Envoyer
                mon
                feedback</a>
            </div>
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </section>
    <!-- end cta -->
    <FooterVitrine />
  </div>
</template>
