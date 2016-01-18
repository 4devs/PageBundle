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
     * init.
     *
     * @param string $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * set Manager.
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
     * persist page.
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
     * remove page.
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
     * get Class.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * create Static Page.
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
     * find One By criteria.
     *
     * @param array $criteria
     *
     * @return Page
     */
    public function findOneBy(array $criteria)
    {
        return $this->getRepository()->findOneBy($criteria);
    }

    /**
     * @param array      $criteria
     * @param array|null $orderBy
     * @param int|null   $limit
     * @param int|null   $offset
     *
     * @return array
     */
    public function findBy(array $criteria = [], array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->getRepository()->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @return ObjectManager
     */
    protected function getManager()
    {
        return $this->manager;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function getRepository()
    {
        return $this->manager->getRepository($this->class);
    }
}
