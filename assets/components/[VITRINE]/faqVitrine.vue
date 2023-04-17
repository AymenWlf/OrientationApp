<script>
export default {
  name: "FaqVitrine",
  components: {},
};
</script>

<template>
  <!-- start faqs -->
  <section class="section" id="faq">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="text-center mb-5">
            <h3 class="mb-3 fw-semibold">Questions fréquemment posées</h3>
            <p class="text-muted mb-4 ff-secondary">
              Si vous ne trouvez pas de réponse à votre question, contactez-nous ! et nous
              vous répondrons dans les 48h
            </p>

            <div class="">
              <a
                href="mailto:contact@asversity.com"
                type="button"
                class="btn btn-primary btn-label rounded-pill"
                ><i
                  class="ri-mail-line label-icon align-middle rounded-pill fs-16 me-2"
                ></i
                >Nous envoyer un email</a
              >
            </div>
          </div>
        </div>
      </div>
      <!-- end row -->

      <div class="row g-lg-5 g-4">
        <div class="col-lg-12">
          <div class="d-flex align-items-center mb-2">
            <div class="flex-shrink-0 me-1">
              <i class="ri-question-line fs-24 align-middle text-success me-1"></i>
            </div>
            <div class="flex-grow-1">
              <h5 class="mb-0 fw-semibold">Questions Général</h5>
            </div>
          </div>
          <div
            class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box"
            id="genques-accordion"
          >
            <div class="accordion-item">
              <h2 class="accordion-header" id="genques-headingOne">
                <button
                  class="accordion-button"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#genques-collapseOne"
                  aria-expanded="true"
                  aria-controls="genques-collapseOne"
                >
                  Qui sommes-nous ?
                </button>
              </h2>
              <div
                id="genques-collapseOne"
                class="accordion-collapse collapse show"
                aria-labelledby="genques-headingOne"
                data-bs-parent="#genques-accordion"
              >
                <div class="accordion-body ff-secondary">
                  NotaryDesk est projet développé par la société technologique ASversity
                  basé sur Casablanca, fondé par deux jeunes entrepreneurs dotés d'une
                  vision innovante dans le domaine des technologies numériques
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="genques-headingTwo">
                <button
                  class="accordion-button collapsed"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#genques-collapseTwo"
                  aria-expanded="false"
                  aria-controls="genques-collapseTwo"
                >
                  Pourquoi NotaryDesk ?
                </button>
              </h2>
              <div
                id="genques-collapseTwo"
                class="accordion-collapse collapse"
                aria-labelledby="genques-headingTwo"
                data-bs-parent="#genques-accordion"
              >
                <div class="accordion-body ff-secondary">
                  NotaryDesk est un logiciel web accessible partout et facile à utiliser,
                  développer en collaboration de notaires connaissant les besoins du
                  domaine
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="genques-headingThree">
                <button
                  class="accordion-button collapsed"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#genques-collapseThree"
                  aria-expanded="false"
                  aria-controls="genques-collapseThree"
                >
                  Est-ce que c'est sécurisé ?
                </button>
              </h2>
              <div
                id="genques-collapseThree"
                class="accordion-collapse collapse"
                aria-labelledby="genques-headingThree"
                data-bs-parent="#genques-accordion"
              >
                <div class="accordion-body ff-secondary">
                  NotaryDesk est développé suivant les guides de sécurités des
                  applications WEB publiés par La Direction Générale De La Sécurité Des
                  Systèmes D'Information
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="genques-headingFour">
                <button
                  class="accordion-button collapsed"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#genques-collapseFour"
                  aria-expanded="false"
                  aria-controls="genques-collapseFour"
                >
                  Comment ça se passe l'installation ?
                </button>
              </h2>
              <div
                id="genques-collapseFour"
                class="accordion-collapse collapse"
                aria-labelledby="genques-headingFour"
                data-bs-parent="#genques-accordion"
              >
                <div class="accordion-body ff-secondary">
                  Après nous avoir contacté, un de nos commerciaux passe à votre cabinet
                  afin de vous faire tester l'application vous et vos collaborateurs, et
                  après concrétisation du contract, un formateur passera vous former à son
                  utilisation.
                </div>
              </div>
            </div>
          </div>
          <!--end accordion-->
        </div>
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end faqs -->
</template>
