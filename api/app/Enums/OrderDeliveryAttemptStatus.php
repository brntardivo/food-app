<?php

enum OrderDeliveryAttemptStatus
{
    case DELIVERED;
    case NO_RECEIVED;
    case ADDRESS_NOT_FOUND;
}
