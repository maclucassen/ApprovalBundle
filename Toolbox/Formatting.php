<?php

/*
 * This file is part of the Kimai time-tracking app.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KimaiPlugin\ApprovalBundle\Toolbox;

use DateTime;
use Symfony\Contracts\Translation\TranslatorInterface;

class Formatting
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function parseDate(DateTime $dateTime)
    {
        $weekNumber = (clone $dateTime)->format('W');

        if ((clone $dateTime)->format('D') === 'Mon') {
            $startWeekDay = (clone $dateTime)->format('d.m.Y');
        } else {
            $startWeekDay = (clone $dateTime)->modify('last monday')->format('d.m.Y');
        }

        $endWeekDay = (clone $dateTime)->modify('next sunday')->format('d.m.Y');

        return (clone $dateTime)->format('F Y') . ' - ' . $this->translator->trans('label.week') . ' ' . $weekNumber . ' [' . $startWeekDay . ' - ' . $endWeekDay . ']';
    }
}
