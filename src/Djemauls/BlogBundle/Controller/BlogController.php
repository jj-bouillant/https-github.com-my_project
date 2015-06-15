<?php

namespace Djemauls\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Djemauls\BlogBundle\Entity\Article;
use Djemauls\BlogBundle\Form\ArticleType;
use Djemauls\BlogBundle\Entity\Image;
use Djemauls\BlogBundle\Entity\Commentaire;
use Djemauls\BlogBundle\Entity\Categorie;

class BlogController extends Controller
{
    public function indexAction()
    {

        $repository = $this->getDoctrine()->getManager()->getRepository("DjemaulsBlogBundle:Article");
        /* $article_x est une instance de Djemauls\BlogBundle\Entity\Article */  
        /* $listarticles = $repository->findAll(); */
        $listarticles = $repository->getArticles();

        /* foreach($listarticles as $article)
        {
        	// $article est une instance de Article
        	echo $article->getContenu();
        }

    /*  */    
        return $this->render('DjemaulsBlogBundle:Blog:index.html.twig', array('lart' => $listarticles));
    }


    public function voirAction($id)
    {
    	/*

    	$repository = $this->getDoctrine()->getManager()->getRepository(("DjemaulsBlogBundle:Article"));
    	$repositoryC = $this->getDoctrine()->getManager()->getRepository(("DjemaulsBlogBundle:Commentaire"));
    	
        // $article_x est une instance de Djemauls\BlogBundle\Entity\Article  
        $article1 = $repository->find($id);
        $commentaires = $repositoryC->findBy(array("article" => $article1));
       

        $listarticles = $repository->getArticles();
    
        return $this->render('DjemaulsBlogBundle:Blog:voir.html.twig', array('article' => $article1, 'commentaires' => $commentaires));
        */
        $repository = $this->getDoctrine()->getManager()->getRepository(("DjemaulsBlogBundle:Article"));

        $article1 = $repository->getArticle($id);

        return $this->render('DjemaulsBlogBundle:Blog:voir.html.twig', array('article' => $article1));
    }




