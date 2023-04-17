<script>
import { layoutComputed } from "../state/helpers";
import { SimpleBar } from "simplebar-vue3";

export default {
  components: {
    SimpleBar,
  },
  data() {
    return {
      settings: {
        minScrollbarLength: 60,
      },
    };
  },
  computed: {
    ...layoutComputed,
    layoutType: {
      get() {
        return this.$store ? this.$store.state.layout.layoutType : {} || {};
      },
    },
  },

  watch: {
    $route: {
      handler: "onRoutechange",
      immediate: true,
      deep: true,
    },
  },

  mounted() {
    if (document.querySelectorAll(".navbar-nav .collapse")) {
      let collapses = document.querySelectorAll(".navbar-nav .collapse");
      collapses.forEach((collapse) => {
        // Hide sibling collapses on `show.bs.collapse`
        collapse.addEventListener("show.bs.collapse", (e) => {
          e.stopPropagation();
          let closestCollapse = collapse.parentElement.closest(".collapse");
          if (closestCollapse) {
            let siblingCollapses = closestCollapse.querySelectorAll(".collapse");
            siblingCollapses.forEach((siblingCollapse) => {
              if (siblingCollapse.classList.contains("show")) {
                let aChild = siblingCollapse.parentNode.firstChild;
                if (aChild.hasAttribute("aria-expanded")) {
                  aChild.setAttribute("aria-expanded", "false");
                }
                siblingCollapse.classList.remove("show");
              }
            });
          } else {
            let getSiblings = (elem) => {
              // Setup siblings array and get the first sibling
              let siblings = [];
              let sibling = elem.parentNode.firstChild;
              // Loop through each sibling and push to the array
              while (sibling) {
                if (sibling.nodeType === 1 && sibling !== elem) {
                  siblings.push(sibling);
                }
                sibling = sibling.nextSibling;
              }
              return siblings;
            };
            let siblings = getSiblings(collapse.parentElement);
            siblings.forEach((item) => {
              if (item.childNodes.length > 2)
                item.firstElementChild.setAttribute("aria-expanded", "false");
              let ids = item.querySelectorAll("*[id]");
              ids.forEach((item1) => {
                let aChild = item1.parentNode.firstChild;
                if (aChild.hasAttribute("aria-expanded")) {
                  aChild.setAttribute("aria-expanded", "false");
                }
                item1.classList.remove("show");
                if (item1.childNodes.length > 2) {
                  let val = item1.querySelectorAll("ul li a");

                  val.forEach((subitem) => {
                    if (subitem.hasAttribute("aria-expanded"))
                      subitem.setAttribute("aria-expanded", "false");
                  });
                }
              });
            });
          }
        });

        // Hide nested collapses on `hide.bs.collapse`
        collapse.addEventListener("hide.bs.collapse", (e) => {
          e.stopPropagation();
          let childCollapses = collapse.querySelectorAll(".collapse");
          childCollapses.forEach((childCollapse) => {
            let childCollapseInstance = childCollapse;
            childCollapseInstance.hide();
          });
        });
      });
    }
  },

  methods: {
    onRoutechange(ele) {
      this.initActiveMenu(ele.path);
      if (document.getElementsByClassName("mm-active").length > 0) {
        const currentPosition = document.getElementsByClassName("mm-active")[0].offsetTop;
        if (currentPosition > 500)
          if (this.$refs.isSimplebar)
            this.$refs.isSimplebar.value.getScrollElement().scrollTop =
              currentPosition + 300;
      }
    },

    initActiveMenu(ele) {
      setTimeout(() => {
        if (document.querySelector("#navbar-nav")) {
          let a = document
            .querySelector("#navbar-nav")
            .querySelector('[href="' + ele + '"]');

          if (a) {
            a.classList.add("active");
            let parentCollapseDiv = a.closest(".collapse.menu-dropdown");
            if (parentCollapseDiv) {
              parentCollapseDiv.classList.add("show");
              parentCollapseDiv.parentElement.children[0].classList.add("active");
              parentCollapseDiv.parentElement.children[0].setAttribute(
                "aria-expanded",
                "true"
              );
              if (parentCollapseDiv.parentElement.closest(".collapse.menu-dropdown")) {
                parentCollapseDiv.parentElement
                  .closest(".collapse")
                  .classList.add("show");
                if (
                  parentCollapseDiv.parentElement.closest(".collapse")
                    .previousElementSibling
                )
                  parentCollapseDiv.parentElement
                    .closest(".collapse")
                    .previousElementSibling.classList.add("active");
              }
            }
          }
        }
      }, 0);
    },
  },
};
</script>

