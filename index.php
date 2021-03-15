<?php
$output = '<form method="get">
    <h2>Форма квадратного уравнения Ax<sup>2</sup> + Bx + C = 0</h2>
    <p>Ввод коэффициентов</p>
    A: <input type="text" name="A" value=' . (isset($_GET['A']) ? $_GET['A'] : '') . '><br>
    B: <input type="text" name="B" value=' . (isset($_GET['B']) ? $_GET['B'] : '') . '><br>
    C: <input type="text" name="C" value=' . (isset($_GET['C']) ? $_GET['C'] : '') . '><br>
    <label>Метод решения:
    <select name="solver">
        <option value="d" ' . (isset($_GET['solver']) && ($_GET['solver'] == 'd') ? ' selected' : '') . '>Через дискриминант</option>
        <option value="v" ' . (isset($_GET['solver']) && ($_GET['solver'] == 'v') ? ' selected' : '') . '>По теореме Виета</option>
    </select>
    </label><br>
    <input type="submit" value="Рассчитать корни">';

if (!empty($_GET['A'])) {
    $a = $_GET['A'];
    $b = $_GET['B'];
    $c = $_GET['C'];
    $solver = $_GET['solver'];
    if ($solver === 'd') {
        $dsc = $b ** 2 - (4 * $a * $c);
        if ($a == 0) {
            $x = round(-$c / $b, 2);
            $output .='<br> Решение: <br>' . 'x = ' . $x;
        } elseif ($dsc > 0){
            $x1 = ((-$b) + pow($dsc, 0.5)) / (2 * $a);
            $x2 = ((-$b) - pow($dsc, 0.5)) / (2 * $a);
            $output .='<br> Решение: <br>' . 'x1 = ' . $x1 . '; ' . '<br>' . 'x2 = ' . $x2;
        } elseif ($dsc == 0) {
            $x = (-$b) / (2 * $a);
            $output .='<br> Решение: <br>' . 'x = ' . $x;
        } else {
            $output .= '<br>' . 'There is NO solve';
        }
    } elseif ($solver === 'v') {
        $output .= '<br>' . 'Введи диапазон поиска корней:' . '<br>' . 'min <input type="text" name="min" value=' . (isset($_GET['min']) ? $_GET['min'] : '') . '><br>
            max <input type="text" name="max" value=' . (isset($_GET['max']) ? $_GET['max'] : '') . '><br><input type="submit" value="Рассчитать">';
        $min = $_GET['min'];
        $max = $_GET['max'];
        if ($min > $max) {
            $min = $_GET['max'];
            $max = $_GET['min'];
            $output .= '<br>' . 'Ты смог!!! Ты перепутал минимум и максимум. Человекам такое свойственно...';
        }
        $k1 = -$b/$a;
        $k2 = $c/$a;
        if ($a != 0){
            for ($x1 = $min; $x1 < $max; $x1 += 0.01) {
                for ($x2 = $min; $x2 < $max; $x2 += 0.01){
                    if (round($x1 + $x2) == $k1 && round($x1*$x2) == $k2) {
                        $r1 = round($x1);
                        $r2 = round($x2);
                        break;
                    }
                }
            }
            if (isset($_GET['min']) && ($r1 == null) && ($r2 == null)) {
                $output .= '<br>' . 'В этом диапазоне корней нет';
            } elseif (isset($_GET['min'])) {
                $output .= '<br> Решение: <br>' . 'x1 = ' . $r1 . '; ' . '<br>' . 'x2 = ' . $r2;
            }

        } else {
            $output .= '<br>' . 'Не трожь Виета без "а"';
        }

    }
} else {
    $output .= '<br>' . 'введите все коэффициенты, иначе ЭТО не похоже на квадратное уравнение';
}
$output .= '</form>';
echo $output;
