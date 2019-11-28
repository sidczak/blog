<?php

namespace BlogAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('file', 'file')
            ->add('excerpt', 'textarea', array('attr' => array('rows' => '3')))
            ->add('content', 'textarea', array('attr' => array('rows' => '18')))
            ->add('author_email', 'email')
            ->add('status_post', 'choice', array(
                'choices' => array(
                    'publish' => 'Publish', 
                    'expect' => 'Expect', 
                    'draft' => 'Draft',
                ),
                'expanded' => false
            ))
            ->add('show_comment', 'checkbox', array(
                'label' => 'Show comment',
            ))
            ->add('enable_comment', 'checkbox', array(
                'label' => 'Enable comment',
            ))
            ->add('views_post')
            ->add('published_at', 'date', array(
            	'widget' => 'single_text',
            	'attr' => array('placeholder' => 'YYYY-MM-DD'),
            ))
            ->add('updated_at', 'date', array(
            	'widget' => 'single_text',
            	'attr' => array('placeholder' => 'YYYY-MM-DD'),
            ))
            ->add('category')
            ->add('tags', null, array(
                'expanded' => true,
            	'required' => true,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
       $this->configureOptions($resolver);
        
        $resolver->setDefaults(array(
            'data_class' => 'BlogAdminBundle\Entity\Post'
        ));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        //define your defaults here
        $resolver->setDefaults(array(
            'widget' => 'single_text',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'blogadminbundle_post';
    }
}
