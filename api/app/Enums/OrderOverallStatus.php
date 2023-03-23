<?php 

enum OrderOverallStatus {
    case WAITING_ACCEPT;
    case PREPARING;
    case READY_FOR_DELIVERY;
    case DELIVERED;
    case CANCELLED;
}