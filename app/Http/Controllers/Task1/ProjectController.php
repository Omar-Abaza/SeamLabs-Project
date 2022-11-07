<?php

namespace App\Http\Controllers\Task1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{


    /**
     *
     * the count of all numbers except numbers with a 5 in it
     *
     * @param int $start
     * @param int $end
     * @return int
     *
     * */
    public function firstQues(int $start, int $end)
    {
        $count = 0;
        for ($i = $start; $i <= $end; $i++) {
            $i = (string) $i;
            $array_of_nums  = array_map('intval', str_split($i));
            if (in_array(5, $array_of_nums)) {
                continue;
            }
            $count++;
        }
        return $count;
    }

    /**
     *
     * convert alphabetic string to the index of this string.
     *
     * @param string $input_string
     * @return int
     *
     * */
    public function secondQues(string $input_string)
    {
        $input_string = strtoupper($input_string);
        $result = 0;
        for ($i = 0; $i < strlen($input_string); $i++) {
            $result *= 26;
            $result += ord($input_string[$i]) - ord('A') + 1;
        }
        return $result;
    }

    /**
     *
     * @param int $a
     * @param int $b
     * @return int
     * */
    private function math_min($a, $b)
    {
        return ($a <= $b) ? $a : $b;
    }

    /**
     *
     * the number of steps required in order to reduce the given numbers in array to zero
     *
     * @param string $input_string
     * @return array
     *
     * */
    public function thirdQues(Request $request)
    {
        $sizeOfQ_Array = $request->sizeOfQ_Array;
        $Q_array = $request->Q_array;
        for ($i = 0; $i < $sizeOfQ_Array; $i++) {
            $sizeOfX_Array = $Q_array[$i];
            if ($sizeOfX_Array <= 3) {
                $Q_array[$i] = $sizeOfX_Array;
                break;
            }
            $X_array = array_fill(0, $sizeOfX_Array + 1, 0);
            $X_array[0] = 0;
            $X_array[1] = 1;
            $X_array[2] = 2;
            $X_array[3] = 3;

            $res = 0;
            for ($j = 4; $j <= $sizeOfX_Array; $j++) {
                $res = 1 + $X_array[$j - 1];
                $a = 2;
                while ($a * $a <= $j) {
                    if ($j % $a == 0) {
                        $res = ProjectController::math_min($res, 1 + $X_array[$j / $a]);
                    }
                    $a += 1;
                }
                $X_array[$j] = $res;
            }
            $Q_array[$i] = $X_array[$sizeOfX_Array];
        }
        return $Q_array;
    }

    ///////////
    // public function anotherThirdQues(int $n)
    // {
    //     if ($n <= 3) return $n;
    //     $Q_array = array_fill(0, $n, 0);
    //     $Q_array[0] = 0;
    //     $Q_array[1] = 1;
    //     $Q_array[2] = 2;
    //     $Q_array[3] = 3;
    //     $res = 0;
    //     for ($i = 4; $i <= $n; $i++) {
    //         $res = 1 + $Q_array[$i - 1];
    //         $a = 2;
    //         while ($a * $a <= $i) {
    //             if ($i % $a == 0) {
    //                 $res = ProjectController::math_min($res, 1 + $Q_array[$i / $a]);
    //             }
    //             $a += 1;
    //         }
    //         $Q_array[$i] = $res;
    //     }
    //     return $Q_array[$n];
    // }
}
