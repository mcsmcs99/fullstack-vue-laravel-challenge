<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Customer;
use App\Models\Purchase;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            Customer::create(['name' => 'Matheus Silva', 'email' => 'matheus.silva@example.com']),
            Customer::create(['name' => 'Ana Beatriz Costa', 'email' => 'ana.costa@example.com']),
            Customer::create(['name' => 'João Pedro Almeida', 'email' => 'joao.almeida@example.com']),
            Customer::create(['name' => 'Carla Mendes', 'email' => 'carla.mendes@example.com']),
            Customer::create(['name' => 'Rafael Oliveira', 'email' => 'rafael.oliveira@example.com']),
        ];

        $courses = [
            Course::create(['title' => 'Laravel do Zero ao Avançado', 'description' => 'Aprenda Laravel construindo uma API REST completa.', 'price' => 199.90]),
            Course::create(['title' => 'Vue 3 Completo', 'description' => 'Domine o Vue 3 com Composition API.', 'price' => 249.90]),
            Course::create(['title' => 'JavaScript Moderno', 'description' => 'ES6+ na prática para o dia a dia de desenvolvimento.', 'price' => 299.90]),
            Course::create(['title' => 'APIs REST com Laravel', 'description' => null, 'price' => 349.90]),
            Course::create(['title' => 'Desenvolvimento Full Stack', 'description' => 'Vue no frontend e Laravel no backend, do zero ao deploy.', 'price' => 499.90]),
        ];

        $purchases = [
            ['customer' => 0, 'course' => 0, 'status' => 'paid', 'purchased_at' => '2026-07-05 10:00:00', 'notes' => null, 'amount' => 179.90],
            ['customer' => 0, 'course' => 1, 'status' => 'pending', 'purchased_at' => '2026-09-05 14:30:00', 'notes' => null],
            ['customer' => 0, 'course' => 2, 'status' => 'canceled', 'purchased_at' => '2026-06-20 09:15:00', 'notes' => 'Cliente solicitou reembolso'],
            ['customer' => 1, 'course' => 1, 'status' => 'paid', 'purchased_at' => '2026-08-10 16:45:00', 'notes' => null],
            ['customer' => 1, 'course' => 3, 'status' => 'paid', 'purchased_at' => '2026-07-22 11:20:00', 'notes' => null],
            ['customer' => 1, 'course' => 4, 'status' => 'pending', 'purchased_at' => '2026-09-12 08:00:00', 'notes' => 'Aguardando confirmação de pagamento'],
            ['customer' => 2, 'course' => 0, 'status' => 'paid', 'purchased_at' => '2026-06-30 13:10:00', 'notes' => null, 'amount' => 179.90],
            ['customer' => 2, 'course' => 2, 'status' => 'canceled', 'purchased_at' => '2026-07-15 17:00:00', 'notes' => null],
            ['customer' => 2, 'course' => 4, 'status' => 'paid', 'purchased_at' => '2026-08-25 10:30:00', 'notes' => null],
            ['customer' => 3, 'course' => 1, 'status' => 'paid', 'purchased_at' => '2026-08-01 09:45:00', 'notes' => null, 'amount' => 219.90],
            ['customer' => 3, 'course' => 3, 'status' => 'pending', 'purchased_at' => '2026-09-18 15:00:00', 'notes' => null],
            ['customer' => 3, 'course' => 4, 'status' => 'canceled', 'purchased_at' => '2026-06-10 12:00:00', 'notes' => 'Erro na cobrança'],
            ['customer' => 3, 'course' => 0, 'status' => 'paid', 'purchased_at' => '2026-07-28 14:00:00', 'notes' => null],
            ['customer' => 4, 'course' => 2, 'status' => 'paid', 'purchased_at' => '2026-08-15 10:00:00', 'notes' => null],
            ['customer' => 4, 'course' => 3, 'status' => 'pending', 'purchased_at' => '2026-09-08 09:30:00', 'notes' => null],
            ['customer' => 4, 'course' => 4, 'status' => 'paid', 'purchased_at' => '2026-07-02 16:15:00', 'notes' => null, 'amount' => 449.90],
            ['customer' => 4, 'course' => 1, 'status' => 'pending', 'purchased_at' => '2026-09-20 11:00:00', 'notes' => null],
            ['customer' => 2, 'course' => 3, 'status' => 'paid', 'purchased_at' => '2026-08-05 13:40:00', 'notes' => null],
        ];

        foreach ($purchases as $data) {
            $course = $courses[$data['course']];

            Purchase::create([
                'customer_id' => $customers[$data['customer']]->id,
                'course_id' => $course->id,
                'amount' => $data['amount'] ?? $course->price,
                'status' => $data['status'],
                'purchased_at' => $data['purchased_at'],
                'notes' => $data['notes'],
            ]);
        }
    }
}
