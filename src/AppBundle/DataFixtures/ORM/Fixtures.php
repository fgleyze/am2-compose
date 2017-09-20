<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Agency;
use AppBundle\Entity\Associate;
use AppBundle\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $agency = $this->createAgency();
        $associate1 = $this->createAssociate1($agency);
        $associate2 = $this->createAssociate2($agency);
        $project = $this->createProject($agency);

        $manager->persist($agency);
        $manager->persist($associate1);
        $manager->persist($associate2);
        $manager->persist($project);

        $manager->flush();
    }

    private function createAgency()
    {
        $agency = new Agency();
        $agency->setName('AM2 Architecture');
        $agency->setCatchword('Une architecture pour tous');
        $agency->setDescription("AM2 Architecture est la collaboration de deux soeurs d'origine colombienne et diplômées Architectes HMONP ( = DPLG) en 2010. Pour enrichir leurs compétences, l’une, Martha Marin, a fait des études d'architecte d'intérieur, et l’autre, Angela Marin, d’urbanisme. Après plusieurs années de collaboration dans différentes agences d'architecture comme TOA Architectes ou Groupe 6, à Paris, Avignon, Marrakech et Bogota entre autre, elles décident en 2015 de s’associer pour créer leur propre structure. Grâce à leur bagage multiculturel et leurs formations, elles offrent, tout en étant moderne, une architecture sensible et fonctionnelle.");
        $agency->setAddress("103 rue du Chemin Vert, 75011 Paris");
        $agency->setEmail("am2-architecture@gmail.com");

        return $agency;
    }

    private function createAssociate1(Agency $agency)
    {
        $associate = new Associate();
        $associate->setFirstName('Angela');
        $associate->setLastName('Marin');
        $associate->setPhone('0783931191');
        $associate->setAgency($agency);

        return $associate;
    }

    private function createAssociate2(Agency $agency)
    {
        $associate = new Associate();
        $associate->setFirstName('Martha');
        $associate->setLastName('Marin');
        $associate->setPhone('0601020304');
        $associate->setAgency($agency);

        return $associate;
    }

    private function createProject(Agency $agency)
    {
        $project = new Project();
        $project->setTitle('La Ruche');
        $project->setDescription("La Ruche Qui Dit Oui fait appel à nous pour traduire leur philosophie et principes dans l’architecture de leurs nouveaux bureaux à Bastille. Ils souhaitent donner une nouvelle image aux clients et aux investisseurs : une start-up solide qui s’installe sereinement dans le marché ; une boite moderne, qui évolue et qui est prête à se développer au-delà des frontières.");
        $project->setFeatures("Client : La Ruche Qui Dit Oui");
        $project->setAgency($agency);

        return $project;
    }
}
