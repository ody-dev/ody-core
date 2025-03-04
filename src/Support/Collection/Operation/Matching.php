<?php

declare(strict_types=1);

namespace Ody\Core\Support\Collection\Operation;

use Closure;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\ClosureExpressionVisitor;
use Doctrine\Common\Collections\Order;
use Generator;
use Ody\Core\Support\Collection\Contract\Operation\Sortable;

/**
 * @immutable
 *
 * @template TKey
 * @template T
 */
final class Matching extends AbstractOperation
{
    /**
     * @return Closure(Criteria): Closure(iterable<TKey, T>): Generator<TKey, T>
     */
    public function __invoke(): Closure
    {
        return
            /**
             * @return Closure(iterable<TKey, T>): Generator<TKey, T>
             */
            static function (Criteria $criteria): Closure {
                $expr = $criteria->getWhereExpression();
                $pipes = [];

                if (null !== $expr) {
                    /** @var Closure(T): bool $filterCallback */
                    $filterCallback = (new ClosureExpressionVisitor())->dispatch($expr);
                    $pipes[] = (new Filter())()($filterCallback);
                }

                $orderings = $criteria->orderings();

                if ([] !== $orderings) {
                    $next = null;

                    foreach (array_reverse($orderings) as $field => $ordering) {
                        $next = ClosureExpressionVisitor::sortByField($field, Order::Descending === $ordering ? -1 : 1, $next);
                    }

                    $pipes[] = (new Sort())()(Sortable::BY_VALUES)($next);
                }

                $offset = $criteria->getFirstResult();
                $length = $criteria->getMaxResults();

                $pipes[] = (new Limit())()($length ?? -1)($offset ?? 0);

                /** @var Closure(iterable<TKey, T>): Generator<TKey, T> $pipe */
                $pipe = (new Pipe())()(...$pipes);

                // Point free style.
                return $pipe;
            };
    }
}
