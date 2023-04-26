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
        "Sciences Mathématiques A et B" => ["Sciences et Technologies", "Sciences de l'Ingénieur", "Informatique", "Physique", "Économie", "Gestion", "Droit", "Santé"],
        "Sciences Physiques et Chimiques" => [
            "Scientifiques et techniques",
            "Médicales et paramédicales",
            "Enseignement et recherche",
            "Gestion, finance et management",
            "Informatiques et numériques",
            "Droit et sciences politiques",
            "Commerce et marketing",
            "Tourisme et hôtellerie"
        ],
        "Sciences de la Vie et de la Terre" => ["Sciences et Technologies", "Santé", "Sciences de l'Ingénieur", "Biologie", "Environnement", "Géologie", "Agriculture, Forêt et Environnement", "Économie", "Gestion", "Droit"],
        "Sciences Économiques" => ["Sciences Économiques et Gestion", "Droit et Sciences Politiques", "Économie Sociale et Solidaire", "Tourisme et Hôtellerie", "Communication et Marketing", "Ressources Humaines"],
        "Lettres et Sciences Humaines" => ["Langues et Lettres", "Sciences Humaines et Sociales", "Tourisme et Hôtellerie", "Communication et Marketing", "Éducation, Culture et Patrimoine"],
        "Techniques de Gestion Comptable" => ["Sciences Économiques et Gestion", "Comptabilité", "Finance", "Gestion", "Droit et Sciences Politiques"],
        "Sciences Agronomiques" => ["Agriculture, Forêt et Environnement", "Sciences et Technologies", "Biologie", "Environnement", "Géologie", "Sciences de la Vie et de la Terre", "Économie", "Gestion", "Droit"],
        "Langues et Communication" => ["Langues et Lettres", "Arts, Audiovisuel et Communication", "Tourisme et Hôtellerie", "Communication et Marketing", "Éducation, Culture et Patrimoine"],
        "Sciences et Technologies Électriques" => ["Sciences et Technologies", "Sciences de l'Ingénieur", "Électricité", "Électronique", "Informatique", "Économie", "Gestion", "Droit"],
        "Sciences et Technologies Mécaniques" => ["Sciences et Technologies", "Sciences de l'Ingénieur", "Mécanique", "Électronique", "Informatique", "Économie", "Gestion", "Droit"]
    ];

    const DESC_FILLIERES_SPC = [
        "Sciences Physiques et Chimiques" => [
            "Cette filière regroupe les métiers liés à la science, la technologie et la recherche, tels que les mathématiques, la physique, la chimie, la biologie, l'ingénierie, l'aéronautique, l'énergie, etc.",
            "Cette filière regroupe les métiers de la médecine, des soins infirmiers, de la pharmacie, de la dentisterie, de la kinésithérapie, de l'ergothérapie, de la psychologie, etc.",
            "Cette filière regroupe les métiers de l'enseignement, de la formation et de la recherche, tels que l'enseignement primaire, secondaire et universitaire, la formation professionnelle, la recherche en sciences sociales, etc.",
            "Cette filière regroupe les métiers liés à la gestion, la finance, le marketing, la vente, le commerce et l'entrepreneuriat, tels que la comptabilité, la gestion d'entreprise, le marketing, la publicité, les ventes, etc.",
            "Cette filière regroupe les métiers liés à l'informatique et aux technologies numériques, tels que la programmation, le développement web et mobile, l'analyse de données, la cybersécurité, la conception de jeux vidéo, etc.",
            "Cette filière regroupe les métiers liés au droit et aux sciences politiques, tels que les avocats, les notaires, les juges, les juristes d'entreprise, les diplomates, les politologues, etc.",
            "Cette filière regroupe les métiers liés aux affaires et au commerce, tels que la gestion commerciale, la négociation, la logistique, les achats, les relations publiques, etc.",
            "Cette filière regroupe les métiers liés à l'hôtellerie, la restauration, le tourisme et les loisirs, tels que les métiers de l'hôtellerie, les métiers de la restauration, le tourisme, le sport, l'événementiel, etc."
        ],
        "Sciences Mathématiques A et B" => [
            "Cette filière regroupe l'ensemble des disciplines scientifiques et technologiques qui permettent de comprendre le fonctionnement de notre univers et de développer de nouvelles technologies.",
            "Cette filière forme des ingénieurs capables de concevoir, de réaliser et de gérer des projets techniques et scientifiques.",
            "La filière d'informatique forme des professionnels capables de concevoir, de développer et de gérer des systèmes informatiques complexes.",
            "La filière de physique permet d'étudier les lois de l'univers et d'acquérir les connaissances nécessaires pour comprendre et résoudre des problèmes complexes.",
            "La filière d'économie permet de comprendre le fonctionnement de l'économie mondiale et de développer des compétences en gestion et en analyse économique.",
            "La filière de gestion forme des professionnels capables de gérer efficacement les entreprises et les organisations dans un contexte économique complexe.",
            "La filière de droit permet d'acquérir les connaissances nécessaires pour comprendre les lois et les réglementations qui régissent notre société et de développer des compétences en analyse juridique.",
            "La filière de santé permet d'étudier le corps humain, les maladies, les traitements et les thérapies pour aider les personnes à maintenir ou améliorer leur état de santé.",
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
        "Aimez-vous les sciences et la technologie ?" => [5, 2, 4, 1, 5, 2, 1, 0],
        "Aimez-vous résoudre des problèmes mathématiques ?" => [5, 1, 4, 1, 4, 1, 1, 0],
        "Aimez-vous la physique et la chimie ?" => [5, 4, 3, 1, 3, 1, 1, 0],
        "Êtes-vous intéressé par les langues étrangères ?" => [2, 2, 4, 1, 2, 4, 4, 5],
        "Aimez-vous travailler en équipe ?" => [3, 3, 4, 3, 3, 3, 4, 4],
        "Êtes-vous intéressé par les métiers liés à la santé ?" => [2, 5, 3, 1, 2, 5, 2, 5],
        "Aimez-vous être créatif ou artistique ?" => [1, 1, 2, 1, 2, 2, 5, 5],
        "Avez-vous des compétences en programmation ?" => [5, 1, 4, 2, 5, 2, 2, 0],
        "Êtes-vous intéressé par la gestion d'entreprise ?" => [2, 2, 5, 5, 2, 2, 5, 4],
        "Avez-vous des compétences en résolution de problèmes juridiques ?" => [1, 1, 4, 3, 1, 5, 4, 1],

        "Êtes-vous à l'aise avec l'écriture ou la communication ?" => [1, 2, 3, 5, 2, 5, 5, 4],
        "Êtes-vous intéressé par les arts visuels ou les métiers d'art ?" => [1, 1, 2, 2, 2, 3, 5, 4],
        "Êtes-vous intéressé par les métiers de l'environnement ou de l'agriculture ?" => [2, 2, 4, 1, 2, 5, 4, 5],
        "Êtes-vous à l'aise avec la résolution de problèmes techniques ?" => [4, 1, 4, 3, 4, 3, 1, 0],
        "Êtes-vous intéressé par les métiers du social et de l'humanitaire ?" => [2, 2, 3, 5, 2, 5, 5, 4],
        "Êtes-vous à l'aise avec l'analyse financière ou la comptabilité ?" => [1, 1, 3, 5, 2, 5, 5, 4],
        "Êtes-vous intéressé par les métiers de l'audiovisuel ou de la communication digitale ?" => [1, 2, 3, 5, 3, 5, 5, 4],
        "Êtes-vous à l'aise avec la gestion de projets ?" => [3, 3, 4, 4, 3, 4, 5, 4],
        "Êtes-vous intéressé par les métiers de la création artistique ou du design ?" => [1, 1, 2, 1, 2, 2, 5, 5],
        "Êtes-vous à l'aise avec l'informatique et les nouvelles technologies ?" => [5, 3, 5, 2, 5, 1, 2, 0]
    ];

    const QST_SM_A_B = [
        "Les mathématiques et la résolution de problèmes complexes vous passionnent-elles?" => [5, 5, 5, 5, 3, 3, 3, 0],
        "Trouvez-vous les domaines des sciences et technologies stimulants et captivants?" => [5, 5, 5, 5, 3, 3, 2, 0],
        "L'idée de concevoir, construire et analyser des systèmes techniques en tant qu'ingénieur vous attire-t-elle?" => [4, 5, 4, 4, 2, 2, 1, 0],
        "Avez-vous un intérêt pour la biologie, la physiologie et les sciences de la santé ?" => [0, 0, 0, 0, 0, 0, 0, 5],
        "Êtes-vous curieux d'apprendre la programmation informatique et de développer des solutions technologiques?" => [4, 4, 5, 3, 3, 3, 2, 0],
        "La physique et la compréhension des lois qui gouvernent notre univers vous intéressent-elles?" => [4, 4, 3, 5, 2, 2, 1, 0],
        "L'étude de l'économie, des marchés et des politiques économiques vous semble-t-elle passionnante?" => [0, 0, 0, 0, 5, 4, 3, 0],
        "Aimeriez-vous apprendre la gestion d'entreprise, les ressources humaines et les stratégies de leadership?" => [0, 0, 0, 0, 4, 5, 3, 0],
        "Le droit, la régulation et la résolution de conflits juridiques vous captivent-ils?" => [0, 0, 0, 0, 3, 3, 5, 0],
        "Vous sentez-vous concerné par les enjeux de santé publique et la prévention des maladies ?" => [0, 0, 0, 0, 0, 0, 0, 5],
        "Appréciez-vous travailler en équipe sur des projets scientifiques, technologiques ou techniques?" => [5, 5, 5, 5, 0, 0, 0, 0],
        "Aimeriez-vous résoudre des problèmes réels en utilisant les mathématiques et les modèles mathématiques?" => [5, 5, 5, 5, 0, 0, 0, 0],
        "Êtes-vous intéressé par l'analyse et la visualisation de données pour en tirer des conclusions pertinentes?" => [4, 4, 5, 4, 5, 4, 3, 0],
        "Aimez-vous comprendre et appliquer les dernières avancées technologiques?" => [5, 5, 5, 4, 0, 0, 0, 0],
        "Êtes-vous intéressé par l'étude des algorithmes, des structures de données et de la complexité computationnelle pour résoudre des problèmes informatiques?" => [4, 4, 5, 3, 2, 2, 1, 0],
        "Êtes-vous passionné par l'application des mathématiques dans divers domaines, tels que la biologie ou la chimie?" => [5, 4, 4, 5, 0, 0, 0, 0],
        "Souhaitez-vous comprendre le fonctionnement des marchés financiers et le rôle de la politique économique?" => [0, 0, 0, 0, 5, 4, 3, 0],
        "Êtes-vous intéressé par l'organisation et la gestion de projets pour atteindre des objectifs spécifiques?" => [0, 0, 0, 0, 4, 5, 4, 0],
        "Les questions juridiques, la régulation et la législation vous passionnent-elles?" => [0, 0, 0, 0, 3, 3, 5, 0],
        "Souhaitez-vous travailler dans un environnement médical ou paramédical pour aider les personnes malades ?" => [0, 0, 0, 0, 0, 0, 0, 5]
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
