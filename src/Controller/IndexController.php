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
        "Sciences Mathématiques A et B" => [
            "Ingénierie",
            "Médecine et santé",
            "Informatique et technologies de l'information",
            "Sciences économiques et de gestion",
            "Physique et chimie",
            "Mathématiques et statistiques",
            "Architecture et urbanisme",
            "Éducation et enseignement"
        ],
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
        "Sciences Économiques" => [
            "Économie et Gestion",
            "Commerce et Marketing",
            "Management et Entrepreneuriat",
            "Finances et Banque",
            "Statistique et Analyse des Données"
        ],
        "Sciences de la Vie et de la Terre" => [
            "Ingénierie",
            "Médecine et santé",
            "Informatique et technologies de l'information",
            "Sciences économiques et de gestion",
            "Physique et chimie",
            "Mathématiques et statistiques",
            "Architecture et urbanisme",
            "Éducation et enseignement"
        ],
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
            "Cette filière regroupe les métiers de l'ingénierie et de la technologie, tels que l'ingénierie civile, l'ingénierie industrielle, l'ingénierie mécanique, l'ingénierie électrique, etc.",
            "Cette filière regroupe les métiers de la médecine et de la santé, tels que la médecine générale, la chirurgie, la dentisterie, la pharmacie, la physiothérapie, etc.",
            "Cette filière regroupe les métiers liés à l'informatique et aux technologies numériques, tels que la programmation, le développement web et mobile, l'analyse de données, la cybersécurité, la conception de jeux vidéo, etc.",
            "Cette filière regroupe les métiers de la gestion et de l'économie, tels que le management, la finance, la comptabilité, le marketing, les ressources humaines, etc.",
            "Cette filière regroupe les métiers liés aux sciences physiques et chimiques, tels que la physique, la chimie, la biologie, la géologie, l'environnement, etc.",
            "Cette filière regroupe les métiers liés aux mathématiques et aux statistiques, tels que les mathématiques appliquées, la modélisation mathématique, la statistique, l'analyse de données, etc.",
            "Cette filière regroupe les métiers de l'architecture et de l'urbanisme, tels que l'architecture, l'urbanisme, l'aménagement du territoire, la construction, etc.",
            "Cette filière regroupe les métiers de l'éducation et de l'enseignement, tels que l'enseignement primaire et secondaire, l'enseignement supérieur, la formation professionnelle, etc."
        ],
        "Sciences Économiques" => [
            "Cette filière regroupe les métiers de la gestion et de l'économie, tels que la planification stratégique, la gestion de projets, la gestion de la chaîne d'approvisionnement, la gestion des ressources humaines, la gestion des opérations, etc.",
            "Cette filière regroupe les métiers liés à la vente, à la publicité, au marketing et aux relations publiques, tels que la gestion des ventes, la recherche de marché, la planification des événements, la publicité et les relations publiques, etc.",
            "Cette filière regroupe les métiers liés à la gestion des entreprises et de leurs activités, tels que la gestion des opérations, la gestion des finances, la gestion des ressources humaines, la gestion de la chaîne d'approvisionnement, etc.",
            "Cette filière regroupe les métiers liés aux finances et à la banque, tels que la gestion de portefeuille, la gestion des risques, la comptabilité, la finance d'entreprise, la banque d'investissement, etc.",
            "Cette filière regroupe les métiers liés à l'analyse de données, à la recherche et à la modélisation, tels que l'analyse statistique, la modélisation mathématique, la recherche opérationnelle, l'économétrie, etc."
        ]
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

    const QST_PC_NEW = [
        "Êtes-vous intéressé(e) par les sciences ?" => array(3, 0, 0, 0, 3, 0, 0, 0),
        "Préférez-vous les tâches qui nécessitent de la rigueur et de la précision ?" => array(2, 2, 2, 3, 2, 2, 2, 0),
        "Aimez-vous travailler sur des projets à long terme ?" => array(2, 1, 1, 2, 2, 2, 2, 0),
        "Avez-vous une passion pour l'environnement ?" => array(3, 0, 0, 0, 0, 0, 0, 0),
        "Avez-vous une aptitude pour la résolution de problèmes complexes ?" => array(3, 0, 0, 0, 3, 0, 0, 0),
        "Êtes-vous intéressé(e) par les défis de la santé ?" => array(0, 3, 0, 0, 0, 0, 0, 0),
        "Êtes-vous attentif(ve) aux besoins des autres ?" => array(0, 3, 0, 0, 0, 0, 0, 0),
        "Avez-vous une capacité d'écoute et de communication efficace ?" => array(0, 3, 0, 0, 0, 0, 0, 0),
        "Aimez-vous apprendre sur les sujets liés à la médecine ?" => array(0, 3, 0, 0, 0, 0, 0, 0),
        "Êtes-vous capable de travailler sous pression ?" => array(0, 2, 0, 2, 0, 2, 0, 2),

        "Aimez-vous aider les autres à résoudre leurs problèmes et à trouver des solutions ?" => array(0, 0, 3, 0, 0, 0, 2, 0),
        "Êtes-vous doué(e) pour la gestion de projet et l'organisation ?" => array(0, 0, 3, 2, 0, 2, 2, 0),
        "Avez-vous une passion pour la justice sociale et l'égalité ?" => array(0, 0, 3, 0, 0, 0, 0, 0),
        "Êtes-vous à l'aise pour parler en public ?" => array(0, 0, 2, 0, 0, 0, 0, 0),
        "Êtes-vous intéressé(e) par la recherche et l'exploration de nouvelles idées ?" => array(0, 0, 3, 0, 0, 0, 0, 0),
        "Avez-vous une passion pour les technologies numériques ?" => array(0, 0, 0, 0, 3, 0, 2, 0),
        "Êtes-vous intéressé(e) par les langues étrangères ?" => array(0, 0, 0, 0, 0, 0, 2, 0),
        "Avez-vous des compétences en analyse financière et en planification budgétaire ?" => array(0, 0, 0, 3, 0, 0, 3, 0),
        "Aimez-vous résoudre des problèmes complexes en utilisant la technologie ?" => array(0, 0, 0, 0, 3, 0, 2, 0),
        "Avez-vous une passion pour l'innovation et les nouvelles technologies ?" => array(0, 0, 0, 0, 3, 0, 2, 0)
    ];

    const QST_SM_A_B = [
        "Êtes-vous intéressé par la science et la technologie ?" => [5, 0, 4, 3, 3, 4, 2, 0],
        "Êtes-vous intéressé par l'informatique et la technologie de l'information ?" => [4, 0, 5, 3, 2, 3, 1, 0],
        "Êtes-vous intéressé par la gestion d'entreprise ?" => [2, 0, 3, 5, 2, 2, 3, 0],
        "Êtes-vous créatif et passionné par l'architecture et la conception ?" => [2, 0, 2, 1, 1, 1, 5, 0],
        "Avez-vous de bonnes compétences en physique et chimie ?" => [4, 0, 0, 1, 5, 4, 0, 0],
        "Avez-vous un esprit logique et aimez-vous résoudre des problèmes mathématiques ?" => [3, 0, 2, 3, 2, 5, 1, 0],
        "Êtes-vous à l'aise avec les mathématiques et les statistiques ?" => [3, 0, 2, 2, 1, 5, 1, 0],
        "Aimez-vous travailler sur des projets de construction et de design urbain ?" => [1, 0, 0, 1, 1, 1, 5, 0],
        "Êtes-vous intéressé par l'enseignement et le partage des connaissances ?" => [1, 0, 1, 1, 1, 1, 1, 5],
        "Êtes-vous intéressé par les sciences médicales et la santé humaine ?" => [0, 5, 0, 0, 4, 2, 0, 0],


        "Êtes-vous capable de communiquer efficacement avec les autres ?" => [2, 0, 2, 2, 1, 1, 2, 4],
        "Aimez-vous travailler avec des enfants et des jeunes ?" => [1, 0, 1, 1, 1, 1, 1, 4],
        "Êtes-vous intéressé par les sciences sociales et le comportement humain ?" => [1, 0, 3, 5, 1, 1, 1, 2],
        "Aimez-vous travailler avec des ordinateurs et des logiciels ?" => [3, 0, 5, 2, 1, 2, 1, 0],
        "Êtes-vous intéressé par la conception de systèmes électroniques et électriques ?" => [4, 0, 1, 1, 1, 2, 1, 0],
        "Êtes-vous intéressé par la recherche scientifique et le développement de nouvelles technologies ?" => [5, 0, 3, 1, 1, 2, 1, 0],
        "Êtes-vous intéressé par la psychologie et la santé mentale ?" => [1, 0, 1, 3, 1, 2, 1, 1],
        "Aimez-vous travailler avec des chiffres et des données financières ?" => [1, 0, 1, 5, 1, 3, 1, 0],
        "Aimez-vous résoudre des problèmes complexes et travailler en équipe ?" => [4, 0, 3, 3, 1, 3, 2, 0],
        "Aimez-vous travailler avec des machines et des outils ?" => [4, 0, 1, 1, 1, 1, 2, 0],

    ];

    const QST_SM_A_B_NEW = [
        "Êtes-vous intéressé(e) par les sciences ?" => array(0, 3, 0, 0, 0, 3, 0, 0),
        "Préférez-vous les tâches qui nécessitent de la rigueur et de la précision ?" => array(3, 0, 3, 3, 3, 3, 3, 0),
        "Aimez-vous travailler sur des projets à long terme ?" => array(2, 0, 2, 2, 2, 2, 2, 0),
        "Avez-vous une passion pour l'environnement ?" => array(2, 0, 0, 0, 2, 0, 0, 0),
        "Avez-vous une aptitude pour la résolution de problèmes complexes ?" => array(3, 0, 3, 0, 3, 3, 0, 0),
        "Êtes-vous intéressé(e) par les défis de la santé ?" => array(0, 3, 0, 0, 0, 0, 0, 0),
        "Êtes-vous attentif(ve) aux besoins des autres ?" => array(0, 3, 0, 0, 0, 0, 0, 0),
        "Avez-vous une capacité d'écoute et de communication efficace ?" => array(0, 3, 0, 0, 0, 0, 0, 0),
        "Aimez-vous apprendre sur les sujets liés à la médecine ?" => array(0, 3, 3, 0, 0, 0, 0, 0),
        "Êtes-vous capable de travailler sous pression ?" => array(0, 2, 0, 2, 0, 2, 0, 2),

        "Aimez-vous aider les autres à résoudre leurs problèmes et à trouver des solutions ?" => array(0, 0, 3, 0, 0, 0, 0, 0),
        "Êtes-vous doué(e) pour la gestion de projet et l'organisation ?" => array(0, 0, 3, 3, 0, 3, 0, 0),
        "Avez-vous une passion pour la justice sociale et l'égalité ?" => array(0, 0, 3, 0, 0, 0, 0, 0),
        "Êtes-vous à l'aise pour parler en public ?" => array(0, 0, 2, 0, 0, 0, 0, 0),
        "Êtes-vous intéressé(e) par la recherche et l'exploration de nouvelles idées ?" => array(0, 0, 3, 0, 3, 0, 0, 0),
        "Avez-vous une passion pour les technologies numériques ?" => array(0, 0, 3, 0, 3, 0, 3, 0),
        "Êtes-vous intéressé(e) par les langues étrangères ?" => array(0, 0, 0, 0, 0, 0, 0, 0),
        "Avez-vous des compétences en analyse financière et en planification budgétaire ?" => array(0, 0, 3, 3, 0, 0, 3, 0),
        "Aimez-vous résoudre des problèmes complexes en utilisant la technologie ?" => array(0, 0, 3, 0, 3, 0, 3, 0),
        "Avez-vous une passion pour l'innovation et les nouvelles technologies ?" => array(0, 0, 3, 0, 3, 0, 3, 0)
    ];

    const QST_ECO = [
        "Aimez-vous travailler avec les chiffres et faire des calculs mathématiques ?" => [4, 2, 4, 5, 2],
        "Préférez-vous travailler en équipe ?" => [1, 3, 3, 2, 1],
        "Êtes-vous créatif(ve) et aimez-vous imaginer de nouvelles idées ?" => [2, 2, 5, 2, 2],
        "Avez-vous un intérêt pour la technologie et l'informatique ?" => [2, 2, 5, 2, 2],
        "Aimez-vous résoudre des problèmes complexes ?" => [4, 3, 4, 3, 4],
        "Êtes-vous à l'aise pour prendre la parole en public ?" => [3, 3, 3, 3, 3],
        "Avez-vous un intérêt pour les sciences médicales et la santé humaine ?" => [1, 1, 2, 1, 1],
        "Aimez-vous organiser et planifier des événements ?" => [2, 2, 3, 2, 2],
        "Avez-vous un intérêt pour l'histoire et la géographie ?" => [2, 2, 2, 2, 2],
        "Aimez-vous dessiner et concevoir des objets ou des plans ?" => [1, 1, 3, 1, 1],

        "Avez-vous un intérêt pour la politique et les relations internationales ?" => [4, 3, 4, 3, 2],
        "Aimez-vous travailler avec vos mains et manipuler des objets ?" => [2, 2, 2, 2, 1],
        "Êtes-vous à l'aise pour gérer des budgets et des finances ?" => [5, 3, 5, 4, 2],
        "Avez-vous un intérêt pour la nature et l'environnement ?" => [2, 2, 2, 5, 1],
        "Êtes-vous curieux(se) et aimez-vous apprendre de nouvelles choses ?" => [3, 3, 3, 3, 3],
        "Aimez-vous enseigner et partager vos connaissances avec les autres ?" => [2, 2, 3, 2, 2],
        "Avez-vous un intérêt pour les arts et la culture ?" => [3, 4, 3, 3, 2],
        "Êtes-vous à l'aise avec l'utilisation de la langue anglaise ?" => [4, 4, 4, 4, 2],
        "Aimez-vous diriger et prendre des décisions importantes ?" => [3, 3, 5, 3, 2],
        "Avez-vous un intérêt pour les entreprises et la gestion d'entreprise ?" => [5, 4, 5, 4, 2],

    ];

    const QST_ECO_NEW = array(
        "Êtes-vous intéressé(e) par les questions liées à l'argent et aux finances ?" => array(3, 2, 1, 3, 2),
        "Avez-vous une aptitude pour la gestion de projet et l'organisation ?" => array(3, 2, 3, 2, 1),
        "Aimez-vous aider les autres à résoudre leurs problèmes et à trouver des solutions ?" => array(3, 3, 3, 1, 1),
        "Avez-vous une passion pour la justice sociale et l'égalité ?" => array(1, 0, 0, 0, 0),
        "Êtes-vous à l'aise pour parler en public ?" => array(2, 1, 1, 0, 1),
        "Êtes-vous intéressé(e) par le commerce et les affaires ?" => array(0, 3, 1, 0, 1),
        "Avez-vous une aptitude pour la vente et la négociation ?" => array(0, 3, 0, 0, 1),
        "Avez-vous une passion pour les nouvelles technologies et les réseaux sociaux ?" => array(0, 0, 0, 0, 3),
        "Avez-vous une passion pour l'innovation et la créativité ?" => array(0, 0, 3, 0, 1),
        "Êtes-vous à l'aise pour travailler avec les chiffres ?" => array(2, 1, 0, 3, 0),
        "Aimez-vous résoudre des problèmes complexes en utilisant les statistiques ?" => array(0, 0, 0, 0, 3),
        "Êtes-vous intéressé(e) par la recherche et l'analyse de données ?" => array(0, 0, 0, 0, 3),
        "Avez-vous une aptitude pour la résolution de problèmes complexes ?" => array(0, 0, 0, 0, 3),
        "Êtes-vous capable de travailler sous pression ?" => array(0, 0, 0, 3, 0),
        "Êtes-vous à l'aise pour travailler en équipe ?" => array(0, 0, 3, 0, 0),
        "Êtes-vous capable de prendre des décisions rapidement ?" => array(0, 0, 3, 0, 0),
        "Êtes-vous capable de gérer des situations difficiles ?" => array(0, 0, 3, 0, 0),
        "Êtes-vous à l'aise pour travailler avec des clients ?" => array(0, 0, 3, 0, 0),
        "Avez-vous une aptitude pour la résolution de conflits ?" => array(0, 0, 3, 0, 0),
        "Avez-vous une passion pour les sciences économiques et la gestion ?" => array(3, 0, 3, 3, 0)
    );



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
                $arrayQst = self::QST_PC_NEW;
                break;
            case "Sciences Mathématiques A et B":
                $arrayQst = self::QST_SM_A_B_NEW;
                break;
            case "Sciences Économiques":
                $arrayQst = self::QST_ECO;
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
