<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ServiceOrders extends Enum
{
    const RepairCompleted = '修理完了';
    const EstimatePending = '見積待ち';
    const Monitoring = '様子見';
    const Other = 'その他';
}