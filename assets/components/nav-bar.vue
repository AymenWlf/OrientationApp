<script>
import { SimpleBar } from "simplebar-vue3";

// import { currentUser } from "../state/helpers";
import Notif from "./helpers/notif.vue";

/**
 * Nav-bar Component
 */

export default {
  data() {
    return {
      notifs: [
        {
          title: null,
          content: null,
          type: null,
          isRead: false,
          state: "info",
          created_at: Date(),
          updated_at: Date(),
          sender: null,
        },
      ],
    };
  },
  components: {
    SimpleBar,
    Notif,
  },

  methods: {
    toggleHamburgerMenu() {
      var windowSize = document.documentElement.clientWidth;

      if (windowSize > 767)
        document.querySelector(".hamburger-icon").classList.toggle("open");

      //For collapse horizontal menu
      if (document.documentElement.getAttribute("data-layout") === "horizontal") {
        document.body.classList.contains("menu")
          ? document.body.classList.remove("menu")
          : document.body.classList.add("menu");
      }

      //For collapse vertical menu
      if (document.documentElement.getAttribute("data-layout") === "vertical") {
        if (windowSize < 1025 && windowSize > 767) {
          document.body.classList.remove("vertical-sidebar-enable");
          document.documentElement.getAttribute("data-sidebar-size") == "sm"
            ? document.documentElement.setAttribute("data-sidebar-size", "")
            : document.documentElement.setAttribute("data-sidebar-size", "sm");
        } else if (windowSize > 1025) {
          document.body.classList.remove("vertical-sidebar-enable");
          document.documentElement.getAttribute("data-sidebar-size") == "lg"
            ? document.documentElement.setAttribute("data-sidebar-size", "sm")
            : document.documentElement.setAttribute("data-sidebar-size", "lg");
        } else if (windowSize <= 767) {
          document.body.classList.add("vertical-sidebar-enable");
          document.documentElement.setAttribute("data-sidebar-size", "lg");
        }
      }

      //Two column menu
      if (document.documentElement.getAttribute("data-layout") == "twocolumn") {
        document.body.classList.contains("twocolumn-panel")
          ? document.body.classList.remove("twocolumn-panel")
          : document.body.classList.add("twocolumn-panel");
      }
    },
    toggleMenu() {
      this.$parent.toggleMenu();
    },
    toggleRightSidebar() {
      this.$parent.toggleRightSidebar();
    },
    initDarkMode() {
      if (localStorage.getItem("darkMode") == "true") {
        document.documentElement.setAttribute("data-layout-mode", "dark");
      } else {
        document.documentElement.setAttribute("data-layout-mode", "light");
      }
    },
    initFullScreen() {
      document.body.classList.toggle("fullscreen-enable");
      if (
        !document.fullscreenElement &&
        /* alternative standard method */
        !document.mozFullScreenElement &&
        !document.webkitFullscreenElement
      ) {
        // current working methods
        if (document.documentElement.requestFullscreen) {
          document.documentElement.requestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) {
          document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullscreen) {
          document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
      } else {
        if (document.cancelFullScreen) {
          document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
          document.webkitCancelFullScreen();
        }
      }
    },
    toggleDarkMode() {
      if (document.documentElement.getAttribute("data-layout-mode") == "dark") {
        localStorage.setItem("darkMode", "false");
        document.documentElement.setAttribute("data-layout-mode", "light");
      } else {
        localStorage.setItem("darkMode", "true");
        document.documentElement.setAttribute("data-layout-mode", "dark");
      }
    },
  },
  computed: {
    ...currentUser,
    user: {
      get() {
        return this.$store ? this.$store.state.user.user : {} || {};
      },
    },
    loadingStatus: {
      get() {
        return this.$store ? this.$store.state.user.loadingStatus : {} || {};
      },
    },
  },
  mounted() {
    this.initDarkMode();
    document.addEventListener("scroll", function () {
      var pageTopbar = document.getElementById("page-topbar");
      if (pageTopbar) {
        document.body.scrollTop >= 50 || document.documentElement.scrollTop >= 50
          ? pageTopbar.classList.add("topbar-shadow")
          : pageTopbar.classList.remove("topbar-shadow");
      }
    });
    if (document.getElementById("topnav-hamburger-icon"))
      document
        .getElementById("topnav-hamburger-icon")
        .addEventListener("click", this.toggleHamburgerMenu);
  },
};
</script>

<template>
  <header id="page-topbar">
    <div class="layout-width">
      <div class="navbar-header">
        <div class="d-flex">
          <!-- LOGO -->
          <div class="navbar-brand-box horizontal-logo">
            <router-link to="/" class="logo logo-dark">
              <span class="logo-sm">
                <img src="../styles/images/logo-sm.png" alt="" height="22" />
              </span>
              <span class="logo-lg">
                <img src="../styles/images/logo.png" alt="" height="17" />
              </span>
            </router-link>

            <router-link to="/" class="logo logo-light">
              <span class="logo-sm">
                <img src="../styles/images/logo-sm.png" alt="" height="22" />
              </span>
              <span class="logo-lg">
                <img src="../styles/images/logo.png" alt="" height="17" />
              </span>
            </router-link>
          </div>

          <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
            id="topnav-hamburger-icon">
            <span class="hamburger-icon">
              <span></span>
              <span></span>
              <span></span>
            </span>
          </button>
        </div>

        <div class="d-flex align-items-center">
          <!-- <div class="dropdown d-md-none topbar-head-dropdown header-item">
                  <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                    id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-search fs-22"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">
                    <form class="p-3">
                      <div class="form-group m-0">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search ..."
                            aria-label="Recipient's username" />
                          <button class="btn btn-primary" type="submit">
                            <i class="mdi mdi-magnify"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div> -->

          <div class="ms-1 header-item d-none d-sm-flex">
            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
              data-toggle="fullscreen" @click="initFullScreen">
              <i class="bx bx-fullscreen fs-22"></i>
            </button>
          </div>

          <div class="ms-1 header-item d-none d-sm-flex">
            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode"
              @click="toggleDarkMode">
              <i class="bx bx-moon fs-22"></i>
            </button>
          </div>

          <Notif />

          <div class="dropdown ms-sm-3 header-item topbar-user">
            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <span class="d-flex align-items-center">
                <img class="rounded-circle header-profile-user" src="../styles/images/guest.png" alt="Header Avatar" />
                <span class="text-start ms-xl-2" v-if="!loadingStatus">
                  <!-- <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ user.lastname }} {{
                      user.firstname }}</span> -->
                  <!-- <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{ user.travail }}</span> -->
                </span>
                <div class="text-center" v-else>
                  <button class="btn btn-link btn-md text-success mt-2" type="button" id="loadmore">
                    <!---->
                    <div class="btn-content">
                      <i class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i>
                    </div>
                  </button>
                </div>
              </span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
              <!-- item-->
              <!-- <h6 class="dropdown-header">Bienvenu {{ user.lastname }}</h6> -->
              <!-- <router-link class="dropdown-item" to="/pages/profile"><i
                        class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                      <span class="align-middle">Profil</span>
                    </router-link>
                    <router-link class="dropdown-item" to="/pages/faqs"><i
                        class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i>
                      <span class="align-middle">Aide</span>
                    </router-link>
                    <div class="dropdown-divider"></div>
                    <router-link class="dropdown-item" to="/pages/profile-setting"><i
                        class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i>
                      <span class="align-middle">Paramètre</span>
                    </router-link>
                    <router-link class="dropdown-item" to="/auth/lockscreen-basic"><i
                        class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i>
                      <span class="align-middle">Verouiller</span>
                    </router-link> -->
              <a class="dropdown-item" href="/logout"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                <span class="align-middle" data-key="t-logout">Se déconnecter</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>
