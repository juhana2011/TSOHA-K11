<?php
$dogs = A('db:select * from koirat LEFT JOIN koirien_tulokset ON koirat.reknro=koirien_tulokset.koira');




