<?php
declare(strict_types = 1);

const OPERATION_EXIT = 0;
const OPERATION_ADD = 1;
const OPERATION_DELETE = 2;
const OPERATION_PRINT = 3;
const OPERATION_REPLACE = 4;

global $items;
global $operationNumber;
global $operations;

$operations = [
    OPERATION_EXIT => OPERATION_EXIT . '. Завершить программу.',
    OPERATION_ADD => OPERATION_ADD . '. Добавить товар в список покупок.',
    OPERATION_DELETE => OPERATION_DELETE . '. Удалить товар из списка покупок.',
    OPERATION_PRINT => OPERATION_PRINT . '. Отобразить список покупок.',
    OPERATION_REPLACE => OPERATION_REPLACE . '. Изменить товар из списка покупок.',
];

$items = [];

function clear():void {
// system('clear');
system('cls'); // windows
}

function emptyList():void {
    global $items;
    if (count($items)) {
        echo 'Ваш список покупок: ' . PHP_EOL;
        echo implode("\n", $items) . "\n";
        } else {
            echo 'Ваш список покупок пуст.' . PHP_EOL;
        };
    }

function toDoList(): void
{
    global $operations;
    global $operationNumber;

    $userInput = NULL;
    while ($userInput == NULL) {
        echo 'Выберите операцию для выполнения: ' . PHP_EOL;
        echo implode(PHP_EOL, $operations) . PHP_EOL . '> ';
        $userInput = trim(fgets(STDIN));
        if (!array_key_exists($userInput, $operations)) {
            clear();
            $userInput = NULL;
            echo '!!! Неизвестный номер операции, повторите попытку.' . PHP_EOL;
        }
    }
    $operationNumber = $userInput;
}

function whatOperation():void {
    global $operations;
    global $operationNumber;

        if (!array_key_exists($operationNumber, $operations)) {
            echo 'Выбрана операция: '  . $operations[$operationNumber] . PHP_EOL;
        }
    };

    function addItem():void {
        global $items;
        echo "Введение название товара для добавления в список: \n> ";
            $itemName = trim(fgets(STDIN));  
            $items[] = $itemName;
    }

    function deleteItem():void {
        global $items;
        echo 'Текущий список покупок:' . PHP_EOL;
        echo 'Список покупок: ' . PHP_EOL;
        echo implode("\n", $items) . "\n";

        echo 'Введение название товара для удаления из списка:' . PHP_EOL . '> ';
        $itemName = trim(fgets(STDIN));

        if (in_array($itemName, $items, true) !== false) {
            while (($key = array_search($itemName, $items, true)) !== false) {
                unset($items[$key]);
            }
        }
    }

    
    function replaceItem():void {
        global $items;
        echo 'Текущий список покупок:' . PHP_EOL;
        echo 'Список покупок: ' . PHP_EOL;
        echo implode("\n", $items) . "\n";

        echo 'Введение название товара из списка для изменения:' . PHP_EOL . '> ';
        $itemName = trim(fgets(STDIN));
        echo 'Введение название товара на что заменить:' . PHP_EOL . '> ';
        $key = trim(fgets(STDIN));

        if (in_array($itemName, $items, true) !== false){
            $items = str_replace($itemName, $key, $items);
        } else {
            echo '!!! Неизвестный товар, повторите попытку.' . PHP_EOL;
        }
    }


    function printItem():void {
        global $items;
        echo 'Ваш список покупок: ' . PHP_EOL;
            echo implode(PHP_EOL, $items) . PHP_EOL;
            echo 'Всего ' . count($items) . ' позиций. '. PHP_EOL;
            echo 'Нажмите enter для продолжения';
            fgets(STDIN);
    }

    do {
        clear(); 
        emptyList();
        toDoList();
        whatOperation();

    switch ($operationNumber) {
        case OPERATION_ADD:
            addItem();
            break; 

        case OPERATION_DELETE:
            deleteItem();
            break;

        case OPERATION_REPLACE:
            replaceItem();
            break;    

        case OPERATION_PRINT:
            printItem();
            break;
    }

    echo "\n ----- \n";
} while ($operationNumber > 0);

echo 'Программа завершена' . PHP_EOL;

