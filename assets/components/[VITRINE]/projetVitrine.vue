<template>
  <!-- start projet -->
  <section class="section" id="projet">
    <b-container>
      <b-row class="align-items-center justify-content-lg-between justify-content-center gy-4">
        <b-col lg="5" sm="7">
          <div class="about-img-section mb-5 mb-lg-0 text-center">
            <b-card no-body class="rounded shadow-lg inquiry-box d-none d-lg-block">
              <b-card-body class="d-flex align-items-center">
                <div class="avatar-sm flex-shrink-0 me-3">
                  <div class="avatar-title bg-soft-secondary text-secondary rounded-circle fs-18">
                    <i class="ri-briefcase-2-line"></i>
                  </div>
                </div>
                <h5 class="fs-15 lh-base mb-0">Consulter <span class="text-secondary fw-semibold">145+</span>
                  établissement
                </h5>
              </b-card-body>
            </b-card>

            <b-card no-body class="feedback-box">
              <b-card-body class="d-flex shadow-lg">
                <div class="flex-shrink-0 me-3">
                  <img src="../../styles/images/users/avatar-10.jpg" alt="" class="avatar-sm rounded-circle">
                </div>
                <div class="flex-grow-1">
                  <h5 class="fs-14 lh-base mb-0">Tonya Noble</h5>
                  <p class="text-muted fs-11 mb-1">UI/UX Designer</p>

                  <div class="text-warning">
                    <i class="ri-star-s-fill"></i>
                    <i class="ri-star-s-fill"></i>
                    <i class="ri-star-s-fill"></i>
                    <i class="ri-star-s-fill"></i>
                    <i class="ri-star-s-line"></i>
                  </div>
                </div>
              </b-card-body>
            </b-card>
            <img src="../../styles/images/about.jpg" alt="" class="img-fluid mx-auto rounded-3" />
          </div>
        </b-col>
        <b-col lg="6">
          <div class="text-muted">
            <h1 class="mb-3 lh-base">Qu'est ce que <span class="text-primary">E-Tawjihi ?</span>
            </h1>
            <p class="ff-secondary fs-16 mb-2"><b>E-Tawjihi</b> est une plateforme intelligente d'orientation scolaire et
              professionnelle, qui a pour but d’aider l’élève à planifier son avenir scolaire et professionnel d’une
              manière efficace et personnalisée utilisant tout le pouvoir de l'intélligence artificielle.
            </p>
            <p class="ff-secondary fs-16">Nous comprenons qu'il peut être difficile pour les étudiants de trouver des
              informations fiables et actualisées sur les options de carrière et les établissements d'enseignement
              supérieurs. C'est pourquoi nous avons créé E-Tawjihi, une solution en ligne qui permet aux étudiants
              d'explorer différentes options de carrière, de découvrir des établissements d'enseignement, de comparer des
              programmes d'études et de trouver des réponses à leurs questions concernant leur avenir.
            </p>

            <div class="vstack gap-2 mb-4 pb-1">
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-2">
                  <div class="avatar-xs icon-effect">
                    <div class="avatar-title bg-transparent text-success rounded-circle h2">
                      <i class="ri-check-fill"></i>
                    </div>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <p class="mb-0">Intelligence artificielle</p>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-2">
                  <div class="avatar-xs icon-effect">
                    <div class="avatar-title bg-transparent text-success rounded-circle h2">
                      <i class="ri-check-fill"></i>
                    </div>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <p class="mb-0">Tests d'orientation</p>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-2">
                  <div class="avatar-xs icon-effect">
                    <div class="avatar-title bg-transparent text-success rounded-circle h2">
                      <i class="ri-check-fill"></i>
                    </div>
                  </div>
                </div>
                <div class="flex-grow-1">
                  <p class="mb-0">Liste des établissements supérieurs</p>
                </div>
              </div>
            </div>

            <div>
              <b-link href="#!" class="btn btn-primary">Find Your Jobs <i
                  class="ri-arrow-right-line align-bottom ms-1"></i></b-link>
            </div>
          </div>
        </b-col>

      </b-row>
    </b-container>
  </section>
  <!-- end projet -->
</template>

<script>
export default {
  name: "ProjetVitrine",
  components: {},
  methods: {},
};
</script>
