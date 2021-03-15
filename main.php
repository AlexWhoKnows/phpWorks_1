<?php

if (!empty($_GET['A']) && $_GET['A'] != 0) {
	$a = $_GET['A'];
	$b = $_GET['B'];
	$c = $_GET['C'];
	$solver = $_GET['solverType'];
	$min = $_GET['min'];
	$max = $_GET['max'];
	if ($solver === 'd') {
		$dsc = $b ** 2 - (4 * $a * $c);
		if ($dsc > 0) {
			$x1 = ((-$b) - pow($dsc, 0.5)) / (2 * $a);
			$x2 = ((-$b) + pow($dsc, 0.5)) / (2 * $a);
			echo '<br> Решение: <br>' . 'x1 = ' . $x1 . ',' . '<br>' . 'x2 = ' . $x2;
		} elseif ($dsc == 0) {
			$x = (-$b) / (2 * $a);
			echo '<br> Решение: <br>' . 'x = ' . $x;
		} else {
			echo '<br>' . 'There is NO solve';
		}
	} elseif ($solver === 'v') {
		if ($min > $max) {
			$min = $_GET['max'];
			$max = $_GET['min'];
			echo '<br>' . 'Ты смог!!! Ты перепутал минимум и максимум. Человекам такое свойственно...';
		}
		$k1 = -$b / $a;
		$k2 = $c / $a;
		if ($a != 0) {
			for ($x1 = $min; $x1 < $max; $x1++) {
				$x2 = round($k1 - $x1);
				if (round($x1 * $x2) == $k2) {
					$r1 = round($x1);
					$r2 = round($x2);
					break;
				}
			}
			if (isset($_GET['min']) && ($r1 == null) && ($r2 == null)) {
				echo '<br>' . 'В этом диапазоне корней нет';
			} elseif (isset($_GET['min'])) {
				echo '<br> Решение: <br>' . 'x1 = ' . $r1 . '; ' . '<br>' . 'x2 = ' . $r2;
			}

		} else {
			echo '<br>' . 'Не трожь Виета без "а"';
		}

	}
} elseif ($_GET['A'] == 0) {
	$x = round(-$_GET['C'] / $_GET['B'], 2);
	echo 'Это же не совсем квадратное уравнение... Но я могу его решить! Вот решение: <br>';
	echo 'x = ' . $x;
} else {
	echo '<br>' . 'введите все коэффициенты, иначе ЭТО не похоже на квадратное уравнение';
}


