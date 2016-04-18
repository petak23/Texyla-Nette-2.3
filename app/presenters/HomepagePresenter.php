<?php

namespace App\Presenters;

use Nette;

/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter {
  
  /**
   * Example form factory
   * @return Form
   */
  protected function createComponentExampleForm() {
    $form = new Nette\Application\UI\Form;

    $form->addTextarea("text", NULL)
        ->setAttribute('cols', 80)
        ->setAttribute('rows', 20)
        ->getControlPrototype()->class("texyla");

    $form->addSubmit("s", "Submit");
    $form->onSuccess[] = $this->exampleFormSubmitted;
    return $form;
  }
	
	public function exampleFormSubmitted($form) {
    $values = $form->getValues();
    dump($values);
  }

	public function renderDefault() {
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
    $this->texy->allowedTags = false;
    $this->texy->headingModule->balancing = "FIXED";
    $template->addFilter('texy', [$this->texy, 'process']);
    return $template;
  }

}
