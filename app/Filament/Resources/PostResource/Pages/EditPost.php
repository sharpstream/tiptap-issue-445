<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
       // If plain text is null it also throws exception so added a fallback. This is not an issue.
       $data['plain_text'] = $data['plain_text'] ?? '';

       // SCENARIOS:

       // Option 1: simply set rich text to be value of plain text (works on everything BUT if it is only numeric)
       $data['rich_text'] = $data['plain_text'];

       // Option 2: use converter to return what tiptap editor wants (same as Option 1)
       /*
       $data['rich_text'] = tiptap_converter()->asHTML($data['plain_text']);
       // or
       $data['rich_text'] = tiptap_converter()->asJSON($data['plain_text']);
       */

       // Workaround A (with <p> tags)
       /*
       if (is_numeric($data['plain_text'])) {
        $data['plain_text'] = '<p>' . $data['plain_text'] . '</p>';
        $data['rich_text'] = $data['plain_text']; //
        $data['plain_text'] = tiptap_converter()->asText($data['rich_text']);
       }
       */

       // Workaround B (with a dot)
       /*
       if (is_numeric($data['plain_text'])) {
          $data['plain_text'] = $data['plain_text'] . '.';
          $data['rich_text'] = $data['plain_text'];
          $data['plain_text'] = tiptap_converter()->asText($data['rich_text']);
       }
       */

       // Workaround C (console log throws an error after refreshing page few times randomly)
       // Note this is my bad and it is likely not supporting <span> tags though it kinda strange that it doesn't.
       // See image: https://imgur.com/a/hjX5QzH
       /*
       if (is_numeric($data['plain_text'])) {
        $data['plain_text'] = '<span>' . $data['plain_text'] . '</span>';
        $data['rich_text'] = $data['plain_text']; //
        $data['plain_text'] = tiptap_converter()->asText($data['rich_text']);
       }
       */

       return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
