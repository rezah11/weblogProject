<?php
/**
 * @param array $numbers
 * @return array
 */
function filterInt(array $numbers): array
{
    return array_filter($numbers, function ($numbers) {
        return is_int($numbers);
    });
}
$numbers = [0, 0, 4, 3, null, 4];
//var_export(array_filter($numbers,$isInt));
//die();


foreach (filterInt($numbers) as $num) {
    echo $num;
};
