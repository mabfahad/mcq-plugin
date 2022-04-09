<?php

class SemcqDeactivator
{
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}