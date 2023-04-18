<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    // const TYPE_BAC = [
    //     "Sciences Expérimentales",
    //     "Sciences Mathématiques",
    //     "Sciences et Technologies",
    //     "Sciences et Technologies de l'Industrie et du Développement Durable",
    //     "Sciences Économiques",
    //     "Sciences de Gestion",
    //     "Lettres et Sciences Humaines",
    //     "Sciences et Technologies Électriques",
    //     "Sciences et Technologies Mécaniques",
    //     "Sciences et Technologies des Arts Appliqués",
    //     "Sciences et Technologies Agronomiques",
    //     "Baccalauréat Professionnel"
    // ];

    // const FILLIERE_PAR_BAC = [
    //     "Sciences Expérimentales" => [
    //         "Médecine",
    //         "Pharmacie",
    //         "Dentisterie",
    //         "Biologie",
    //         "Physique",
    //         "Chimie",
    //         "Mathématiques",
    //         "Sciences de la Terre",
    //         "Sciences Agronomiques",
    //         "Sciences et Technologies Électriques",
    //         "Sciences et Technologies Mécaniques",
    //         "Sciences et Technologies de l'Industrie et du Développement Durable"
    //     ],
    //     "Sciences Mathématiques" => [
    //         "Mathématiques",
    //         "Physique",
    //         "Chimie",
    //         "Informatique",
    //         "Sciences de la Terre",
    //         "Sciences et Technologies Électriques",
    //         "Sciences et Technologies Mécaniques",
    //         "Sciences et Technologies de l'Industrie et du Développement Durable"
    //     ],
    //     "Sciences et Technologies" => [
    //         "Informatique",
    //         "Génie Civil",
    //         "Génie Mécanique",
    //         "Génie Électrique",
    //         "Génie Industriel",
    //         "Génie Informatique",
    //         "Génie des Procédés",
    //         "Génie des Matériaux",
    //         "Génie Énergétique",
    //         "Sciences et Technologies Agronomiques",
    //         "Sciences et Technologies des Arts Appliqués"
    //     ],
    //     "Sciences et Technologies de l'Industrie et du Développement Durable" => [
    //         "Génie Civil",
    //         "Génie Mécanique",
    //         "Génie Électrique",
    //         "Génie Industriel",
    //         "Génie Informatique",
    //         "Génie des Procédés",
    //         "Génie des Matériaux",
    //         "Génie Énergétique",
    //         "Sciences et Technologies Agronomiques",
    //         "Sciences et Technologies des Arts Appliqués"
    //     ],
    //     "Sciences Économiques" => [
    //         "Économie",
    //         "Gestion",
    //         "Commerce",
    //         "Finance",
    //         "Marketing",
    //         "Management"
    //     ],
    //     "Sciences de Gestion" => [
    //         "Économie",
    //         "Gestion",
    //         "Commerce",
    //         "Finance",
    //         "Marketing",
    //         "Management"
    //     ],
    //     "Lettres et Sciences Humaines" => [
    //         "Lettres",
    //         "Langues",
    //         "Histoire",
    //         "Géographie",
    //         "Sociologie",
    //         "Philosophie",
    //         "Anthropologie",
    //         "Archéologie",
    //         "Communication"
    //     ],
    //     "Sciences et Technologies Électriques" => [
    //         "Électrotechnique",
    //         "Électronique",
    //         "Informatique",
    //         "Automatique",
    //         "Énergie"
    //     ],
    //     "Sciences et Technologies Mécaniques" => [
    //         "Mécanique",
    //         "Énergie",
    //         "Construction mécanique",
    //         "Conception et fabrication mécanique",
    //         "Maintenance industrielle"
    //     ],
    //     "Sciences et Technologies des Arts Appliqués" => [
    //         "Design graphique",
    //         "Design d'espace",
    //         "Design de produits",
    //         "Design textile",
    //         "Design de mode"
    //     ],
    //     "Sciences et Technologies Agronomiques" => [
    //         "Agronomie",
    //         "Agro-industrie",
    //         "Élevage",
    //         "Pêche et aquaculture",
    //         "Foresterie",
    //         "Environnement"
    //     ],
    //     "Baccalauréat Professionnel" => [
    //         "Génie"
    //     ]
    // ];

    const CATEGORIE_PAR_BAC = [
        "Sciences Mathématiques A et B" => ["Sciences et Technologies", "Sciences de l'Ingénieur", "Informatique", "Physique", "Économie", "Gestion", "Droit"],
        "Sciences Physiques et Chimiques" => ["Sciences et Technologies", "Sciences de l'Ingénieur", "Physique", "Chimie", "Électronique", "Informatique", "Économie", "Gestion", "Droit"],
        "Sciences de la Vie et de la Terre" => ["Sciences et Technologies", "Santé", "Sciences de l'Ingénieur", "Biologie", "Environnement", "Géologie", "Agriculture, Forêt et Environnement", "Économie", "Gestion", "Droit"],
        "Sciences Économiques" => ["Sciences Économiques et Gestion", "Droit et Sciences Politiques", "Économie Sociale et Solidaire", "Tourisme et Hôtellerie", "Communication et Marketing", "Ressources Humaines"],
        "Techniques de Gestion Comptable" => ["Sciences Économiques et Gestion", "Comptabilité", "Finance", "Gestion", "Droit et Sciences Politiques"],
        "Sciences Agronomiques" => ["Agriculture, Forêt et Environnement", "Sciences et Technologies", "Biologie", "Environnement", "Géologie", "Sciences de la Vie et de la Terre", "Économie", "Gestion", "Droit"],
        "Lettres et Sciences Humaines" => ["Langues et Lettres", "Sciences Humaines et Sociales", "Tourisme et Hôtellerie", "Communication et Marketing", "Éducation, Culture et Patrimoine"],
        "Langues et Communication" => ["Langues et Lettres", "Arts, Audiovisuel et Communication", "Tourisme et Hôtellerie", "Communication et Marketing", "Éducation, Culture et Patrimoine"],
        "Sciences et Technologies Électriques" => ["Sciences et Technologies", "Sciences de l'Ingénieur", "Électricité", "Électronique", "Informatique", "Économie", "Gestion", "Droit"],
        "Sciences et Technologies Mécaniques" => ["Sciences et Technologies", "Sciences de l'Ingénieur", "Mécanique", "Électronique", "Informatique", "Économie", "Gestion", "Droit"]
    ];

    const TYPE_BAC = [
        "Sciences Mathématiques A et B",
        "Sciences Physiques et Chimiques",
        "Sciences de la Vie et de la Terre",
        "Sciences Économiques",
        "Techniques de Gestion Comptable",
        "Sciences Agronomiques",
        "Lettres et Sciences Humaines",
        "Langues et Communication",
        "Sciences et Technologies Électriques",
        "Sciences et Technologies Mécaniques"
    ];

    const QST_1 = [
        "Aimez-vous résoudre des problèmes mathématiques complexes ?" => [2, 2, 0, 2, 0, 0, 0],
        "Êtes-vous intéressé par les mathématiques appliquées à l'économie et à la finance ?" => [2, 2, 0, 1, 0, 0, 0],
        "Avez-vous une curiosité pour la physique et la chimie ?" => [0, 0, 0, 2, 0, 0, 0],
        "Êtes-vous doué pour la programmation informatique ?" => [0, 2, 2, 0, 0, 0, 0],
        "Aimez-vous apprendre les langues étrangères et les cultures ?" => [0, 0, 0, 0, 0, 0, 2],
        "Êtes-vous intéressé par les phénomènes sociaux et les sciences humaines ?" => [0, 0, 0, 0, 2, 2, 0],
        "Êtes-vous créatif et intéressé par les arts ?" => [0, 0, 0, 0, 0, 2, 0],
        "Avez-vous une curiosité pour l'histoire et la géographie ?" => [0, 0, 0, 0, 2, 0, 0],
        "Aimez-vous les langues et les cultures étrangères ?" => [0, 0, 0, 0, 0, 0, 2],
        "Êtes-vous intéressé par l'économie et la finance ?" => [0, 1, 0, 0, 2, 2, 0],
        "Avez-vous une curiosité pour la biologie et la santé ?" => [0, 0, 0, 1, 0, 0, 0],
        "Êtes-vous doué pour la compréhension de textes juridiques complexes ?" => [0, 0, 0, 0, 0, 0, 2],
        "Aimez-vous les sciences politiques et les relations internationales ?" => [0, 0, 0, 2, 2, 0, 0],
        "Êtes-vous intéressé par les sciences de l'environnement et le développement durable ?" => [2, 0, 0, 0, 0, 0, 0],
        "Avez-vous une curiosité pour l'architecture et l'urbanisme ?" => [0, 0, 0, 0, 0, 0, 2]
    ];

    #[Route('/get/type_bac', name: 'get.typeBac', methods: ['GET'])]
    public function getTypeBac(): Response
    {

        return $this->json(self::TYPE_BAC, Response::HTTP_OK, []);
    }

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        $reponses = [1, 0, 1, 1, 0, 1, 1, 1, 0, 1, 0, 1, 0, 1, 0];
        $score = [0, 0, 0, 0, 0, 0, 0];
        $max = [0, 0, 0, 0, 0, 0, 0];
        $perc = [0, 0, 0, 0, 0, 0, 0];
        $cpt = 0;
        foreach (self::QST_1 as $qst => $resp) {
            if ($reponses[$cpt] == 1) {
                for ($i = 0; $i < count($score); $i++) {
                    $score[$i] += $resp[$i];
                }
            }

            for ($i = 0; $i < count($score); $i++) {
                $max[$i] += $resp[$i];
            }
            $cpt++;
        }

        for ($i = 0; $i < count($score); $i++) {
            $perc[$i] = ($score[$i] * 100) / $max[$i];
        }

        arsort($perc);

        // Récupération des clés des trois plus grands nombres
        $top_three_keys = array_slice(array_keys($perc, true), 0, 3);

        dd($top_three_keys);
        return $this->render('index/index.html.twig');
    }
}
