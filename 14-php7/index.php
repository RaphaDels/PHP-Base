<?php

function isMajor(int $age, array $contacts = []): bool {
    return $age >= 18;
}

var_dump(isMajor(19));
