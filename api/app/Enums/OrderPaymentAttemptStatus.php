<?php

enum OrderPaymentAttemptStatus {
    case PAID;
    case ERROR; 
    case PENDING;
    case AWAITING;
}