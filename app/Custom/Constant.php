<?php
/**
 * Created by PhpStorm.
 * User: W
 * Date: 11/11/2017
 * Time: 13:56
 */

namespace App\Custom;


class Constant
{
    //////////  CONSTANTS USED IN CONTROLLER  //////////

    // APPROVAL STATUSES
    const SUBMITTED = 1;
    const PENDING_REJECTION = 2;
    const PENDING_APPROVAL = 3;
    const REJECTED = 4;
    const APPROVED = 5;



    //CHARITYQ ORGID
    const CHARITYQ_ID = 1;

    //APPROVAL STATUS REASON
    CONST STATUS_REASON_DEFAULT = 'Pending Approval';

    // RULE TYPES
    const AUTO_REJECT_RULE = 1;
    const PRE_APPROVE_RULE = 2;

    // ACTIVE FLAGS
    const ACTIVE = 1;
    const INACTIVE = 0;

    //EMAIL TEMPLATE TYPES
    const NEW_BUSINESS = 1;
    const NEW_USER = 2;
    const REQUEST_APPROVED_DEFAULT = 3;
    const REQUEST_APPROVED = 4;
    const REQUEST_REJECTED_DEFAULT = 5;
    const REQUEST_REJECTED = 6;
    const RESET_PASSWORD = 6;

    //USER_ROLES
    const ROOT_USER = 1;
    const TAGG_ADMIN = 2;
    const TAGG_USER = 3;
    const BUSINESS_ADMIN = 4;
    const BUSINESS_USER = 5;

    //DELAYED EMAIL IN DAYS
    const DELAYED_EMAIL_DURATION_FOR_REJECT_REQUESTS = 2;

    //Subscription plans
    const MONTHLY5 = 'MONTHLY';
    const MONTHLY25 = 'MONTHLY';
    const MONTHLY100 = 'MONTHLY';
    const ANUALLY5 = 'ANUALLY';
    const ANUALLY25 = 'ANUALLY';
    const ANUALLY100 = 'ANUALLY';


//////////  END OF CONSTANTS USED  //////////

}