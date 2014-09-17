<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

    /**
     * Example form factory
     * @return Form
     */
    protected function createComponentExampleForm()
    {
        $form = new Nette\Application\UI\Form;

        $form->addTextarea("text", NULL)
            ->setAttribute('cols', 80)
            ->setAttribute('rows', 20)
            ->getControlPrototype()->class("texyla");

        $form->addSubmit("s", "Submit");
        $form->onSuccess[] = callback($this, 'exampleFormSubmitted');
        return $form;
    }

	
	public function exampleFormSubmitted($form){

        $values = $form->getValues();

        dump($values);

        //add redirect later 

    }

	public function renderDefault()
	{


        $this->template->texytest = '
        Vítejte!
--------

Můžete používat syntax Texy!, pokud Vám vyhovuje:
- třeba **tučné** písmo nebo *kurzíva*
- a takto se dělá "odkaz":http://texy.info
- více najdete na stránce "syntax":[syntax]


Ale také můžete zůstat u HTML:
- takto <b>HTML</b>
- nebo i <b class=xx>úplně <i>hloupě</b>, Texy! to pořeší';

	}


    protected function createTemplate($class = NULL) {
        $template = parent::createTemplate($class);
        $texy = new \Texy();
        $texy->allowedTags = false;
        $template->registerHelper('texy', callback($texy, 'process'));
        return $template;
    }

}
