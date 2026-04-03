<?php

namespace App\Console\Commands;

use App\Models\Exercise;
use Google\Client;
use Google\Service\Sheets;
use Illuminate\Console\Command;

class FetchExercisesCommand extends Command
{
    protected $signature = 'fetch:exercises {batch_size=50}';

    protected $description = 'Get exercises from the Google spreadsheet';

    public function handle(): void
    {
        $client = new Client;
        $client->setApplicationName('Google Sheets API PHP');
        $client->setScopes([Sheets::SPREADSHEETS_READONLY]);
        $client->setAuthConfig(config('services.gsheets.credentials'));
        $client->setAccessType('offline');

        $service = new Sheets($client);

        $spreadsheetId = config('services.gsheets.spreadsheet_id');

        $headersResponse = $service->spreadsheets->get($spreadsheetId, [
            'ranges' => 'Exercises!B16:E16',
            'includeGridData' => true,
        ]);
        $headerRow = $headersResponse->getSheets()[0]->getData()[0]->getRowData()[0];
        $keys = array_map(fn($cell) => $cell->getFormattedValue(), iterator_to_array($headerRow));

        $dataResponse = $service->spreadsheets->get($spreadsheetId, [
            'ranges' => 'Exercises!B17:E3094',
            'includeGridData' => true,
        ]);
        $rows = $dataResponse->getSheets()[0]->getData()[0]->getRowData();

        if (empty($rows)) {
            echo "Нет данных.\n";
        } else {
            foreach ($rows as $row) {
                $record = [];
                foreach ($row as $j => $cell) {
                    $record[$keys[$j]] = $cell->getHyperLink() ?? $cell->getFormattedValue();
                }

                if (!Exercise::where('name', $record['name'])->exists()) {
                    Exercise::create($record);
                }
            }
        }
    }
}
