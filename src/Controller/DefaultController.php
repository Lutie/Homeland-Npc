<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Character;
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
            $this->em->persist($character);
            $this->em->flush();

            $this->addFlash('success', 'The character "' . $character->getName() . '" has been created.');

            return $this->redirectToRoute('index');
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
        $form = $this->createForm(CharacterType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($character);
            $this->em->flush();

            $this->addFlash('success', 'The character "' . $character->getName() . '" has been modified.');

            return $this->redirectToRoute('index');
        }

        return $this->render('create.html.twig', [
            'form' => $form->createView(),
            'character' => $character
        ]);
    }

    /**
     * @Route("/delete/{id}", name="default_delete")
     */
    public function deleteAction(Character $character)
    {
        $this->em->remove($character);
        $this->em->flush();

        $this->addFlash('success', 'The character "' . $character->getName() . '" has been deleted.');

        return $this->redirectToRoute('index');
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
     * @Route("/export/{id}", name="default_export")
     */
    public function exportAction(Character $character)
    {
        $this->generatePdf($character);
    }

    function generatePdf(Character $character) {
        $html = $this->renderView('pdf/character_sheet.html.twig', [
            'data' => $character,
        ]);

        $pdfRender = new PdfRender;
        $pdfRender->generatePdf($html, $character->getName() . " sheet");
    }
 
    /**
     * @Route("/random", name="random")
     */
    public function randomAction(Request $request)
    {
        $age = rand(17, 77);
        $sex = rand(0, 2);

        $subject = $request->query->get('subject');

        //if (in_array($subject, ['universe', 'all'])) $size = $this->getRandom(Particularity::class, 15);

        //if (in_array($subject, ['particularities', 'all'])) {
        //    if (rand(0, 100) < 66) $particularities[] = $this->getRandom(Particularity::class, 0);
        //    if (rand(0, 100) < 33) $particularities[] = $this->getRandom(Particularity::class, 0);
        //}
        //if (in_array($subject, ['liabilities', 'all'])) {
        //    if (rand(0, 100) < 66) $liabilities[] = $this->getRandom(Liability::class, 0);
        //    if (rand(0, 100) < 33) $liabilities[] = $this->getRandom(Liability::class, 0);
        //}

        $data = [
            'age' => $age,
            'sex' => $sex
        ];

        return new JsonResponse($data);

    }

    private function getRandom($class, $type)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository($class);

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

        return $proprety->getId();
    }
}
