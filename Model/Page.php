<?php
/**
 * @author Andrey Samusev <andrey_simfi@list.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FDevs\PageBundle\Model;

use Doctrine\Common\Collections\Collection;

abstract class Page implements MetaInterface, PageInterface
{
    use MetaTrait;
    use PageTrait;
    use TimestampableTrait;

    /**
     * @var string
     */
    protected $templateName;

    /**
     * init
     */
    public function __construct()
    {
        $this->preUpdate();
    }

    /**
     * get Name
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle() instanceof Collection && $this->getTitle()->first(
        ) instanceof LocaleText ? $this->getTitle()->first()->getText() : 'New Page';
    }

    /**
     * preUpdate
     *
     * @return $this
     */
    public function preUpdate()
    {
        $this->updateTime();
    }

    /**
     * @param string $templateName
     *
     * @return $this
     */
    public function setTemplateName($templateName)
    {
        $this->templateName = $templateName;

        return $this;
    }

    /**
     * @return string
     */
    public function getTemplateName()
    {
        return $this->templateName;
    }

}
