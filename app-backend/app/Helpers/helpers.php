<?php

if (!function_exists('getPortugueseModelName')) {
    function getPortugueseModelName($modelName)
    {
        $models = config('translations.models');


        return $models[$modelName] ?? $modelName;
    }
}
