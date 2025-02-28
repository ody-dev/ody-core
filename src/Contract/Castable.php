<?php

declare(strict_types=1);
namespace Ody\Core\Contract;

interface Castable
{
    /**
     * Get the name of the caster class to use when casting from / to this cast target.
     *
     * @return CastsAttributes|CastsInboundAttributes|string
     */
    public static function castUsing();
}
