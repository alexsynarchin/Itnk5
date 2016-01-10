<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users') -> delete();
        $users = array(
            array(
                'first_name' => ' Гульнара ',
                'last_name' => 'Фахретдинова',
                'surname' => 'Данисовна',
                'username' => 'test',
                'password' => Hash::make('123'),
                'organization_id' => '1'
            ),
            array(
                'first_name' => ' Гульнара ',
                'last_name' => 'Фахретдинова',
                'surname' => 'Данисовна',
                'username' => '1-0277046397',
                'password' => Hash::make('74hbhxkt'),
                'organization_id' => '2'
            ),
            array(
                'first_name' => 'Галина',
                'last_name' => 'Резепкина ',
                'surname' => 'Александровна',
                'username' => '1-0267011814',
                'password' => Hash::make('eqpwu9dz'),
                'organization_id' => '3'
            ),
            array(
                'first_name' => 'Элина',
                'last_name' => 'Гумарова',
                'surname' => 'Эдуардовна',
                'username' => '1-0274037845',
                'password' => Hash::make('evxjr2f0'),
                'organization_id' => '4'
            ),
            array(
                'first_name' => 'Лилия',
                'last_name' => 'Закирова',
                'surname' => 'Сафовна',
                'username' => '1-0274037980',
                'password' => Hash::make('hs3ptmz2'),
                'organization_id' => '5'
            ),
            array(
                'first_name' => 'Людмила',
                'last_name' => 'Андреева',
                'surname' => 'Ивановна',
                'username' => '1-0269003417',
                'password' => Hash::make('emw341rf'),
                'organization_id' => '6'
            ),
            array(
                'first_name' => 'Алия',
                'last_name' => 'Гумерова',
                'surname' => 'Сибагатулловна ',
                'username' => '1-0274035894',
                'password' => Hash::make('1zcjapgk'),
                'organization_id' => '7'
            ),
            array(
                'first_name' => 'С.',
                'last_name' => 'Ганиуллина',
                'surname' => 'З.',
                'username' => '1-0267001478',
                'password' => Hash::make('79a6s673'),
                'organization_id' => '8'
            ),
            array(
                'first_name' => 'Людмила',
                'last_name' => 'Андреева',
                'surname' => 'Ивановна',
                'username' => '1-0274037595',
                'password' => Hash::make('6zxuyjna'),
                'organization_id' => '9'
            ),
            array(
                'first_name' => 'Руслан',
                'last_name' => 'Баширов',
                'surname' => 'Рафаилович',
                'username' => '1-0267005137',
                'password' => Hash::make('uagn5gwl'),
                'organization_id' => '10'
            ),
            array(
                'first_name' => 'Ринат',
                'last_name' => 'Ильясов',
                'surname' => 'Юлаевич',
                'username' => '1-0274005843',
                'password' => Hash::make('kmtyev9u'),
                'organization_id' => '11'
            ),
            array(
                'first_name' => 'Наталья',
                'last_name' => 'Шаронова',
                'surname' => 'Аркадьевна',
                'username' => '1-0274035799',
                'password' => Hash::make('eju2lcps'),
                'organization_id' => '12'
            ),
            array(
                'first_name' => 'Марина',
                'last_name' => 'Шмелёва',
                'surname' => 'Григорьевна',
                'username' => '1-0274019500',
                'password' => Hash::make('p84xtkrm'),
                'organization_id' => '13'
            ),
            array(
                'first_name' => 'Евгений',
                'last_name' => 'Потапов ',
                'surname' => 'Сергеевич',
                'username' => '1-0264053710',
                'password' => Hash::make('tgnxvwsb'),
                'organization_id' => '14'
            ),
            array(
                'first_name' => 'Анна',
                'last_name' => 'Шумилова ',
                'surname' => 'Олеговна',
                'username' => '1-0274146788',
                'password' => Hash::make('33006rhr'),
                'organization_id' => '15'
            ),
            array(
                'first_name' => 'Татьяна',
                'last_name' => 'Панова',
                'surname' => 'Александровна',
                'username' => '1-0277021681',
                'password' => Hash::make('jo95ccba'),
                'organization_id' => '16'
            ),
            array(
                'first_name' => 'Азамат',
                'last_name' => 'Шаяхметов',
                'surname' => '',
                'username' => '1-0275073412',
                'password' => Hash::make('eq3arw93'),
                'organization_id' => '17'
            ),
            array(
                'first_name' => 'Рафис',
                'last_name' => 'Мухамедьянов ',
                'surname' => 'Гареевич',
                'username' => '1-0274052988',
                'password' => Hash::make('p3ci5v6t'),
                'organization_id' => '18'
            ),
            array(
                'first_name' => 'Лейсан',
                'last_name' => 'Гайсина ',
                'surname' => 'Альфировна',
                'username' => '1-0274112690',
                'password' => Hash::make('8zc83kex'),
                'organization_id' => '19'
            ),
            array(
                'first_name' => 'Ильмира',
                'last_name' => 'Латыпова',
                'surname' => 'Раиловна',
                'username' => '1-0274903453',
                'password' => Hash::make('90r84bdl'),
                'organization_id' => '20'
            ),
            array(
                'first_name' => 'Рамиля',
                'last_name' => 'Крюкова',
                'surname' => 'Сафуановна',
                'username' => '1-0276006338',
                'password' => Hash::make('wu79u7hy'),
                'organization_id' => '21'
            ),
            array(
                'first_name' => 'Оксана',
                'last_name' => 'Сергеева',
                'surname' => 'Валентиновна',
                'username' => '1-0275009960',
                'password' => Hash::make('8nb0hhjy'),
                'organization_id' => '22'
            ),
            array(
                'first_name' => 'Юлия',
                'last_name' => 'Шарафутдинова ',
                'surname' => 'Рамзисовна',
                'username' => '1-270000273',
                'password' => Hash::make('q9m3gnkn'),
                'organization_id' => '23'
            ),
            array(
                'first_name' => 'Зайтуна ',
                'last_name' => 'Туктарова',
                'surname' => 'Гадыевна',
                'username' => '1-0274037250',
                'password' => Hash::make('z8yzgx83'),
                'organization_id' => '24'
            ),
            array(
                'first_name' => 'З',
                'last_name' => 'Шарафутдинова',
                'surname' => 'М',
                'username' => '1-0275002411',
                'password' => Hash::make('cgo6hftn'),
                'organization_id' => '25'
            ),
            array(
                'first_name' => 'Гузель',
                'last_name' => 'Риммовна',
                'surname' => '',
                'username' => '1-0275071849',
                'password' => Hash::make('k387edm4'),
                'organization_id' => '26'
            ),
            array(
                'first_name' => 'Максим',
                'last_name' => 'Красноперов',
                'surname' => '',
                'username' => 'admin',
                'password' => Hash::make('f8463edg7'),
                'organization_id' => '27'
            )
        );
        DB::table('users') -> insert($users);
    }
}
