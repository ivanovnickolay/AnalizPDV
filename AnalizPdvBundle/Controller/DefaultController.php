<?php

namespace AnalizPdvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AnalizPdvBundle\Entity\LoadFile;
use AnalizPdvBundle\Form\LoadFileForm;
use AnalizPdvBundle\Form\NewLoadFileForm;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //return $this->render('AnalizPdvBundle:Default:index.html.twig');
        return $this->render('AnalizPdvBundle:Default:index.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newLoadAction(Request $request)
    {
       $form = $this->createForm(NewLoadFileForm::class);
        $formHandler=$this->get("handler_load_file");
            if($formHandler->handler($form,$request))
                {
                    return $this->redirect($this->generateUrl('view_all_load'));
                }

            return $this->render('@AnalizPdv/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    public function newAction(Request $request)
    {
        $Load = new LoadFile();
        $form = $this->createForm(LoadFileForm::class, $Load);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $Load->getOriginalName();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->container->getParameter('file_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $Load->setUploadName($fileName);
            $Load->setTypeFile($file->getExtension());
            $Load->setOriginalName("dfws");

            $em = $this->getDoctrine()->getManager();
            $em->persist($Load);
            $em->flush();

            return $this->redirect($this->generateUrl('view_all_load'));
        }

        return $this->render('@AnalizPdv/new.html.twig', array('form' => $form->createView(),));
    }

    public function okAction(Request $request)
    {
        return $this->render('@AnalizPdv/ok.html.twig');

    }

    public function viewAction()
    {
        $Files = $this->getDoctrine()->getRepository("LoadFileBundle:LoadFile")->findAll();
        if (!$Files) {
            throw $this->createNotFoundException('Ошибка загрузки данных о файлах');
        }

        return $this->render('@AnalizPdv/ok.html.twig',array("files"=>$Files));
        //TODO добавить корректное отображение даты в шаблоне
    }
}
