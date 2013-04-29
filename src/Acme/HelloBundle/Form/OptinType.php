<?php
namespace Acme\HelloBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class OptinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('email');
	}

	public function getName()
	{
		return 'optin';
	}
}