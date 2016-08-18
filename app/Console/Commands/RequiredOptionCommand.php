<?php

namespace App\Console\Commands;

trait RequiredOptionCommand
{
    public function requireOption($name, $error)
    {
        if ($this->option($name))
            return $this->option($name);

        $this->error($error);
        exit;
    }
}
