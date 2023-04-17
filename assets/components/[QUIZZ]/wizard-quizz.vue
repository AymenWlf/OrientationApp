<script>
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
                quizz: [
                    {
                        question: "T beau ?",
                        choix: null
                    },
                    {
                        question: "T mechant ?",
                        choix: null
                    },
                    {
                        question: "T null ?",
                        choix: null
                    },
                ]
            },
            settings: {
                isStarted: false,
                done: false
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
            } else {
                this.settings.done = true;
                this.$emit('update-is-done', true);
                console.log(this.ressources.quizz);
            }

            window.scrollTo(0, 0);
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
                                    :searchable="true" :options="['aymen', 'oyejd']" />
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
                        <div v-for="(el, i) in ressources.quizz" :key="i" class="mt-5 tab-pane fade show active"
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
                                    <b-col lg="6">
                                        <b-form-group :id="'qst' + i" class="my-1" :label="el.question">
                                            <b-form-radio v-model="el.choix" :name="'quizz-radio' + i"
                                                value="Oui">Oui</b-form-radio>
                                            <b-form-radio v-model="el.choix" :name="'quizz-radio' + i"
                                                value="Non">Non</b-form-radio>
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
                        <span class="float-end text-success"><b>100%</b></span>
                        <h6 class="card-title mb-0">
                            Quality Forcast
                            <b-badge variant="success" class="align-middle fs-10">Excellent</b-badge>
                        </h6>
                    </b-card-header>
                    <b-card-body>
                        <p class="card-text">They all have something to say beyond the words on the page. They
                            can come across as casual or neutral, exotic or graphic. Cosby sweater eu banh mi,
                            qui irure terry richardson ex squid.</p>
                        <div class="text-end">
                            <b-link href="javascript:void(0);" class="link-success fw-medium">
                                Read More
                                <i class="ri-arrow-right-line align-middle"></i>
                            </b-link>
                        </div>
                    </b-card-body>
                </b-card>
            </b-col>
            <b-col xxl="4">
                <b-card no-body class="border card-border-warning">
                    <b-card-header>
                        <span class="float-end text-warning"><b>75%</b></span>
                        <h6 class="card-title mb-0">
                            Handle to Forcast
                            <span class="badge bg-warning text-light align-middle fs-10">Medium</span>
                        </h6>
                    </b-card-header>
                    <b-card-body>
                        <p class="card-text">Whether article spirits new her covered hastily sitting her. Money
                            witty books nor son add build on the card Chicken age had evening believe but
                            proceed pretend mrs.</p>
                        <div class="text-end">
                            <b-link href="javascript:void(0);" class="link-warning fw-medium">
                                Read More
                                <i class="ri-arrow-right-line align-middle"></i>
                            </b-link>
                        </div>
                    </b-card-body>
                </b-card>
            </b-col>
            <b-col xxl="4">
                <b-card no-body class="border card-border-danger">
                    <b-card-header>
                        <span class="float-end text-danger"><b>40%</b></span>
                        <h6 class="card-title mb-0">
                            Handle to Forcast
                            <b-badge variant="danger" class="align-middle fs-10">Poor</b-badge>
                        </h6>
                    </b-card-header>
                    <b-card-body>
                        <p class="card-text">Whether article spirits new her covered hastily sitting her. Money
                            witty books nor son add build on the card Chicken age had evening believe but
                            proceed pretend mrs.</p>
                        <div class="text-end">
                            <b-link href="javascript:void(0);" class="link-danger fw-medium">
                                Read More
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
                        rows="10" max-rows="20"></b-form-textarea>
                </div>

                <div class="d-flex align-items-start gap-3 mt-4">
                    <b-button type="button" variant="success" class="btn-label right ms-auto nexttab nexttab"
                        data-nexttab="pills-info-desc-tab"><i
                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Envoyer</b-button>
                </div>
            </b-col>
        </b-row>
    </template>
</template>
