<script>
import { currentUser } from "../../state/helpers";
export default {
  name: "HeaderVitrine",
  components: {},
  computed: {
    ...currentUser,
    user: {
      get() {
        return this.$store ? this.$store.state.user.user : {} || {};
      },
    },
  },
  mounted() {
    window.addEventListener("scroll", function (ev) {
      ev.preventDefault();
      var navbar = document.getElementById("navbar");
      if (navbar) {
        if (document.body.scrollTop >= 50 || document.documentElement.scrollTop >= 50) {
          navbar.classList.add("is-sticky");
        } else {
          navbar.classList.remove("is-sticky");
        }
      }
    });
  },
};
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-landing fixed-top" id="navbar">
    <div class="container">
      <a class="navbar-brand" href="/#">
        <!-- <img
            src="../../styles/images/logo-nobg.png"
            class="card-logo card-logo-dark"
            alt="logo dark"
            height="35"
          />
          <img
            src="../../styles/images/logo-nobg.png"
            class="card-logo card-logo-light"
            alt="logo light"
            height="35"
          /> -->
      </a>
      <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <i class="mdi mdi-menu"></i>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
          <!-- <li class="nav-item">
              <a class="nav-link active" href="#search">Trouver un notaire</a>
            </li> -->
          <li class="nav-item">
            <a class="nav-link active2" href="#hero">Logiciel Notaire</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#fonctionalites">Fonctionalités</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#mobilite">Mobilité</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#faq">FAQ ?</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li>
        </ul>

        <div class="">
          <div class="btns-vitrine text-center my-3 my-sm-0">
            <a href="/login" class="btn btn-primary">Administration</a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!-- end navbar -->
</template>
