<script>
import axios from "axios";
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
export default {
    name: "WizardQuizz",
    components: {
        Multiselect
    },
    props: {
        IsDone: {
            type: Boolean,
            required: true,
            sync: true
        },
        Nom: {
            type: String,
            required: true,
            sync: true
        },
        Prenom: {
            type: String,
            required: true,
            sync: true
        }
    },
    data() {
        return {
            datas: {
                email: null,
                prenom: null,
                nom: null,
                tel: null,
                type_bac: null,
                message: null
            },
            ressources: {
                quizz: {
                    pc: [
                        {
                            question: "Êtes-vous intéressé(e) par les sciences ?",
                            choix: null,
                        },
                        {
                            question: "Préférez-vous les tâches qui nécessitent de la rigueur et de la précision ?",
                            choix: null,
                        },
                        {
                            question: "Aimez-vous travailler sur des projets à long terme ?",
                            choix: null,
                        },
                        {
                            question: "Avez-vous une passion pour l'environnement ?",
                            choix: null,
                        },
                        {
                            question: "Avez-vous une aptitude pour la résolution de problèmes complexes ?",
                            choix: null,
                        },
                        {
                            question: "Êtes-vous intéressé(e) par les défis de la santé ?",
                            choix: null,
                        },
                        {
                            question: "Êtes-vous attentif(ve) aux besoins des autres ?",
                            choix: null,
                        },
                        {
                            question: "Avez-vous une capacité d'écoute et de communication efficace ?",
                            choix: null,
                        },
                        {
                            question: "Aimez-vous apprendre sur les sujets liés à la médecine ?",
                            choix: null,
                        },
                        {
                            question: "Êtes-vous capable de travailler sous pression ?",
                            choix: null,
                        },
                        { question: "Aimez-vous aider les autres à résoudre leurs problèmes et à trouver des solutions ?", choix: null },
                        { question: "Êtes-vous doué(e) pour la gestion de projet et l'organisation ?", choix: null },
                        { question: "Avez-vous une passion pour la justice sociale et l'égalité ?", choix: null },
                        { question: "Êtes-vous à l'aise pour parler en public ?", choix: null },
                        { question: "Êtes-vous intéressé(e) par la recherche et l'exploration de nouvelles idées ?", choix: null },
                        { question: "Avez-vous une passion pour les technologies numériques ?", choix: null },
                        { question: "Êtes-vous intéressé(e) par les langues étrangères ?", choix: null },
                        { question: "Avez-vous des compétences en analyse financière et en planification budgétaire ?", choix: null },
                        { question: "Aimez-vous résoudre des problèmes complexes en utilisant la technologie ?", choix: null },
                        { question: "Avez-vous une passion pour l'innovation et les nouvelles technologies ?", choix: null }

                    ],
                    sm_a_b: [
                        {
                            question: "Êtes-vous intéressé(e) par les sciences ?",
                            choix: null
                        },
                        {
                            question: "Préférez-vous les tâches qui nécessitent de la rigueur et de la précision ?",
                            choix: null
                        },
                        {
                            question: "Aimez-vous travailler sur des projets à long terme ?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une passion pour l'environnement ?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une aptitude pour la résolution de problèmes complexes ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous intéressé(e) par les défis de la santé ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous attentif(ve) aux besoins des autres ?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une capacité d'écoute et de communication efficace ?",
                            choix: null
                        },
                        {
                            question: "Aimez-vous apprendre sur les sujets liés à la médecine ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous capable de travailler sous pression ?",
                            choix: null
                        },
                        {
                            question: "Aimez-vous aider les autres à résoudre leurs problèmes et à trouver des solutions ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous doué(e) pour la gestion de projet et l'organisation ?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une passion pour la justice sociale et l'égalité ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous à l'aise pour parler en public ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous intéressé(e) par la recherche et l'exploration de nouvelles idées ?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une passion pour les technologies numériques ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous intéressé(e) par les langues étrangères ?",
                            choix: null
                        },
                        {
                            question: "Avez-vous des compétences en analyse financière et en planification budgétaire ?",
                            choix: null
                        },
                        {
                            question: "Aimez-vous résoudre des problèmes complexes en utilisant la technologie ?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une passion pour l'innovation et les nouvelles technologies ?",
                            choix: null
                        }

                    ],
                    eco: [
                        {
                            question: "Êtes-vous intéressé(e) par les questions liées à l'argent et aux finances ?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une aptitude pour la gestion de projet et l'organisation ?",
                            choix: null
                        },
                        {
                            question: "Aimez-vous aider les autres à résoudre leurs problèmes et à trouver des solutions ?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une passion pour la justice sociale et l'égalité ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous à l'aise pour parler en public ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous intéressé(e) par le commerce et les affaires ?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une aptitude pour la vente et la négociation ?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une passion pour les nouvelles technologies et les réseaux sociaux ?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une passion pour l'innovation et la créativité ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous à l'aise pour travailler avec les chiffres ?",
                            choix: null
                        },
                        {
                            question: "Aimez-vous résoudre des problèmes complexes en utilisant les statistiques ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous intéressé(e) par la recherche et l'analyse de données ?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une aptitude pour la résolution de problèmes complexes ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous capable de travailler sous pression ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous à l'aise pour travailler en équipe ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous capable de prendre des décisions rapidement ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous capable de gérer des situations difficiles ?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous à l'aise pour travailler avec des clients ?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une aptitude pour la résolution de conflits ?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une passion pour les sciences économiques et la gestion ?",
                            choix: null
                        }
                    ],
                },
                resultat: {
                    prem: {
                        filliere: null,
                        perc: null,
                        desc: null
                    },
                    deux: {
                        filliere: null,
                        perc: null,
                        desc: null
                    },
                    trois: {
                        filliere: null,
                        perc: null,
                        desc: null
                    }
                },
            },
            settings: {
                isStarted: false,
                done: false,
                test: true,
                quizz: null,
                typesBac: [
                    'Sciences Physiques et Chimiques',
                    'Sciences Mathématiques A et B',
                    "Sciences Économiques"
                ]
            }
        };
    },
    methods: {
        checkInfoForm() {
            if (!this.settings.isStarted) {
                this.settings.isStarted = true;
                this.$emit('update-prenom', this.datas.prenom);
                this.$emit('update-nom', this.datas.nom);
                console.log(this.datas);

                //Quizz par type bac
                switch (this.datas.type_bac) {
                    case "Sciences Physiques et Chimiques":
                        this.settings.quizz = this.ressources.quizz.pc;
                        break;

                    case "Sciences Mathématiques A et B":
                        this.settings.quizz = this.ressources.quizz.sm_a_b;
                        break;

                    case "Sciences Économiques":
                        this.settings.quizz = this.ressources.quizz.eco;
                        break;

                    default:
                        break;
                }
                axios
                    .post("/api/dataUser", this.datas)
                    .then((res) => {
                        console.log(res.data);
                    });
            } else {
                this.settings.done = true;
                this.$emit('update-is-done', true);
                console.log(this.ressources.quizz);
                var formData = {
                    quizz: this.settings.quizz,
                    datas: this.datas
                }

                axios
                    .post("/api/results", formData)
                    .then((res) => {
                        console.log(res.data);
                        var result = this.ressources.resultat;
                        var cpt = 0;
                        res.data.forEach(el => {
                            console.log(el);
                            switch (cpt) {
                                case 0:
                                    result.prem.perc = el.perc;
                                    result.prem.filliere = el.filliere;
                                    result.prem.desc = el.desc;
                                    break;
                                case 1:
                                    result.deux.perc = el.perc;
                                    result.deux.filliere = el.filliere;
                                    result.deux.desc = el.desc;
                                    break;
                                case 2:
                                    result.trois.perc = el.perc;
                                    result.trois.filliere = el.filliere;
                                    result.trois.desc = el.desc;
                                    break;
                                default:
                                    break;
                            }
                            cpt++;
                        });

                    });
            }

            window.scrollTo(0, 0);
        },
        sendMessage() {
            if (this.datas.message == null) {
                this.$notify({
                    title: "Message invalid !",
                    text:
                        "Merci de remplir le champs feedback !",
                    type: "warn",
                    duration: 10000,
                });
                return;
            }
            axios
                .post("/api/sendMessage", this.datas)
                .then((res) => {
                    this.datas.message = null
                    this.$notify({
                        title: "Envoyé !",
                        text:
                            "Merci pour votre message !",
                        type: "success",
                        duration: 10000,
                    });
                    console.log(res.data);
                });
        }
    }
};
</script>

