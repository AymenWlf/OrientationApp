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
                            question: "Aimez-vous résoudre des problèmes complexes?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous créatif/ve?",
                            choix: null
                        },
                        {
                            question: "Aimez-vous travailler avec des ordinateurs et des technologies?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous intéressé/e par la compréhension des phénomènes physiques?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous curieux/se de savoir comment les choses fonctionnent?",
                            choix: null
                        },
                        {
                            question: "Aimez-vous faire des expériences scientifiques?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous intéressé/e par les mathématiques et les statistiques?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous capable de penser de manière analytique?",
                            choix: null
                        },
                        {
                            question: "Avez-vous un bon sens de l'observation?",
                            choix: null
                        },
                        {
                            question: "Avez-vous un fort désir d'apprendre de nouvelles choses?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous capable de travailler en équipe?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une forte éthique de travail?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous doué/e pour la communication?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous intéressé/e par les enjeux économiques et financiers?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous doué/e pour la résolution de problèmes logiques?",
                            choix: null
                        },
                        {
                            question: "Aimez-vous travailler avec des chiffres?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous intéressé/e par les lois et la justice?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous doué/e pour la négociation et la persuasion?",
                            choix: null
                        },
                        {
                            question: "Avez-vous une passion pour l'entrepreneuriat et la création d'entreprise?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous capable de travailler sous pression et de respecter des délais serrés?",
                            choix: null
                        }
                    ],
                    sm_a_b: [
                        {
                            question: "Les mathématiques et la résolution de problèmes complexes vous passionnent-elles?",
                            choix: null
                        },
                        {
                            question: "Trouvez-vous les domaines des sciences et technologies stimulants et captivants?",
                            choix: null
                        },
                        {
                            question: "L'idée de concevoir, construire et analyser des systèmes techniques en tant qu'ingénieur vous attire-t-elle?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous curieux d'apprendre la programmation informatique et de développer des solutions technologiques?",
                            choix: null
                        },
                        {
                            question: "La physique et la compréhension des lois qui gouvernent notre univers vous intéressent-elles?",
                            choix: null
                        },
                        {
                            question: "L'étude de l'économie, des marchés et des politiques économiques vous semble-t-elle passionnante?",
                            choix: null
                        },
                        {
                            question: "Aimeriez-vous apprendre la gestion d'entreprise, les ressources humaines et les stratégies de leadership?",
                            choix: null
                        },
                        {
                            question: "Le droit, la régulation et la résolution de conflits juridiques vous captivent-ils?",
                            choix: null
                        },
                        {
                            question: "Appréciez-vous travailler en équipe sur des projets scientifiques, technologiques ou techniques?",
                            choix: null
                        },
                        {
                            question: "Aimeriez-vous résoudre des problèmes réels en utilisant les mathématiques et les modèles mathématiques?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous intéressé par l'analyse et la visualisation de données pour en tirer des conclusions pertinentes?",
                            choix: null
                        },
                        {
                            question: "Aimez-vous comprendre et appliquer les dernières avancées technologiques?",
                            choix: null
                        },
                        {
                            question: "Souhaitez-vous travailler sur des défis concrets liés à l'énergie, l'environnement ou les transports?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous passionné par l'application des mathématiques dans divers domaines, tels que la biologie ou la chimie?",
                            choix: null
                        },
                        {
                            question: "Souhaitez-vous comprendre le fonctionnement des marchés financiers et le rôle de la politique économique?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous intéressé par l'organisation et la gestion de projets pour atteindre des objectifs spécifiques?",
                            choix: null
                        },
                        {
                            question: "Les questions juridiques, la régulation et la législation vous passionnent-elles?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous prêt à relever des défis et à apprendre continuellement dans le domaine que vous choisirez?",
                            choix: null
                        },
                        {
                            question: "Souhaitez-vous contribuer à la recherche et au développement dans votre domaine d'études futur?",
                            choix: null
                        },
                        {
                            question: "Êtes-vous intéressé par l'étude des algorithmes, des structures de données et de la complexité computationnelle pour résoudre des problèmes informatiques?",
                            choix: null
                        }
                    ]
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
                }
            },
            settings: {
                isStarted: false,
                done: false,
                test: true,
                quizz: null,
                typesBac: [
                    'Sciences Physiques et Chimiques',
                    'Sciences Mathématiques A et B'
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
