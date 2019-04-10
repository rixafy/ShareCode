<?php

declare(strict_types=1);

namespace App\Model\Variable;

use App\Entity\DateTimeTrait;
use App\Entity\UniqueTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="variable")
 * @ORM\HasLifecycleCallbacks
 */
class Variable
{
    use UniqueTrait;
    use DateTimeTrait;

    /**
     * @ORM\Column(type="string", unique=true, length=31)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="integer", length=31)
     * @var int
     */
    private $value;

    public function __construct(VariableData $variableData)
    {
        $this->edit($variableData);
    }

    public function edit(VariableData $variableData): void
	{
		$this->name = $variableData->name;
		$this->value = $variableData->value;
	}

    public function getValue(): int
    {
        return $this->value;
    }

    public function increaseValue(int $add = 1): void
    {
        $this->value += $add;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