<template>
    <b-card v-if="!settings.done" id="Quizz" no-body>
        <b-card-header>
            <b-card-title class="mb-0 text-center">Test de personalité</b-card-title>
        </b-card-header>
        <b-card-body>
            <form v-on:submit.prevent="checkInfoForm" class="form-steps" autocomplete="off">
                <div class="tab-content">
                    <div v-if="!settings.isStarted" class="tab-pane fade show active" id="pills-gen-info">
                        <div>
                            <div class="mb-4">
                                <div>
                                    <h5 class="mb-1">Informations général</h5>
                                    <p class="text-muted">
                                        Nous avons besoin de vos informations pour personnalisé le Quizz
                                    </p>
                                </div>
                            </div>
                            <b-row>
                                <b-col lg="6">
                                    <div class="mb-3">
                                        <label class="form-label" for="prenom-input">Prénom</label>
                                        <input v-model="datas.prenom" type="text" class="form-control" id="prenom-input"
                                            placeholder="Votre prénom..." required />
                                        <div class="invalid-feedback">Donnez votre prénom !</div>
                                    </div>
                                </b-col>
                                <b-col lg="6">
                                    <div class="mb-3">
                                        <label class="form-label" for="nom-input">Nom</label>
                                        <input v-model="datas.nom" type="text" class="form-control" id="nom-input"
                                            placeholder="Votre nom..." required />
                                        <div class="invalid-feedback">Donnez votre nom !</div>
                                    </div>
                                </b-col>
                                <b-col lg="6">
                                    <div class="mb-3">
                                        <label class="form-label" for="email-input">Email</label>
                                        <input v-model="datas.email" type="email" class="form-control" id="email-input"
                                            placeholder="Votre adresse email..." required />
                                        <div class="invalid-feedback">Donnez une adresse email valid !</div>
                                    </div>
                                </b-col>
                                <b-col lg="6">
                                    <div class="mb-3">
                                        <label class="form-label" for="tel-input">Téléphone</label>
                                        <input v-model="datas.tel" type="tel" class="form-control" id="tel-input"
                                            placeholder="Votre numero de téléphone..." required />
                                        <div class="invalid-feedback">Donnez votre numero de téléphone !</div>
                                    </div>
                                </b-col>
                            </b-row>
                            <div class="mb-3">
                                <label class="form-label" for="bac-input">Type de votre BAC</label>
                                <Multiselect id="bac-input" required v-model="datas.type_bac" :close-on-select="true"
                                    :searchable="true" :options="settings.typesBac" />
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-3 mt-4">
                            <b-button type="submit" variant="success" class="btn-label right ms-auto nexttab nexttab"
                                data-nexttab="pills-info-desc-tab"><i
                                    class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Commencer
                                !</b-button>
                        </div>
                    </div>
                    <template v-else>
                        <div v-for="(el, i) in settings.quizz" :key="i" class="mt-5 tab-pane fade show active"
                            id="pills-gen-info">
                            <div>
                                <div class="mb-0">
                                    <div>
                                        <h5 class="mb-1">Question : {{ i + 1 }}</h5>
                                        <p class="text-muted">
                                            Choisissez oui ou non
                                        </p>
                                    </div>
                                </div>
                                <b-row>
                                    <b-col lg="12">
                                        <b-form-group :id="'qst' + i" class="my-1" :label="el.question">
                                            <b-form-radio required v-model="el.choix" :name="'quizz-radio' + i"
                                                value="1">Oui</b-form-radio>
                                            <b-form-radio required v-model="el.choix" :name="'quizz-radio' + i"
                                                value="0">Non</b-form-radio>
                                        </b-form-group>
                                    </b-col>
                                </b-row>
                            </div>
                        </div>

                        <div class="d-flex align-items-start gap-3 mt-4">
                            <b-button type="submit" variant="warning" class="btn-label right ms-auto nexttab nexttab"
                                data-nexttab="pills-info-desc-tab"><i
                                    class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Terminer</b-button>
                        </div>
                    </template>
                </div>
            </form>
        </b-card-body>
    </b-card>

    <template v-else>
        <b-row>
            <b-col xxl="4">
                <b-card no-body class="border card-border-success">
                    <b-card-header>
                        <span class="float-end text-success"><b>{{ ressources.resultat.prem.perc }}%</b></span>
                        <h6 class="card-title mb-0">
                            {{ ressources.resultat.prem.filliere }}
                            <b-badge variant="success" class="align-middle fs-10">Premier choix</b-badge>
                        </h6>
                    </b-card-header>
                    <b-card-body>
                        <p class="card-text">{{ ressources.resultat.prem.desc }}</p>
                        <div class="text-end">
                            <b-link target="_blank" href="https://www.instagram.com/e_tawjihi_ma/"
                                class="link-success fw-medium">
                                En savoir plus
                                <i class="ri-arrow-right-line align-middle"></i>
                            </b-link>
                        </div>
                    </b-card-body>
                </b-card>
            </b-col>
            <b-col xxl="4">
                <b-card no-body class="border card-border-warning">
                    <b-card-header>
                        <span class="float-end text-warning"><b>{{ ressources.resultat.deux.perc }}%</b></span>
                        <h6 class="card-title mb-0">
                            {{ ressources.resultat.deux.filliere }}
                            <span class="badge bg-warning text-light align-middle fs-10">Deuxième choix</span>
                        </h6>
                    </b-card-header>
                    <b-card-body>
                        <p class="card-text">{{ ressources.resultat.deux.desc }}</p>
                        <div class="text-end">
                            <b-link target="_blank" href="https://www.instagram.com/e_tawjihi_ma/"
                                class="link-warning fw-medium">
                                En savoir plus
                                <i class="ri-arrow-right-line align-middle"></i>
                            </b-link>
                        </div>
                    </b-card-body>
                </b-card>
            </b-col>
            <b-col xxl="4">
                <b-card no-body class="border card-border-danger">
                    <b-card-header>
                        <span class="float-end text-danger"><b>{{ ressources.resultat.trois.perc }}%</b></span>
                        <h6 class="card-title mb-0">
                            {{ ressources.resultat.trois.filliere }}
                            <b-badge variant="danger" class="align-middle fs-10">Troisième choix</b-badge>
                        </h6>
                    </b-card-header>
                    <b-card-body>
                        <p class="card-text">{{ ressources.resultat.trois.desc }}</p>
                        <div class="text-end">
                            <b-link target="_blank" href="https://www.instagram.com/e_tawjihi_ma/"
                                class="link-danger fw-medium">
                                En savoir plus
                                <i class="ri-arrow-right-line align-middle"></i>
                            </b-link>
                        </div>
                    </b-card-body>
                </b-card>
            </b-col>
        </b-row>

        <b-row>
            <b-col lg="12">
                <div class="mb-3">
                    <label class="form-label" for="prenom-input">Votre avis nous intéresse !</label>
                    <b-form-textarea id="textarea" v-model="datas.message"
                        placeholder="Avez-vous des recommandations à faire, des modifications ou une fonctionnalité qui vous intéresse pou améliorer notre plateforme E-TAWJIHI ?"
                        rows="5"></b-form-textarea>
                </div>

                <div class="d-flex align-items-start gap-3 mt-4">
                    <b-button @click="sendMessage()" type="button" variant="success"
                        class="btn-label right ms-auto nexttab nexttab" data-nexttab="pills-info-desc-tab"><i
                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Envoyer</b-button>
                </div>
            </b-col>
        </b-row>
    </template>
</template>
