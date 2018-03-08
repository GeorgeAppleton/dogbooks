<?php

function strToDatetime($str) {
    return new DateTime(date('Y-m-d', strtotime($str)));
}
