<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Character;
use App\Entity\Particularity;
use App\Type\CharacterType;
use App\Service\PdfRender;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }
 
    /**
     * @Route(name="default_index")
     */
    public function indexAction()
    {
        $repository = $this->em->getRepository(Character::class);
        $data = $repository->findAll();
        return $this->render('index.html.twig', [
            'data' => $data
        ]);
    }

    /**
     * @Route("/create", name="default_create")
     */
    public function createAction(Request $request)
    {
        $character = new Character();
        $form = $this->createForm(CharacterType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $character = $this->hydrateCharacterFromForm($character, $form);
            $this->em->persist($character);
            $this->em->flush();

            $this->addFlash('success', 'The character "' . $character->getName() . '" has been created.');

            return $this->redirectToRoute('default_index');
        }

        return $this->render('create.html.twig', [
            'form' => $form->createView(),
            'character' => $character
        ]);
    }

    /**
     * @Route("/update/{id}", name="default_update")
     */
    public function updateAction(Request $request, Character $character)
    {
        $this->hydrateCharacterFromEntity($character);
        $form = $this->createForm(CharacterType::class, $character);
        $form->handleRequest($request);

        $this->hydrateCharacterFromEntity($character);

        if ($form->isSubmitted() && $form->isValid()) {
            $character = $this->hydrateCharacterFromForm($character, $form);
            $this->em->persist($character);
            $this->em->flush();

            $this->addFlash('success', 'The character "' . $character->getName() . '" has been modified.');

            return $this->redirectToRoute('default_index');
        }

        return $this->render('create.html.twig', [
            'form' => $form->createView(),
            'character' => $character
        ]);
    }

    private function hydrateCharacterFromForm($character, $form)
    {
        $params = Particularity::PARTICULARITY_TYPES_BY_STR;
        $character->clearParticularities();
        foreach ($params as $key => $param) {
            if (isset($form[$key]) && $form[$key]->getData())
                $character->addParticularities($form[$key]->getData());
        }
        return $character;
    }

    private function hydrateCharacterFromEntity($character)
    {
        foreach ($character->getParticularities() as $particularity) {
            switch($particularity->getType()) {
                case Particularity::DEFAULT:
                    if(!in_array($particularity, $character->defaults))
                        $character->defaults[] = $particularity;
                    break;
                case Particularity::ETHNIC:
                    $character->ethnic = $particularity;
                    break;
                case Particularity::MORPHOLOGY:
                    if(!in_array($particularity, $character->morphologies))
                        $character->morphologies[] = $particularity;
                    break;
                case Particularity::OCCUPATION:
                    $character->occupation = $particularity;
                    break;
                case Particularity::JOB:
                    $character->job = $particularity;
                    break;
                case Particularity::CHARACTER:
                    $character->character = $particularity;
                    break;
                case Particularity::ALIGNEMENT:
                    $character->alignement = $particularity;
                    break;
                case Particularity::PERSONA:
                    $character->persona = $particularity;
                    break;
                case Particularity::MANIA:
                    if(!in_array($particularity, $character->manias))
                        $character->manias[] = $particularity;
                    break;
                case Particularity::DISTINCTIVE:
                    if(!in_array($particularity, $character->distinctives))
                        $character->distinctives[] = $particularity;
                    break;
                case Particularity::CULTURAL:
                    $character->cultural = $particularity;
                    break;
                case Particularity::LIABILITY:
                    if(!in_array($particularity, $character->liabilities))
                        $character->liabilities[] = $particularity;
                    break;
                case Particularity::UNIVERSE:
                    $character->universe = $particularity;
                    break;
                case Particularity::SIZE:
                    $character->size = $particularity;
                    break;
                case Particularity::STATURE:
                    $character->stature = $particularity;
                    break;
                case Particularity::QUALITY:
                    if(!in_array($particularity, $character->qualities))
                        $character->qualities[] = $particularity;
                    break;
                case Particularity::IDEAL:
                    $character->ideal = $particularity;
                    break;
            }
        }
        return $character;
    }

    /**
     * @Route("/delete/{id}", name="default_delete")
     */
    public function deleteAction(Character $character)
    {
        $this->em->remove($character);
        $this->em->flush();

        $this->addFlash('success', 'The character "' . $character->getName() . '" has been deleted.');

        return $this->redirectToRoute('default_index');
    }

    /**
     * @Route("/display/{id}", name="default_display")
     */
    public function displayAction(Character $character)
    {
        return $this->render('display.html.twig', [
            'character' => $character
        ]);
    }

    /**
     * @Route("/export/{id}", requirements={"id":"\d+"}, name="default_export")
     */
    public function exportAction(Character $character)
    {
        $this->hydrateCharacterFromEntity($character);
        $html = $this->renderView('pdf/character_sheet.html.twig', [
            'data' => $character,
        ]);

        $pdfRender = new PdfRender;
        $pdfRender->generatePdf($html, $character->getName() . " sheet");

        return $this->redirectToRoute('default_index');
    }

    /**
     * @Route("/preview/{id}", requirements={"id":"\d+"}, name="default_preview")
     */
    public function previewAction(Character $character)
    {
        $this->hydrateCharacterFromEntity($character);
        return $this->render('pdf/character_sheet.html.twig', [
            'data' => $character,
        ]);
    }
 
    /**
     * @Route("/random", name="random")
     */
    public function randomAction(Request $request)
    {
        $age = rand(17, 77);
        $sex = rand(0, 2);

        $subject = $request->query->get('subject');

        if (in_array($subject, ['defaults', 'all'])) {
            if (rand(0, 100) < 66) $defaults[] = $this->getRandom(Particularity::class, 0);
            if (rand(0, 100) < 33) $defaults[] = $this->getRandom(Particularity::class, 0);
        }
        
        if (in_array($subject, ['ethnic', 'all'])) $ethnic = $this->getRandom(Particularity::class, 1);

        if (in_array($subject, ['morphologies', 'all'])) {
            if (rand(0, 100) < 66) $morphologies[] = $this->getRandom(Particularity::class, 2);
            if (rand(0, 100) < 33) $morphologies[] = $this->getRandom(Particularity::class, 2);
        }
        
        if (in_array($subject, ['occupation', 'all'])) $occupation = $this->getRandom(Particularity::class, 3);
        
        if (in_array($subject, ['job', 'all'])) $job = $this->getRandom(Particularity::class, 4);
        
        if (in_array($subject, ['character', 'all'])) $character = $this->getRandom(Particularity::class, 5);
        
        if (in_array($subject, ['alignement', 'all'])) $alignement = $this->getRandom(Particularity::class, 6);
        
        if (in_array($subject, ['persona', 'all'])) $persona = $this->getRandom(Particularity::class, 7);

        if (in_array($subject, ['manias', 'all'])) {
            if (rand(0, 100) < 66) $manias[] = $this->getRandom(Particularity::class, 8);
            if (rand(0, 100) < 33) $manias[] = $this->getRandom(Particularity::class, 8);
        }

        if (in_array($subject, ['distinctives', 'all'])) {
            if (rand(0, 100) < 66) $distinctives[] = $this->getRandom(Particularity::class, 9);
            if (rand(0, 100) < 33) $distinctives[] = $this->getRandom(Particularity::class, 9);
        }

        if (in_array($subject, ['culturals', 'all'])) {
            if (rand(0, 100) < 66) $culturals[] = $this->getRandom(Particularity::class, 10);
            if (rand(0, 100) < 33) $culturals[] = $this->getRandom(Particularity::class, 10);
        }

        if (in_array($subject, ['liabilities', 'all'])) {
            if (rand(0, 100) < 66) $liabilities[] = $this->getRandom(Particularity::class, 11);
            if (rand(0, 100) < 33) $liabilities[] = $this->getRandom(Particularity::class, 11);
        }
        
        if (in_array($subject, ['universe', 'all'])) $universe = $this->getRandom(Particularity::class, 12);
        
        if (in_array($subject, ['size', 'all'])) $size = $this->getRandom(Particularity::class, 13);
        
        if (in_array($subject, ['stature', 'all'])) $stature = $this->getRandom(Particularity::class, 14);

        $data = [
            'age' => $age,
            'sex' => $sex,
            'defaults' => isset($defaults) ? $defaults : null,
            'ethnic' => isset($ethnic) ? $ethnic : null,
            'morphologies' => isset($morphologies) ? $morphologies : null,
            'occupation' => isset($occupation) ? $occupation : null,
            'job' => isset($job) ? $job : null,
            'character' => isset($character) ? $character : null,
            'alignement' => isset($alignement) ? $alignement : null,
            'persona' => isset($persona) ? $persona : null,
            'manias' => isset($manias) ? $manias : null,
            'distinctives' => isset($distinctives) ? $distinctives : null,
            'culturals' => isset($culturals) ? $culturals : null,
            'liabilities' => isset($liabilities) ? $liabilities : null,
            'culturals' => isset($culturals) ? $culturals : null,
            'universe' => isset($universe) ? $universe : null,
            'size' => isset($size) ? $size : null,
            'stature' => isset($stature) ? $stature : null,
        ];

        return new JsonResponse($data);
    }

    private function getRandom($class, $type)
    {
        $repository = $this->em->getRepository($class);

        if ($type != 0) {
            $list = $repository->findBy(['type' => $type], ['ratio' => 'DESC']);
        } else {
            $list = $repository->findBy([], ['ratio' => 'DESC']);
        }

        $table = [];
        foreach ($list as $option) {
            $table[] = $option->getRatio();
        }
        $rand = rand(0, array_sum($table));
        foreach ($list as $option) {
            $rand -= $option->getRatio();
            if ($rand <= 0) {
                $proprety = $option;
                break;
            }
        }

        return isset($proprety) ? $proprety->getId() : null;
    }
}
