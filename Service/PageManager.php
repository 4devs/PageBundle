<?php

namespace FDevs\PageBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use FDevs\PageBundle\Model\Page;

abstract class PageManager
{
    /** @var ObjectManager */
    private $manager;

    /** @var string */
    private $class;

    /**
     * init
     *
     * @param string $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * set Manager
     *
     * @param ObjectManager $manager
     *
     * @return self
     */
    public function setManager($manager)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * persist page
     *
     * @param Page $page
     *
     * @return $this
     */
    public function persist(Page $page)
    {
        $this->manager->persist($page);

        return $this;
    }

    /**
     * remove page
     *
     * @param Page $page
     *
     * @return $this
     */
    public function remove(Page $page)
    {
        $this->manager->remove($page);

        return $this;
    }

    /**
     * get Class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * create Static Page
     *
     * @return Page
     */
    public function createPage()
    {
        $class = $this->getClass();
        $page = new $class();

        return $page;
    }

    /**
     * find One By criteria
     *
     * @param array $criteria
     *
     * @return Page
     */
    public function findOneBy(array $criteria)
    {
        return $this->manager->getRepository($this->class)->findOneBy($criteria);
    }
}
