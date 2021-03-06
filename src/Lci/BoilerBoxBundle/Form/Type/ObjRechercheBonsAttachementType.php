<?php
namespace Lci\BoilerBoxBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;


use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Lci\BoilerBoxBundle\Entity\User;
use Lci\BoilerBoxBundle\Entity\SiteBA;


class ObjRechercheBonsAttachementType extends AbstractType {
	/**
     * @param FormBuilderInterface $builder
     * @param array $options
    */
	public function buildForm(FormBuilderInterface $builder, array $option) {
		$builder
        ->add('user', EntityType::class, array(
            'class'           => User::class,
            'label'           => 'Intervenant',
            'label_attr'      => array('class' => 'label_smalltext'),
			'attr'			  => array(
				'class' 		=> 'smallselect',
			),
			'choice_label'    => 'label',
			'placeholder'   => 'Tout intervenant',
			'query_builder'   => function(EntityRepository $er){
				return $er->createQueryBuilder('u')->orderBy('u.label', 'ASC');
			}
        ))
        ->add('userInitiateur', EntityType::class, array(
            'class'           => User::class,
            'label'           => 'Initiateur du bon',
            'label_attr'      => array('class' => 'label_smalltext'),
            'attr'            => array(
                'class'         => 'smallselect',
            ),
            'choice_label'    => 'label',
            'placeholder'     => 'Tout initiateur',
            'query_builder'   => function(EntityRepository $er){
                return $er->createQueryBuilder('u')->orderBy('u.label', 'ASC');
            }
        ))
		->add('numeroAffaire', TextType::class, array(
            'label' 	 => 'Numéro d\'affaire',
			'label_attr' => array('class' => 'label_smalltext'),
			'trim' 		 => true,
            'attr' 		 => array(
				'class' 	  => 'biginput upper centrer',
                'placeholder' => 'XXXXXX',
				'maxlength'   => 7
            ),
        ))
        ->add('numeroBA', TextType::class, array(
            'label'      => 'Numéro de bon',
            'label_attr' => array('class' => 'label_smalltext'),
            'trim'       => true,
            'attr'       => array(
                'class'       => 'biginput upper centrer',
                'placeholder' => 'XXXXXX',
                'maxlength'   => 6
            ),
        ))
       ->add('site', EntityType::class, array(
            'class'         => SiteBA::class,
			'label' 		=> 'Nom du site',
			'choice_label'	=> 'intitule',
			'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('ba')
                    ->orderBy('ba.intitule', 'ASC');
            },
			'required'      => true,
            'label_attr'    => array ('class' => 'label_smalltext'),
            'attr'          => array('class' => 'smallselect'),
			'placeholder'   => 'Tout site'
		))
        ->add('nomDuContact', TextType::class, array(
            'label'         => 'Nom du contact',
            'label_attr'    => array ('class' => 'label_smalltext'),
            'required'      => true,
            'trim'          => true,
            'attr'          => array(
                'class'         => 'biginput centrer'
            )
        ))
	 	->add('saisie', ChoiceType::class, array(
			'label'			=> 'Type de bon',
			'label_attr' 	=> array('class' => 'label_smalltext'),
			'expanded'		=> true,
			'multiple'		=> false,
			'choices'		=> array(
                'Tous type de bons' => null,
                'Bons saisis'    	=> true,
                'Bons non saisis'   => false
			),
            'required'    	=> false
		))
		->add('dateMin', DateType::class, array(
            'label' 	 => 'Signé (entre) le ',
            'label_attr' => array('class' => 'label_smalltext'),
            'widget' 	 => 'single_text',
            'input' 	 => 'string',
            'format'     => 'dd-MM-yyyy',
            'invalid_message' => 'Format de la date incorrect.',
            'attr' 		 => array(
                'class' 	  => 'smalldate',
                'placeholder' => 'dd/mm/YYYY',
				'maxlength'   => 10
            )
        ))
		->add('dateMax', DateType::class, array(
            'label' 	 => 'et',
            'label_attr' => array('class' => 'label_smalltext'),
            'widget' 	 => 'single_text',
            'input' 	 => 'string',
            'format'     => 'dd-MM-yyyy',
            'invalid_message' => 'Format de la date incorrect.',
            'attr' 		 => array(
                'class' 	  => 'smalldate',
                'placeholder' => 'dd/mm/YYYY',
				'maxlength'   => 10
            )
        ))
        ->add('dateMinInitialisation', DateType::class, array(
            'label'      => 'Initialisé (entre) le ',
            'label_attr' => array('class' => 'label_smalltext'),
            'widget'     => 'single_text',
            'input'      => 'string',
            'format'     => 'dd-MM-yyyy',
            'invalid_message' => 'Format de la date incorrect.',
            'attr'       => array(
                'class'       => 'smalldate',
                'placeholder' => 'dd/mm/YYYY',
                'maxlength'   => 10
            )
        ))
        ->add('dateMaxInitialisation', DateType::class, array(
            'label'      => 'et',
            'label_attr' => array('class' => 'label_smalltext'),
            'widget'     => 'single_text',
            'input'      => 'string',
            'format'     => 'dd-MM-yyyy',
            'invalid_message' => 'Format de la date incorrect.',
            'attr'       => array(
                'class'       => 'smalldate',
                'placeholder' => 'dd/mm/YYYY',
                'maxlength'   => 10
            )
        ))
        ->add('dateMinIntervention', DateType::class, array(
            'label'      => 'Intervention (entre) le ',
            'label_attr' => array('class' => 'label_smalltext'),
            'widget'     => 'single_text',
            'input'      => 'string',
            'format'     => 'dd-MM-yyyy',
            'invalid_message' => 'Format de la date incorrect.',
            'attr'       => array(
                'class'       => 'smalldate',
                'placeholder' => 'dd/mm/YYYY',
                'maxlength'   => 10
            )
        ))
        ->add('dateMaxIntervention', DateType::class, array(
            'label'      => 'et',
            'label_attr' => array('class' => 'label_smalltext'),
            'widget'     => 'single_text',
            'input'      => 'string',
            'format'     => 'dd-MM-yyyy',
            'invalid_message' => 'Format de la date incorrect.',
            'attr'       => array(
                'class'       => 'smalldate',
                'placeholder' => 'dd/mm/YYYY',
                'maxlength'   => 10
            )
        ))
        ->add('valideur', EntityType::class, array(
            'class'           => User::class,
            'label'           => 'Validé par',
            'label_attr'      => array('class' => 'label_smalltext'),
            'attr'            => array(
                'class'         => 'smallselect',
            ),
            'choice_label'    => 'label',
            'placeholder'     => 'Tout valideur',
            'query_builder'   => function(EntityRepository $er){
                return $er->createQueryBuilder('u')->orderBy('u.label', 'ASC');
            }
        ))
		->add('validationTechnique', CheckboxType::class, array(
			'label'       => 'Technique',
            'label_attr'  => array('class' => 'label_smalltext'),
            'attr'        => array(
            	'class'       => 'input_checkbox'
            ),
            'required'    => false
        ))
        ->add('validationHoraire', CheckboxType::class, array(
            'label'       => 'Horaire',
            'label_attr'  => array('class' => 'label_smalltext'),
            'attr'        => array(
                'class'       => 'input_checkbox'
            ),
            'required'    => false
        ))
        ->add('validationSAV', CheckboxType::class, array(
            'label'       => 'SAV',
            'label_attr'  => array('class' => 'label_smalltext'),
            'attr'        => array(
                'class'       => 'input_checkbox'
            ),
            'required'    => false
        ))
        ->add('validationFacturation', CheckboxType::class, array(
            'label'       => 'Facturation',
            'label_attr'  => array('class' => 'label_smalltext'),
            'attr'        => array(
                'class'       => 'input_checkbox'
            ),
            'required'    => false
        ))
		->add('sensValidation', ChoiceType::class, array(
			'label'		=> 'Validation',
			'choices'	=> array(
                'Aucune'  			=> null,
                'Bons validés'  	=> true,
                'Bons non validés' 	=> false
			),
			'expanded'	=> true,
			'multiple'	=> false
		));
	}



    /*
     * @param OptionsResolver $resolver
    */
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => 'Lci\BoilerBoxBundle\Entity\ObjRechercheBonsAttachement'
        ));
    }


    /**
     * @return string
    */
    public function getName(){
        return 'lci_boilerboxbundle_rechercheBonsAttachement';
    }

}
