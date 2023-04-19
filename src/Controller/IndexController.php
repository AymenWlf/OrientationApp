<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
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

    const DESC_FILLIERES_SPC = [
        "Cette filière regroupe l'ensemble des disciplines scientifiques et technologiques qui permettent de comprendre le fonctionnement de notre univers et de développer de nouvelles technologies.",
        "Cette filière forme des ingénieurs capables de concevoir, de réaliser et de gérer des projets techniques et scientifiques.",
        "La filière de physique permet d'étudier les lois de l'univers et d'acquérir les connaissances nécessaires pour comprendre et résoudre des problèmes complexes.",
        "La filière de chimie permet de comprendre la structure et les propriétés des atomes et des molécules, ainsi que les réactions chimiques qui se produisent entre eux.",
        "La filière d'électronique permet de comprendre les principes de fonctionnement des systèmes électroniques et de développer de nouveaux dispositifs et technologies.",
        "La filière d'informatique forme des professionnels capables de concevoir, de développer et de gérer des systèmes informatiques complexes.",
        "La filière d'économie permet de comprendre le fonctionnement de l'économie mondiale et de développer des compétences en gestion et en analyse économique.",
        "La filière de gestion forme des professionnels capables de gérer efficacement les entreprises et les organisations dans un contexte économique complexe.",
        "La filière de droit permet d'acquérir les connaissances nécessaires pour comprendre les lois et les réglementations qui régissent notre société et de développer des compétences en analyse juridique."
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
        "Aimez-vous résoudre des problèmes mathématiques complexes ?" => [2, 2, 0, 2, 1, 1, 0, 0, 0],
        "Êtes-vous intéressé par les mathématiques appliquées à l'économie et à la finance ?" => [2, 2, 0, 1, 1, 1, 2, 2, 0],
        "Avez-vous une curiosité pour la physique et la chimie ?" => [0, 0, 2, 2, 2, 1, 0, 0, 0],
        "Êtes-vous doué pour la programmation informatique ?" => [0, 2, 0, 0, 1, 2, 0, 0, 0],
        "Aimez-vous apprendre les langues étrangères et les cultures ?" => [0, 0, 0, 0, 0, 0, 0, 2, 2],
        "Êtes-vous intéressé par les phénomènes sociaux et les sciences humaines ?" => [0, 0, 0, 0, 0, 0, 2, 2, 1],
        "Êtes-vous créatif et intéressé par les arts ?" => [0, 0, 0, 0, 0, 1, 0, 0, 2],
        "Avez-vous une curiosité pour l'histoire et la géographie ?" => [0, 0, 0, 0, 0, 0, 1, 1, 1],
        "Aimez-vous les langues et les cultures étrangères ?" => [0, 0, 0, 0, 0, 0, 0, 2, 2],
        "Êtes-vous intéressé par l'économie et la finance ?" => [0, 1, 0, 0, 2, 2, 2, 2, 1],
        "Avez-vous une curiosité pour la biologie et la santé ?" => [0, 0, 2, 2, 0, 0, 0, 0, 0],
        "Êtes-vous doué pour la compréhension de textes juridiques complexes ?" => [0, 0, 0, 0, 0, 0, 2, 2, 2],
        "Aimez-vous les sciences politiques et les relations internationales ?" => [0, 0, 0, 2, 2, 0, 1, 1, 1],
        "Êtes-vous intéressé par les sciences de l'environnement et le développement durable ?" => [2, 0, 1, 0, 0, 0, 0, 0, 0],
        "Avez-vous une curiosité pour l'architecture et l'urbanisme ?" => [0, 0, 0, 0, 0, 0, 2, 2, 2]
    ];

    #[Route('/get/qst', name: 'get.qst', methods: ['GET'])]
    public function getQst(): Response
    {

        return $this->json(self::TYPE_BAC, Response::HTTP_OK, []);
    }

    public function TraitementReponses(array $reponses): array
    {
        // $reponses = [1, 0, 1, 1, 0, 1, 1, 1, 0, 1, 0, 1, 0, 1, 0];
        $score = [0, 0, 0, 0, 0, 0, 0, 0, 0];
        $max = [0, 0, 0, 0, 0, 0, 0, 0, 0];
        $perc = [0, 0, 0, 0, 0, 0, 0, 0, 0];
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

        $i = 0;
        foreach ($perc as $key => $value) {
            $resultat[] = ["filliere" => self::CATEGORIE_PAR_BAC["Sciences Physiques et Chimiques"][$key], "desc" => self::DESC_FILLIERES_SPC[$key], "perc" => intval(round($value, 2))];

            if ($i == 2) {
                break;
            }
            $i++;
        }

        return $resultat;
    }

    #[Route('/api/results', name: 'api.results', methods: ['POST'])]
    public function results(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $reponses = [];

        //Tableau de reponses;
        foreach ($data as $el) {
            $reponses[] = intval($el["choix"]);
        }

        $resultat = $this->TraitementReponses($reponses);
        return $this->json($resultat, Response::HTTP_OK, []);
    }

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig');
    }
}
