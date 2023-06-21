<?php

namespace App\Domain\Features;

interface SaveBook
{
    public function handle(array $data);
}
