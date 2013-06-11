<?php

for($i = 0; $i < 500; $i ++)
{
	$sum += (rand(10000,20000) ^ 2) / rand(80000, 120000);
}

echo $sum.'<br>';

for($i = 0; $i < 500; $i ++)
{
	$percentage = (rand(10000,20000) ^ 2) / rand(80000, 120000) / $sum;
}
echo $percentage;