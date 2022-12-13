<?php

namespace i3or1s\EFakture\Model;

enum VatPeriod: string
{
    case JANUARY = 'January';
    case FEBRUARY = 'February';
    case MARCH = 'March';
    case APRIL = 'April';
    case MAY = 'May';
    case JUN = 'Jun';
    case JULY = 'July';
    case AUGUST = 'August';
    case SEPTEMBER = 'September';
    case OCTOBER = 'October';
    case NOVEMBER = 'November';
    case DECEMBER = 'December';
    case FIRST_QUARTER = 'FirstQuarter';
    case SECOND_QUARTER = 'SecondQuarter';
    case THIRD_QUARTER = 'ThirdQuarter';
    case FOURTH_QUARTER = 'FourthQuarter';
}
