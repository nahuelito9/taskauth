<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskApiTest extends TestCase
{

    use RefreshDatabase;
    public function test_rutas_de_tareas_requieren_autenticacion(): void
    {
        $response = $this->getJson('/api/tareas');

        $response->assertStatus(401);
    }

    public function test_usuario_autenticado_puede_crear_tarea(): void
{
    $user = \App\Models\User::factory()->create();

    $response = $this->actingAs($user)->postJson('/api/tareas', [
        'title' => 'Tarea de prueba',
    ]);

    $response->assertStatus(201);
    $response->assertJsonFragment(['title' => 'Tarea de prueba']);
}
    public function test_usuario_puede_completar_su_tarea(): void
{
    $user = \App\Models\User::factory()->create();
    $tarea = $user->tasks()->create(['title' => 'Tarea a completar', 'completed' => false]);

    $response = $this->actingAs($user)->patchJson("/api/tareas/{$tarea->id}/completar");

    $response->assertStatus(200);
    $response->assertJsonFragment(['completed' => true]);
}

    public function test_usuario_puede_borrar_su_tarea(): void
{
    $user = \App\Models\User::factory()->create();
    $tarea = $user->tasks()->create(['title' => 'Tarea a borrar', 'completed' => false]);

    $response = $this->actingAs($user)->deleteJson("/api/tareas/{$tarea->id}");

    $response->assertStatus(200);
    $this->assertDatabaseMissing('tasks', ['id' => $tarea->id]);
}

    public function test_usuario_no_puede_borrar_tarea_de_otro(): void
{
    $usuarioA = \App\Models\User::factory()->create();
    $usuarioB = \App\Models\User::factory()->create();
    $tareaDeA = $usuarioA->tasks()->create(['title' => 'Tarea de A', 'completed' => false]);

    // El usuario B intenta borrar la tarea de A
    $response = $this->actingAs($usuarioB)->deleteJson("/api/tareas/{$tareaDeA->id}");

    $response->assertStatus(404);
    $this->assertDatabaseHas('tasks', ['id' => $tareaDeA->id]);
}

}

