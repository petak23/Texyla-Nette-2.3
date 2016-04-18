<?php

namespace App\Presenters;

use Nette;
use Texy;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter {
  
  /** @var Nette\Http\Request @inject*/
  public $httpRequest;

  /** @var Texy\Texy @inject */
	public $texy;
  
  /** @var \WebLoader\Nette\LoaderFactory @inject */
  public $webLoader;
  
  /**
   * Texyla loader factory
   * @return TexylaLoader
   */
  protected function createComponentTexyla() {
    $baseUri = $this->httpRequest->getUrl()->baseUrl;
    $filter = new \WebLoader\Filter\VariablesFilter(array(
        "baseUri" => $baseUri,
        "previewPath" => $this->link("Texyla:preview"),
        "filesPath" => $this->link("Texyla:listFiles"),
        "filesUploadPath" => $this->link("Texyla:upload"),
        "filesMkDirPath" => $this->link("Texyla:mkDir"),
        "filesRenamePath" => $this->link("Texyla:rename"),
        "filesDeletePath" => $this->link("Texyla:delete"),
    ));

    $texyla = $this->webLoader->createJavaScriptLoader('texyla');
    $texyla->getCompiler()->addFilter($filter);
    return $texyla;
  }

    /** @return CssLoader */
  protected function createComponentCss() {
    $css = $this->webLoader->createCssLoader('default');
    $css->getCompiler()->addFilter(function ($code) {
      return \CssMin::minify($code);
    });
    $css->setMedia('screen');
    return $css;
  }

  /** @return JavaScriptLoader */
  protected function createComponentJs() {
    $js = $this->webLoader->createJavaScriptLoader('default');
    $js->getCompiler()->addFilter(function ($code) {
        return \JSMin::minify($code, "remove-last-semicolon");
    });
    return $js;
  }
    
}
