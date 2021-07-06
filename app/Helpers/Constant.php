<?php


namespace App\Helpers;


class Constant
{
    const NOTIFICATION_TYPE = [
        'General'=>1,
        'Ticket'=>3,
        'Chat'=>4,
    ];
    const VERIFICATION_TYPE = [
        'Email'=>1,
        'Mobile'=>2
    ];
    const VERIFICATION_TYPE_RULES = '1,2';
    const TICKETS_STATUS = [
        'Open'=>1,
        'Closed'=>2
    ];
    const TICKETS_TYPE = [
        'Complain'=>1,
        'Suggestion'=>2,
        'Enquiry'=>3,
        'Others'=>4,
    ];
    const TICKETS_TYPE_RULES = '1,2,3,4';

    const SENDER_TYPE = [
        'User'=>1,
        'Admin'=>2,
    ];
    const MEDIA_TYPES = [
        'Ad'=>1,
    ];
    const ADVERTISEMENT_SELL_TYPE = [
        'InsideWebsite'=>1,
        'OutsideWebsite'=>2,
        'NeverSell'=>3
    ];
    const ADVERTISEMENT_SELL_TYPE_RULES='1,2,3';
    const SETTING_CATEGORY = [
        'Field'=>1,
        'Page'=>2,
    ];
}
