<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Kontak;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KontakControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_kontaks(): void
    {
        $kontaks = Kontak::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('kontaks.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.kontaks.index')
            ->assertViewHas('kontaks');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_kontak(): void
    {
        $response = $this->get(route('kontaks.create'));

        $response->assertOk()->assertViewIs('app.kontaks.create');
    }

    /**
     * @test
     */
    public function it_stores_the_kontak(): void
    {
        $data = Kontak::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('kontaks.store'), $data);

        $this->assertDatabaseHas('kontaks', $data);

        $kontak = Kontak::latest('id')->first();

        $response->assertRedirect(route('kontaks.edit', $kontak));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_kontak(): void
    {
        $kontak = Kontak::factory()->create();

        $response = $this->get(route('kontaks.show', $kontak));

        $response
            ->assertOk()
            ->assertViewIs('app.kontaks.show')
            ->assertViewHas('kontak');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_kontak(): void
    {
        $kontak = Kontak::factory()->create();

        $response = $this->get(route('kontaks.edit', $kontak));

        $response
            ->assertOk()
            ->assertViewIs('app.kontaks.edit')
            ->assertViewHas('kontak');
    }

    /**
     * @test
     */
    public function it_updates_the_kontak(): void
    {
        $kontak = Kontak::factory()->create();

        $data = [
            'nama' => $this->faker->text(255),
            'pesan' => $this->faker->text(),
            'tanggal' => $this->faker->date(),
        ];

        $response = $this->put(route('kontaks.update', $kontak), $data);

        $data['id'] = $kontak->id;

        $this->assertDatabaseHas('kontaks', $data);

        $response->assertRedirect(route('kontaks.edit', $kontak));
    }

    /**
     * @test
     */
    public function it_deletes_the_kontak(): void
    {
        $kontak = Kontak::factory()->create();

        $response = $this->delete(route('kontaks.destroy', $kontak));

        $response->assertRedirect(route('kontaks.index'));

        $this->assertModelMissing($kontak);
    }
}
