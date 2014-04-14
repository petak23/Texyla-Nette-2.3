<?php

namespace App\Presenters;

use Nette,
	App\Model;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{


    /**
     * Texyla loader factory
     * @return TexylaLoader
     */
    protected function createComponentTexyla()
    {
        $baseUri = $this->context->httpRequest->url->baseUrl;
        $filter = new \WebLoader\Filter\VariablesFilter(array(
            "baseUri" => $baseUri,
            "previewPath" => $this->link("Texyla:preview"),
            "filesPath" => $this->link("Texyla:listFiles"),
            "filesUploadPath" => $this->link("Texyla:upload"),
            "filesMkDirPath" => $this->link("Texyla:mkDir"),
            "filesRenamePath" => $this->link("Texyla:rename"),
            "filesDeletePath" => $this->link("Texyla:delete"),
        ));

        $texyla = new \TexylaLoader($filter, $baseUri . "webtemp");
        return $texyla;
    }


    protected function createComponentCss()
    {

        $files = new \WebLoader\FileCollection(WWW_DIR . '/css');
        $files->addFiles(array(
            'screen.css',
            'print.css',
            WWW_DIR . '/js/texyla/css/style.css',
            WWW_DIR . '/css/jquery-ui1.8.24.css',
            WWW_DIR . '/js/texyla/themes/default/theme.css'
        ));
//        $files->addRemoteFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/ui-lightness/jquery-ui.css');

        $compiler = \WebLoader\Compiler::createCssCompiler($files, WWW_DIR . '/webtemp');
        $fil = new \WebLoader\Filter\CssUrlsFilter(WWW_DIR, $this->template->basePath);

        $compiler->addFileFilter($fil);

//        $compiler->addFilter(function ($code) {
//            return \CssMin::minify($code);
//        });

        $baseUri = $this->context->httpRequest->url->baseUrl;
        $control = new \WebLoader\Nette\CssLoader($compiler,  $baseUri . "webtemp");
        $control->setMedia('screen');

        return $control;
    }

    protected function createComponentJs()
    {

        $files = new \WebLoader\FileCollection(WWW_DIR . '/js');
        $files->addFiles(array(
            WWW_DIR . '/js/jquery1.7.2.min.js',
            WWW_DIR . '/js/jquery-ui1.8.1.min.js',
            WWW_DIR . '/js/netteForms.js'
        ));
//        $files->addRemoteFile('http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js');
//        $files->addRemoteFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js');

        $compiler = \WebLoader\Compiler::createJsCompiler($files, WWW_DIR . '/webtemp');

//        $compiler->addFilter(function ($code) {
//            return \JSMin::minify($code, "remove-last-semicolon");
//        });

        $control = new \WebLoader\Nette\JavaScriptLoader($compiler, $this->template->basePath . '/webtemp');

        return $control;
    }

}
