<?php

namespace FDevs\PageBundle\Model;

abstract class OpenGraphPage extends Page implements OpenGraphInterface
{
    use PreviewTrait;
    use OpenGraphTrait;
}
