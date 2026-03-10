<?php

namespace App\Telegram\Commands;

use App\Actions\UpdateUserSettings;
use SergiX44\Nutgram\Handlers\Type\Command;
use SergiX44\Nutgram\Nutgram;

class UpdateUserSettingsCommand extends Command
{
    protected string $command = 'command';

    protected ?string $description = 'A lovely description.';

    public function handle(Nutgram $bot, UpdateUserSettings $action): void
    {
        $bot->sendMessage('This is a command!');
    }
}
