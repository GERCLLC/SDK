<?php

namespace GERCLLC\SDK\constructList\commandList\CommonGetInfo;

use GERCLLC\SDK\abstracts\AbstractCommand;

class PayData extends AbstractCommand
{
    /**
     * @var int $point_id
     */
    protected $point_id;

    /** @var array $dataArray */
    protected $dataArray = [];

    /**
     * @return int
     */
    public function getPointId(): int
    {
        return $this->point_id;
    }

    /**
     * @param int $point_id
     * @return $this
     */
    public function setPointId(int $point_id): self
    {
        $this->point_id = $point_id;

        return $this;
    }

    public function getArray(): array
    {
        if (!empty($this->getPointId())) {
            $this->dataArray['point_id'] = $this->getPointId();
        }

        return $this->dataArray;
    }

    public function valid(): bool
    {
        if (empty($this->getPointId())) {
            return false;
        }

        return true;
    }
}