<?php

namespace Database\Seeders;

use App\Models\MasterClass;
use Illuminate\Database\Seeder;

class MasterClassSeeder extends Seeder
{
    public function run(): void
    {
        if (MasterClass::count() > 0) {
            echo "Мастер-классы уже существуют. Пропускаем.\n";

            return;
        }

        $masterClasses = [
            [
                'category_id' => 1,
                'instructor_id' => 1,
                'title' => 'Моделирование моделей транспорта',
                'description' => 'Мастер-класс научит основам моделирования различных видов транспортных средств. Ученики строят, испытывают и запускают модели судов, самолетов и автомобилей.',
                'date' => '2026-06-05',
                'time_slot' => '13-15',
                'max_participants' => 10,
                'price' => 1500.00,
            ],
            [
                'category_id' => 1,
                'instructor_id' => 1,
                'title' => 'Моделирование зданий и сооружений',
                'description' => 'Опытные педагоги научат моделировать различные элементы малоэтажных жилых и нежилых зданий, конструировать разные виды крыш и стен.',
                'date' => '2026-06-14',
                'time_slot' => '15-17',
                'max_participants' => 8,
                'price' => 1800.00,
            ],
            [
                'category_id' => 2,
                'instructor_id' => 1,
                'title' => 'Шоколадные поделки',
                'description' => 'Шоколадные фонтаны, фруктовые пальмы, приготовление шоколадных конфет, мороженого и других сладостей. Вы готовите только из проверенных компонентов, делаете яства с любовью.',
                'date' => '2026-06-10',
                'time_slot' => '9-11',
                'max_participants' => 12,
                'price' => 2000.00,
            ],
            [
                'category_id' => 2,
                'instructor_id' => 1,
                'title' => 'Приготовление стейков',
                'description' => 'Мы все любим стейки, но не у каждого из нас получается их правильно приготовить. На этом мастер-классе мы расскажем вам всё о стейках.',
                'date' => '2026-06-17',
                'time_slot' => '11-13',
                'max_participants' => 10,
                'price' => 2500.00,
            ],
            [
                'category_id' => 3,
                'instructor_id' => 1,
                'title' => 'Геометрическая резьба по дереву',
                'description' => 'Данный мастер-класс для начинающих, знакомит с геометрической резьбой, с самых основных элементов. Несложными движениями и творческим комбинированием создаются удивительные узоры на дереве.',
                'date' => '2026-06-20',
                'time_slot' => '13-15',
                'max_participants' => 8,
                'price' => 1500.00,
            ],
            [
                'category_id' => 3,
                'instructor_id' => 1,
                'title' => 'Деревянные игрушки',
                'description' => 'На мастер-классе вы научитесь вырезать фигурки животных из качественных пород дерева с помощью профессиональных инструментов.',
                'date' => '2026-06-25',
                'time_slot' => '15-17',
                'max_participants' => 6,
                'price' => 1700.00,
            ],
        ];

        foreach ($masterClasses as $class) {
            MasterClass::create($class);
        }

        echo 'Создано мастер-классов: '.count($masterClasses)."\n";
    }
}
