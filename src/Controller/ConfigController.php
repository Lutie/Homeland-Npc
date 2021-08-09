<?php

namespace App\Controller;

use App\Entity\Particularity;
use App\Entity\Attribute;
use App\Type\ParticularityType;
use App\Type\AttributeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/config")
 */
class ConfigController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @Route(name="config_index")
     */
    public function indexAction()
    {
        return $this->render('config/index.html.twig');
    }

    /**
     * 
     * Particularity
     * 
     */

    /**
     * @Route("/particularity", name="config_particularity")
     */
    public function particularityAction(Request $request)
    {
        $repository = $this->em->getRepository(Particularity::class);
        if ($request->query->get('filter')) {
            $data = $repository->findBy(['type' => $request->query->get('filter')]);
        } else {
            $data = $repository->findAll();
        }

        return $this->render('config/table.html.twig', [
            'subject' => 'particularity',
            'data' => $data
        ]);
    }

    /**
     * @Route("/particularity/create/", name="config_particularity_create")
     */
    public function particularityCreateAction(Request $request)
    {
        $data = new Particularity();
        $form = $this->createForm(ParticularityType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($data);
            $this->em->flush();

            $this->addFlash('success', 'The particularity "' . $data->getName() . '" has been created.');

            if (is_callable([$data, 'getType'])) {
                $type = $data->getType();
            }

            return $form->get('saveAndNew')->isClicked() ? $this->redirectToRoute('config_particularity_create', ['type' => $type]) : $this->redirectToRoute('config_particularity');
        }

        $form->get('type')->setData($request->query->get('type'));

        return $this->render('config/create.html.twig', [
            'subject' => 'particularity',
            'form' => $form->createView(),
            'data' => $data
        ]);
    }

    /**
     * @Route("/particularity/create/{id}", name="config_particularity_update")
     */
    public function particularityUpdateAction(Request $request, Particularity $particularity)
    {
        $form = $this->createForm(ParticularityType::class, $particularity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($particularity);
            $this->em->flush();

            $this->addFlash('success', 'The particularity "' . $particularity->getName() . '" has been updated.');

            return $this->redirectToRoute('config_particularity');
        }

        return $this->render('config/create.html.twig', [
            'subject' => 'particularity',
            'form' => $form->createView(),
            'data' => $particularity
        ]);
    }

    /**
     * @Route("/particularity/delete/{id}", name="config_particularity_delete")
     */
    public function particularityDeleteAction(Request $request, Particularity $particularity)
    {
        $this->em->remove($particularity);
        $this->em->flush();

        $this->addFlash('success', 'The particularity "' . $particularity->getName() . '" has been deleted.');

        return $this->redirectToRoute('config_particularity');
    }

    /**
     * 
     * Attribute
     * 
     */
    

    /**
     * @Route("/attribute", name="config_attribute")
     */
    public function attributeAction()
    {
        $repository = $this->em->getRepository(Attribute::class);
        $data = $repository->findAll();

        return $this->render('config/table.html.twig', [
            'subject' => 'attribute',
            'data' => $data
        ]);
    }

    /**
     * @Route("/attribute/create", name="config_attribute_create")
     */
    public function attributeCreateAction(Request $request)
    {
        $data = new Attribute();
        $form = $this->createForm(AttributeType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($data);
            $this->em->flush();

            $this->addFlash('success', 'The attribute "' . $data->getName() . '" has been created.');

            if (is_callable([$data, 'getType'])) {
                $type = $data->getType();
            }

            return $form->get('saveAndNew')->isClicked() ? $this->redirectToRoute('config_attribute_create') : $this->redirectToRoute('config_attribute');
        }

        return $this->render('config/create.html.twig', [
            'subject' => 'attribute',
            'form' => $form->createView(),
            'data' => $data
        ]);
    }

    /**
     * @Route("/attribute/update/{id}", name="config_attribute_update")
     */
    public function attributeUpdateAction(Request $request, Attribute $attribute)
    {
        $form = $this->createForm(AttributeType::class, $attribute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($attribute);
            $this->em->flush();

            $this->addFlash('success', 'The attribute "' . $attribute->getName() . '" has been updated.');

            return $this->redirectToRoute('config_attribute');
        }

        return $this->render('config/create.html.twig', [
            'subject' => 'attribute',
            'form' => $form->createView(),
            'data' => $attribute
        ]);
    }

    /**
     * @Route("/attribute/delete/{id}", name="config_attribute_delete")
     */
    public function attributeDeleteAction(Request $request, Attribute $attribute)
    {
        $this->em->remove($attribute);
        $this->em->flush();

        $this->addFlash('success', 'The attribute "' . $attribute->getName() . '" has been deleted.');

        return $this->redirectToRoute('config_attribute');
    }
}