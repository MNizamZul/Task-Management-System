<?php

namespace App\Enums;

enum TaskStatus: string
{
    case Todo = 'To Do';
    case InProgress = 'In Progress';
    case Done = 'Done';

    public function label(): string
    {
        return $this->value;
    }

    public function badgeClasses(): string
    {
        return match ($this) {
            self::Todo => 'bg-rose-100 text-rose-700',
            self::InProgress => 'bg-amber-100 text-amber-700',
            self::Done => 'bg-emerald-100 text-emerald-700',
        };
    }

    public function dashboardCardClasses(): string
    {
        return match ($this) {
            self::Todo => 'bg-rose-100 text-rose-900 shadow-rose-200/60',
            self::InProgress => 'bg-amber-100 text-amber-900 shadow-amber-200/60',
            self::Done => 'bg-emerald-100 text-emerald-900 shadow-emerald-200/60',
        };
    }

    public function dashboardLabelClasses(): string
    {
        return match ($this) {
            self::Todo => 'text-rose-700',
            self::InProgress => 'text-amber-700',
            self::Done => 'text-emerald-700',
        };
    }

    /**
     * @return list<string>
     */
    public static function values(): array
    {
        return array_map(
            static fn (self $status) => $status->value,
            self::cases(),
        );
    }
}
