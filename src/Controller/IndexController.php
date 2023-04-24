<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Resultat;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    public function __construct(private EntityManagerInterface $em, private UtilisateurRepository $utilsRepo)
    {
    }
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
        "Sciences Physiques et Chimiques" => [
            "Cette filière regroupe l'ensemble des disciplines scientifiques et technologiques qui permettent de comprendre le fonctionnement de notre univers et de développer de nouvelles technologies.",
            "Cette filière forme des ingénieurs capables de concevoir, de réaliser et de gérer des projets techniques et scientifiques.",
            "La filière de physique permet d'étudier les lois de l'univers et d'acquérir les connaissances nécessaires pour comprendre et résoudre des problèmes complexes.",
            "La filière de chimie permet de comprendre la structure et les propriétés des atomes et des molécules, ainsi que les réactions chimiques qui se produisent entre eux.",
            "La filière d'électronique permet de comprendre les principes de fonctionnement des systèmes électroniques et de développer de nouveaux dispositifs et technologies.",
            "La filière d'informatique forme des professionnels capables de concevoir, de développer et de gérer des systèmes informatiques complexes.",
            "La filière d'économie permet de comprendre le fonctionnement de l'économie mondiale et de développer des compétences en gestion et en analyse économique.",
            "La filière de gestion forme des professionnels capables de gérer efficacement les entreprises et les organisations dans un contexte économique complexe.",
            "La filière de droit permet d'acquérir les connaissances nécessaires pour comprendre les lois et les réglementations qui régissent notre société et de développer des compétences en analyse juridique."
        ],
        "Sciences Mathématiques A et B" => [
            "Cette filière regroupe l'ensemble des dssssssisciplines scientifiques et technologiques qui permettent de comprendre le fonctionnement de notre univers et de développer de nouvelles technologies.",
            "Cette filière forme des ingénieurs capables de concevoir, de réaliser et de gérer des projets techniques et scientifiques.",
            "La filière de physique permet d'étudier les lois de l'univers et d'acquérir les connaissances nécessaires pour comprendre et résoudre des problèmes complexes.",
            "La filière de chimie permet de comprendre la structure et les propriétés des atomes et des molécules, ainsi que les réactions chimiques qui se produisent entre eux.",
            "La filière d'électronique permet de comprendre les principes de fonctionnement des systèmes électroniques et de développer de nouveaux dispositifs et technologies.",
            "La filière d'informatique forme des professionnels capables de concevoir, de développer et de gérer des systèmes informatiques complexes.",
            "La filière d'économie permet de comprendre le fonctionnement de l'économie mondiale et de développer des compétences en gestion et en analyse économique.",
            "La filière de gestion forme des professionnels capables de gérer efficacement les entreprises et les organisations dans un contexte économique complexe.",
            "La filière de droit permet d'acquérir les connaissances nécessaires pour comprendre les lois et les réglementations qui régissent notre société et de développer des compétences en analyse juridique."
        ],
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

    const QST_PC = [
        "Aimez-vous résoudre des problèmes complexes?" => [5, 4, 2, 3, 3, 4, 1, 1, 0],
        "Êtes-vous créatif/ve?" => [3, 3, 3, 3, 4, 4, 3, 4, 4],
        "Aimez-vous travailler avec des ordinateurs et des technologies?" => [3, 3, 1, 1, 5, 5, 1, 1, 0],
        "Êtes-vous intéressé/e par la compréhension des phénomènes physiques?" => [1, 1, 5, 4, 3, 1, 0, 0, 0],
        "Êtes-vous curieux/se de savoir comment les choses fonctionnent?" => [4, 4, 4, 4, 4, 4, 2, 1, 1],
        "Aimez-vous faire des expériences scientifiques?" => [3, 3, 4, 5, 3, 1, 1, 1, 0],
        "Êtes-vous intéressé/e par les mathématiques et les statistiques?" => [4, 4, 4, 4, 4, 5, 4, 1, 0],
        "Êtes-vous capable de penser de manière analytique?" => [4, 4, 4, 4, 4, 5, 4, 2, 1],
        "Avez-vous un bon sens de l'observation?" => [3, 3, 3, 3, 3, 3, 1, 1, 1],
        "Avez-vous un fort désir d'apprendre de nouvelles choses?" => [4, 4, 4, 4, 4, 4, 4, 4, 3],
        "Êtes-vous capable de travailler en équipe?" => [3, 3, 3, 3, 3, 3, 3, 5, 4],
        "Avez-vous une forte éthique de travail?" => [3, 3, 3, 3, 3, 3, 3, 4, 4],
        "Êtes-vous doué/e pour la communication?" => [2, 2, 2, 2, 2, 2, 4, 4, 4],
        "Êtes-vous intéressé/e par les enjeux économiques et financiers?" => [1, 1, 1, 1, 1, 1, 4, 4, 4],
        "Êtes-vous doué/e pour la résolution de problèmes logiques?" => [4, 4, 4, 4, 4, 5, 2, 2, 2],
        "Aimez-vous travailler avec des chiffres?" => [4, 4, 4, 4, 4, 5, 2, 2, 2],
        "Êtes-vous intéressé/e par les lois et la justice?" => [1, 1, 1, 1, 1, 1, 4, 4, 5],
        "Avez-vous une passion pour l'entrepreneuriat et la création d'entreprise?" => [2, 2, 2, 2, 2, 2, 4, 4, 4],
        "Êtes-vous capable de travailler sous pression et de respecter des délais serrés?" => [2, 3, 3, 3, 2, 2, 3, 3, 3],
        "Avez-vous une aptitude pour la résolution de problèmes pratiques et concrets?" => [3, 4, 3, 3, 3, 3, 1, 1, 1]
    ];

    const QST_SM_A_B = [
        "Aimez-vous résoudre dsssssses problèmes complexes?" => [5, 4, 2, 3, 3, 4, 1, 1, 0],
        "Êtes-vous créatif/ve?" => [3, 3, 3, 3, 4, 4, 3, 4, 4],
        "Aimez-vous travailler avec des ordinateurs et des technologies?" => [3, 3, 1, 1, 5, 5, 1, 1, 0],
        "Êtes-vous intéressé/e par la compréhension des phénomènes physiques?" => [1, 1, 5, 4, 3, 1, 0, 0, 0],
        "Êtes-vous curieux/se de savoir comment les choses fonctionnent?" => [4, 4, 4, 4, 4, 4, 2, 1, 1],
        "Aimez-vous faire des expériences scientifiques?" => [3, 3, 4, 5, 3, 1, 1, 1, 0],
        "Êtes-vous intéressé/e par les mathématiques et les statistiques?" => [4, 4, 4, 4, 4, 5, 4, 1, 0],
        "Êtes-vous capable de penser de manière analytique?" => [4, 4, 4, 4, 4, 5, 4, 2, 1],
        "Avez-vous un bon sens de l'observation?" => [3, 3, 3, 3, 3, 3, 1, 1, 1],
        "Avez-vous un fort désir d'apprendre de nouvelles choses?" => [4, 4, 4, 4, 4, 4, 4, 4, 3],
        "Êtes-vous capable de travailler en équipe?" => [3, 3, 3, 3, 3, 3, 3, 5, 4],
        "Avez-vous une forte éthique de travail?" => [3, 3, 3, 3, 3, 3, 3, 4, 4],
        "Êtes-vous doué/e pour la communication?" => [2, 2, 2, 2, 2, 2, 4, 4, 4],
        "Êtes-vous intéressé/e par les enjeux économiques et financiers?" => [1, 1, 1, 1, 1, 1, 4, 4, 4],
        "Êtes-vous doué/e pour la résolution de problèmes logiques?" => [4, 4, 4, 4, 4, 5, 2, 2, 2],
        "Aimez-vous travailler avec des chiffres?" => [4, 4, 4, 4, 4, 5, 2, 2, 2],
        "Êtes-vous intéressé/e par les lois et la justice?" => [1, 1, 1, 1, 1, 1, 4, 4, 5],
        "Avez-vous une passion pour l'entrepreneuriat et la création d'entreprise?" => [2, 2, 2, 2, 2, 2, 4, 4, 4],
        "Êtes-vous capable de travailler sous pression et de respecter des délais serrés?" => [2, 3, 3, 3, 2, 2, 3, 3, 3],
        "Avez-vous une aptitude pour la résolution de problèmes pratiques et concrets?" => [3, 4, 3, 3, 3, 3, 1, 1, 1]
    ];

    #[Route('/get/qst', name: 'get.qst', methods: ["GET"])]
    public function getQst(): Response
    {

        return $this->json(self::TYPE_BAC, Response::HTTP_OK, []);
    }

    public function TraitementReponses(array $reponses, string $type_bac): array
    {
        // $reponses = [1, 0, 1, 1, 0, 1, 1, 1, 0, 1, 0, 1, 0, 1, 0];
        $cpt = 0;

        $arrayQst = [];
        $emptyArr = null;

        switch ($type_bac) {
            case "Sciences Physiques et Chimiques":
                $arrayQst = self::QST_PC;
                break;
            case "Sciences Mathématiques A et B":
                $arrayQst = self::QST_SM_A_B;
                break;

            default:
                # code...
                break;
        }

        //Init TypeBacArr
        $emptyArr = array_fill(0, count(self::CATEGORIE_PAR_BAC[$type_bac]), 0);

        //Init Arr
        $score = $emptyArr;
        $max = $emptyArr;
        $perc = $emptyArr;

        foreach ($arrayQst as $qst => $resp) {
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
            $resultat[] = ["filliere" => self::CATEGORIE_PAR_BAC[$type_bac][$key], "desc" => self::DESC_FILLIERES_SPC[$type_bac][$key], "perc" => intval(round($value, 2))];

            if ($i == 2) {
                break;
            }
            $i++;
        }

        return $resultat;
    }

    #[Route('/api/dataUser', name: 'api.dataUser', methods: ["POST"])]
    public function dataUser(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $utilisateur = $this->utilsRepo->findOneBy(['email' => $data['email']]);
        if (!$utilisateur) {
            $utilisateur = new Utilisateur();
        }

        $utilisateur->setNom($data["nom"])
            ->setPrenom($data["prenom"])
            ->setTel($data["tel"])
            ->setEmail($data["email"])
            ->setTypeBac($data["type_bac"]);

        $this->em->persist($utilisateur);
        $this->em->flush();

        return $this->json($data, Response::HTTP_OK, []);
    }

    #[Route('/api/sendMessage', name: 'api.sendMessage', methods: ["POST"])]
    public function sendMessage(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $utils = $this->utilsRepo->findOneBy(['email' => $data['email']]);
        $message = new Message();

        if ($utils) {
            $message
                ->setMessage($data['message'])
                ->setUser($utils);
        }

        $this->em->persist($message);
        $this->em->flush();

        return $this->json($data, Response::HTTP_OK, []);
    }

    #[Route('/api/results', name: 'api.results', methods: ['POST'])]
    public function results(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $reponses = [];

        // dd($data);
        //Tableau de reponses;
        foreach ($data['quizz'] as $el) {
            $reponses[] = intval($el["choix"]);
        }
        $resultat = $this->TraitementReponses($reponses, $data['datas']['type_bac']);

        $results = new Resultat();
        $cpt = 0;

        foreach ($resultat as $el) {
            switch ($cpt) {
                case 0:
                    $results->setFilliere($el['filliere']);
                    $results->setDescr($el['desc']);
                    $results->setPerc($el['perc']);
                    break;
                case 1:
                    $results->setFilliere2($el['filliere']);
                    $results->setDescr2($el['desc']);
                    $results->setPerc2($el['perc']);
                    break;
                case 2:
                    $results->setFilliere3($el['filliere']);
                    $results->setDescr3($el['desc']);
                    $results->setPerc3($el['perc']);
                    break;

                default:
                    # code...
                    break;
            }

            $cpt++;
        }

        $results->setUtilisateur($this->utilsRepo->findOneBy(['email' => $data['datas']['email']]));

        $this->em->persist($results);
        $this->em->flush();

        return $this->json($resultat, Response::HTTP_OK, []);
    }

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig');
    }
}
