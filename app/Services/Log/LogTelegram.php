<?php


namespace App\Services\Log;


use Monolog\Handler\TelegramBotHandler;

class LogTelegram extends TelegramBotHandler
{
    public function write(array $record): void
    {
        $mensagem = "[{$record['level_name']}] - data: {$record['datetime']->format('d/m/Y H:i:s')} - mensagem: {$record['message']}";
        if (isset($record['context']['exception'])) {
            $mensagem .= " - Arquivo: {$record['context']['exception']->getFile()} - Linha: {$record['context']['exception']->getLine()}";
        }
        $record['formatted'] = $mensagem;
        parent::write($record);
    }
}
