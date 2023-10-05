<?php

namespace App\DataFixtures;

use App\Entity\Librairie;
use App\Entity\Livre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const LIBRAIRIE_OLIVIER = 'librairie-olivier';
    private const LIBRAIRIE_SLASH = 'librairie-slash';

    private static function librairieDataGenerator()
    {
        yield ["Livres d'Olivier", self::LIBRAIRIE_OLIVIER];
        yield ["Collection de 400 livres", self::LIBRAIRIE_SLASH];
    }

    private static function livresGenerator()
    {
        yield [self::LIBRAIRIE_OLIVIER, "Titre 1", "Auteur 1", "Description du livre 1"];
        yield [self::LIBRAIRIE_OLIVIER, "Titre 2", "Auteur 2", "Description du livre 2"];
        yield [self::LIBRAIRIE_SLASH, "Titre 3", "Auteur 3", "Description du livre 3"];
    }

    public function load(ObjectManager $manager)
    {
        foreach (self::librairieDataGenerator() as [$description, $librairieReference]) {
            $librairie = new Librairie();
            $librairie->setDescription($description);
            $manager->persist($librairie);
            $manager->flush();

            $this->addReference($librairieReference, $librairie);
        }

        foreach (self::livresGenerator() as [$librairieReference, $titre, $auteur, $description]) {
            $librairie = $this->getReference($librairieReference);
            $livre = new Livre();
            $livre->setTitre($titre);
            $livre->setAuteur($auteur);
            $livre->setDescription($description);
            $livre->setLibrairie($librairie);

            $manager->persist($livre);
        }
        $manager->flush();
    }
}
