<?php
session_start();


    if($_SESSION['ismember']==0)
    {
        echo "选择版本，立即使用";

    }
    else if ($_SESSION['duecheck']==0)
    {
        echo "您的会员已过期，请立即续费";

    }
    else if ($_SESSION['numcheck']==0)
    {
        echo "您当月的次数已用尽（60次），请立即续费";
    }


