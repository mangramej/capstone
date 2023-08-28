<?php

namespace App\Modules\Traits;

use WireUi\Traits\Actions;

trait WithAlert
{
    use Actions;

    public function alert(string $type, string $title, string $description = null, string $event = null): void
    {
        if (! in_array($type, ['success', 'error', 'warning', 'info'])) {
            return;
        }

        if ($type === 'success') {
            $this->notification()->success(
                title: $title,
                description: $description
            );
        }

        if ($type === 'error') {
            $this->notification()->error(
                title: $title,
                description: $description
            );
        }

        if ($type === 'warning') {
            $this->notification()->warning(
                title: $title,
                description: $description
            );
        }

        if ($type === 'info') {
            $this->notification()->info(
                title: $title,
                description: $description
            );
        }

        if (! is_null($event)) {
            $this->emit($event);
        }
    }
}