<template>
  <div class="container-fluid">
    <div id="two-column-menu"></div>

    <template v-if="layoutType === 'twocolumn'">
      <SimpleBar class="navbar-nav" id="navbar-nav">
        <li class="menu-title">
          <span data-key="t-menu">MENU</span>
        </li>
        <li class="nav-item">
          <a
            class="nav-link menu-link"
            href="#sidebarDashboards"
            data-bs-toggle="collapse"
            role="button"
            aria-expanded="false"
            aria-controls="sidebarDashboards"
          >
            <i class="ri-dashboard-2-line"></i>
            <span data-key="t-dashboards"> Dashboard</span>
          </a>
          <div class="collapse menu-dropdown" id="sidebarDashboards">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <router-link
                  to="/app/dashboard/projects"
                  class="nav-link"
                  data-key="t-projects"
                >
                  Projects
                </router-link>
              </li>
            </ul>
          </div>
        </li>
      </SimpleBar>
    </template>

    <template v-else>
      <ul class="navbar-nav h-100" id="navbar-nav">
        <li class="menu-title">
          <span data-key="t-menu">MENU</span>
        </li>
        <li class="nav-item">
          <router-link class="nav-link menu-link" to="/app/dashboard/">
            <i class="mdi mdi-phone-classic"></i>
            <span data-key="t-dashboards">Tableau de bord</span>
          </router-link>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link menu-link" href="/#sidebarDashboards" data-bs-toggle="collapse" role="button"
            aria-expanded="false" aria-controls="sidebarDashboards">
            <i class="ri-dashboard-2-line"></i>
            <span data-key="t-dashboards">Tableau de bord</span>
          </a>
          <div class="collapse menu-dropdown" id="sidebarDashboards">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <router-link to="/app/dashboard/analytics" class="nav-link custom-abc" data-key="t-analytics">
                  Statistiques
                </router-link>
              </li>
            </ul>
          </div>
        </li> -->
        <li class="menu-title">
          <span data-key="t-menu">Notarial</span>
        </li>
        <li class="nav-item">
          <router-link class="nav-link menu-link" to="/app/rdv">
            <i class="mdi mdi-phone-classic"></i>
            <span data-key="t-rdv">Rendez-Vous</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link menu-link" to="/app/client">
            <i class="mdi mdi-account-box-multiple"></i>
            <span data-key="t-client">Clients</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link menu-link" to="/app/societe">
            <i class="mdi mdi-office-building"></i>
            <span data-key="t-societe">Sociétés</span>
          </router-link>
        </li>
        <li class="nav-item">
          <a
            class="nav-link menu-link"
            href="/#sidebarDossier"
            data-bs-toggle="collapse"
            role="button"
            aria-expanded="false"
            aria-controls="sidebarDossier"
          >
            <i class="mdi mdi-folder"></i>
            <span data-key="t-dossier">Dossiers</span>
          </a>
          <div class="collapse menu-dropdown" id="sidebarDossier">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <router-link
                  to="/app/dossier/consultation"
                  class="nav-link custom-abc"
                  data-key="t-consultation"
                >
                  Consultation
                </router-link>
              </li>
              <li class="nav-item">
                <router-link
                  to="/app/dossier/ouverture"
                  class="nav-link custom-abc"
                  data-key="t-consultation"
                >
                  Ouverture
                </router-link>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <router-link class="nav-link menu-link" to="/app/propriete">
            <i class="mdi mdi-home-city"></i>
            <span data-key="t-propriete">Propriétés</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link menu-link" to="/app/cdg">
            <i class="mdi mdi-bank"></i>
            <span data-key="t-cdg">Affaires CDG</span>
          </router-link>
        </li>
        <li class="menu-title">
          <span data-key="t-menu">Paramètres</span>
        </li>
        <li class="nav-item">
          <a
            class="nav-link menu-link"
            href="/#sidebarSettings"
            data-bs-toggle="collapse"
            role="button"
            aria-expanded="false"
            aria-controls="sidebarSettings"
          >
            <i class="ri-settings-3-line"></i>
            <span data-key="t-settings">Paramètres</span>
          </a>
          <div class="collapse menu-dropdown" id="sidebarSettings">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <router-link
                  to="/app/settings/profile"
                  class="nav-link custom-abc"
                  data-key="t-profile"
                >
                  Profile & Mot de passe
                </router-link>
              </li>
              <!-- <li class="nav-item">
                <router-link
                  to="/app/settings/collabs"
                  class="nav-link custom-abc"
                  data-key="t-collaborateur"
                >
                  Rôles
                  <span class="badge bg-warning badge-pill" data-key="t-new"
                    >Prochainement</span
                  >
                </router-link>
              </li> -->
            </ul>
          </div>
        </li>
      </ul>
    </template>
  </div>
  <!-- Sidebar -->
</template>
