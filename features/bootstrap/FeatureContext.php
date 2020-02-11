<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Behat\Context\SnippetAcceptingContext;


/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawMinkContext implements Context, SnippetAcceptingContext
{

    public function __construct()
    {
    }


    /**
     * @Then I save references in a local storage device
     */
    public function iSaveReferencesInALocalStorageDevice()
    {
        $page = $this->getSession()->getPage();

        $content = $page->find('named', array('id', 'mw-content-text'));

        $references = $content->find('css', '.references'); //Find devuelve únicamente el primer match de la clase .references

        $items = $references->findAll('css', 'li'); //FindAll devuelve todos los elementos que coincidan con li

        $links = [];

        foreach ($items as $item) {
            $linkContainer = $item->find('xpath', '//span[@class="reference-text"]');
            $links[] = $linkContainer->find('xpath', '//a/@href')->getText();
        }

        file_put_contents('scrapped_references.txt', join(PHP_EOL, $links));
    }

    /**
     * @Then I take a screenshot
     */
    public function iTakeAScreenshot()
    {
        try {
            $image_data = $this->getSession()->getDriver()->getScreenshot();
            $file_and_path = '/tmp/'.strtotime(date()).'_screenshot.jpg';
            file_put_contents($file_and_path, $image_data);

        } catch (Exception $exception) {
            throw new \Exception('No se ha podido obtener la screenshot');
        }
    }

}
