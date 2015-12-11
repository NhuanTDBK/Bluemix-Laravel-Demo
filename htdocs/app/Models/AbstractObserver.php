<?php

namespace App\Models;

interface AbstractObserver
{
    //
    public function saved($model);
    public function saving($model);
    public function deleted($model);
    public function deleting($model);
}
