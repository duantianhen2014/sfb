<?php

namespace App\Commands;

use Swoft\Console\Bean\Annotation\Command;
use Swoft\Console\Input\Input;
use Swoft\Console\Output\Output;
use Swoft\Console\Bean\Annotation\Mapping;

/**
 * @Command(coroutine=false, enabled=true, name="sfb")
 */
class GetAdministratorCommand
{

    /**
     * 输出当前的管理员账号和密码
     *
     * @Usage
     * sfb:{command}
     *
     * @Example
     * php bin/swoft sfb:{command}
     *
     * @param Input $input
     * @param Output $output
     *
     * @Mapping("administrator")
     */
    public function administrator(Input $input, Output $output)
    {
        $output->writeln('username:' . config('administrator.administrator.username'));
        $output->writeln('password:' . config('administrator.administrator.password'));
    }
}
