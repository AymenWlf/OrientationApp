<script>
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
export default {
    name: "WizardQuizz",
    components: {
        Multiselect
    },
    data() {
        return {
            datas: {
                email: null,
                prenom: null,
                nom: null,
                tel: null,
                type_bac: null
            }
        };
    },
};
</script>

<template>
    <b-card id="Quizz" no-body>
        <b-card-header>
            <b-card-title class="mb-0">Test de personalité</b-card-title>
        </b-card-header>
        <b-card-body>
            <form action="#" class="form-steps" autocomplete="off">
                <div class="text-center pt-3 pb-4 mb-1">
                    <h5>Test de personalité</h5>
                </div>
                <div id="custom-progress-bar" class="progress-nav mb-4">
                    <div class="progress" style="height: 1px">
                        <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>

                    <ul class="nav nav-pills progress-bar-tab custom-nav" role="tablist">
                        <li class="nav-item" role="presentation">
                            <b-button pill variant="link" class="nav-link active" data-progressbar="custom-progress-bar"
                                id="pills-gen-info-tab" type="button" role="tab">1</b-button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pills-gen-info">
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
                            <b-button type="button" variant="success" class="btn-label right ms-auto nexttab nexttab"
                                data-nexttab="pills-info-desc-tab"><i
                                    class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Commencer
                                !</b-button>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-info-desc" role="tabpanel" aria-labelledby="pills-info-desc-tab">
                        <div>
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto mb-2">
                                    <img src="../../styles/images/users/user-dummy-img.jpg"
                                        class="rounded-circle avatar-lg img-thumbnail user-profile-image"
                                        alt="user-profile-image" />
                                    <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                        <input id="profile-img-file-input" type="file" class="profile-img-file-input"
                                            accept="image/png, image/jpeg" />
                                        <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                            <span class="avatar-title rounded-circle bg-light text-body">
                                                <i class="ri-camera-fill"></i>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <h5 class="fs-14">Add Image</h5>
                            </div>
                            <div>
                                <label class="form-label" for="gen-info-description-input">Description</label>
                                <textarea class="form-control" placeholder="Enter Description"
                                    id="gen-info-description-input" rows="2" required></textarea>
                                <div class="invalid-feedback">Please enter a description</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-3 mt-4">
                            <b-button variant="link" type="button" class="text-decoration-none btn-label previestab"
                                data-previous="pills-gen-info-tab"><i
                                    class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>
                                Back to General</b-button>
                            <b-button type="button" variant="success" class="btn-label right ms-auto nexttab nexttab"
                                data-nexttab="pills-success-tab"><i
                                    class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</b-button>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-success" role="tabpanel" aria-labelledby="pills-success-tab">
                        <div>
                            <div class="text-center">
                                <div class="mb-4">
                                    <lottie colors="primary:#0ab39c,secondary:#405189" :options="defaultOptions"
                                        :height="120" :width="120" />
                                </div>
                                <h5>Well Done !</h5>
                                <p class="text-muted">You have Successfully Signed Up</p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </b-card-body>
    </b-card>
</template>