    public function ajouterAction($ref)
    {
    	$article = new Article();
    	$form = $this->createForm(new ArticleType, $article);
    	

    	$request = $this->getRequest();
    	if ($request->getMethod() == "POST" ) {
    		$form->handleRequest($request);
    		if ($form->isValid()) {
    			

    			//$session = $this->get('session');
    			// Idéalement le mettre dans un try
    			try {
    			$entityManager = $this->getDoctrine()->getManager();
    			$entityManager->persist($article);
    			$entityManager->flush();
    		        } catch (Exception $ex) {
    		}
    	}
			return $this->render('DjemaulsBlogBundle:Blog:ajouter.html.twig', array(
    			'form' => $form->createView()));

    	/* 2ieme solution ---------------------------------------------------------------------------
    	$article = new Article();
    	// on cré le formbuilder grace a la methode du controleur
    	$formBuilder = $this->createFormBuilder($article);
    	// on ajoute les champs de l'entité que l'on veut a notre formulaire
    	$formBuilder
    	->add('datecreation', 'date')
    	->add('titre',        'text')
    	->add('contenu',      'textarea')
    	->add('auteur',       'text')
    	->add('publication',  'checkbox');
    	// pour l'instant, pas de commentaires, catego
    	$form = $formBuilder->getForm();
    	return $this->render('DjemaulsBlogBundle:Blog:ajouter.html.twig', array(
    	'form' => $form->createView())); /*
		---------------------------------------------------------------------------------------------

	/* dans ajouter
    <!--  #   <h1>CREATION Article/Commentaire/Image </h1>
    #   Id Article : {{ article.id }} <br>
    #   Titre Art  : {{ article.titre }} <br>
    #   Auteur Art : {{ article.auteur }} <br>
    #   Contenu Art: {{ article.contenu }} <br>
    #   Image   : <img src="{{asset('images/') }}{{ article.image.url }}" alt="{{asset('images/') }}{{ article.image.url }}" width="100" height="70" /> #<br>
    #   Id commentaire...... : {{ commentaire.id }} 
    #   Auteur Commentaire.. : {{ commentaire.auteur }} 
    #   Contenu Commmentaire : {{ commentaire.contenu }} 
      -->


    	// 1iere solution --------------------------------------------
        /* $em = $this->getDoctrine()->getManager();
        $image1   = new Image;
        $image1   ->setUrl('jjb2.jpeg')
                  ->setAlt('Image du gars jjb1c');

        $categorie1  = new Categorie;
        $categorie1     ->setNom('Sport');

        $categorie2  = new Categorie;
        $categorie2     ->setNom('Politique');

        $categorie3  = new Categorie;
        $categorie3     ->setNom('Emploi');
                        /* ->setArticle($article1); 
        $em-> persist($categorie1);
        $em-> persist($categorie2);
        $em-> persist($categorie3);

        $article1 = new Article;
        $article1 ->setTitre('Titre Article 26')
                  ->setAuteur('Djémauls')
                  ->setImage($image1)
                  ->addCategory($categorie1)
                  ->setContenu('C-Nous avons déclare que PHP Symfony est plutôt cool pour développer mes projets');
        

        $commentaire1   = new Commentaire;
        $commentaire1   ->setAuteur('Ambre')
                        ->setContenu('Contenu du commentaire Ambre')
                        ->setArticle($article1);
        $commentaire2   = new Commentaire;
        $commentaire2   ->setAuteur('Fauve')
                        ->setContenu('Contenu du commentaire Fauve')
                        ->setArticle($article1);
        
        /* demande à l'entité manager de commencer une transaction 
        $em-> persist($article1);
        $em-> persist($commentaire1);
        $em-> persist($commentaire2);

        $article1 ->setTitre('Titre Article 26')
                  ->setAuteur('Djémauls')
                  ->setImage($image1)
                  ->addCategory($categorie2)
                  ->setContenu('C-Nous avons déclare que PHP Symfony est plutôt cool pour développer mes projets');
        $em-> persist($article1);
        $article1 ->setTitre('Titre Article 26')
                  ->setAuteur('Djémauls')
                  ->setImage($image1)
                  ->addCategory($categorie3)
                  ->setContenu('C-Nous avons déclare que PHP Symfony est plutôt cool pour développer mes projets');
        $em-> persist($article1);
        /* Il efface ce qu'il y a dans la mémoire tampon 
        $em->clear(); 
        Remets à à la valeur initiale la valeur 
        $em->refresh($article);
        Delete un $article
        $em->remove($article);*/
        /* Il démarre la transaction et s'il n'y a pas de PB, il fait le COMMIT
        Mettre :     {% include "DjemaulsBlogBundle:Blog:formulaire.html.twig" %} pour le formulaire 
        $em->flush();
        return $this->render('DjemaulsBlogBundle:Blog:ajouter.html.twig', array(
        'article' => $article1, 'image' => $image1, 'commentaire' => $commentaire1)); 
        */
    }

}



    public function modifierAction($art)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(("DjemaulsBlogBundle:Article"));
        /* $article_x est une instance de Djemauls\BlogBundle\Entity\Article */  
        $article12 = $repository->find($art);
    /*  */    


		$em = $this->getDoctrine()->getManager();
        
        $article12 ->setTitre('Hello world Mofif-3')
                   ->setAuteur('Djémauls')
                   ->setContenu('Modif-3-Toutefois, il se peut que certains scripts seront produits en Java');

        $em-> persist($article12);
       
        $em->flush();

    /*  
        return $this->render('DjemaulsBlogBundle:Blog:modifier.html.twig', array('article' => $article12));*/
   
        return $this->redirect($this->generateUrl('djemauls_blog_voir', array('id' => $article12->getId())));
    }



    public function menugAction()
    {
        
        $repository = $this->getDoctrine()->getManager()->getRepository(("DjemaulsBlogBundle:Article"));
        /* $article_x est une instance de Djemauls\BlogBundle\Entity\Article */  
        $listarticles = $repository->findBy(array('auteur'=>'djemauls'),
        	                                 array('datecreation'=>'desc'),
        	                                 5,
        	                                 0);

        /* foreach($listarticles as $article)
        {
        	// $article est une instance de Article
        	echo $article->getContenu();
        }

    /*  */    
        /* $articles=array(
            array("titre"=>"Hello World 1", "contenu"=>"Lorem ipsum dolor"),
            array("titre"=>"Hello World 2", "contenu"=>"Lorem ipsum dolor"),
            array("titre"=>"Hello World 3", "contenu"=>"Lorem ipsum dolor"),
            );
           */
        return $this->render('DjemaulsBlogBundle:Blog:menug.html.twig', array('larticles' => $listarticles));
    }


}
