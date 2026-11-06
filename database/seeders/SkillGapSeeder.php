<?php

namespace Database\Seeders;

use App\Models\AssessmentQuestion;
use App\Models\CareerTarget;
use App\Models\LearningResource;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillGapSeeder extends Seeder
{
    public function run(): void
    {
        $careerData = [
            'frontend-developer' => [
                'title' => 'Frontend Developer',
                'description' => 'Membangun tampilan dan interaksi website menggunakan teknologi frontend.',
                'icon' => 'code',
                'skills' => [
                    ['name' => 'HTML & CSS', 'category' => 'Frontend', 'level' => 4],
                    ['name' => 'JavaScript', 'category' => 'Programming', 'level' => 4],
                    ['name' => 'Git & GitHub', 'category' => 'Tools', 'level' => 3],
                ],
            ],
            'ui-ux-designer' => [
                'title' => 'UI/UX Designer',
                'description' => 'Merancang pengalaman pengguna dan antarmuka aplikasi yang mudah digunakan.',
                'icon' => 'palette',
                'skills' => [
                    ['name' => 'User Research', 'category' => 'Design', 'level' => 3],
                    ['name' => 'Wireframing', 'category' => 'Design', 'level' => 4],
                    ['name' => 'Figma', 'category' => 'Tools', 'level' => 4],
                ],
            ],
            'data-analyst' => [
                'title' => 'Data Analyst',
                'description' => 'Mengolah dan menganalisis data untuk menghasilkan informasi yang berguna.',
                'icon' => 'chart',
                'skills' => [
                    ['name' => 'SQL', 'category' => 'Database', 'level' => 4],
                    ['name' => 'Microsoft Excel', 'category' => 'Data', 'level' => 4],
                    ['name' => 'Data Visualization', 'category' => 'Analytics', 'level' => 3],
                ],
            ],
        ];

        $questions = [
            'HTML & CSS' => 'Seberapa baik kamu membuat struktur halaman web dan mengatur tampilannya dengan CSS?',
            'JavaScript' => 'Seberapa baik kamu menggunakan JavaScript untuk membuat interaksi pada halaman web?',
            'Git & GitHub' => 'Seberapa baik kamu menggunakan Git dan GitHub untuk mengelola kode program?',
            'User Research' => 'Seberapa baik kamu melakukan riset untuk memahami kebutuhan pengguna?',
            'Wireframing' => 'Seberapa baik kamu membuat wireframe sebelum merancang tampilan aplikasi?',
            'Figma' => 'Seberapa baik kamu menggunakan Figma untuk membuat desain antarmuka?',
            'SQL' => 'Seberapa baik kamu menulis query SQL untuk mengambil dan mengolah data?',
            'Microsoft Excel' => 'Seberapa baik kamu menggunakan Excel untuk mengolah dan menganalisis data?',
            'Data Visualization' => 'Seberapa baik kamu menyajikan data dalam bentuk grafik atau visualisasi?',
        ];

        $resourceTitles = [
            'HTML & CSS' => ['Pelajari Dasar HTML', 'Pelajari CSS dan Layout Responsif'],
            'JavaScript' => ['Dasar-Dasar JavaScript', 'DOM dan Event pada JavaScript'],
            'Git & GitHub' => ['Dasar Git dan GitHub'],
            'User Research' => ['Pengantar User Research'],
            'Wireframing' => ['Membuat Wireframe Aplikasi'],
            'Figma' => ['Dasar Desain UI dengan Figma'],
            'SQL' => ['Dasar SQL dan SELECT', 'JOIN dan Agregasi SQL'],
            'Microsoft Excel' => ['Rumus Dasar dan Pengolahan Data Excel'],
            'Data Visualization' => ['Dasar Visualisasi Data'],
        ];

        foreach ($careerData as $slug => $data) {
            $career = CareerTarget::updateOrCreate(
                ['slug' => $slug],
                ['title' => $data['title'], 'description' => $data['description'], 'icon' => $data['icon']]
            );

            $skillIds = [];
            foreach ($data['skills'] as $skillData) {
                $skill = Skill::firstOrCreate(
                    ['name' => $skillData['name']],
                    ['category' => $skillData['category']]
                );
                $career->skills()->syncWithoutDetaching([
                    $skill->id => ['required_level' => $skillData['level']],
                ]);
                $skillIds[$skill->name] = $skill->id;

                AssessmentQuestion::firstOrCreate(
                    ['skill_id' => $skill->id],
                    ['question' => $questions[$skill->name], 'description' => 'Nilai kemampuanmu dari 1 (belum pernah) sampai 5 (sangat mahir).']
                );
            }

            foreach ($data['skills'] as $skillData) {
                $skillId = $skillIds[$skillData['name']];
                foreach ($resourceTitles[$skillData['name']] as $index => $title) {
                    LearningResource::firstOrCreate(
                        [
                            'career_target_id' => $career->id,
                            'skill_id' => $skillId,
                            'title' => $title,
                        ],
                        [
                            'description' => 'Pelajari materi ini secara bertahap, lalu praktikkan dengan membuat latihan kecil.',
                            'level' => $index === 0 ? 'Pemula' : 'Menengah',
                            'sequence' => ($index + 1) + (array_search($skillData, $data['skills'], true) * 2),
                        ]
                    );
                }
            }
        }
    }
}
