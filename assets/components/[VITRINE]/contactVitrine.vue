<script>
import axios from "axios";
import helpersFunctions from "../../helpersFunctions/helpersFunctions.js";

export default {
  name: "ContactVitrine",
  data() {
    return {
      Constraints: {
        emailBlured: false,
        loading: false,
        success: false,
        error: false,
      },
      datas: {
        name: null,
        phone: null,
        subject: null,
        message: null,
        email: null,
      },
    };
  },
  created() {
    this.validEmail = helpersFunctions.validEmail;
  },
  components: {},
  methods: {
    submit: function () {
      if (!this.validEmail(this.datas.email)) {
        alert("email non valid !");
        return;
      }
      this.Constraints.loading = true;
      axios
        .post("/api/contact/push", this.datas)
        .then((res) => {
          this.Constraints.success = true;
        })
        .catch((error) => {
          this.Constraints.error = true;

          // error.response.status Check status code
        })
        .finally(() => {
          this.Constraints.loading = false;
          this.resetForm();
          //Perform action in always
        });
    },
    reset: function () {
      this.Constraints.success = false;
      this.Constraints.error = false;
    },
    resetForm: function () {
      this.datas.name = null;
      this.datas.email = null;
      this.datas.phone = null;
      this.datas.subject = null;
      this.datas.message = null;
      this.Constraints.emailBlured = false;
    },
  },
};
</script>

<template>
  <!-- Contact -->
  <section class="section" id="contact">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="text-center mb-5">
            <h2 class="mb-3 fw-semibold">Nous Contacter</h2>
            <p class="text-muted mb-4 ff-secondary">
              Nous sommes à votre service afin de répondre à tous vos questions
            </p>
          </div>
        </div>
      </div>
      <div class="row gy-4">
        <div class="col-lg-4">
          <div>
            <div class="mt-4">
              <h5 class="fs-13 text-muted text-uppercase">SIEGE SOCIAL:</h5>
              <div class="ff-secondary fw-semibold">
                39, Av Lalla yacout 1er etg centre ville Casablanca Maroc
              </div>
            </div>
            <div class="mt-4">
              <h5 class="fs-13 text-muted text-uppercase">TELEPHONES:</h5>
              <div class="ff-secondary fw-semibold">
                <a href="tel:+212687789595">06 87 78 95 95</a>
              </div>
              <div class="ff-secondary fw-semibold">
                <a href="tel:+212687789595">06 14 87 40 83</a>
              </div>
            </div>
            <div class="mt-4">
              <h5 class="fs-13 text-muted text-uppercase">EMAIL:</h5>
              <div class="ff-secondary fw-semibold">
                <a href="mailto:contact@asversity.com">contact@asversity.com</a>
              </div>
            </div>
            <div class="mt-4">
              <h5 class="fs-13 text-muted text-uppercase">HORAIRES D'OUVERTURES</h5>
              <div class="ff-secondary fw-semibold">de 9:00h à 18:00h</div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div>
            <form v-on:submit.prevent="submit" action="#">
              <div class="row">
                <div class="col-lg-6">
                  <div class="mb-4">
                    <label for="name" class="form-label fs-13">Nom</label><input @focus="reset()" name="name" id="name"
                      type="text" class="form-control bg-light border-light" placeholder="Votre Nom" required
                      v-model="datas.name" />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-4">
                    <label for="email" class="form-label fs-13">Email</label><input
                      @focus="Constraints.emailBlured = false && reset()" name="email" id="email" type="email"
                      placeholder="Votre Email" required v-model="datas.email" v-bind:class="{
                        'form-control': true,
                        'bg-light': true,
                        'border-light': true,
                        'is-invalid': Constraints.emailBlured && !validEmail(datas.email),
                      }" @blur="Constraints.emailBlured = true" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="mb-4">
                    <label for="subject" class="form-label fs-13">Sujet</label><input @focus="reset()" type="text"
                      class="form-control bg-light border-light" id="subject" name="subject" placeholder="Sujet" required
                      v-model="datas.subject" />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="mb-4">
                    <label for="phone" class="form-label fs-13">Téléphone</label><input @focus="reset()" type="text"
                      class="form-control bg-light border-light" id="phone" name="phone" placeholder="Téléphone" required
                      v-model="datas.phone" />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div class="mb-3">
                    <label for="comments" class="form-label fs-13">Message</label><textarea @focus="reset()"
                      name="comments" id="comments" rows="3" class="form-control bg-light border-light"
                      placeholder="Votre Message.." required v-model="datas.message" style="height: 107px"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12 text-end">
                  <span v-if="Constraints.loading" class="spinner-border flex-shrink-0" role="status"><span
                      class="visually-hidden">Loading...</span></span>
                  <input v-if="
                    !Constraints.success && !Constraints.error && !Constraints.loading
                  " type="submit" id="submit" name="send" class="submitBnt btn btn-primary" value="Envoyer" />
                  <div v-if="Constraints.error" class="alert alert-danger mb-xl-0" role="alert">
                    <strong>Erreur</strong>, Veuillez rafraichir la page et réessayer !
                    <!---->
                  </div>
                  <div v-if="Constraints.success" class="alert alert-success" role="alert">
                    <strong>Success</strong>, Votre message a été envoyer, vous aurez de
                    nos nouvelles très bientôt
                    <!---->
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact -->
</template>
