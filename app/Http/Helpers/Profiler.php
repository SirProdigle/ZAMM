<?php
/**
 * Created by PhpStorm.
 * User: rogue
 * Date: 02/12/2017
 * Time: 22:58
 */

namespace App\Http\Helpers;


class Profiler
{

    static function Start($flag)
    {
        global $p_times;
        if (null === $p_times)
            $p_times = [];
        if (!array_key_exists($flag, $p_times))
            $p_times[$flag] = ['total' => 0, 'open' => 0];
        $p_times[$flag]['open'] = microtime(true);
    }

   static function End($flag)
    {
        global $p_times;
        if (isset($p_times[$flag]['open'])) {
            $p_times[$flag]['total'] += (microtime(true) - $p_times[$flag]['open']);
            unset($p_times[$flag]['open']);
        }
    }

    static function Dump()
    {
        global $p_times;
        $dump = [];
        $sum = 0;
        foreach ($p_times as $flag => $info) {
            $dump[$flag]['elapsed'] = $info['total'];
            $sum += $info['total'];
        }
        foreach ($dump as $flag => $info) {
            $dump[$flag]['percent'] = $dump[$flag]['elapsed'] / $sum;
        }
        dd($dump);
    }


}