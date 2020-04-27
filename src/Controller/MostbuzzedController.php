<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\BuzzManager;

class MostbuzzedController extends AbstractController
{
    /**
     * Display all tvshow informations
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function buzz()
    {
        $buzzManager = new BuzzManager();
        $buzzes = $buzzManager->selectNbBuzzed();

        return $this->twig->render('Mostbuzzed/buzz.html.twig', ['buzzes' => $buzzes]);
    }
}
