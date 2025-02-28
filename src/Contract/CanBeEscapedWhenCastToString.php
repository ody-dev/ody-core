<?php

declare(strict_types=1);
namespace Ody\Core\Contract;

interface CanBeEscapedWhenCastToString
{
    /**
     * Indicate that the object's string representation should be escaped when __toString is invoked.
     *
     * @param bool $escape
     * @return $this
     */
    public function escapeWhenCastingToString($escape = true);
}
