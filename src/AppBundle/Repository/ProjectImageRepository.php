<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Agency;
use AppBundle\Entity\ProjectImage;
use Doctrine\ORM\EntityRepository;

class ProjectImageRepository extends EntityRepository
{
    public function findByAgencyAndPosition(Agency $agency, $position) {
        $projectImages = $this->getEntityManager()
            ->createQueryBuilder()
            ->select('projectImage')
            ->from(ProjectImage::class, 'projectImage')
            ->join('projectImage.project', 'project')
            ->where('project.agency = :agency')
            ->andWhere('projectImage.position = :position')
            ->setParameter('agency', $agency)
            ->setParameter('position', $position)
            ->getQuery()
            ->getResult();

        $indexProjectImages = array();

        foreach ($projectImages as $projectImage) {
            $indexProjectImages[$projectImage->getProject()->getId()] = $projectImage;
        }

        return $indexProjectImages;
    }
}
