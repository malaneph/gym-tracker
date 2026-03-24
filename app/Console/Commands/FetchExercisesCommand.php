<?php

namespace App\Console\Commands;

use App\Models\Exercise;
use Google\Client;
use Google\Service\Sheets;
use Illuminate\Console\Command;

class FetchExercisesCommand extends Command
{
    protected $signature = 'fetch:exercises';

    protected $description = 'Get exercises from the Google spreadsheet';

    public function handle(): void
    {
        $client = new Client();
        $client->setApplicationName('Google Sheets API PHP');
        $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
        $client->setAuthConfig(config('services.gsheets.credentials'));
        $client->setAccessType('offline');

        $service = new Sheets($client);

        $spreadsheetId = config('services.gsheets.spreadsheet_id');  // ID таблицы (в URL)
        $range = 'Exercises!B16:E3094';  // Диапазон данных

        $response = $service->spreadsheets->get($spreadsheetId, [
            'ranges' => $range,
            'includeGridData' => true
        ]);
        $values = $response->getSheets()[0]->getData()[0]->getRowData();

        if (empty($values)) {
            echo "Нет данных.\n";
        } else {
            $result = [];
            foreach ($values as $i => $row) {
                $result[$i] = [];

                if ($i === 0) {
                    $keys = [];
                    foreach ($row as $cell) {
                        $keys[] = $cell->getFormattedValue(); // TODO: сделать по другому получение названий столбцов
                    }
                } else {
                    foreach ($row as $j => $cell) {
                        $result[$i][$keys[$j]] = $cell->getHyperLink() ?? $cell->getFormattedValue();
                    }

                    if (!Exercise::where('name', $result[$i]['name'])->exists()) {
                        Exercise::create($result[$i]);
                    }
                }
            }
        }
    }
}
