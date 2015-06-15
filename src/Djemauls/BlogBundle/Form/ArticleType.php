<?php

namespace Djemauls\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('publication','checkbox', array("required"=>false))
            ->add('contenu','textarea',array('attr'=>array('class'=>'cheditor')))
            ->add('auteur','text')
    //        ->add('pays')
            ->add('datecreation')
    //        ->add('image')
            ->add('categories','entity',array("class" => "DjemaulsBlogBundle:Categorie",
                            "property" => "nom", 
                            "multiple" => true,
                            "expanded" => true)
                )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Djemauls\BlogBundle\Entity\Article'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'djemauls_blogbundle_article';
    }
}
